<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Gallery;

class GalleryController extends Controller
{
    public function index(){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        } 
        $galleryItems = Gallery::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $galleryItems = $galleryItems->where('title', 'LIKE', '%'.$_GET['search'].'%');
        }
        $galleryItems = $galleryItems->latest()->paginate($qty); 
        $galleryItems->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
        ]);
        return view('backend.gallery.index', compact('galleryItems'));
    }

    public function viewGallery(){
        $galleryItems = Gallery::orderBy('id', 'desc')->get();  
        return view('backend.gallery.gallery_gallery', compact('galleryItems'));
    }

    public function store(Request $request){
        $file_title_hi = $request->file_title_hi;
        $file_title_en = $request->file_title_en;
        $file_type = $request->file_type; 
        $images = $request->file('selected_file');

        if($file_type == 'image'){
            if ($request->hasFile('selected_file')){
                foreach ($images as $index => $item){
            $originalName = $item->getClientOriginalName(); //get full name of the file with extension
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);   // get full name of the file without extension
            $extension = $item->getClientOriginalExtension();  //get the extension
            $fileName = $index.'_'.$fileName . '_' . time() . '.' . $extension;  // creat new and unique name

            $path = 'public/build/assets/upload/gallery/image/'.$fileName;
            $item->move(public_path('build/assets/upload/gallery/image'), $fileName);
            Gallery::create([
                'title_en' => $file_title_en,
                'title_hi' => $file_title_hi,
                'type' => $file_type,
                'file_path' => $path 
            ]); 
        }
        } 
        }else if($file_type == 'video'){
            if ($request->hasFile('selected_file')){
                foreach ($images as $index => $item){
            $originalName = $item->getClientOriginalName(); //get full name of the file with extension
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);   // get full name of the file without extension
            $extension = $item->getClientOriginalExtension();  //get the extension
            $fileName = $index.'_'.$fileName . '_' . time() . '.' . $extension;  // creat new and unique name

            $path = 'public/build/assets/upload/gallery/video/'.$fileName;
            $item->move(public_path('build/assets/upload/gallery/video'), $fileName);
            Gallery::create([
                'title_en' => $file_title_en,
                'title_hi' => $file_title_hi,
                'type' => $file_type,
                'file_path' => $path 
            ]); 
        }
        } 
        }
       
        return redirect()->back()->with('success', "File uploaded successfully !"); 
    }

    public function updateStatus(Request $request){
        $id = $request->gallery_id;
        $status = $request->gallery_status;
        $gallery_status_update = Gallery::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

    public function edit($id){
        $file_data = Gallery::where('id', $id)->first();
        return response()->json($file_data);
    }


    public function update(Request $request){
        $id = $request->edit_file_id;
        $file_title_hi = $request->edit_file_title_hi; 
        $file_title_en = $request->edit_file_title_en; 
        $file_type = $request->edit_file_type;

        if($request->hasFile('edit_upload_file')){
            $original_name = $request->file('edit_upload_file')->getClientOriginalName();
            $file_name = pathinfo($original_name, PATHINFO_FILENAME);
            $extension = $request->file('edit_upload_file')->getClientOriginalExtension();
            $newFileName = $file_name.'_'.time().'_.'.$extension;

            if($file_type == 'image'){
                $store_path = 'public/build/assets/upload/gallery/image/';
                $request->file('edit_upload_file')->move(public_path('build/assets/upload/gallery/image'), $newFileName);
                Gallery::where('id', $id)->update([
                    'file_path' => $store_path.$newFileName
                ]);
            }else{
                $store_path = 'public/build/assets/upload/gallery/video/';
                $request->file('edit_upload_file')->move(public_path('build/assets/upload/gallery/video'), $newFileName);
                Gallery::where('id', $id)->update([
                    'file_path' => $store_path.$newFileName
                ]);
            }       
        }
        Gallery::where('id', $id)->update([
            'title_hi' => $file_title_hi,
            'title_en' => $file_title_en,
            'type' => $file_type
        ]);

        return redirect()->back()->with('update_success', "File Updated Successfully !");


    }

    public function destroy($id){
        try{
            $file = Gallery::findOrFail($id);
            $destroy_file = $file->delete();
            return response()->json([
                'status' => 200,
                'message' => "File has been deleted !"
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }
}
