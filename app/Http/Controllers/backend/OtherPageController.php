<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\OtherPage;
use Str;
use Auth;
use App\Models\backend\Post;
use App\Models\backend\Page; 
use Session;
use App\Models\backend\PdfFile;
class OtherPageController extends Controller
{
    public function index(){
         if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }

        $page_list = OtherPage::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $page_list = $page_list->where('page_name', 'LIKE', '%'.$_GET['search'].'%');
        }
        $page_list = $page_list->orderBy('id', 'desc')->paginate($qty);
        $page_list->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
        ]);
        return view('backend.pages.other_pages.index', compact('page_list'));
    }

    public function create(){
        return view('backend.pages.other_pages.create');
    }

    public function edit($id){
        $page = OtherPage::where('id', $id)->first();
        // dd($page->toArray());
        return view('backend.pages.other_pages.edit', compact('page'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
            'page_name' => 'required',
            // 'meta_description' => 'max:150',
            // 'short_description' => 'required',
            'slug' => 'required|unique:pages|unique:posts|unique:pdf_pages',
            'page_language' => 'required',
            'thumbnail' => 'mimes:jpg,png,jpeg,webp',
            'page_content' => 'required'
        ]);

        if($request->hasFile('thumbnail')){
            $thumbnailFile = $request->file('thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/thumbnail/other_pages'), $thumbnail_name);  
            OtherPage::where('id', $id)->update(['thumbnail_image'=> $thumbnail_name]);
        } 

        $slug = strtolower(Str::slug($request->slug));   
        $data = [ 
        'page_name' => $request->page_name,
        'meta_title' => $request->meta_title,
        'meta_keyword' => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'short_description' => $request->short_description,
        'slug' => $slug,
        'page_language' => $request->page_language, 
        'page_data' => $request->page_content,  
        ]; 
        $page = OtherPage::where('id', $id)->update($data);  
        return redirect(route('admin.other_pages.index'))->with('page_update_success', 'Page has been successfully updated !');
    }

    public function store(Request $request){
            $validator = $request->validate([
            'page_name' => 'required',
            // 'meta_description' => 'max:150',
            // 'short_description' => 'required',
            'slug' => 'required|unique:pages|unique:posts|unique:pdf_pages',
            'page_language' => 'required',
            'thumbnail' => 'mimes:jpg,png,jpeg,webp',
            'page_content' => 'required'
        ]);

        $thumbnail = '';

        if($request->hasFile('thumbnail')){
            $thumbnailFile = $request->file('thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/thumbnail/other_pages'), $thumbnail_name);
            $thumbnail = $thumbnail_name;  
        } 
        $slug = strtolower(Str::slug($request->slug));   
        $data = [ 
        'page_name' => $request->page_name,
        'meta_title' => $request->meta_title,
        'meta_keyword' => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'short_description' => $request->short_description,
        'slug' => $slug,
        'page_language' => $request->page_language,
        'thumbnail_image' => $thumbnail,
        'page_data' => $request->page_content, 
        'views' => 0,
        ]; 
        $page = OtherPage::create($data);  
        if($page){
            return redirect(route('admin.other_pages.index'))->with('page_success', 'Page has been successfully created !');
        }else{
            return redirect(route('admin.other_pages.index'))->with('page_failed', 'Something went wrong please try again !');
        } 
    }

    public function destroy($id){
        $page = OtherPage::find($id);
        $d_page = $page->delete();
        if($d_page){
            return redirect()->back()->with('delete_success', 'Page has been delete successfully !');
        }else{
            return redirect()->back()->with('delete_failed', 'Something went wrong please try again !');
        } 
    }

    public function updateStatus(Request $request){
        $page_status = $request->page_status;
        $page_id = $request->page_id; 
        $page_status_update = OtherPage::where('id', $page_id)->update(['page_status' => $page_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

    public function getOtherPage($page_slug){ 
        $lang = Session::get('lang');
        $other_page = OtherPage::where('slug', $page_slug)->where('page_language', $lang)->first();
        if(!$other_page){
           return redirect('404');
        }
        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->orderBy('views', 'desc')->paginate(5);
        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
        return view('backend.pages.other_pages.single', compact('other_page', 'popular_article', 'spiritual_collection_pdf'));
    }
}


