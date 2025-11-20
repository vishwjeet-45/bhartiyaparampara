<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\PdfFile;
use Illuminate\Http\Request;
use App\Models\backend\PdfPage;
use Carbon\Carbon;

class PdfFileController extends Controller
{
    public function index(){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }
        $pdf_page_list = PdfPage::where('page_status', 1)->get();
        $pdf_file_list = PdfFile::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $pdf_file_list = $pdf_file_list->where('pdf_file_title', 'LIKE', '%'.$_GET['search'].'%');
        }
        if(isset($_GET['pdf_page']) && $_GET['pdf_page'] != ''){
            $pdf_file_list = $pdf_file_list->where('pdf_page_id', $_GET['pdf_page']);
        }

        $pdf_file_list = $pdf_file_list->orderBy('id', 'desc')->paginate($qty);
        $pdf_file_list->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
            'pdf_page' => isset($_GET['pdf_page']) ? $_GET['pdf_page'] : '',
        ]);
        return view('backend.pdf_upload.index', compact('pdf_file_list', 'pdf_page_list'));
    } 

    public function create(){
        $pdf_page_list = PdfPage::where('page_status', 1)->get();
        return view('backend.pdf_upload.create', compact('pdf_page_list'));
    }

    public function store(Request $request){
        $year = Carbon::now()->format('Y');
        // $validater = $request->validate([
        //     'file_title' => 'required',
        //     'short_description' => 'required',
        //     'main_page' => 'required', 
        //     'thumbnail' => 'required|mimes:png,jpg,jpeg,webp', 
        //     'pdf_file' => 'required|mimes:pdf',
        //     'language' => 'required'
        // ]);

        
        $pdf_file_id = PdfFile::create([
            'pdf_file_title_hi' => $request->file_title_hi,
            'pdf_file_title_en' => $request->file_title_en,
            'pdf_page_id' => $request->main_page,
            'short_description_hi' => $request->short_description_hi,
            'short_description_en' => $request->short_description_en,
            'file_status' => 1,
            'file_language' => $request->language,
            'downloads' => 0
            ])->id;
            
            

            if($request->date != ''){
                PdfFile::where('id', $pdf_file_id)->update(['created_at'=> $request->date]);
            }

            if($request->hasFile('thumbnail')){
                $thumbnailFile = $request->file('thumbnail');
                $originalThumbnailName = $thumbnailFile->getClientOriginalName();
                $thumbnail_name = time().'.'.$thumbnailFile->extension();
                $thumbnailFile->move(public_path('build/assets/upload/thumbnail/pdf_file_thumbnail'), $thumbnail_name); 
                PdfFile::where('id', $pdf_file_id)->update(['thumbnail'=> $thumbnail_name]);
            }
           
            if($request->hasFile('pdf_file')){
                $pdfFile = $request->file('pdf_file');
                $originalPDFName = $pdfFile->getClientOriginalName();
                $pdf_name = time().'.'.$pdfFile->extension();
                $pdfFile->move(public_path('magazine/'.$year), $originalPDFName); 
                PdfFile::where('id', $pdf_file_id)->update(['pdf_file'=> $originalPDFName, 'year'=>$year]); 
            }
            return redirect(route('admin.upload_pdf.index'))->with('file_upload_success', 'PDF has been uploaded successfully...!');
    }

    public function edit($id){
        $pdf_file = PdfFile::where('id', $id)->first();
        $pdf_page_list = PdfPage::where('page_status', 1)->get();
        return view('backend.pdf_upload.edit', compact('pdf_file', 'pdf_page_list'));
    }

    public function update(Request $request, $id){
        $year = Carbon::now()->format('Y');
        $validater = $request->validate([
            'file_title_hi' => 'required',
            'file_title_en' => 'required',
            'short_description_hi' => 'required',
            'short_description_en' => 'required',
            'main_page' => 'required', 
            'thumbnail' => 'mimes:png,jpg,jpeg,webp', 
            'pdf_file' => 'mimes:pdf'
        ]);

        $pdf_file_id = PdfFile::where('id', $id)->update([
            'pdf_file_title_hi' => $request->file_title_hi,
            'pdf_file_title_en' => $request->file_title_en,
            'pdf_page_id' => $request->main_page,
            'short_description_hi' => $request->short_description_hi,
            'short_description_en' => $request->short_description_en,
            'file_status' => 1,
            'file_language' => $request->language,
            'downloads' => $request->downloads,
            'year' => $request->year
        ]);

        if($request->date != ''){
            PdfFile::where('id', $id)->update(['created_at'=> $request->date]);

        }

            if($request->hasFile('thumbnail')){
                $thumbnailFile = $request->file('thumbnail');
                $originalThumbnailName = $thumbnailFile->getClientOriginalName();
                $thumbnail_name = time().'.'.$thumbnailFile->extension();
                $thumbnailFile->move(public_path('build/assets/upload/thumbnail/pdf_file_thumbnail'), $thumbnail_name); 
                PdfFile::where('id', $id)->update(['thumbnail'=> $thumbnail_name]);
            }

            if($request->hasFile('pdf_file')){
                $pdfFile = $request->file('pdf_file');
                $originalPDFName = $pdfFile->getClientOriginalName(); 
                $pdf_name = time().'.'.$pdfFile->extension();
                $pdfFile->move(public_path('magazine/'.$request->year), $originalPDFName);  
                // $pdfFile->move(public_path('build/assets/upload/pdf_pages/pdf_files'), $pdf_name); 
                PdfFile::where('id', $id)->update(['pdf_file'=> $originalPDFName]); 
            }

            return redirect(route('admin.upload_pdf.index'))->with('file_update_success', 'PDF has been update successfully...!');

    }

    public function updateStatus(Request $request){
        $pdf_file_status = $request->pdf_file_status;
        $pdf_file_id = $request->pdf_file_id; 
        $pdf_file_status_update = PdfFile::where('id', $pdf_file_id)->update(['file_status' => $pdf_file_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

    public function destroy($id){
        $pdf_file = PdfFile::findOrFail($id);
        $pdf_file_delete = $pdf_file->delete();

        if($pdf_file_delete){
            return redirect()->back()->with('delete_success', 'File has been delete successfully !');
        }else{
            return redirect()->back()->with('delete_failed', 'Something went wrong please try again !');
        } 
    }
}
