<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\MainCategory;
use App\Models\backend\Category;
use App\Models\backend\SubCategory;
use App\Models\backend\Post;
use Illuminate\Support\Str;
use App\Models\User;
use Session;
use Auth;
use Carbon\Carbon;
use App\Models\backend\Like;
use App\Models\backend\SocialMedia;
use Mail;
use App\Mail\PostRejectMail;
use App\Models\backend\PdfFile;
class PostController extends Controller
{
    public function index($lang = 'en'){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 9;
        }

        $posts = Post::select('*')->with('getUser');
        if(Auth::user()->user_type != 1 && Auth::user()->is_team == 0){
            $posts = $posts->where('post_by', Auth::user()->id);
        }

        if(isset($_GET['search']) && $_GET['search'] != ''){
            $posts = $posts->where('meta_title', 'LIKE', '%'.$_GET['search'].'%');
        }

         if(isset($_GET['main_category']) && $_GET['main_category'] != ''){
             $main_cat_id = (int)$_GET['main_category'];
             $posts = $posts->whereJsonContains('main_category_id', $main_cat_id);
         }
        // if(isset($_GET['sub_category']) && $_GET['sub_category'] != ''){
        //     $cat_id = (int)$_GET['sub_category'];
        //     $posts = $posts->whereJsonContains('sub_category_id', $cat_id);
        // }


        if(isset($_GET['writer_name']) && $_GET['writer_name'] != ''){
            $ids = [];

            $users = User::where('name', 'LIKE', '%'.$_GET['writer_name'].'%')->get();
            foreach($users as $user){
                array_push($ids, $user->id);
            }
            $posts = $posts->whereIn('post_by', $ids);
        }

        if(isset($_GET['sort_by_status']) && $_GET['sort_by_status'] != '' && $_GET['sort_by_status'] == '0'){
            $posts = $posts->where('post_approval_status', '0');
        }else if(isset($_GET['sort_by_status']) && $_GET['sort_by_status'] != '' && $_GET['sort_by_status'] == '1'){
                $posts = $posts->where('post_approval_status', '1');
        }else if(isset($_GET['sort_by_status']) && $_GET['sort_by_status'] != '' && $_GET['sort_by_status'] == '2'){
                    $posts = $posts->where('post_approval_status', '2');
            }

        if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'date_desc'){
            $posts = $posts->orderBy('publish_on', 'desc');
        }else if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'date_asc'){
            $posts = $posts->orderBy('publish_on', 'asc');
        }else if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'view_desc'){
            $posts = $posts->orderBy('views', 'desc');
        } else{
            $posts = $posts->orderBy('id', 'desc');
        }


        $posts = $posts->paginate($qty);
        $main_category_list = MainCategory::where('main_category_status', 1)->get();
        $category_list = Category::where('category_status', 1)->get();
        $sub_category_list = SubCategory::where('sub_category_status', 1)->get();

        $posts->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
            'main_category' => isset($_GET['main_category']) ? $_GET['main_category'] : '',
            'writer_name' => isset($_GET['writer_name']) ? $_GET['writer_name'] : '',
            'sort_by_status' => isset($_GET['sort_by_status']) ? $_GET['sort_by_status'] : '',
            'select_filter' => isset($_GET['select_filter']) ? $_GET['select_filter'] : '',
        ]);

        return view('backend.post.index', compact('posts', 'main_category_list', 'category_list', 'sub_category_list'));
    }
    public function create(){
        $main_category = MainCategory::where('main_category_status', 1)->get();
        $user_list = User::where('user_type', 2)->where('writer_account_status', 1)->get();
        return view('backend.post.create', compact('main_category', 'user_list'));
    }
    public function edit($id){
        $post_detail = Post::where('id', $id)->first();
        $m_c_list = MainCategory::where('main_category_status', 1)->get();
        $c_list = Category::where('category_status', 1)->get();
        $s_c_list = SubCategory::where('sub_category_status', 1)->get();
        $user_list = User::whereIn('user_type', [1,2])->where('writer_account_status', 1)
        ->orWhere(function($query){
            $query->where('user_type', 3)
            ->where('is_team', 1);
        })
        ->get();
        return view('backend.post.edit', compact('post_detail', 'm_c_list', 'c_list', 's_c_list', 'user_list'));
    }
    public function store(Request $request){
        // return $request->blog_detail_editor;
        $user_type = Auth::user()->user_type;
        $validater = $request->validate([
            // 'slug' => 'required|unique:posts',
            'post_language' => 'required',
              'thumbnail' => 'nullable|max:1000|image|dimensions:max_width=738,max_height=452',
            'main_category' => 'required',
            // 'blog_detail_editor' => 'required',
            'short_description' => 'required',
        ]);

        $main_category_ids = collect($request->main_category)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all();
          $category_ids = collect($request->category)->map(function ($value) {
            return intval(trim($value, '"'));
          })->all();
          $sub_category_ids = collect($request->sub_category)->map(function ($value) {
            return intval(trim($value, '"'));
          })->all();
        $slug = strtolower(Str::slug($request->slug));
        $data = [
        'post_by' => $request->post_writer_name == '' ? Auth::user()->id : $request->post_writer_name,
        'meta_title' => $request->meta_title,
        'meta_keyword' => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'short_description' => $request->short_description,
        'slug' => $slug,
        'post_language' => $request->post_language,
        'main_category_id' => $main_category_ids,
        'category_id' => $category_ids,
        'sub_category_id' => $sub_category_ids,
        'post_data' => $request->input('blog_detail_editor'),
        'post_status' => 1,
        'post_approval_status' => (Auth::user()->user_type == 1 ? 1 : 2),
        'views' => 0,
        'publish_on' => $request->post_publish_date == '' ? Carbon::now() : date('Y-m-d H:i:s', strtotime($request->post_publish_date)) ,
        ];
        $post = Post::create($data);
        if($request->hasFile('thumbnail')){
            $thumbnailFile = $request->file('thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/thumbnail'), $thumbnail_name);
            Post::where('id', $post->id)->update(['thumbnail_image' => $thumbnail_name]);
        }

        if($post){
            if($user_type==1){
                return redirect(route('admin.post.index'))->with('post_success', 'You have successfully posted !');
            }else if($user_type==2){
                return redirect(route('writer.post.index'))->with('post_success', 'You have successfully posted !');
            }else if($user_type==3){
                return redirect(route('user.post.index'))->with('post_success', 'You have successfully posted !');
            }

         }else{

            if($user_type==1){
                return redirect(route('admin.post.index'))->with('post_fail', 'Something went wrong please try again !');
            }else if($user_type==2){
                return redirect(route('writer.post.index'))->with('post_fail', 'Something went wrong please try again !');
            }else if($user_type==3){
                return redirect(route('user.post.index'))->with('post_fail', 'Something went wrong please try again !');
            }

         }
    }

    public function update(Request $request, $id){
         $validater = $request->validate([
            'slug' => 'required',
            'post_language' => 'required',
             'thumbnail' => 'nullable|max:1000|image|dimensions:max_width=738,max_height=452',
            'main_category' => 'required',
            // 'blog_detail_editor' => 'required',
            'short_description' => 'required',
        ]);
        try{
        $user_type = Auth::user()->user_type;


        if($request->hasFile('thumbnail')){
            $thumbnailFile = $request->file('thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/thumbnail'), $thumbnail_name);
            Post::where('id', $id)->update(['thumbnail_image'=>$thumbnail_name]);
        }

        $main_category_ids = collect($request->main_category)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all();

          $category_ids = collect($request->category)->map(function ($value) {
            return intval(trim($value, '"'));
          })->all();

          $sub_category_ids = collect($request->sub_category)->map(function ($value) {
            return intval(trim($value, '"'));
          })->all();

        $slug = strtolower(Str::slug($request->slug));
        $data = [
        'post_by' => $request->post_writer_name == '' ? Auth::user()->id : $request->post_writer_name,
        'meta_title' => $request->meta_title,
        'meta_keyword' => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'short_description' => $request->short_description,
        'slug' => $slug,
        'post_language' => $request->post_language,
        'main_category_id' => $main_category_ids,
        'category_id' => $category_ids,
        'sub_category_id' => $sub_category_ids,
        'post_data' => $request->blog_detail_editor,
        'post_status' => 1,
        'post_approval_status' => $user_type == 1 || Auth::user()->is_team == 1 ? $request->post_approval_status:2,
        'upcomming_at' => Carbon::now()
        ];
        $post = Post::where('id', $id)->update($data);
        if($request->post_approval_status == 0){
            $user_id = Post::find($id)->post_by;
            $user_detail = User::where('id', $user_id)->first();
            $mailData = [
                'name' => $user_detail->name,
                'email' => $user_detail->email,
                'phone' => $user_detail->phone,
                'reject_msg' =>$request->reject_comment
            ];
            Mail::to($user_detail->email)->send(new PostRejectMail($mailData));
            $post = Post::where('id', $id)->update([
                'approval_comment' => $request->reject_comment
            ]);
        }else{
            $post = Post::where('id', $id)->update([
                'approval_comment' => ''
            ]);
        }
        if($user_type ==  1 || Auth::user()->is_team == 1){
            Post::where('id', $id)->update(['publish_on'=> $request->post_publish_date]);
        }

        if($post){
            if($user_type==1){
                return redirect(route('admin.post.index'))->with('post_success', 'You have successfully updated post  !');
            }else if($user_type==2){
                return redirect(route('writer.post.index'))->with('post_success', 'You have successfully updated post !');
            }else if($user_type==3){
                return redirect(route('user.post.index'))->with('post_success', 'You have successfully updated post !');
            }

         }else{

            if($user_type==1){
                return redirect(route('admin.post.index'))->with('post_fail', 'Something went wrong please try again !');
            }else if($user_type==2){
                return redirect(route('writer.post.index'))->with('post_fail', 'Something went wrong please try again !');
            }else if($user_type==3){
                return redirect(route('user.post.index'))->with('post_fail', 'Something went wrong please try again !');
            }

         }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function view($id){
        $lang = Session::get('lang');
        $post = Post::with('getUser')->find($id);
        $post_detail = Post::where('slug', $post->slug)->with([
            'getUser',
            'comments.user:id,name,profile_image,user_type',
            'comments.replies.user:id,name,profile_image,user_type',
            // 'comments.replies.replies.user:id,name', if need one more deep level comment
          ])->where('post_status', 1)->first();
        //    return $post_detail;
        return view('backend.post.single', compact('post_detail'));
    }

    public function getCategories(Request $request){
        $main_categories = $request->main_categories;
        if(!empty($main_categories) || $main_categories != ''){
        $categories = Category::whereIn('main_category_id', $main_categories)->get();
        if($categories){
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $categories
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'failed'
            ]);
        }
    }

}

    public function getSubCategories(Request $request){
        $categories = $request->categories;
        if(!empty($categories) || $categories != ''){
        $sub_categories = SubCategory::whereIn('category_id', $categories)->get();

        if($sub_categories){
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $sub_categories
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'failed'
            ]);
        }
    }

    }

    public function ckeditorUpload(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('upload/post_img'), $fileName);
            $url = url('public/upload/post_img/' . $fileName);
            // return response()->json(['url' => $url]);
             return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    public function tinyeditorUpload(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $baseUrl = url('/');
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();

        $image->move(public_path('upload/post_img'), $imageName);
        $url = $baseUrl.'/public/upload/post_img/'.$imageName;
        return response()->json(['location' => $url]);
    }

    public function summerNoteEditorUpload(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $baseUrl = url('/');
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();

        $image->move(public_path('upload/post_img'), $imageName);
        $url = $baseUrl.'/public/upload/post_img/'.$imageName;
        // return response()->json(['location' => $url]);
        return $url;
    }

    public function postList($m_cat_name, $cat_name = '', $sub_cat_name = ''){
        $lang = Session::get('lang');
        $new_m_cat_name = $m_cat_name;
        $m_cat_detail = MainCategory::where('slug', $new_m_cat_name)->first();
        if($m_cat_detail == ''){
            return redirect('404');
        }
        $m_cat_id = $m_cat_detail->id;
        $m_cat_name_with_lang = MainCategory::where('id', $m_cat_id)->first();
        $bread_crumb1 = '';
        $bread_crumb2 = '';
        $bread_crumb3 = '';
        $cat_id = '';

        $category_detail['main_cat_detail'] = MainCategory::where('slug', $m_cat_name)->first();
        if($cat_name != ''){
        $category_detail['cat_detail'] = Category::where('slug', $cat_name)->first();
        if($category_detail['cat_detail']  == ''){
            return redirect('404');
        }
        }
        if($sub_cat_name != ''){
        $category_detail['sub_cat_detail'] = SubCategory::where('slug', $sub_cat_name)->first();
        if($category_detail['sub_cat_detail']  == ''){
            return redirect('404');
        }
    }

        $post_list = Post::select('*');
        if($cat_name == '' && $sub_cat_name == ''){
            $post_list=$post_list->whereJsonContains('main_category_id', $m_cat_id);
            $bread_crumb1 = $m_cat_name_with_lang;
        }else if($sub_cat_name == ''){
            $new_cat_name = $cat_name;
            $cat_id = Category::where('slug', $new_cat_name)->first()->id;
            $post_list=$post_list->whereJsonContains('category_id', $cat_id);
            $cat_name_with_lang = Category::where('id', $cat_id)->first();
            $bread_crumb1 = $m_cat_name_with_lang;
            $bread_crumb2 = $cat_name_with_lang;
        }else{
            //breadcrumb for category name (start)
            $new_cat_name = $cat_name;
            $cat_id = Category::where('slug', $new_cat_name)->first()->id;
            $cat_name_with_lang = Category::where('id', $cat_id)->first();
            //breadcrumb for category name (end)

            //breadcrumb for sub category name (start)
            $new_sub_cat_name =  $sub_cat_name;
            $sub_cat_id = SubCategory::where('slug', $new_sub_cat_name)->first()->id;
            $sub_cat_name_with_lang = SubCategory::where('id', $sub_cat_id)->first();
            //breadcrumb for sub category name (end)
            $post_list=$post_list->whereJsonContains('sub_category_id', $sub_cat_id);
            $bread_crumb1 = $m_cat_name_with_lang;
            $bread_crumb2 = $cat_name_with_lang;
            $bread_crumb3 = $sub_cat_name_with_lang;
        }
        $cat_list = Category::where('main_category_id', $m_cat_id)->with('subCategories')->where('category_status', 1)->get();
        $sub_cat_list = SubCategory::where('main_category_id', $m_cat_id)->where('category_id', $cat_id)->where('sub_category_status', 1)->get();
        // return $cat_list;
        $post_list=$post_list->where('post_language', $lang)->with('getUser')->where('post_approval_status', 1)->where('post_status', 1)->orderBy('publish_on', 'desc')->paginate(12);
        // return $post_list;

        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->paginate(5);
        $social_media = SocialMedia::where('user_id', 1)->first();
        // return $post_list;

        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);

        return view('frontend.post.post-list', compact('post_list', 'bread_crumb1', 'bread_crumb2' ,'bread_crumb3',
        'cat_list', 'sub_cat_list', 'm_cat_name', 'cat_name', 'sub_cat_name', 'popular_article', 'social_media',
        'category_detail', 'spiritual_collection_pdf'));
    }

    public function ViewPostFrontend($slug){


        $lang = Session::get('lang');
        $post = Post::where('slug', $slug)->with([
            'getUser',
            'comments.user:id,name,profile_image',
            'comments.replies.user:id,name,profile_image',
            // 'comments.replies.replies.user:id,name', if need one more deep level comment
            ])->where('post_status', 1)->where('post_language', $lang)->first();

            // dd($slug,$post,$lang);
            if(!empty($post) || $post != ''){
                $getCreatedBy = Post::with('getUser')->where('slug', $slug)->first();


                // if(Str::slug($getCreatedBy->getUser->name) != $writer){
                //     return redirect('404');
                // }

                Post::where('slug', $slug)->increment('views');
                $related_post = Post::whereJsonContains('main_category_id', $post->main_category_id)->with('getUser')->where('post_language', $lang)->where('post_approval_status', 1)->get();
                $popular_post = Post::with('getUser')->where('post_language', $lang)->where('post_approval_status', 1)->orderBy('views', 'desc')->paginate(5);
                $users_all_post = Post::with('getUser')->where('post_by', $post->post_by)->where('post_approval_status', 1)->where('post_language', $lang)->orderBy('id', 'desc')->get();
                $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
                // return dd($users_all_post->toArray());

            $like_count = Like::where('post_id', $post->id)->where('like_type', 'like')->count();
            $heart_count = Like::where('post_id', $post->id)->where('like_type', 'heart')->count();

            if(auth::check()){
                $user_action = Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
                if($user_action){
                    $action_type = $user_action->like_type;
                }else{
                    $action_type = 'nothing';
                }
            }else{
                $action_type = 'nothing';
            }

            return view('frontend.post.single', compact('post', 'like_count', 'heart_count', 'action_type', 'related_post',
            'popular_post', 'users_all_post', 'spiritual_collection_pdf'));
        }else{
            return redirect('/');
        }


    }

    public function megaMenu(){
        return view('frontend.post.mega-menu');
    }

    public function getSlug(Request $request){
        $slug = $request->new_slug;
        $id = $request->post_id;
        $slug_data = Post::where('slug', $slug)->where('id', '!=', $id)->get();

        if($slug_data->isEmpty()){
            return response()->json([
                'status' => 200,
                'message' => 'not_exist',
                'data' => $slug_data
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'exist',
                'data' => $slug_data
            ]);
        }

    }

    public function destroyPost(Request $request){
        $id = $request->id;
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'status' => 200,
            'messsage' => 'deleted'
        ]);
    }

    public function checkCreateSlug(Request $request){
        $slug = Str::slug($request->slug);
        $language = $request->language;
        $check_slug = Post::where('slug', $slug)->where('post_language', $language)->first();
            if($check_slug){
                return response()->json([
                    'status' => 400,
                    'message' => 'slug_exist',
                    'table'=> 'main_category'
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'slug_not_exist',
                    'table'=> 'main_category'
                ]);
            }
    }

    public function checkEditSlug(Request $request){
        $slug = Str::slug($request->slug);
        $language = $request->language;
        $id = $request->post_id;
            $check_slug = Post::where('id', '!=', $id)->where('slug', $slug)->where('post_language', $language)->first();
            if($check_slug){
                return response()->json([
                    'status' => 400,
                    'message' => 'slug_exist',
                    'table'=> 'main_category'
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'slug_not_exist',
                    'table'=> 'main_category'
                ]);
            }
    }




}
