<?php

namespace App\Http\Controllers\backend;
use App\Models\backend\Page;
use App\Models\backend\PdfFile;
use Session;
use App\Models\backend\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }

        $page_list = Page::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $page_list = $page_list->where('page_name', 'LIKE', '%'.$_GET['search'].'%');
        }
        $page_list = $page_list->orderBy('id', 'desc')->paginate($qty);

        
        return view('backend.pages.index', compact('page_list'));
    }

    public function create(){
        return view('backend.pages.create');
    }

    public function edit($id){
        $page = Page::where('id', $id)->first();
        return view('backend.pages.edit', compact('page'));
    }
 

    public function update(Request $request){

        $page_id = $request->input('page_id');
        $page_name = $request->input('page_name');
        $meta_title = $request->input('meta_title');
        $meta_keyword = $request->input('meta_keyword');
        $meta_description = $request->input('meta_description');
        $short_description = $request->input('short_description');
        // $slug = $request->input('slug');
        $post_language = $request->post_language;
        $page_status = $request->page_status;
        $blog_detail_editor = $request->blog_detail_editor;

        if($request->hasFile('thumbnail')){
            $thumbnailFile = $request->file('thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/thumbnail/pages'), $thumbnail_name);  
            $page = Page::where('id', $page_id)->update(['thumbnail_image'=> $thumbnail_name]);
        } 


        $page = Page::where('id', $page_id)->update([
            'page_name' => $page_name,
            'meta_title' => $meta_title,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'short_description' => $short_description,
            // 'slug' => $slug,
            'page_status' => $page_status,
            'page_language' => $post_language, 
            'page_data' => $blog_detail_editor, 
        ]);

        return redirect(route('admin.pages.index'))->with('success', 'Page has been successfully updated');

        
    // if($page){
    //         return redirect(route('admin.pages.index'))->with('success', 'Page has been successfully updated');
    //     }else{
    //         return redirect(route('admin.pages.index'))->with('failed', 'Something went wrong');
    //     }
       
    }
    public function frontendViewPage($slug){
        $lang = Session::get('lang'); 
        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->paginate(5);
        $page = Page::where('page_status', 1)->where('slug', $slug)->where('page_language', $lang)->first();
        if($page == ''){
            return redirect('/404');
        }else{
        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
        return view('frontend.pages.index', compact('page', 'popular_article', 'spiritual_collection_pdf'));  
        } 
    }

    
}
