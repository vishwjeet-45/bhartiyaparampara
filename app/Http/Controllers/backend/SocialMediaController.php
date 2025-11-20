<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\SocialMedia;
use Auth;

class SocialMediaController extends Controller
{
    public function index(){
        $social_media_list = SocialMedia::where('user_id', Auth::user()->id)->first();
        return view('backend.social.index', compact('social_media_list'));
    }

    public function edit(string $social_media_name){ 
        $sm = SocialMedia::where('user_id', Auth::user()->id)->first();
        $url = $sm->$social_media_name;
        $status_column = $social_media_name.'_status';
        $status = $sm->$status_column; 
        return response()->json([
            "url" => $url,
            "status" => $status
        ]);
    }

    public function update(Request $request){
        $name = $request->social_media_name;
        $url = $request->edit_social_media_url;
        $status = $request->edit_social_media_status;
        $status_column = $name.'_status';

        $update = SocialMedia::where('user_id', Auth::user()->id)->update([
            $name => $url,
            $status_column => $status
        ]);
        return redirect()->back()->with('update_success', "Successfully Updated");
    }


    public function updateStatus(Request $request){
        $sm_status = $request->sm_status;
        $sm_name = $request->sm_name; 
        $status_column = $sm_name.'_status';
        $c_status_update = SocialMedia::where('user_id', Auth::user()->id)->update([$status_column => $sm_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

}
