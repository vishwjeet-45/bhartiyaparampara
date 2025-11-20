<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\backend\MainCategory;
use Illuminate\Http\Request;
use Session;
use App\Models\backend\Page;
use Auth;
 use App\Models\backend\PdfPage;
 use App\Models\backend\OtherPage;
 use App\Models\backend\Notification;
 use App\Services\NotificationService;
 use App\Models\backend\SocialMedia;
 use App\Models\backend\Advertisement;
 use Carbon\Carbon;
 use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NotificationService::class, function($app){
            return new NotificationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        if (!Session::has('lang')) {
            Session::put('lang', 'hi');
        } 
         if (request()->is('admin/*') || request()->is('api/*') || request()->is('login')) {
        $admin_notification_list = Notification::getAdminNotification();
        $admin_unread_notification_count = Notification::getAdminUnreadNotification();
             view()->share([
                'admin_notification_list' => $admin_notification_list,
                'admin_unread_notification_count' => $admin_unread_notification_count,
            ]);
        }
    
    
        $main_categories = MainCategory::with('getCategories.subCategories')->where('main_category_status', 1)->whereIn('page_type', [0, 1, 2, 4])->orderBy('order_number', 'asc')->get();
        $pages_list = Page::getPages();

        $pdf_page_list = PdfPage::getPdfPages();
         
        $admin_notification_list = Notification::getAdminNotification();
        $admin_unread_notification_count = Notification::getAdminUnreadNotification();

        $social_media = SocialMedia::where('user_id', 1)->where('user_type', 1)->first();

        $today_date = Carbon::now();
      $top_ads_small = Advertisement::where('start_date', '<=', $today_date)->where('end_date', '>=', $today_date)->where('position', 'top')->where('size', 'small')->where('status', 1)->get();
      $top_ads_large = Advertisement::where('start_date', '<=', $today_date)->where('end_date', '>=', $today_date)->where('position', 'top')->where('size', 'large')->where('status', 1)->get();
      $middle_ads_small = Advertisement::where('start_date', '<=', $today_date)->where('end_date', '>=', $today_date)->where('position', 'middle')->where('size', 'small')->where('status', 1)->get();
      $middle_ads_large = Advertisement::where('start_date', '<=', $today_date)->where('end_date', '>=', $today_date)->where('position', 'middle')->where('size', 'large')->where('status', 1)->get();
      $bottom_ads_small = Advertisement::where('start_date', '<=', $today_date)->where('end_date', '>=', $today_date)->where('position', 'bottom')->where('size', 'small')->where('status', 1)->get();
      $bottom_ads_large = Advertisement::where('start_date', '<=', $today_date)->where('end_date', '>=', $today_date)->where('position', 'bottom')->where('size', 'large')->where('status', 1)->get();



        view()->share([
        'main_categories' => $main_categories,
        'pages_list' => $pages_list, 
        'pdf_page_list' => $pdf_page_list, 
        'admin_notification_list' => $admin_notification_list,
        'social_media' => $social_media,
        'admin_unread_notification_count' => $admin_unread_notification_count,
        'top_ads_small' => $top_ads_small,
        'top_ads_large' => $top_ads_large,
        'middle_ads_small' => $middle_ads_small,
        'middle_ads_large' => $middle_ads_large,
        'bottom_ads_small' => $bottom_ads_small,
        'bottom_ads_large' => $bottom_ads_large
    ]);
    }

}
