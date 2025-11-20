<?php 
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\backend\PageController;
use App\Http\Controllers\backend\PdfPageController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\CommentController;
use App\Http\Controllers\backend\QuestionAndAnswerController;
use App\Http\Controllers\backend\OtherPageController;
use App\Http\Controllers\customauth\UserController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\NewsletterController;
use PharIo\Version\UnsupportedVersionConstraintException;

Route::get('/reset-db', function() {
    DB::statement('SET GLOBAL max_prepared_stmt_count = 200000');
    return "Database connection reset";
});


    // get post list (start)
        Route::get('post/{m_cat_name}/{cat_name?}/{sub_cat_name?}', [PostController::class, 'postList'])->name('frontend.post_list');
    // get post list (ends)

    // frontend single post (start)
        //  Route::get('/article/{writer_name}/{slug}', [PostController::class, 'ViewPostFrontend'])->name('frontend.view.post');
         Route::get('{slug}', [PostController::class, 'ViewPostFrontend'])->name('frontend.view.post');
    // frontend single post (end)


    //category which work as page (start)
    Route::get('page/{slug}', [PageController::class,'frontendViewPage'])->name('frontend.view.page');
    //category which work as page (ends)

    // Other pages (starts)
    Route::get('pages/{page_slug}', [OtherPageController::class, 'getOtherPage'])->name('frontend.other_page.single');
    // Other pages (ends)

    //Pdf Pages (start)
    Route::get('/pdf/{slug}', [PdfPageController::class,'frontViewPdfPage'])->name('frontend.pdf_page.index');
    Route::post('/updateDownloadCount', [PdfPageController::class, 'updateDownloadCount'])->name('updateDownloadCount');
    //Pdf page (ends)
    
    // subscribe our newsletter (starts)
    Route::post('subscribe-newsletter', [NewsletterController::class, 'store'])->name('frontend.subscribe_newsletter');
    // // subscribe our newsletter (end)


    // mega menu page (start)
    
    // mega menu page (end)

    //Comment frontend start
    Route::post('store-comment', [CommentController::class, 'storeComment'])->name('store_comment');
    Route::post('store-reply', [CommentController::class, 'storeReply'])->name('store_reply');
    //Comment frontend end

    //Question and Answer Route (start)
    Route::get('/in/question-and-answer', [QuestionAndAnswerController::class, 'frontView'])->name('frontend.question.index');
    Route::post('post-answer', [QuestionAndAnswerController::class, 'postAnswer'])->name('frontend.question.post');
    //Question and Answer Route (end)

    Route::get('/in/gallery', [GalleryController::class, 'viewGallery'])->name('frontend.gallery.view');

    Route::get('/writer-profile/{writer_name_slug}/{id}', [HomeController::class, 'writerProfile'])->name('frontend.writer_profile');


    // frontend team list (start)
    Route::get('/in/team', [UserController::class, 'teamListFrontend'])->name('frontend.team.list');
    Route::post('/writer-corner/{team_name}/profile', [UserController::class, 'teamProfileView'])->name('frontend.team.profile_view');
    Route::get('/in/writer-corner/{team_name}/profile', [UserController::class, 'teamProfileView'])->name('frontend.team.profile_viewd');
    // frontend team list (end)

    //page not available error (start)
    // Route::get('/404', [HomeController::class, 'pageNotFound'])->name('frontend.page_not_found');
    //page not available error (end)

    //All writer list (writer's corner) (start)
    Route::get('/in/writer-corner', [UserController::class, 'writersCornerFrontend'])->name('frontend.writers_corner_list');
    //All writer list (writer's corner) (end)