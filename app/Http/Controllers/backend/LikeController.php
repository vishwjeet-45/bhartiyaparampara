<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Post;
use App\Models\backend\Like;

class LikeController extends Controller
{
    public function Like(Request $request){
        $post_id = $request->post_id; 
        $user_id = $request->user_id;
        
        if($user_id == 0){
            return redirect('/login');
        }else{
        $like_type = $request->like_type; 
        $post = Post::where('id', $post_id)->get();  
        $like = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
        if($like){
            if($like_type === $like->like_type){
                $like->delete();
                return response()->json([
                    "status" => 200,
                    "message" => $like_type."_removed",
                    "like_type" => $like_type
                ]);
            }else{
                $like->delete();
                Like::create([
                    'user_id' => $user_id,
                    'post_id' => $post_id, 
                    'like_type' => $like_type,
                ]);
                return response()->json([
                    "status" => 200,
                    "message" => $like->like_type."_removed_and_".$like_type."_created",
                    "like_type" => $like_type,
                ]);
            } 
            
        }else{  // Create First time like or heart 
            Like::create([
                'user_id' => $user_id,
                'post_id' => $post_id, 
                'like_type' => $like_type,
            ]);
            return response()->json([
                "status" => 200,
                "message" => "new_".$like_type."_created",
                "like_type" => $like_type,
            ]);
        } 
    }   
    }



}
