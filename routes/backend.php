<?php
 use App\Http\Controllers\backend\CategoryController;
 use App\Http\Controllers\backend\CommentController;
 use App\Http\Controllers\backend\DashboardController;
 use App\Http\Controllers\backend\MainCategoryController; 
 use App\Http\Controllers\backend\PdfFileController;
 use App\Http\Controllers\backend\PdfPageController;
 use App\Http\Controllers\backend\QuestionAndAnswerController;
 use App\Http\Controllers\backend\SubCategoryController; 
 use App\Http\Controllers\backend\PostController; 
 use App\Http\Controllers\backend\PageController;
 use App\Http\Controllers\backend\SocialMediaController;
 use App\Http\Controllers\backend\WidgetController;
 use App\Http\Controllers\customauth\UserController;  
 use App\Http\Controllers\backend\OtherPageController;
 use App\Http\Controllers\frontend\NewsletterController;
 use App\Http\Controllers\backend\GalleryController; 
 use App\Http\Controllers\backend\LikeController; 
 use App\Http\Controllers\backend\AdvertisementController; 
 use App\Http\Controllers\backend\NotificationController; 

 Route::middleware(['auth', 'checkAdmin'])->group(function(){
   Route::get('/admin/dashboard', [DashboardController::class, 'AdminDashboard'])->name('admin.dashboard');
   Route::get('/admin/auth', [DashboardController::class, 'RedirectAdminDashboard'])->name('admin');
   
   //main Category starts
   Route::get('/admin/main-category', [MainCategoryController::class, 'index'])->name('admin.main_category.index');
   Route::post('/admin/main-category', [MainCategoryController::class, 'store'])->name('admin.main_category.store');
   Route::get('/admin/main-category/edit/{id}', [MainCategoryController::class, 'edit'])->name('admin.main_category.edit');
   Route::post('/admin/main-category/update', [MainCategoryController::class, 'update'])->name('admin.main_category.update');
   Route::get('/admin/main-category/delete/{id}', [MainCategoryController::class, 'destroy'])->name('admin.main_category.destroy');
   Route::get('/admin/main-category/update-statis', [MainCategoryController::class, 'updateStatus'])->name('admin.main_category.update_status');
   Route::get('/admin/main-category/check-edit-slug', [MainCategoryController::class, 'checkEditSlug'])->name('admin.main_category.check_edit_slug');
   Route::get('/admin/main-category/check-create-slug', [MainCategoryController::class, 'checkCreateSlug'])->name('admin.main_category.check_create_slug');
   //main Category ends

   //Category (starts)
   Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
   Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
   Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
   Route::post('/admin/category/update', [CategoryController::class, 'update'])->name('admin.category.update');
   Route::get('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
   Route::get('/admin/category/update-statis', [CategoryController::class, 'updateStatus'])->name('admin.category.update_status');
   Route::get('/admin/category/check-edit-slug', [CategoryController::class, 'checkEditSlug'])->name('admin.category.check_edit_slug');
   Route::get('/admin/category/check-create-slug', [CategoryController::class, 'checkCreateSlug'])->name('admin.category.check_create_slug');
   //Category (ends)

   //Sub Category (starts)
   Route::get('/admin/sub-category', [SubCategoryController::class, 'index'])->name('admin.sub_category.index');
   Route::post('/admin/sub-category', [SubCategoryController::class, 'store'])->name('admin.sub_category.store');
   Route::get('/admin/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('admin.sub_category.edit');
   Route::post('/admin/sub-category/update', [SubCategoryController::class, 'update'])->name('admin.sub_category.update');
   Route::get('/admin/sub-category/delete/{id}', [SubCategoryController::class, 'destroy'])->name('admin.sub_category.destroy');
   Route::get('/admin/sub-category/update-status', [SubCategoryController::class, 'updateStatus'])->name('admin.sub_category.update_status');
   Route::get('/admin/sub-category/get-category-list', [SubCategoryController::class, 'getCategoryList'])->name('admin.sub_category.get_category_list');
   Route::get('/admin/sub-category/check-edit-slug', [SubCategoryController::class, 'checkEditSlug'])->name('admin.sub_category.check_edit_slug');
   Route::get('/admin/sub-category/check-create-slug', [SubCategoryController::class, 'checkCreateSlug'])->name('admin.sub_category.check_create_slug');
   //Sub Category (ends)

   //Post routes (start)
   Route::get('/admin/post', [PostController::class, 'index'])->name('admin.post.index');
   Route::get('/admin/post/create', [PostController::class,'create'])->name('admin.post.create');
   Route::post('/admin/post/create', [PostController::class,'store'])->name('admin.post.store');
   Route::get('/admin/post/edit/{id}', [PostController::class,'edit'])->name('admin.post.edit');
   Route::post('/admin/post/update/{id}', [PostController::class,'update'])->name('admin.post.update');
   Route::get('/admin/post/view/{id}', [PostController::class,'view'])->name('admin.post.view');
   Route::get('/admin/post/check-create-slug', [PostController::class,'checkCreateSlug'])->name('admin.post.check_create_slug');
   Route::get('/admin/post/check-edit-slug', [PostController::class,'checkEditSlug'])->name('admin.post.check_edit_slug');
   //Post routes (end)

   //upload image from cd editor in create post page (starts)
   Route::post('/admin/ckeditor/upload', [PostController::class,'ckeditorUpload'])->name('admin.ckeditor.upload');
   Route::post('/admin/tinyeditor', [PostController::class,'tinyeditorUpload'])->name('admin.tinyeditor.upload');
   Route::post('/admin/summber-not-editor', [PostController::class, 'summerNoteEditorUpload'])->name('admin.summernote.upload');
   //upload image from cd editor in create post page (end)

   //get category list and put in select option on create post page (start)
   Route::post('/get-categories', [PostController::class, 'getCategories'])->name('get_categories');
   Route::post('/get-sub-categories', [PostController::class, 'getSubCategories'])->name('get_sub_categories');
   //get category list and put in select option on create post page (ends)

  //  check slug is exist or not in edit page (starts)
  Route::get('get-slug', [PostController::class, 'getSlug'])->name('get_slug');
  //  check slug is exist or not in edit page (end)

    // Pages routes (starts)
    Route::get('/admin/pages', [PageController::class, 'index'])->name('admin.pages.index');
    Route::get('/admin/page/edit/{id}', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::post('/admin/page/edit', [PageController::class, 'update'])->name('admin.pages.update');
    
    // Pages routes (ends)

    // Other Pages (starts)
    Route::get('/admin/other-pages', [OtherPageController::class, 'index'])->name('admin.other_pages.index');
    Route::get('/admin/other-pages/create', [OtherPageController::class, 'create'])->name('admin.other_pages.create');
    Route::post('/admin/other-pages/create', [OtherPageController::class, 'store'])->name('admin.other_pages.store');
    Route::get('/admin/other-pages/edit/{id}', [OtherPageController::class, 'edit'])->name('admin.other_pages.edit');
    Route::post('/admin/other-pages/edit/{id}', [OtherPageController::class, 'update'])->name('admin.other_pages.update');
    Route::get('/admin/other-pages/destroy/{id}', [OtherPageController::class, 'destroy'])->name('admin.other_pages.destroy');
    Route::get('/admin/other-pages/update-status', [OtherPageController::class, 'updateStatus'])->name('admin.other_pages.update_status');
    // Other Pages (end)

    // Top Header Pages (Starts)
    Route::get('/admin/top-header-pages', [OtherPageController::class, 'index'])->name('admin.top_header_page.index');
    Route::get('/admin/top-header-pages/create', [OtherPageController::class, 'create'])->name('admin.top_header_page.create');
    Route::post('/admin/top-header-pages/create', [OtherPageController::class, 'store'])->name('admin.top_header_page.store');
    Route::get('/admin/top-header-pages/edit/{id}', [OtherPageController::class, 'edit'])->name('admin.top_header_page.edit');
    Route::post('/admin/top-header-pages/edit/{id}', [OtherPageController::class, 'update'])->name('admin.top_header_page.update');
    Route::get('/admin/top-header-pages/destroy/{id}', [OtherPageController::class, 'destroy'])->name('admin.top_header_page.destroy');
    Route::get('/admin/top-header-pages/update-status', [OtherPageController::class, 'updateStatus'])->name('admin.top_header_page.update_status');
    // Top Header Pages (Ends)

    // User Writer routes (starts)
    Route::get('/admin/users', [UserController::class, 'UserList'])->name('admin.user.index')->middleware('acc_status');
    Route::get('/admin/user/view/{id}', [UserController::class, 'viewUser'])->name('admin.user.view');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'editUser'])->name('admin.user.edit');
    Route::post('/admin/user/edit/{id}', [UserController::class, 'updateUser'])->name('admin.user.update');
    Route::get('/admin/user/destroy', [UserController::class, 'destroyUser'])->name('admin.user.destroy');
    Route::get('/admin/user/block', [UserController::class, 'blockUser'])->name('admin.user.block');

    Route::get('/admin/writers', [UserController::class, 'WriterList'])->name('admin.writer.index')->middleware('acc_status');
    Route::get('/admin/writer/view/{id}', [UserController::class, 'viewWriter'])->name('admin.writer.view');
    Route::get('/admin/writer/edit/{id}', [UserController::class, 'editWriter'])->name('admin.writer.edit');
    Route::post('/admin/writer/edit/{id}', [UserController::class, 'updateWriter'])->name('admin.writer.update');
    Route::get('/admin/writer/destroy', [UserController::class, 'destroyWriter'])->name('admin.writer.destroy');
    Route::get('/admin/writer/block', [UserController::class, 'blockWriter'])->name('admin.writer.block');
    // User routes (ends)

  // Question and answer (starts)
  Route::get('/admin/question-and-answer', [QuestionAndAnswerController::class, 'index'])->name('admin.question_and_answer.index');
  Route::post('/admin/question-and-answer', [QuestionAndAnswerController::class, 'store'])->name('admin.question_and_answer.store');
  Route::get('/admin/question-and-answer/update-status', [QuestionAndAnswerController::class, 'updateStatus'])->name('admin.question_and_answer.update_status');
  Route::get('/admin/question-and-answer/update-a-status', [QuestionAndAnswerController::class, 'updateAnswerStatus'])->name('admin.question_and_answer.update_a_status');
  Route::get('/admin/question-and-answer/edit/{id}', [QuestionAndAnswerController::class, 'edit'])->name('admin.question_and_answer.edit');
  Route::post('/admin/question-and-answer/update', [QuestionAndAnswerController::class, 'update'])->name('admin.question_and_answer.update');
  Route::get('/admin/question-and-answer/delete/{id}', [QuestionAndAnswerController::class, 'destroy'])->name('admin.question_and_answer.destroy');
  // Question and answer (ends)

    //Pdf Page (start)
    Route::get('/admin/pdf-page', [PdfPageController::class, 'index'])->name('admin.pdf_page.index');
    Route::get('/admin/pdf-page/create', [PdfPageController::class, 'create'])->name('admin.pdf_page.create');
    Route::post('/admin/pdf-page/create', [PdfPageController::class, 'store'])->name('admin.pdf_page.store');
    Route::get('/admin/pdf-page/edit/{id}', [PdfPageController::class, 'edit'])->name('admin.pdf_page.edit');
    Route::post('/admin/pdf-page/update/{id}', [PdfPageController::class, 'update'])->name('admin.pdf_page.update');
    Route::get('/admin/pdf-page/update_status', [PdfPageController::class, 'updateStatus'])->name('admin.pdf_page.update_status');
    Route::get('/admin/pdf-page/destroy/{id}', [PdfPageController::class, 'destroy'])->name('admin.pdf_page.destroy');
    //Pdf Page (end)

    // upload pdf files (starts)
    Route::get('/admin/upload_pdf', [PdfFileController::class, 'index'])->name('admin.upload_pdf.index');
    Route::get('/admin/upload_pdf/create', [PdfFileController::class, 'create'])->name('admin.upload_pdf.create');
    Route::post('/admin/upload_pdf/create', [PdfFileController::class, 'store'])->name('admin.upload_pdf.store');
    Route::get('/admin/upload_pdf/edit/{id}', [PdfFileController::class, 'edit'])->name('admin.upload_pdf.edit');
    Route::post('/admin/upload_pdf/edit/{id}', [PdfFileController::class, 'update'])->name('admin.upload_pdf.update');
    Route::get('/admin/upload_pdf/update_status', [PdfFileController::class, 'updateStatus'])->name('admin.upload_pdf.update_status');
    Route::get('/admin/upload_pdf/destroy/{id}', [PdfFileController::class, 'destroy'])->name('admin.upload_pdf.destroy');
    // upload pdf files (ends)

    // comments route (starts)
    Route::get('/admin/comment', [CommentController::class, 'index'])->name('admin.comment.index');
    Route::get('/admin/comment/update_status', [CommentController::class, 'updateStatus'])->name('admin.comment.update_status');
    Route::get('/admin/reply/update_status', [CommentController::class, 'updateReplyStatus'])->name('admin.reply.update_status');
    // comments route (ends)

    //Newsletter (start)
    Route::get('admin/newsletter', [NewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('admin/newsletter/update_status', [NewsletterController::class, 'updateSatus'])->name('admin.newsletter.update_status');
    Route::get('admin/newsletter/destroy/{id}', [NewsletterController::class, 'destroy'])->name('admin.newsletter.destroy');
    Route::get('admin/newsletter/create', [NewsletterController::class, 'create'])->name('admin.newsletter.create');
    Route::post('admin/newsletter/create', [NewsletterController::class, 'NewsletterSend'])->name('admin.newsletter.create');
    //Newsletter (end)

    //Edit Profile page (start)
    Route::get('admin/edit-profile', [UserController::class, 'viewEditMyProfile'])->name('admin.view.edit_my_profile');
    Route::post('admin/edit-profile', [UserController::class, 'EditMyProfile'])->name('admin.edit.edit_my_profile');
    //Edit Profile page (end)

    //Gallery Page (starts)
    Route::get('admin/gallery', [GalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('admin/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('admin/gallery/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('admin/gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    Route::get('admin/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::post('admin/gallery/update', [GalleryController::class, 'update'])->name('admin.gallery.update');
    Route::get('admin/gallery/update-status', [GalleryController::class, 'updateStatus'])->name('admin.gallery.update_status');
    //Gallery Page (ends)

    //Social media for admin starts
    Route::get('admin/social-media', [SocialMediaController::class, 'index'])->name('admin.social_media.index');
    Route::get('admin/social-media/edit/{social_media_name}', [SocialMediaController::class, 'edit'])->name('admin.social_media.edit');
    Route::post('admin/social-media/update', [SocialMediaController::class, 'update'])->name('admin.social_media.update');
    Route::get('admin/social-media/update_status', [SocialMediaController::class, 'updateStatus'])->name('admin.social_media.update_status');
    //Social media for admin end

     // Widget Section (start)
     Route::get('admin/widget/first-slider', [WidgetController::class, 'firstSliderIndex'])->name('admin.widget.first_slider.index');
     Route::post('admin/widget/first-slider/store', [WidgetController::class, 'firstSliderStore'])->name('admin.widget.first_slider.store');
     Route::post('admin/widget/first-slider/edit', [WidgetController::class, 'firstSliderEdit'])->name('admin.widget.first_slider.edit');
     Route::post('admin/widget/first-slider/update/', [WidgetController::class, 'firstSliderUpdate'])->name('admin.widget.first_slider.update');
     Route::post('admin/widget/first-slider/update-status/', [WidgetController::class, 'firstSliderUpdateStatus'])->name('admin.widget.first_slider.update_status');
     Route::post('admin/widget/first-slider/destroy/', [WidgetController::class, 'firstSliderDestroy'])->name('admin.widget.first_slider.destroy');
     Route::get('admin/widget/video-section', [WidgetController::class, 'videoSectionIndex'])->name('amdin.widget.video_section.index');
     Route::post('admin/widget/video-section/store', [WidgetController::class, 'videoSectionStore'])->name('amdin.widget.video_section.store');
     Route::get('admin/widget/video-section/destroy', [WidgetController::class, 'videoSectionDestroy'])->name('amdin.widget.video_section.destroy');
     Route::get('admin/widget/video-section/edit', [WidgetController::class, 'videoSectionEdit'])->name('admin.widget.video_section.edit');
     Route::post('admin/widget/video-section/update', [WidgetController::class, 'videoSectionUpdate'])->name('admin.widget.video_section.update');
     Route::get('admin/widget/video-section/update-status', [WidgetController::class, 'videoSectionUpdateStatus'])->name('admin.widget.video_section.update_status');
     // Widget Section (end)


    //  Team section (start)
    Route::get('admin/team', [UserController::class, 'teamListIndex'])->name('admin.team.index');
    Route::post('admin/team', [UserController::class, 'teamListStore'])->name('admin.team.store');
    Route::get('admin/team/remove', [UserController::class, 'teamListRemove'])->name('admin.team.remove');
     //  Team section (ends)

     //Advertisement (start)
    Route::get('admin/advertisement', [AdvertisementController::class, 'index'])->name('admin.advertisement.index');
    Route::post('admin/advertisement', [AdvertisementController::class, 'store'])->name('admin.advertisement.store');
    Route::get('admin/advertisement/status_update', [AdvertisementController::class, 'statusUpdate'])->name('admin.advertisement.status_update');
    Route::get('admin/advertisement/edit', [AdvertisementController::class, 'edit'])->name('admin.advertisement.edit');
    Route::post('admin/advertisement/update', [AdvertisementController::class, 'update'])->name('admin.advertisement.update');
    Route::get('admin/advertisement/destroy', [AdvertisementController::class, 'destroy'])->name('admin.advertisement.destroy');
     //Advertisement (end)

     // Send mail to block and unblock user (Start)
    //  Route::get('admin/block_user', [UserController::class, ''])
     // Send mail to block and unblock user (end)

    //   all notification in admin start
     Route::get('admin/all-notification', [NotificationController::class, 'allNotification'])->name('admin.all_notification');
    //   all notification in admin end
  
    });

 
// All Writer routs (starts)====================================================================================
   Route::middleware(['auth', 'acc_status', 'checkWriter'])->group(function(){
    Route::get('/writer', [DashboardController::class, 'RedirectAdminDashboard'])->name('admin');
    Route::get('/writer/dashboard', [DashboardController::class, 'WriterDashboard'])->name('writer.dashboard');
    
    //Post routes (start)
    Route::get('/writer/post', [PostController::class, 'index'])->name('writer.post.index');
    Route::get('/writer/post/create', [PostController::class,'create'])->name('writer.post.create');
    Route::post('/writer/post/create', [PostController::class,'store'])->name('writer.post.store');
    Route::get('/writer/post/edit/{id}', [PostController::class,'edit'])->name('writer.post.edit');
    Route::post('/writer/post/update/{id}', [PostController::class,'update'])->name('writer.post.update');
    Route::get('/writer/post/view/{id}', [PostController::class,'view'])->name('writer.post.view');
    //Post routes (end)

    //upload image from cd editor in create post page (starts)
    Route::post('/writer/ckeditor/upload', [PostController::class, 'ckeditorUpload'])->name('writer.ckeditor.upload');
    Route::post('/writer/tinyeditor', [PostController::class, 'tinyeditorUpload'])->name('writer.tinyeditor.upload');
    Route::post('/writer/summber-not-editor', [PostController::class, 'summerNoteEditorUpload'])->name('writer.summernote.upload');
   //upload image from cd editor in create post page (end)

    // comments route (starts)
    Route::get('/writer/comment', [CommentController::class, 'index'])->name('writer.comment.index');
    // comments route (ends)

        //Edit Profile page (start)
        Route::get('writer/edit-profile', [UserController::class, 'viewEditMyProfile'])->name('writer.view.edit_my_profile');
        Route::post('writer/edit-profile', [UserController::class, 'EditMyProfile'])->name('writer.edit.edit_my_profile');
        //Edit Profile page (end)

      //Social media for writer starts
         Route::get('writer/social-media', [SocialMediaController::class, 'index'])->name('writer.social_media.index');
         Route::get('writer/social-media/edit/{social_media_name}', [SocialMediaController::class, 'edit'])->name('writer.social_media.edit');
         Route::post('writer/social-media/update', [SocialMediaController::class, 'update'])->name('writer.social_media.update');
         Route::get('writer/social-media/update_status', [SocialMediaController::class, 'updateStatus'])->name('writer.social_media.update_status');
      //Social media for writer end


  // Question and answer (starts)
  Route::get('/writer/question-and-answer', [QuestionAndAnswerController::class, 'index'])->name('writer.question_and_answer.index');
  // Question and answer (ends)

  //   all notification in admin start
  Route::get('writer/all-notification', [NotificationController::class, 'allNotification'])->name('writer.all_notification');
  //   all notification in admin end
    
  });
// All Writer routs (ends)======================================================================================


// All Normal user routes (starts)
Route::middleware(['auth', 'checkUser'])->group(function(){
  Route::get('user', [DashboardController::class, 'RedirectAdminDashboard'])->name('user');
  Route::get('user/dashboard', [DashboardController::class, 'UserDashboard'])->name('user.dashboard');

     // comments route (starts)
     Route::get('/user/comment', [CommentController::class, 'index'])->name('user.comment.index');
     // comments route (ends)

      //Edit Profile page (start)
      Route::get('user/edit-profile', [UserController::class, 'viewEditMyProfile'])->name('user.view.edit_my_profile');
      Route::post('user/edit-profile', [UserController::class, 'EditMyProfile'])->name('user.edit.edit_my_profile');
      //Edit Profile page (end)

    //Post routes (start)
       Route::get('/user/post', [PostController::class, 'index'])->name('user.post.index');
       Route::get('/user/post/create', [PostController::class,'create'])->name('user.post.create');
       Route::post('/user/post/create', [PostController::class,'store'])->name('user.post.store');
       Route::get('/user/post/edit/{id}', [PostController::class,'edit'])->name('user.post.edit');
       Route::post('/user/post/update/{id}', [PostController::class,'update'])->name('user.post.update');
       Route::get('/user/post/view/{id}', [PostController::class,'view'])->name('user.post.view');
   //Post routes (end)

  // Question and answer (starts)
  Route::get('/user/question-and-answer', [QuestionAndAnswerController::class, 'index'])->name('user.question_and_answer.index');
  // Question and answer (ends)

      //   all notification in admin start
      Route::get('user/all-notification', [NotificationController::class, 'allNotification'])->name('user.all_notification');
      //   all notification in admin end

});
// All Normal user routes (ends)

// used in both panel after login (starts)=======================================================================
  Route::middleware(['auth'])->group(function(){
  Route::get('/admin/account', [UserController::class, 'accountStatus'])->name('admin.account.status');
  Route::get('/writer/account', [UserController::class, 'accountStatus'])->name('writer.account.status');
  Route::get('/user/account', [UserController::class, 'accountStatus'])->name('user.account.status');
  //get category list and put in select option on create post page (start)
  Route::post('/get-categories', [PostController::class, 'getCategories'])->name('get_categories');
  Route::post('/get-sub-categories', [PostController::class, 'getSubCategories'])->name('get_sub_categories');
  //get category list and put in select option on create post page (ends)

  //delete post for admin and writer panel (start)
  Route::get('/destroyPost/destroy/', [PostController::class,'destroyPost'])->name('post.destroy');
  //delete post for admin and writer panel (end)

  // read notification (start)
  Route::get('/notification/read-notification', [DashboardController::class, 'readNotification'])->name('notification.read_notification');

  // read notification (end)

  // search from panel (start)
  Route::get('panel-search', [DashboardController::class, 'panelSearch'])->name('panel_search');
  // search from panel (end)


});
// used in both panel after login (ends)==========================================================================
