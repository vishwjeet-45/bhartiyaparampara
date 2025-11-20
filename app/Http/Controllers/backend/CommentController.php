<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Comment;
use Auth;
use App\Services\NotificationService;
use App\Models\User;
use App\Models\backend\Post;

class CommentController extends Controller
{

    protected $notificationService;
    public function __construct(NotificationService $notificationService){
        $this->notificationService = $notificationService;
    }


    public function index(){
        $user_list = User::get();
        $post_list = Post::get();
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }

        $comment_list = Comment::select('*');

        if(isset($_GET['search']) && $_GET['search'] != ''){
            $comment_list = $comment_list->where('comment', 'LIKE', '%'.$_GET['search'].'%');
        }

        if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'date_desc'){
            $comment_list = $comment_list->orderBy('created_at', 'desc');
        }else if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'date_asc'){
            $comment_list = $comment_list->orderBy('created_at', 'asc');
        } else{
            $comment_list = $comment_list->orderBy('id', 'desc');
        } 

        if(isset($_GET['user']) && $_GET['user'] != ''){
            $comment_list = $comment_list->where('user_id', $_GET['user']);
        }
 
        if(isset($_GET['post']) && $_GET['post'] != ''){
            $comment_list = $comment_list->where('post_id', $_GET['post']);
        }

        if(Auth::user()->user_type != 1){
        $comment_list = $comment_list->where('user_id', Auth::user()->id);
        }
        
        $comment_list = $comment_list->with(['user', 'post', 
        'replies_for_admin.post:id,meta_title', 
        'replies_for_admin.user:id,name,user_type'])
        ->where('parent_id', NULL)->orderBy('id', 'desc')->paginate($qty); 

        $my_reply = Comment::where('user_id', Auth::user()->id)
        ->with(['post', 'parentComment.user', 'parentComment.replies_for_admin', 'parentComment.replies_for_admin.user',
        'parentComment.replies_for_admin.post'])
        ->where('parent_id', '!=', null)
        ->get();

        // return $my_reply; 
        // return dd($my_reply->toArray()); 
        // return dd($comment_list->toArray());
        $comment_list->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
            'select_filter' => isset($_GET['select_filter']) ? $_GET['select_filter'] : '',
            'user' => isset($_GET['user']) ? $_GET['user'] : '',
            'post' => isset($_GET['post']) ? $_GET['post'] : '',
        ]);
        return view('backend.comments.index', compact('comment_list', 'my_reply', 'user_list', 'post_list'));
    }

    public function storeComment(Request $request){
        $validater = $request->validate([
            'comment'=>'required'
        ]); 
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'comment_approval_status' => 2
        ]);
        if($comment){
            $this->notificationService->getNotify(Auth::user()->name. " posted a comment.", "Comment:- ".$request->comment, "comment", 1, "comment", Auth::user()->id);
            return redirect()->back()->with('comment_updated', 'Your insights add value to the discussion. \n Thanks for contributing to our community..!');
        }else{
            return redirect()->back()->with('comment_faild', 'Something went wrong');
        }
    }

    public function storeReply(Request $request){
        $validater = $request->validate([
            'reply'=>'required'
        ]); 

        $reply = Comment::create([
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_id,
            'post_id' => $request->post_id,
            'comment' => $request->reply,
            'comment_approval_status' => 2
        ]);

        if($reply){
            $this->notificationService->getNotify(Auth::user()->name. " reply on a post.", "Reply:- ".$request->reply, "reply", 1, "reply", Auth::user()->id);
            return redirect()->back()->with('reply_updated', 'We appreciate your perspective and the engagement with our content.');
        }else{
            return redirect()->back()->with('comment_faild', 'Something went wrong');
        }
    }

    public function updateStatus(Request $request){
        $c_status = $request->c_status;
        $c_id = $request->c_id; 
        $c_status_update = Comment::where('id', $c_id)->update(['comment_approval_status' => $c_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

    public function updateReplyStatus(Request $request){
        $r_status = $request->r_status;
        $r_id = $request->r_id; 
        $c_status_update = Comment::where('id', $r_id)->update(['comment_approval_status' => $r_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }
}
