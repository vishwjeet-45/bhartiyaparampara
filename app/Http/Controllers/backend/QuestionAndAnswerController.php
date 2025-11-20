<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Question;
use Auth;
use App\Models\backend\Answer;
use App\Models\backend\MainCategory;
use App\Models\backend\Notification;
use App\Services\NotificationService;
use App\Models\backend\Post;
use Session;
use App\Models\backend\PdfFile;

class QuestionAndAnswerController extends Controller
{
    protected $notificationService;
    public function __construct(NotificationService $notificationService){
        $this->notificationService = $notificationService;
    }


    public function index(){

        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }
 
    $que_list = Question::select('*')->with(['user:id,name,user_type', 'answers_for_admin.user', 'answers_for_user.user:id,name,user_type', 'mainCategory']);
    if(isset($_GET['search']) && $_GET['search'] != ''){
        $que_list = $que_list->where('question_en', 'LIKE', '%'.$_GET['search'].'%');
    } 
    if(isset($_GET['main_cat_filter']) && $_GET['main_cat_filter'] != ''){
        $que_list = $que_list->where('main_category_id', $_GET['main_cat_filter']);
    }

    if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'date_desc'){
        $que_list = $que_list->orderBy('created_at', 'desc');
    }else if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'date_asc'){
        $que_list = $que_list->orderBy('created_at', 'asc');
    }else if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'view_desc'){
        $que_list = $que_list->orderBy('views', 'desc');
    }else if(isset($_GET['select_filter']) && $_GET['select_filter'] != '' && $_GET['select_filter'] == 'view_asc'){
        $que_list = $que_list->orderBy('views', 'asc');
    }  else{
        $que_list = $que_list->orderBy('id', 'desc');
    } 

    $que_list = $que_list->paginate($qty);

    $main_cat_list = MainCategory::where('main_category_status', 1)->get();
    $que_list->appends([
        'qty' => $qty,
        'search' => isset($_GET['search']) ? $_GET['search'] : '',
        'select_filter' => isset($_GET['select_filter']) ? $_GET['select_filter'] : '',
    ]);
    // return $que_list;
        return view('backend.question_and_answer.index', compact('que_list', 'main_cat_list'));
    }

    public function store(Request $request){
        
        $question = Question::create([
            'main_category_id' => $request->question_category,
            'question_en' => $request->question_en,
            'question_hi' => $request->question_hi,
            'user_id' => Auth::user()->id,
            'question_status' => $request->question_status
        ]);

      if($question){
        return redirect(url()->current())->with('que_posted_success', "Your question has been posted successfully");
      }else{
        return redirect(url()->current())->with('que_posted_failed', 'Something went wrong please try again... !');
      }
    }

    public function edit(string $id){
        $data = Question::find($id);
        return response()->json([
            "status" => 200,
            "q_detail" => $data
        ]);
    }


    public function update(Request $request){
        $update_question = Question::where('id', $request->edit_q_id)->update([
            'question_en' => $request->edit_question_en, 
            'question_hi' => $request->edit_question_hi, 
            'main_category_id' => $request->edit_question_category, 
            'question_status' => $request->edit_question_status
        ]);

        if($update_question){
            return redirect()->back()->with('update_success', 'Question has been update successfully !');
        }else{
            return redirect()->back()->with('update_failed', 'Something went wrong please try again !');
        } 
    }

    public function updateStatus(Request $request){
        $q_status = $request->q_status;
        $q_id = $request->q_id; 
        $q_status_update = Question::where('id', $q_id)->update(['question_status' => $q_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

    public function updateAnswerStatus(Request $request){
        $a_status = $request->a_status;
        $a_id = $request->a_id; 
        $q_status_update = Answer::where('id', $a_id)->update(['answer_approval_status' => $a_status]);
       if($q_status_update){
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }else{
        return response()->json([
            'status' => 400,
            'message' => 'failed'
        ]);
    }

    }

    public function frontView(){
        $lang = Session::get('lang');
        $q_and_a_list = Question::with(['answers.user', 'mainCategory'])->where('question_status', 1)->orderBy('id', 'desc')->paginate(10);  
        // dd($q_and_a_list->toArray());
        $popular_post = Post::with('getUser')->where('post_language', $lang)->where('post_approval_status', 1)->orderBy('views', 'desc')->paginate(5);
        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
        return view('backend.question_and_answer.front-view', compact('q_and_a_list','popular_post', 'spiritual_collection_pdf' ));

    }

    public function destroy(string $id){
        $question = Question::findOrFail($id);
        $q_delete = $question->delete();
        $ans_list = Answer::where('question_id', $id)->delete();

        if($q_delete){
            return redirect()->back()->with('delete_success', 'Question has been delete successfully !');
        }else{
            return redirect()->back()->with('delete_failed', 'Something went wrong please try again !');
        } 
    }

    public function postAnswer(Request $request){ 
        $answer = Answer::create([
            'user_id' => Auth::user()->id,
            'question_id' => $request->q_id,
            'answer' => $request->answer, 
            'answer_approval_status' => 0, 
        ]);
          $this->notificationService->getNotify(Auth::user()->name. " posted an answer.", "Ans:- ".$request->answer, "answer", 1, "answer", Auth::user()->id);
        if($answer){
            return redirect()->back()->with('q_post_success', 'Thanks for reaching out!, Question sent successfully!');
        }else{
            return redirect()->back()->with('q_post_fail', 'Something Went Wrong...!');
        }
    }
}
