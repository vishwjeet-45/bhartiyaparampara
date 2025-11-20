<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\PdfPage;
use Str;
use App\Models\backend\PdfFile;
use Session;
use App\Models\backend\Post;
use App\Models\backend\SocialMedia;
class PdfPageController extends Controller
{
    public function index(){
        
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }  

        $pdf_page_list = PdfPage::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $pdf_page_list = $pdf_page_list->where('page_name_en', 'LIKE', '%'.$_GET['search'].'%');
        }
        $pdf_page_list = $pdf_page_list->orderBy('id', 'desc')->paginate($qty); 
        return view("backend.pdf_pages.index", compact('pdf_page_list'));
    }

    public function create(){
        return view("backend.pdf_pages.create");
    }

    public function store(Request $request){
        $validater = $request->validate([
            'page_name_en' => 'required|unique:pdf_pages',
            'page_name_hi' => 'required|unique:pdf_pages',
            'slug' => 'required|unique:pdf_pages',
            'thumbnail' => 'required|mimes:png,jpg,jpeg,webp',  
            // 'short_description' => 'required', 
        ]);


        if($request->hasFile('thumbnail')){
            $thumbnailFile = $request->file('thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/pdf_pages/thumbnail/'), $thumbnail_name);  
        }

        // return $thumbnail_name;
        $slug = strtolower(Str::slug($request->slug));  
        $data = [ 
            'page_name_en' => $request->page_name_en,
            'page_name_hi' => $request->page_name_hi,

            'meta_title_en' => $request->meta_title_en,
            'meta_description_en' => $request->meta_description_en,
            'meta_keyword_en' => $request->meta_keywords,

            'meta_title_hi' => $request->meta_title_hi,
            'meta_description_hi' => $request->meta_description_hi, 

            'short_description' => $request->short_description,
            'slug' => $slug,
            'page_language' => $request->page_language,
            'thumbnail_image' => $thumbnail_name,
            'views' => 0, 
            ]; 
            $pdf_page = PdfPage::create($data);
            if($pdf_page){
                return redirect(route('admin.pdf_page.index'))->with('pdf_page_success', 'Page created successfully...!');
            }else{
                return redirect(route('admin.pdf_page.index'))->with('pdf_page_fail', 'Something went wrong please try again !');
            }



    }

    public function edit($id){
        $pdf_page = PdfPage::find($id);
        if($pdf_page){
            return view('backend.pdf_pages.edit', compact('pdf_page'));
        }else{
            return redirect()->back()->with('page_not_found', 'This page is not available...!');
        }
    }

    public function update(Request $request, $id){
        $validater = $request->validate([
            'page_name_en' => 'required',
            'page_name_hi' => 'required',
            'slug' => 'required', 
            // 'thumbnail' => 'required',  
            // 'short_description' => 'required', 
        ]);


        if($request->hasFile('thumbnail')){
            $thumbnailFile = $request->file('thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/pdf_pages/thumbnail/'), $thumbnail_name);  
            PdfPage::where('id', $id)->update(['thumbnail_image' => $thumbnail_name]);
        }

        // return $thumbnail_name;
        $slug = strtolower(Str::slug($request->slug));  
        $data = [ 
            'page_name_en' => $request->page_name_en,
            'page_name_hi' => $request->page_name_hi,
            'meta_title_en' => $request->meta_title_en,
            'meta_keyword_en' => $request->meta_keywords,
            'meta_description_en' => $request->meta_description_en,
            'meta_title_hi' => $request->meta_title_hi, 
            'meta_description_hi' => $request->meta_description_hi,
            'short_description' => $request->short_description,
            'slug' => $slug,
            'page_language' => $request->page_language, 
            'views' => 0, 
            ]; 
            $update_pdf_page = PdfPage::where('id', $id)->update($data); 
                return redirect(route('admin.pdf_page.index'))->with('pdf_page_update_success', 'Page updated successfully...!'); 
    }

    public function updateStatus(Request $request){
        $pdf_page_status = $request->pdf_page_status;
        $pdf_page_id = $request->pdf_page_id;
        $update_status = PdfPage::where('id', $pdf_page_id)->update(['page_status' => $pdf_page_status]);
        if($update_status){
            return response()->json([
                'status'=>200,
                'message' =>'status_updated'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function destroy($id){
        $pdf_page = PdfPage::findOrFail($id);
        $pdf_page_delete = $pdf_page->delete(); 
        if($pdf_page_delete){
            return redirect()->back()->with('delete_success', 'Page has been delete successfully !');
        }else{
            return redirect()->back()->with('delete_failed', 'Something went wrong please try again !');
        } 
    }

    public function frontViewPdfPage($slug){ 
        $lang = Session::get('lang');
        $pdf_page = PdfPage::where('slug', $slug)->first();

        if($pdf_page == ''){
            return redirect('404');
        }else{
        $pdf_page_id = $pdf_page->id;
        $page_detail = PdfPage::where('id', $pdf_page_id)->first();
        $pdf_file_list = PdfFile::where('pdf_page_id', $pdf_page_id)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(12);
        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->paginate(5);
        $social_media = SocialMedia::where('user_id', 1)->first();

        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
        return view('backend.pdf_pages.front-view', compact('pdf_file_list', 'social_media', 'popular_article',
        'page_detail', 'spiritual_collection_pdf'));
        }
    }

    public function updateDownloadCount(Request $request)
    { 
        $fileId = $request->input('file_id');
        // Assuming you have a 'File' model for your files
        $file = PdfFile::find($fileId); 
        if ($file) {
            $file->downloads++;
            $file->save();
        } 
        return response()->json(['success' => true]);
    }
    


}
