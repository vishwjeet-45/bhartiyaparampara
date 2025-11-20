<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Advertisement;
use App\Models\backend\FirstBannerWidget;
use App\Models\backend\PdfFile;
use Illuminate\Http\Request;
use Route;
use Session;
use App\Models\backend\MainCategory;
use Carbon\Carbon;
use App\Models\backend\PdfPage;
use App\Models\backend\Post;
use App\Models\User;
use App\Models\backend\Category;
use App\Models\backend\SocialMedia;
use App\Models\backend\Video;
use DB;
use Mail;
use App\Mail\AdvertisementReminderMail;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $lang = Session::get('lang');
        // dd($lang);
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = ($currentMonth - 1);
        $first_slider = FirstBannerWidget::where('status', 1)->get();
        $third_slider = PdfFile::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('file_status', 1)
            ->where('pdf_page_id', 10)
            // ->where('file_language', $lang)
            ->first();
        if ($third_slider == null && $lastMonth == 0) {
            $third_slider = PdfFile::whereMonth('created_at', 12)
                ->whereYear('created_at', $currentYear - 1)
                ->where('file_status', 1)
                // ->where('file_language', $lang)
                ->where('pdf_page_id', 10)
                ->first();
        } elseif ($third_slider == null && $lastMonth != 0) {
            $third_slider = PdfFile::where('file_status', 1)
                // ->where('file_language', $lang)
                ->orderBy('created_at', 'desc')
                ->where('pdf_page_id', 10)
                ->first();
        }
        $forth_slider = Post::whereJsonContains('main_category_id', 61)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->latest()->first();
        if (!empty($forth_slider)) {
            $forth_slider_post_user = User::where('id', $forth_slider->post_by)->first();
        } else {
            $forth_slider_post_user = [];
        }
        $fifth_slider = Post::whereJsonContains('main_category_id', 57)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->latest()->first();
        $fifth_slider_post_user = User::where('id', $fifth_slider->post_by)->first();

        $sixth_slider = Post::whereJsonContains('main_category_id', 55)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->latest()->first();
        $sixth_slider_post_user = User::where('id', $sixth_slider->post_by)->first();
        
        
        

        $festival_post = Post::whereJsonContains('main_category_id', 56)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->orderBy('upcomming_at', 'desc')->paginate(4);
            
            
            

        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->where('post_status', 1)->where('post_language', $lang)->orderBy('views', 'desc')->paginate(4);

        $places_to_visit_cat = Category::where('main_category_id', 60)->where('category_status', 1)->get();
        $m_cat_places_to_visit_cat = MainCategory::where('id', 60)->where('main_category_status', 1)->first();

        $ancient_history = Category::where('main_category_id', 57)->where('category_status', 1)->get();
        $ancient_history_m_cat = MainCategory::where('id', 57)->where('main_category_status', 1)->first();

        $handy_tips = Category::where('main_category_id', 61)->where('category_status', 1)->get();
        $handy_tips_m_cat = MainCategory::where('id', 61)->where('main_category_status', 1)->first();

        $health_post = Post::whereJsonContains('main_category_id', 59)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->latest()->first();

        $letest_blog = Post::whereJsonContains('main_category_id', 54)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('id', 'desc')->paginate(3);

        $social_media = SocialMedia::where('user_id', 1)->where('user_type', 1)->first();

        $video_list = Video::where('status', 1)->orderBy('id', 'desc')->where('status', 1)->paginate(7);

        // $writers_corner = Post::whereJsonContains('category_id', 27)->where('post_status', 1)->where('post_language', $lang)->paginate(2);
        $writers_corner = Post::where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->paginate(2);

        $festival_post_most_view = Post::whereJsonContains('main_category_id', 56)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->first();

        $culture_post_list = Post::whereJsonContains('main_category_id', 54)->where('post_approval_status', 1)
            ->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('id', 'desc')->paginate(4);

        $usersWithMostPosts = User::select('users.id', 'users.name', 'users.profile_image', DB::raw('COUNT(posts.id) as post_count'))
            ->leftJoin('posts', 'users.id', '=', 'posts.post_by')
            ->groupBy('users.id', 'users.name', 'users.profile_image') // Include all selected columns in the GROUP BY clause
            ->orderByDesc('post_count')
            // ->take(5)
            ->get();

        $motivation_tips_post = Post::whereJsonContains('category_id', 39)->where('post_status', 1)->where('post_language', $lang)->orderBy('id', 'desc')->first();

        $letest_post_with_update_at = Post::where('post_status', 1)->where('post_language', $lang)->where('post_approval_status', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $second_slider_festival = Post::whereJsonContains('main_category_id', 56)->with('getUser')->where('post_status', 1)->where('post_approval_status', 1)->orderBy('updated_at', 'desc')->where('post_language', $lang)->first();
        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
        // return $spiritual_collection_pdf;


        return view('frontend.home', compact(
            'first_slider',
            'third_slider',
            'forth_slider',
            'forth_slider_post_user',
            'fifth_slider',
            'fifth_slider_post_user',
            'sixth_slider',
            'sixth_slider_post_user',
            'festival_post',
            'popular_article',
            'places_to_visit_cat',
            'm_cat_places_to_visit_cat',
            'ancient_history',
            'handy_tips',
            'health_post',
            'letest_blog',
            'social_media',
            'video_list',
            'writers_corner',
            'festival_post_most_view',
            'culture_post_list',
            'usersWithMostPosts',
            'motivation_tips_post',
            'letest_post_with_update_at',
            'second_slider_festival',
            'spiritual_collection_pdf',
            'ancient_history_m_cat',
            'handy_tips_m_cat'
        )
        );
    }

    public function setLang()
    {
        $current_route = url()->current();
        if (Session::get('lang') == 'hi') {
            Session::put('lang', 'en');

        } else {
            Session::put('lang', 'hi');
        }
        return redirect()->back();
    }



    //  ====================== All are test pages (start)=================================
//  public function Certificate(){
//     return view('frontend.pages.certificate');
//  }

    //  public function blockUserMail(){
//     return view('email.block_user');
//  }
    // public function adsTest(){
//     return view('email.advertisement_form');
// }

    // public function adsReminder(){
//     $users = Advertisement::whereDate('end_date', '=', Carbon::now()->addDays(5)->toDateString())->get(); 

    //     try {
//         foreach ($users as $user) {
//             $adsReminderMailData = [
//                 "email" =>$user->email,
//                 "start_date" => $user->start_date,
//                 "end_date" => $user->end_date
//             ];
//             Mail::to($user->email)->queue(new AdvertisementReminderMail($adsReminderMailData));
//         } 

    //     } catch (\Exception $e) {
//       return  \Log::error('Error sending email: ' . $e->getMessage());
//     }


    public function startAds()
    {
        return view('email.advertisement_start');
    }

    public function rejectPost()
    {
        return view('email.post_reject');
    }

    // }
//  ====================== All are test pages (end)=================================

    public function writerProfile($writer_name_slug, $id, Request $request)
    {
        $lang = Session::get('lang');
        // $user_id = $request->query('id');
        $user_id = $id;
        $post_list = Post::where('post_by', $user_id)->where('post_language', $lang)->with('getUser')->orderBy('publish_on', 'desc')->where('post_status', 1)->where('post_approval_status', 1)->paginate(12);
        $popular_article = Post::where('post_approval_status', 1)->where('post_status', 1)->where('post_language', $lang)->with('getUser')->orderBy('views', 'desc')->paginate(5);
        $writer_social_media = SocialMedia::where('user_id', $user_id)->first();
        $spiritual_collection_pdf = PdfFile::where('pdf_page_id', 12)->where('file_status', 1)->orderBy('created_at', 'desc')->paginate(1);
 
        $user = User::where('id', $user_id)->first(); 
        if (!$user) {
            return redirect(404);
        }else{
            if($writer_name_slug == Str::slug($user->name)){
                $total_post_count = Post::where('post_by', $user_id)->count();
                
        return view('frontend.pages.writer-profile', compact(
            'user',
            'post_list',
            'popular_article',
            'writer_social_media',
            'spiritual_collection_pdf',
            'total_post_count'
        )
        );
    }else{
        return redirect(404);
    }
    }
    }


    public function isActivePage($pageName)
    {
        return Route::currentRouteName() == $pageName;
    }


 
}
