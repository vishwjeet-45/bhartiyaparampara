<?php

namespace App\Http\Controllers\customauth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\backend\Post;
use App\Services\NotificationService;
use Session;
use URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\UserRegisterMail;
use App\Mail\WriterApproveMail;
use App\Mail\WriterRejectMail;
use App\Mail\BlockUserEmail;
use App\Models\backend\SocialMedia;
use App\Models\backend\OtherPage;
use App\Models\backend\PdfPage;
use App\Models\backend\MainCategory;
use App\Models\backend\Category;
use App\Models\backend\SubCategory;
use App\Models\backend\PdfFile;
use Illuminate\Support\Str;





use Illuminate\Http\RedirectResponse;


class UserController extends Controller
{
    protected $notificationService;
    public function __construct(NotificationService $notificationService){
        $this->notificationService = $notificationService;
    }
    // backend user manage function (starts)
    public function WriterList(){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 9;
        }
        $writer_list = User::select('*');

        if(isset($_GET['status']) && $_GET['status'] != ''){
            if($_GET['status'] == 'blocked'){
            $writer_list = $writer_list->where('is_block', 1);
            }else{
                $writer_list = $writer_list->where('writer_account_status', $_GET['status'])->where('is_block', 0);
            }
        }

        if(isset($_GET['search']) && $_GET['search'] != ''){
            $writer_list = $writer_list->where('name', 'LIKE', '%'.$_GET['search'].'%');
        }

        $writer_list = $writer_list->whereIn('user_type', [2])->with('SocialMedia')->orderBy('id', 'desc')->paginate($qty);

        $total_post = [];
        $approve_post = [];
        $pending_post = [];

        foreach($writer_list as $writer){
            $total_post_count = Post::where('post_by', $writer->id)->count();
            $total_post[$writer->id] = $total_post_count;
        }
        foreach($writer_list as $writer){
            $approve_post_count = Post::where('post_by', $writer->id)->where('post_approval_status', 1)->count();
            $approve_post[$writer->id] = $approve_post_count;
        }
        foreach($writer_list as $writer){
            $pending_post_count = Post::where('post_by', $writer->id)->where('post_approval_status', 2)->count();
            $pending_post[$writer->id] = $pending_post_count;
        }
        $writer_list->appends([
            'qty' => $qty,
            'status' => isset($_GET['status']) ? $_GET['status'] : '',
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
        ]);

        return view('backend.user.writer-list', compact('writer_list', 'total_post', 'approve_post', 'pending_post'));
    }

    public function UserList(){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 9;
        }

        $user_list = User::select('*');
        if(isset($_GET['status']) && $_GET['status'] != ''){
                $user_list = $user_list->where('is_block', $_GET['status']);
        }

        if(isset($_GET['search']) && $_GET['search'] != ''){
            $user_list = $user_list->where('name', 'LIKE', '%'.$_GET['search'].'%');
        }

        $user_list = $user_list->whereIn('user_type', [3])->orderBy('id', 'desc')->paginate($qty);
        $total_post = [];
        $approve_post = [];
        $pending_post = [];
        foreach($user_list as $user){
            $total_post_count = Post::where('post_by', $user->id)->count();
            $total_post[$user->id] = $total_post_count;
        }

        foreach($user_list as $user){
            $approve_post_count = Post::where('post_by', $user->id)->where('post_approval_status', 1)->count();
            $approve_post[$user->id] = $approve_post_count;
        }
        foreach($user_list as $user){
            $pending_post_count = Post::where('post_by', $user->id)->where('post_approval_status', 2)->count();
            $pending_post[$user->id] = $pending_post_count;
        }
        $user_list->appends([
            'qty' => $qty,
            'status' => isset($_GET['status']) ? $_GET['status'] : '',
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
        ]);
        return view('backend.user.user-list', compact('user_list', 'total_post', 'approve_post', 'pending_post'));
    }
    // backend user manage function (ends)

    public function viewUser($id){
        $user_detail = User::find($id);
        if($user_detail){
        return view('backend.user.detail', compact('user_detail'));
        }else{
            return redirect('admin');
        }
    }

    public function viewWriter($id){
        $user_detail = User::find($id);
        if($user_detail){
        return view('backend.user.detail', compact('user_detail'));
        }else{
            return redirect('admin');
        }
    }

    public function editUser($id){
        $user_detail = User::find($id);
        if($user_detail){
        return view('backend.user.edit', compact('user_detail'));
        }else{
            return redirect('admin');
        }
    }

    public function editWriter($id){
        $user_detail = User::find($id);
        if($user_detail){
        return view('backend.user.edit', compact('user_detail'));
        }else{
            return redirect('admin');
        }
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);

        if($user){
            $name = Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name)));
            $email = $request->email;
            $account_status = $request->account_status;
            $gender = $request->gender;
            $phone_number = $request->phone_number;
            $city = $request->city;
            $bio_en = $request->bio_en;
            $bio_hi = $request->bio_hi;

            if($request->hasFile('profile_picture')){
                $profile_pic = $request->file('profile_picture');
                $profile_pic_original_name = $profile_pic->getClientOriginalName();
                $profile_new_name_with_ext = time().'.'.$profile_pic->extension();
                $profile_pic->move(public_path('build/assets/upload/user/profile_image'), $profile_new_name_with_ext);
                User::where('id', $id)->update(['profile_image' => $profile_new_name_with_ext]);
            }

            $update_user = User::where('id', $id)->update([
                'name'=> $name,
                'email'=> $email,
                'writer_account_status'=> $account_status,
                'gender'=> $gender,
                'phone_number'=> $phone_number,
                'city'=> $city,
                'bio_en'=> $bio_en,
                'bio_hi'=> $bio_hi
            ]);
            if($update_user){
                return redirect(route('admin.user.index'))->with('user_updated', 'User detail has been saved successfully !');
            }else{
                return redirect(route('admin.user.index'))->with('user_not_updated', 'Something went wrong !');
            }
        }else{
            return redirect('admin');
        }
    }

    public function blockUser(Request $request){
        $id = $request->id;
        $user = User::find($id);

        if($user->is_block == 1){
            User::where('id', $id)->update([
                'is_block' => 0
            ]);
            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone_number,
                'city' => $user->city,
                'content' => '<p>We\'re pleased to inform you that your account on Bhartiya Parampara has been successfully reinstated. We appreciate your cooperation and look forward to your continued positive engagement within our community.</p>'
            ];
            $subject = 'Account Reinstatement on Bhartiya Parampara';
            try{
                Mail::to($user->email)->queue(new BlockUserEmail($mailData, $subject));
            }catch(\Exception $e){
                return $e->getMessage();
            }

        }else{
            User::where('id', $id)->update([
                'is_block' => 1
            ]);

            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone_number,
                'city' => $user->city,
                'content' => '<p>We regret to inform you that your account on BhartiyaParampara has been suspended due to repeated violations of our community guidelines. This decision is made to maintain a safe and respectful environment for all users. If you have questions or would like to appeal, please contact our support team at “support@bhartiyaparampara.com”.</p>'
            ];
            $subject = 'Account Suspension Notification';
            try{
                Mail::to($user->email)->queue(new BlockUserEmail($mailData, $subject));
            }catch(\Exception $e){
                return $e->getMessage();
            }
        }

        return response()->json([
            'status' => 200,
            'messsage' => 'blocked'
        ]);
    }

    public function blockWriter(Request $request){
        $id = $request->id;
        $user = User::find($id);
        if($user->is_block == 1){

            User::where('id', $id)->update([
                'is_block' => 0
            ]);
            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone_number,
                'city' => $user->city,
                'content' => '<p>We are pleased to inform you that after a careful review and consideration, your writer account on Bhartiya Parampara Website has been reinstated. We appreciate your understanding during the temporary suspension and are confident that your continued contributions will enhance the diversity and richness of our community content.</p>
                <p>We encourage open communication and adherence to our community guidelines to ensure a positive environment for all users. Should you have any questions or concerns, feel free to reach out to our support team at support@bhartiyaparampara.com .</p>'
            ];
            $subject = 'Restoration of Writer Access on Bhartiya Parampara';
            try{
                Mail::to($user->email)->queue(new BlockUserEmail($mailData, $subject));
            }catch(\Exception $e){
                return $e->getMessage();
            }

        }else{
            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone_number,
                'city' => $user->city,
                'content' => '<p>I hope this message finds you well. We regret to inform you that after careful consideration and review of your contributions to our community website, we have made the difficult decision to suspend your account, effective immediately.</p>
                <p>This decision was not taken lightly, and it is a result of multiple violations of our community guidelines and terms of service. These violations include [specify the nature of the violations, e.g., plagiarism, inappropriate content, spamming, etc.]. Our primary goal is to maintain a safe, respectful, and inclusive environment for all our users, and unfortunately, your recent actions have compromised these standards.</p>
                <p>As a result of this suspension, you will no longer have access to your account, and any content you have posted will be hidden from public view. We understand that this may be disappointing, but we believe it is essential to uphold the integrity of our community.</p>
                <p>If you believe this decision is in error or would like to appeal the suspension, you can reach out to our support team at “support@bhartiyaparampara.com” within the next 7 working days. Please include any relevant information or evidence to support your appeal.</p>
                <p>We appreciate your understanding and cooperation in this matter. We take the enforcement of our community guidelines seriously to ensure a positive experience for all users. </p>
                <p>Thank you for your past contributions, and we wish you the best in your future endeavours.</p>'
            ];
            $subject = 'Notification: Account Suspension on BhartiyaParampara';
            try{
                Mail::to($user->email)->queue(new BlockUserEmail($mailData, $subject));
            }catch(\Exception $e){
                return $e->getMessage();
            }
            User::where('id', $id)->update([
                'is_block' => 1
            ]);
        }

        return response()->json([
            'status' => 200,
            'messsage' => 'blocked'
        ]);
    }

    // public function updateWriter(Request $request, $id){
    //     $user = User::find($id);
    //     if($user){

    //         $name = Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name)));
    //         $email = $request->email;
    //         $account_status = $request->account_status;
    //         $gender = $request->gender;
    //         $phone_number = $request->phone_number;
    //         $city = $request->city;
    //         $bio_en = $request->bio_en;
    //         $bio_hi = $request->bio_hi;

    //         // return $bio_hi;

    //         if($request->hasFile('profile_picture')){
    //             $profile_pic = $request->file('profile_picture');
    //             $profile_pic_original_name = $profile_pic->getClientOriginalName();
    //             $profile_new_name_with_ext = time().'.'.$profile_pic->extension();
    //             $profile_pic->move(public_path('build/assets/upload/user/profile_image'), $profile_new_name_with_ext);
    //             User::where('id', $id)->update(['profile_image' => $profile_new_name_with_ext]);
    //         }

    //         if($request->hasFile('certificate')){
    //             $certificate = $request->file('certificate');
    //             $certificate_original_name = $certificate->getClientOriginalName();
    //             $certificate_new_name_with_ext = 'certificate_'. time().'.'.$certificate->extension();
    //             $certificate->move(public_path('build/assets/upload/writer/certificate'), $certificate_new_name_with_ext);
    //             User::where('id', $id)->update(['certificate' => $certificate_new_name_with_ext]);
    //             return redirect(route('admin.writer.index'))->with('user_updated', 'Writer detail has been saved successfully !');
    //         }

    //         if(Auth::user()->user_type == 1){
    //             $meta_title_hi = $request->meta_title_hi;
    //             $meta_description_hi = $request->meta_description_hi;
    //             $meta_title_en = $request->meta_title_en;
    //             $meta_description_en = $request->meta_title_en;
    //             $return = User::where('id', $id)->update([
    //                 'meta_title_hi' => $meta_title_hi,
    //                 'meta_description_hi' => $meta_description_hi,
    //                 'meta_title_en' => $meta_title_en,
    //                 'meta_description_en' => $meta_description_en
    //             ]);
    //             return $return;
    //         }

    //         $update_user = User::where('id', $id)->update([
    //             'name'=> $name,
    //             'email'=> $email,
    //             'writer_account_status'=> $account_status,
    //             'gender'=> $gender,
    //             'phone_number'=> $phone_number,
    //             'city'=> $city,
    //             'bio_en'=> $bio_en,
    //             'bio_hi'=> $bio_hi
    //         ]);

    //         $writerApproveMailData = [
    //             'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name))),
    //             'email' => $request->email,
    //             'phone' => $request->phone_number
    //         ];
    //         $writerRejectMailData = [
    //             'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name))),
    //             'email' => $request->email,
    //             'phone' => $request->phone_number
    //         ];
    //         $mailData = [
    //             'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name))),
    //             'email' => $request->email,
    //             'phone' => $request->phone_number,
    //             'city' => $request->city,
    //         ];
    //         $this->notificationService->getNotify("Writer profile has updated.", "Writer name:- ".$name, "w_register", 1, "w_register");

    //         if($account_status == 1 && ($user->writer_account_status == 0 || $user->writer_account_status == 2)){
    //             try{
    //                 Mail::to($request->email)->send(new WriterApproveMail($writerApproveMailData));
    //             }catch(\Exception $e){
    //                 return $e->getMessage();
    //             }
    //         }

    //         if($account_status == 0 && ($user->writer_account_status == 1 || $user->writer_account_status == 2)){
    //             try{
    //                 Mail::to($request->email)->send(new WriterRejectMail($writerRejectMailData));
    //             }catch(\Exception $e){
    //                 return $e->getMessage();
    //             }
    //         }


    //         // if($update_user){
    //         //     return redirect(route('admin.writer.index'))->with('user_updated', 'Writer detail has been saved successfully !');
    //         // }else{
    //         //     return redirect(route('admin.writer.index'))->with('user_not_updated', 'Something went wrong !');
    //         // }
    //         return redirect(route('admin.writer.index'))->with('user_updated', 'Writer detail has been saved successfully !');

    //     }else{
    //         return redirect('admin');
    //     }
    // }
     public function updateWriter(Request $request, $id){
                $validater = $request->validate([
            'profile_picture' => 'nullable|max:500|image|dimensions:max_width=300,max_height=300',
        ]);
        $user = User::find($id);
        if($user){
            $name = Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name)));
            $email = $request->email;
            $account_status = $request->account_status;
            $gender = $request->gender;
            $phone_number = $request->phone_number;
            $city = $request->city;
            $bio_en = $request->bio_en;
            $bio_hi = $request->bio_hi;

            // return $bio_hi;

            if($request->hasFile('profile_picture')){
                $profile_pic = $request->file('profile_picture');
                $profile_pic_original_name = $profile_pic->getClientOriginalName();
                $profile_new_name_with_ext = time().'.'.$profile_pic->extension();
                $profile_pic->move(public_path('build/assets/upload/user/profile_image'), $profile_new_name_with_ext);
                User::where('id', $id)->update(['profile_image' => $profile_new_name_with_ext]);
            }

            if($request->hasFile('certificate')){
                $certificate = $request->file('certificate');
                $certificate_original_name = $certificate->getClientOriginalName();
                $certificate_new_name_with_ext = 'certificate_'. time().'.'.$certificate->extension();
                $certificate->move(public_path('build/assets/upload/writer/certificate'), $certificate_new_name_with_ext);
                User::where('id', $id)->update(['certificate' => $certificate_new_name_with_ext]);
                return redirect(route('admin.writer.index'))->with('user_updated', 'Writer detail has been saved successfully !');
            }

            if(Auth::user()->user_type == 1){
                $meta_title_hi = $request->meta_title_hi;
                $meta_description_hi = $request->meta_description_hi;
                $meta_title_en = $request->meta_title_en;
                $meta_description_en = $request->meta_description_en;

                User::where('id', $id)->update([
                    'meta_title_hi' => $meta_title_hi,
                    'meta_description_hi' => $meta_description_hi,
                    'meta_title_en' => $meta_title_en,
                    'meta_description_en' => $meta_description_en
                ]);
            }

            $update_user = User::where('id', $id)->update([
                'name'=> $name,
                'email'=> $email,
                'writer_account_status'=> $account_status,
                'gender'=> $gender,
                'phone_number'=> $phone_number,
                'city'=> $city,
                'bio_en'=> $bio_en,
                'bio_hi'=> $bio_hi
            ]);

            $writerApproveMailData = [
                'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name))),
                'email' => $request->email,
                'phone' => $request->phone_number
            ];
            $writerRejectMailData = [
                'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name))),
                'email' => $request->email,
                'phone' => $request->phone_number
            ];
            $mailData = [
                'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name))),
                'email' => $request->email,
                'phone' => $request->phone_number,
                'city' => $request->city,
            ];
            $this->notificationService->getNotify("Writer profile has updated.", "Writer name:- ".$name, "w_register", 1, "w_register");

            if($account_status == 1 && ($user->writer_account_status == 0 || $user->writer_account_status == 2)){
                try{
                    Mail::to($request->email)->send(new WriterApproveMail($writerApproveMailData));
                }catch(\Exception $e){
                    return $e->getMessage();
                }
            }

            if($account_status == 0 && ($user->writer_account_status == 1 || $user->writer_account_status == 2)){
                try{
                    Mail::to($request->email)->send(new WriterRejectMail($writerRejectMailData));
                }catch(\Exception $e){
                    return $e->getMessage();
                }
            }


            // if($update_user){
            //     return redirect(route('admin.writer.index'))->with('user_updated', 'Writer detail has been saved successfully !');
            // }else{
            //     return redirect(route('admin.writer.index'))->with('user_not_updated', 'Something went wrong !');
            // }
            return redirect(route('admin.writer.index'))->with('user_updated', 'Writer detail has been saved successfully !');

        }else{
            return redirect('admin');
        }
    }
    public function destroyUser(Request $request){
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 200,
            'messsage' => 'deleted'
        ]);

    }

    public function destroyWriter(Request $request){
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 200,
            'messsage' => 'deleted'
        ]);

    }

    public function registerView(Request $request): View{
        $redirect = $request->input('redirect');
        // Store the redirect URL in the session
        session(['redirect_after_register' => $redirect]);
        return view('frontend.auth.register');
    }

    public function registerUser(Request $request){

        $validator = validator($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|unique:users|string|max:255',
            'phone_number' => 'required|min:10|max:10|unique:users',
            'city' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8|',
            'confirm_password' => 'required|min:8|same:password',
            'user_type' => 'required',
            'term_and_condition' => 'required',
            'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $redirect = session('redirect_after_register', '/');
        if($request->user_type == 2){
        $user = User::create([
            'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->username))),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'user_type' => '2',
            'city' => $request->city,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'writer_account_status' => 2,
            'term_and_condition' => 1
        ]);

        SocialMedia::create([
            "user_id" => $user->id,
            "user_type" => 2
        ]);

        $mailData = [
            'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->username))),
            'email' => $request->email,
            'phone' => $request->phone_number,
            'city' => $request->city,
        ];
        $this->notificationService->getNotify("New writer has registered.", "Writer name:- ".$request->username, "w_register", 1, "w_register");
       try{
        Mail::to($request->email)->send(new RegisterMail($mailData));
       }catch(\Exception $e){
            return $e->getMessage();
       }
       if($user){
    //     $loginrequest->authenticate();
    // $loginrequest->session()->regenerate();
    Auth::login($user);
        // return redirect($url)->with('user_registered', 'success');
        return redirect()->intended($redirect)->with('register_success_writer', 'Your account as Writer will be soon verified by our Admin, post that you will be able to share your unique perspective write-ups.');
    }else{
        return redirect()->back()->with('user_register_failed', 'Something went wrong please try again.');
    }

    }else{
        $user = User::create([
            'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->username))),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'user_type' => '3',
            'city' => $request->city,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'term_and_condition' => 1
        ]);

        SocialMedia::create([
            "user_id" => $user->id,
            "user_type" => 3
        ]);

        $userMailDataFirst = [
            'name' => Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->username))),
            'email' => $request->email,
            'phone' => $request->phone_number,
            'city' => $request->city,
        ];
        Mail::to($request->email)->send(new UserRegisterMail($userMailDataFirst));
        $this->notificationService->getNotify("New User has registered.", "User name:- ".$request->username, "u_register", 1, "u_register");
        if($user){
        //     $loginrequest->authenticate();
        // $loginrequest->session()->regenerate();
        Auth::login($user);
            // return redirect($url)->with('user_registered', 'success');
                return redirect()->intended($redirect)->with('register_success_user', 'Welcome to our community. Get ready to explore the content and enjoy being part of our platform! \n  Happy Surfing!! ');

        }else{
            return redirect()->back()->with('user_register_failed', 'Something went wrong please try again.');
        }
    }
    }

    public function loginView(Request $request){
        // $lastRouteName = URL::previous(-2);
        // Session::put('last_route_name_for_login', $lastRouteName);

        $redirect = $request->input('redirect');
        // Store the redirect URL in the session
        session(['redirect_after_login' => $redirect]);

            if(auth()->check()){
                if(Auth::user()->user_type == 1){
                    return redirect('/admin');
                }elseif(Auth::user()->user_type == 2){
                    return redirect('/writer');
                }if(Auth::user()->user_type == 3){
                    return redirect('/user');
                }
            }else{
            return view('frontend.auth.login');
            }
        }
    public function loginUser(LoginRequest $request){
        $find_user = User::where('email', $request->email)->first();
        if($find_user == ''){
            return redirect()->back()->with('userNotFound', 'Email not exist in our record !');
        }else{
            $user_pass = $request->password;
            $stored_password = $find_user->password;
            $passCheck =  Hash::check($user_pass, $stored_password);
            if(!$passCheck){
            return redirect()->back()->with('wrongPass', 'Password do not match !');
            }
        }

            $request->authenticate();
            $request->session()->regenerate();
            $user_type = Auth::user()->user_type;
            //  $url = Session::get('last_route_name');
            $redirect = session('redirect_after_login', '/');
            if($user_type == 2){
                // return redirect('/writer/dashboard');
                // return redirect($url);
                return redirect()->intended($redirect);
            }else if($user_type == 1){
                return redirect('/admin/dashboard');
            }else if($user_type == 3){
                // return redirect($url);
                return redirect()->intended($redirect);
                // return redirect('/user/dashboard');
            }

    }
    public function accountStatus(){
        $social_media_list = SocialMedia::where('user_id', Auth::user()->id)->first();
        $no_of_post = Post::where('post_by', Auth::user()->id)->count();
        return view('backend.account.index', compact('social_media_list', 'no_of_post'));
    }
    public function viewEditMyProfile(){
        $user_detail = User::where('id', Auth::user()->id)->first();
        return view('backend.user.edit_my_profile', compact('user_detail'));
    }
    public function EditMyProfile(Request $request){
        $validater = $request->validate([
            'profile_picture' => 'nullable|max:500|image|dimensions:max_width=300,max_height=300',
        ]);

            $name = Str::title(str_replace(['-', 'at'], [' ', ''], Str::slug($request->name)));
            // $email = $request->email;
            $gender = $request->gender;
            $phone_number = $request->phone_number;
            $city = $request->city;
            $bio_en = $request->bio_en;
            $bio_hi = $request->bio_hi;
            if(Auth::user()->user_type == 2){
                $account_status = 2;
            }else{
                $account_status = 1;
            }
            if($request->hasFile('profile_picture')){
                $profile_pic = $request->file('profile_picture');
                $profile_pic_original_name = $profile_pic->getClientOriginalName();
                $profile_new_name_with_ext = time().'.'.$profile_pic->extension();
                $profile_pic->move(public_path('build/assets/upload/user/profile_image'), $profile_new_name_with_ext);
                User::where('id', Auth::user()->id)->update(['profile_image' => $profile_new_name_with_ext]);
            }

            if(Auth::user()->user_type == 1){
                $meta_title_hi = $request->meta_title_hi;
                $meta_description_hi = $request->meta_description_hi;
                $meta_title_en = $request->meta_title_en;
                $meta_description_en = $request->meta_title_en;
                User::where('id', Auth::user()->id)->update([
                    'meta_title_hi' => $meta_title_hi,
                    'meta_description_hi' => $meta_description_hi,
                    'meta_title_en' => $meta_title_en,
                    'meta_description_en' => $meta_description_en
                ]);
            }

            $update_user = User::where('id', Auth::user()->id)->update([
                // 'name'=> $name,
                // 'email'=> $email,
                'writer_account_status'=> $account_status,
                'gender'=> $gender,
                'phone_number'=> $phone_number,
                'city'=> $city,
                'bio_en'=> $bio_en,
                'bio_hi'=> $bio_hi
            ]);

            if(Auth::user()->user_type == 1){
                return redirect('admin/account')->with('user_updated', 'Profile has been updated successfully !');
            }else if(Auth::user()->user_type == 2){
                $this->notificationService->getNotify($name."(writer)"." update his profile.", "Please check and update status", "profile_update", 1, "profile_update", Auth::user()->id);
                return redirect('writer/account')->with('user_updated', 'Profile has been updated successfully !');
            }else if(Auth::user()->user_type == 3){
                $this->notificationService->getNotify($name."(user)"." update his profile.", "Please check and update status", "profile_update", 1, "profile_update", Auth::user()->id);
                return redirect('user/account')->with('user_updated', 'Profile has been updated successfully !');
            }else{
                return redirect(route('admin.writer.index'))->with('user_not_updated', 'Something went wrong !');
            }

    }

    public function Certificates(){
        $certificate_list = User::where('user_type', 2)->paginate(9);
        return view('frontend.pages.certificate', compact('certificate_list'));
    }

    public function SearchCertificates(Request $request){
        $lang = Session::get('lang');
        $search_val = $request->search_val;
        $page_name = "certificates";
        $match = stripos($page_name, $search_val);
        $cer = '';
        // post page list
        $post_list = Post::where('meta_title', 'LIKE', '%'.$search_val.'%')->where('post_language', $lang)->where('post_status', 1)->with('getUser')->get();
        foreach($post_list as $post){
                $cer .= '<a href="'.route('frontend.view.post', [$post->slug]).'" target="_blank" class="search-url" id="result-anchor">'.$post->meta_title.'(Post)</a>';
        }

        // other pages list
        $other_page_list = OtherPage::where('slug', 'LIKE', '%'.$search_val.'%')->where('page_language', $lang)->where('page_status', 1)->get();
        foreach($other_page_list as $other_page){
            $cer .= '<a href="'.route('frontend.other_page.single', [$other_page->slug]).'" target="_blank" class="search-url" id="result-anchor">'.$other_page->page_name.'(Other Page)</a>';
        }

        // pdf page list
        $pdf_page_list = PdfPage::where('page_name_en', 'LIKE', '%'.$search_val.'%')->where('page_status', 1)->get();
        $pdf_page_name = 'page_name_'.$lang;
        foreach($pdf_page_list as $pdf_page){
            $cer .= '<a href="'.route('frontend.pdf_page.index', [$pdf_page->slug]).'" target="_blank" class="search-url" id="result-anchor">'.$pdf_page->$pdf_page_name.'(Pdf Page)</a>';
        }

        //  top header menu pages
        $top_header_page_list = MainCategory::where('main_category_name_en', 'LIKE', '%'.$search_val.'%')->where('page_type', 3)->where('main_category_status', 1)->get();
        $top_header_page_name = 'main_category_name_'.$lang;
        foreach($top_header_page_list as $top_header_page){
            $cer .= '<a href="'.route('frontend.post_list', [$top_header_page->main_category_name_en]).'" target="_blank" class="search-url" id="result-anchor">'.$top_header_page->$top_header_page_name.'(Top Header Menu Page)</a>';
        }

        // main category list
        $main_category_list = MainCategory::where('main_category_name_en', 'LIKE', '%'.$search_val.'%')->whereIn('page_type', [0,1])->where('main_category_status', 1)->get();
        $main_category_name = 'main_category_name_'.$lang;
        foreach($main_category_list as $main_category){
            $cer .= '<a href="'.route('frontend.post_list', [$main_category->main_category_name_en]).'" target="_blank" class="search-url" id="result-anchor">'.$main_category->$main_category_name.'(Main Category)</a>';
        }

        // Category list
        $category_list = Category::where('category_name_en', 'LIKE', '%'.$search_val.'%')->where('category_status', 1)->with('mainCategory')->get();
        $category_name = 'category_name_'.$lang;
        foreach($category_list as $category){
            $cer .= '<a href="'.route('frontend.post_list', [$category->mainCategory->main_category_name_en, $category->category_name_en]).'" target="_blank" class="search-url" id="result-anchor">'.$category->$category_name.'(Category)</a>';
        }

        // sub category list
        $sub_category_list = SubCategory::where('sub_category_name_en', 'LIKE', '%'.$search_val.'%')->with('mainCategory', 'Category')->where('sub_category_status', 1)->get();
        $sub_category_name = 'sub_category_name_'.$lang;
        foreach($sub_category_list as $sub_category){
            $cer .= '<a href="'.route('frontend.post_list', [$sub_category->mainCategory->main_category_name_en, $sub_category->Category->category_name_en, $sub_category->sub_category_name_en]).'" target="_blank" class="search-url" id="result-anchor">'.$sub_category->$sub_category_name.'(Sub Category)</a>';
        }

        // pdf file list
        $pdf_file_list = PdfFile::where('pdf_file_title_en', 'LIKE', '%'.$search_val.'%')->where('file_status', 1)->get();
        foreach($pdf_file_list as $pdf_file){
            $cer .= '<a href="'.url('public/build/assets/upload/pdf_pages/pdf_files').'/'.$pdf_file->pdf_file.'" target="_blank" class="search-url" id="result-anchor">'.$pdf_file->pdf_file_title.'(PDF)</a>';
        }

        // gallery page
        if($lang == 'hi'){
        $gallery_name = 'गैलरी';
        }else{
        $gallery_name = 'Gallery';
        }
        $gallery_match = stripos('gallery', $search_val);
        if($gallery_match !== false){
            $cer .= '<a href="'.url("gallery").'" target="_blank" class="search-url" id="result-anchor">'.$gallery_name.'(Gallery Page)</a>';
        }
        // question and answer page
        if($lang == 'hi'){
            $q_and_a_name = 'सवाल-जवाब';
            }else{
                $q_and_a_name = 'Que & Ans';
            }
            $gallery_match = stripos('question and answer', $search_val);
            if($gallery_match !== false){
                $cer .= '<a href="'.url("question-and-answer").'" target="_blank" class="search-url" id="result-anchor">'.$q_and_a_name.'(Que & Ans Page)</a>';
            }
        // $certificate_list = User::where('user_type', 2)->where('certificate', '!=', NULL)->get();
        // if($match !== false){
        //      return '<a href="/certificates" class="search-url"  id="result-anchor" target="_blank">See All Certificates (Page)</a>';
        // }else{
        //     foreach($certificate_list as $cer_list){
        //         if (stripos($cer_list->name, $search_val) !== false) {
        //             $cer .= '<a href="'.url("public/build/assets/upload/writer/certificate").'/'.$cer_list->certificate.'" target="_blank" class="search-url" id="result-anchor">'.$cer_list->name.'(Certificate)</a>';
        //         }
        //     }
        // }

        $writer_profile_list = User::where('name', 'LIKE', '%'.$search_val.'%')->where('user_type', 2)->where('writer_account_status', '1')->where('is_block', 0)->get();
        foreach($writer_profile_list as $writer){
            $cer .= '<a href="'.route('frontend.writer_profile', [Str::slug($writer->name), $writer->id]).'" target="_blank" class="search-url" id="result-anchor">'.$writer->name.' (Writer)</a>';
        }
        if ($cer == '') {
            $cer = '<p>No Result Found</p>';
        }
        return $cer;
    }

    public function teamListIndex(){
        $team_list = User::select('*');
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }

        if(isset($_GET['search']) && $_GET['search'] != ''){
            $team_list = $team_list->where('name', 'LIKE', '%'.$_GET['search'].'%');
        }
        $team_list = $team_list->where('is_team', 1)->orderBy('updated_at', 'desc')->paginate($qty);


        $user_list = User::where('is_team', 0)->get();
        $team_list->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
        ]);
        return view('backend.team.index', compact('team_list', 'user_list'));
    }

    public function teamListStore(Request $request){
        $user = $request->team_user;
        User::where('id', $user)->update([
            'is_team' => 1,
        ]);
        return redirect()->back()->with('member_added', "Team Member Added");
    }

    public function teamListRemove(Request $request){
        $user = $request->id;
        User::where('id', $user)->update([
            'is_team' => 0,
        ]);
        return redirect()->back()->with('member_added', "Team Member Removed");
    }

    public function teamListFrontend(){
        $lang = Session::get('lang');
        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->paginate(5);

        $team_list = User::where('is_team', 1)->where('is_block', 0)->orderBy('id', 'desc')->paginate(10);
        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->where('file_language', $lang)->orderBy('created_at', 'desc')->paginate(1);
        return view('frontend.pages.team_list_view', compact('team_list', 'popular_article', 'spiritual_collection_pdf'));
    }


    public function teamProfileView($team_name, Request $request){
        $id = $request->team_id;

        $user = User::where('id', $id)->first();
        return view('frontend.pages.team_profile', compact('user'));

    }

    public function writersCornerFrontend(){
        $lang = Session::get('lang');
        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->paginate(5);

        $all_writer_list = User::where('user_type', 2)->where('writer_account_status', 1)->where('is_block', 0)->orderBy('name', 'asc')->paginate(10);
        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
        return view('frontend.pages.writer-list', compact('all_writer_list', 'popular_article', 'spiritual_collection_pdf'));
    }

}
