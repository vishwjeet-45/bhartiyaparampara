<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\backend\Post;
use App\Models\backend\Comment;
use App\Models\User;
use App\Models\frontend\Newsletter;
use App\Models\backend\Notification;
use App\Models\backend\PdfPage;
use App\Models\backend\Question;
    
class DashboardController extends Controller
{
    public function AdminDashboard(){
        $total_post = Post::count();
        $rejected_post = Post::where('post_approval_status', 0)->count();
        $approved_post = Post::where('post_approval_status', 1)->count();
        $pending_post = Post::where('post_approval_status', 2)->count();
        $total_users = User::where('user_type', 3)->count();
        $total_writers = User::where('user_type', 2)->count();
        $total_newsletter = Newsletter::where('status', 1)->count(); 
        $latest_comment = Comment::with('user')->orderBy('id', 'desc')->paginate(5);
        $letest_question = Question::where('question_status', 1)->orderBy('id', 'desc')->paginate(5);
        

       

        if(Auth::user()->user_type == 1){
            return view('backend.dashboard.admin_dashboard', compact('total_post', 'approved_post', 'pending_post', 'rejected_post',
        'latest_comment', 'total_users', 'total_writers', 'total_newsletter', 'letest_question'));
        }if(Auth::user()->user_type == 3){
            return redirect('user/dashboard');
        }elseif(Auth::user()->user_type == 2){
            return redirect('writer/dashboard');
        }
    }

    public function WriterDashboard(){

        $total_post = Post::where('post_by', Auth::user()->id)->count();
        $rejected_post = Post::where('post_approval_status', 0)->where('post_by', Auth::user()->id)->count();
        $approved_post = Post::where('post_approval_status', 1)->where('post_by', Auth::user()->id)->count();
        $pending_post = Post::where('post_approval_status', 2)->where('post_by', Auth::user()->id)->count();
          
        $latest_comment = Comment::with('user')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);


        if(Auth::user()->user_type == 1){
            return redirect('admin/dashboard');
        }if(Auth::user()->user_type == 3){
            return redirect('user/dashboard');
        }elseif(Auth::user()->user_type == 2){
            return view('backend.dashboard.writer_dashboard', compact('total_post', 'approved_post', 'pending_post', 'rejected_post',
            'latest_comment'));
        }
    }

    public function UserDashboard(){
        if(Auth::user()->user_type == 1){
            return redirect('admin/dashboard');
        }elseif(Auth::user()->user_type == 2){
            return redirect('writer/dashboard');
        }elseif(Auth::user()->user_type == 3){
            return redirect('user/account');
        }
    }

    public function RedirectAdminDashboard(){
        if(Auth::user()->user_type == 2){
            return redirect('writer/dashboard');
        }elseif(Auth::user()->user_type == 1){
            return redirect('admin/dashboard'); 
        }elseif(Auth::user()->user_type == 3){
            return redirect('user/dashboard'); 
        }
    }    

    public function readNotification(Request $request){
        $id = $request->id;

        Notification::where('id', $id)->update([
            'is_read' => 1
        ]);

        $updatedNoti = Notification::find($id);

        return response()->json([
            'status' => 200,
            'message' => 'read',
            'data' => $updatedNoti
        ]);
    }



    public function panelSearch(Request $request){
        $searchKey = $request->searchKey; 
        $output = '';
        if(Auth::user()->user_type == 1){
            $post_result = Post::where('post_approval_status', 1)->where('meta_title', 'LIKE', '%'.$searchKey.'%')->get(); 
        }else if(Auth::user()->user_type == 2){
            $post_result = Post::where('post_approval_status', 1)->where('post_by', Auth::user()->id)->where('meta_title', 'LIKE', '%'.$searchKey.'%')->get(); 
        } 
        $user_result = User::where('name', 'LIKE', '%'.$searchKey.'%')->get(); 
        $pdf_result = PdfPage::where('meta_title_en', 'LIKE', '%'.$searchKey.'%')->get(); 
 

        if (count($post_result) !== 0) {
            foreach($post_result as $post){
                if(Auth::user()->user_type == 1){
                    $output .= '<a class="dropdown-item search-val" href="'.route('admin.post.view', [$post->id]).'" target="_blank">'.$post->meta_title.' (Post)</a>';
                }else if(Auth::user()->user_type == 2){
                    $output .= '<a class="dropdown-item search-val" href="'.route('writer.post.view', [$post->id]).'" target="_blank">'.$post->meta_title.' (Post)</a>';

                }
            }
      } 
      if(Auth::user()->user_type == 1){
         if (count($user_result) !== 0) {
        foreach($user_result as $user){
            if($user->user_type == 2)
        $output .= '<a class="dropdown-item search-val" href="'.route('admin.user.view', [$user->id]).'" target="_blank">'.$user->name.' (Writer)</a>';
            elseif($user->user_type == 3){
        $output .= '<a class="dropdown-item search-val" href="'.route('admin.writer.view', [$user->id]).'" target="_blank">'.$user->name.' (User)</a>';
            }
        }
      } 
    }

    
    if(Auth::user()->user_type == 1){
        if (count($pdf_result) !== 0) {
        foreach($pdf_result as $pdf){
        $output .= '<a class="dropdown-item search-val" href="'.route('admin.pdf_page.edit', [$pdf->id]).'" target="_blank">'.$pdf->meta_title.' (Pdf Page)</a>';
        }
      } 
    }

    if ($output == '') {
        $output = '<a class="dropdown-item search-val"><b>No Result Found</b></a>';
    }
      return $output;
    }



}
