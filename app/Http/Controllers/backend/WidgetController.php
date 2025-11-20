<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\FirstBannerWidget;
use Auth;
use App\Models\backend\Video;

class WidgetController extends Controller
{
    public function firstSliderIndex(){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        } 
        $first_slider_list = FirstBannerWidget::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $first_slider_list = $first_slider_list->where('title', 'LIKE', '%'.$_GET['search'].'%');
        } 
        $first_slider_list = $first_slider_list->orderBy('id', 'desc')->paginate($qty);
        $first_slider_list->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
        ]);
        return view('backend.widget.first_slider.index', compact('first_slider_list'));
    }
    
    public function firstSliderStore(Request $request){
        $title = $request->title;
        $url = $request->url;
        $status = $request->status;

        $first_banner_widget = FirstBannerWidget::create([
            'title' => $title,
            'url' => $url,
            'user_id' => Auth::user()->id
        ]);
        $id = $first_banner_widget->id;
 
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagefullName = $image->getClientOriginalName();
            $imageName = pathinfo($imagefullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $newImageName = time().'banner_image.'.$extension;
            $storePath = 'build/assets/upload/banner/';
            $image->move(public_path($storePath), $newImageName); 

            FirstBannerWidget::where('id', $id)->update([
                'image' => $newImageName
            ]);
        } 
        return redirect()->back(); 
    }

    public function firstSliderEdit(Request $request){
        $id = $request->id;
        $slider = FirstBannerWidget::where('id', $id)->first();
        return response()->json([
            'status'=>200,
            'message' => 'success',
            'data' => $slider
        ]);
    }

    public function firstSliderUpdate(Request $request){
        $id = $request->slider_id;
        $title = $request->edit_title;
        $url = $request->edit_url;
        $status = $request->edit_status;
        if($request->hasFile('edit_image')){
            $image = $request->file('edit_image');
            $imagefullName = $image->getClientOriginalName();
            $imageName = pathinfo($imagefullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $newImageName = time().'banner_image.'.$extension;
            $storePath = 'build/assets/upload/banner/';
            $image->move(public_path($storePath), $newImageName); 

            FirstBannerWidget::where('id', $id)->update([
                'image' => $newImageName
            ]);
        } 
        $first_banner_widget = FirstBannerWidget::where('id', $id)->update([
            'title' => $title,
            'url' => $url, 
            'status' => $status
        ]);
        return redirect()->back();   
    }

    public function firstSliderUpdateStatus(Request $request){
            $id = $request->id;
            $status = $request->status;

            FirstBannerWidget::where('id', $id)->update([
                'status' => $status
            ]);
            return response()->json([
                'status'=>200,
                'message' => 'success'
            ]);
    }

    public function firstSliderDestroy(Request $request){
        $id = $request->id;
        $slider = FirstBannerWidget::where('id', $id)->first();
        $slider->delete();
        return response()->json([
            'status'=>200,
            'message' => 'success'
        ]);

    }
public function videoSectionIndex(){
    if(isset($_GET['qty']) && $_GET['qty'] != ''){
        $qty = $_GET['qty'];
    }else{
        $qty = 10;
    } 
    $video_list = Video::select('*'); 
    if(isset($_GET['search']) && $_GET['search'] != ''){
        $video_list = $video_list->where('title', 'LIKE', '%'.$_GET['search'].'%');
    } 
    $video_list = $video_list->orderBy('id', 'desc')->paginate($qty);
    $video_list->appends([
        'qty' => $qty,
        'search' => isset($_GET['search']) ? $_GET['search'] : '',
    ]);
    return view('backend.widget.videos.index', compact('video_list'));
}

public function videoSectionStore(Request $request){
    $type = $request->type;

    $thumbnail_originalName = $request->file('thumbnail')->getClientOriginalName(); //get full name of the file with extension
        $thumbnail_fileName = pathinfo($thumbnail_originalName, PATHINFO_FILENAME);   // get full name of the file without extension
        $thumbnail_extension = $request->file('thumbnail')->getClientOriginalExtension();  //get the extension
        $thumbnail_fileName = 'thumbnail_' . time() . '.' . $thumbnail_extension;  // creat new and unique name
        $request->file('thumbnail')->move(public_path('build/assets/upload/videos/thumbnail'), $thumbnail_fileName);

    if($type == 'url'){
        Video::create([
            'title_en' => $request->title_en,
            'title_hi' => $request->title_hi,
            'thumbnail' => 'public/build/assets/upload/videos/thumbnail/'.$thumbnail_fileName,
            'video_link' => $request->video_url,
            'type' => $type,
            'status' => 1
        ]);
        return redirect()->back()->with('created', "Successfully Added !");  
    }else if($type == 'file'){
        $originalName = $request->file('video_file')->getClientOriginalName(); //get full name of the file with extension
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);   // get full name of the file without extension
        $extension = $request->file('video_file')->getClientOriginalExtension();  //get the extension
        $fileName = 'video_' . time() . '.' . $extension;  // creat new and unique name
        $request->file('video_file')->move(public_path('build/assets/upload/videos'), $fileName);
        Video::create([
            'title_en' => $request->title_en,
            'title_hi' => $request->title_hi,
            'thumbnail' => 'public/build/assets/upload/videos/thumbnail/'.$thumbnail_fileName,
            'video_link' => 'public/build/assets/upload/videos/'.$fileName,
            'type' => $type,
            'status' => 1
        ]);
        return redirect()->back()->with('created', "Successfully Added !");  
    }   

}

public function videoSectionDestroy(Request $request){
    $id = $request->id;
    $video = Video::find($id);
    $video->delete();
  return redirect()->back();
}

public function videoSectionEdit(Request $request){
    $id = $request->id;
    $video = Video::where('id', $id)->first();
    return response()->json($video);
}

public function videoSectionUpdate(Request $request){
    $type = $request->type;
    $id = $request->row_id;
 
    if($type == 'url'){ 
        if($request->hasFile('edit_url_thumbnail')){
            $thumbnail_originalName = $request->file('edit_url_thumbnail')->getClientOriginalName(); //get full name of the file with extension
            $thumbnail_fileName = pathinfo($thumbnail_originalName, PATHINFO_FILENAME);   // get full name of the file without extension
            $thumbnail_extension = $request->file('edit_url_thumbnail')->getClientOriginalExtension();  //get the extension
            $thumbnail_fileName = 'thumbnail_' . time() . '.' . $thumbnail_extension;  // creat new and unique name
            $request->file('edit_url_thumbnail')->move(public_path('build/assets/upload/videos/thumbnail'), $thumbnail_fileName);
            Video::where('id', $id)->update([
                'thumbnail' =>  'public/build/assets/upload/videos/thumbnail/'.$thumbnail_fileName
            ]);
        }
        Video::where('id', $id)->update([
            'title_en' => $request->edit_url_title_en,
            'title_hi' => $request->edit_url_title_hi,
            'video_link' => $request->edit_video_url,
            'type' => $type
        ]);

    }else if($type == 'file'){

        if($request->hasFile('edit_upload_video_file')){
        $originalName = $request->file('edit_upload_video_file')->getClientOriginalName(); //get full name of the file with extension
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);   // get full name of the file without extension
        $extension = $request->file('edit_upload_video_file')->getClientOriginalExtension();  //get the extension
        $fileName = 'video_' . time() . '.' . $extension;  // creat new and unique name
        $request->file('edit_upload_video_file')->move(public_path('build/assets/upload/videos'), $fileName);
        Video::where('id', $id)->update([
            'video_link' =>  'public/build/assets/upload/videos/'.$fileName,
        ]);
    } 
    if($request->hasFile('edit_upload_thumbnail')){
        $thumbnail_originalName = $request->file('edit_upload_thumbnail')->getClientOriginalName(); //get full name of the file with extension
        $thumbnail_fileName = pathinfo($thumbnail_originalName, PATHINFO_FILENAME);   // get full name of the file without extension
        $thumbnail_extension = $request->file('edit_upload_thumbnail')->getClientOriginalExtension();  //get the extension
        $thumbnail_fileName = 'thumbnail_' . time() . '.' . $thumbnail_extension;  // creat new and unique name
        $request->file('edit_upload_thumbnail')->move(public_path('build/assets/upload/videos/thumbnail'), $thumbnail_fileName);
        Video::where('id', $id)->update([
            'thumbnail' =>  'public/build/assets/upload/videos/thumbnail/'.$thumbnail_fileName
        ]);
    }
        Video::where('id', $id)->update([
            'title_en' => $request->edit_upload_title_en,
            'title_hi' => $request->edit_upload_title_hi,
            'type' => $type
        ]);
    
}
        return redirect()->back()->with("updated", "Successfully Updated !");  

}


public function videoSectionUpdateStatus(Request $request){
    $status = $request->status;
    $id = $request->id; 
    $status_update = Video::where('id', $id)->update(['status' => $status]);
    return response()->json([
        'status' => 200,
        'message' => 'status_updated'
    ]);
}
}
