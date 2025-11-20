@php
$lang = Session::get('lang');
$pdf_page_name = 'page_name_'.Session::get('lang');
$top_header_menu_page_name = 'main_category_name_'.Session::get('lang');
@endphp

@extends('layouts/frontend/main')

@section('meta-title')
@if($lang == 'hi')
भारतीय परम्परा: त्योहारों का देश, संस्कृति और परंपरा की पहचान
@else
Bhartiya Parampara: Country of Festivals, Identity of Culture and Tradition
@endif
@endsection

@section('meta-description')
@if($lang == 'hi')
भारतीय परंपरा आपको भारतीय सांस्कृतिक, त्योहार, रीति रिवाज, शास्त्र, ज्योतिष, वास्तु, साहित्य, और अन्य कई विषयों पर पूरी
जानकारी प्रदान करती है। आइए, हमारे साथ भारतीय समृद्धि की यात्रा पर निकलें और हमारी विरासत को समझें।
@else
Explore the rich tapestry of Indian culture with Bhartiya Parampara, offering comprehensive information on traditions, festivals, rituals, scriptures, astrology, vastu, literature, and much more. Immerse yourself in the diverse facets of India's heritage and discover the beauty and richness of our civilization.
@endif
@endsection

@section('main-section')
<style>
    .owl-dots {
        display: none !important;
    } 
    .respected-writers {
        justify-content: center;
        display: flex;
    }  
    .writer_intro{
        width:250px;
        height:250px;
    }
    .writer_intro img{
    width: 100%;
        height: 100%;
        width: 260px;
        border-radius: 50%;
     height: 250px;
    }
    .writer_intro p{
        font-weight:bold;
        margin-top:5px;
    }
    .fest_custom_margin{
        margin-bottom: 0px !important;
    }
    .fest_cstm_padd{
            padding: 25px !important;
    }
    .entry__title a{
        color:#000 !important;
    } 
</style>
<!-- Trending Now -->
<div class="container">
    <div class="trending-now">
        <span class="trending-now__label">
            <i class="ui-flash"></i>
            Latest Update</span>
        <div class="newsticker">
            <ul class="newsticker__list">
                @foreach($letest_post_with_update_at as $post)
                @php
                $user = App\Models\User::where('id', $post->post_by)->first();
                @endphp
                <li class="newsticker__item"><a href="{{route('frontend.view.post', [$post->slug])}}"
                        target="_blank" class="newsticker__item-url">{{$post->meta_title}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="newsticker-buttons">
            <button class="newsticker-button newsticker-button--prev" id="newsticker-button--prev"
                aria-label="next article"><i class="ui-arrow-left"></i></button>
            <button class="newsticker-button newsticker-button--next" id="newsticker-button--next"
                aria-label="previous article"><i class="ui-arrow-right"></i></button>
        </div>
    </div>
</div>
<section class="featured-posts-grid featured-posts-grid--1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!------------------------------------------------------- Top Verticle Google ads (large) - (start) -------------------------------------------------->
                <!-- <div class="text-center pb-48"> 
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-9148274628956787"
                        data-ad-slot="8363607966"
                        data-ad-format="auto"
                        data-full-width-responsive="true">
                    </ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script> 
                </div> -->
                <!------------------------------------------------------- Top Verticle Google ads (large) - (end) -------------------------------------------------->
            </div>
            <div class="col-lg-6">
                <article class="entry thumb thumb--size-4">

                    <div id="side-top-side" class="entry__img-holder thumb__img-holder" style="height: 100%;">
                        @foreach($first_slider as $slider)
                        <div class="mySlides" style="height: 100% !important;">
                            <a href="{{$slider->url}}" target="_blank"><img
                                    src="{{url('public/build/assets/upload/banner')}}/{{$slider->image}}"
                                    class="slide-img" alt="Slide 1" style=" height: 100%;"></a>
                        </div>
                        @endforeach
                    </div>

                </article>
                <div class="row">
                    <div class="col-lg-6">
                        @if($third_slider != null)
                        <article class="entry thumb thumb--size-1">
                            <div class="entry__img-holder thumb__img-holder"
                                style="background-image:url('{{url('public/build/assets/upload/thumbnail/pdf_file_thumbnail')}}/{{$third_slider->thumbnail}}');">
                                <div class="bottom-gradient"></div>
                                <div class="thumb-text-holder thumb-text-holder--4">
                                    @php
                                    $pdf_page_detail = App\Models\backend\PdfPage::where('id', 10)->first();
                                    $third_slider_column_name = 'page_name_'.$lang;
                                    @endphp
                                    <a href="{{route('frontend.pdf_page.index', [$pdf_page_detail->slug])}}">
                                        <h5><span
                                                class="badge bg-secondary entry__meta-category entry__meta-category--label entry__meta-category--cyan">{{$pdf_page_detail->$third_slider_column_name}}</span>
                                        </h5>
                                    </a>
                                    <h2 class="thumb-entry-title">
                                        <a href="{{url('public/magazine')}}/{{$third_slider->year}}/{{$third_slider->pdf_file}}"
                                            target="_blank">{{$third_slider->pdf_file_title}} </a>
                                    </h2>
                                </div>
                                <a href="{{url('public/magazine')}}/{{$third_slider->year}}/{{$third_slider->pdf_file}}"
                                    target="_blank" class="thumb-url"></a>
                            </div>
                        </article>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <article class="entry thumb thumb--size-1">
                            <div class="entry__img-holder thumb__img-holder"
                                style="background-image: url('{{url('public/build/assets/upload/thumbnail')}}/{{$sixth_slider->thumbnail_image}}');">
                                <div class="bottom-gradient"></div>
                                @php
                                $culture_page_detail = App\Models\backend\MainCategory::where('id', 55)->first();
                                $culture_column_name = 'main_category_name_'.$lang;
                                @endphp
                                <div class="thumb-text-holder thumb-text-holder--4">
                                    <a
                                        href="{{route('frontend.post_list', [$culture_page_detail->slug])}}">
                                        <h5><span
                                                class="badge bg-secondary entry__meta-category entry__meta-category--label entry__meta-category--cyan">
                                                {{$culture_page_detail->$culture_column_name}}</span>
                                        </h5>
                                    </a>
                                    <h2 class="thumb-entry-title">
                                        <a href="{{route('frontend.view.post', [$sixth_slider->slug])}}" target="_blank">{{$sixth_slider->meta_title}}</a>
                                    </h2>
                                </div>
                                <a href="{{route('frontend.view.post', [$sixth_slider->slug])}}"
                                    target="_blank" class="thumb-url"></a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <article class="entry thumb thumb--size-4">
                    <div class="entry__img-holder thumb__img-holder"
                        style="background-image: url('{{url('public/build/assets/upload/thumbnail')}}/{{$second_slider_festival->thumbnail_image}}');">
                        <div class="bottom-gradient"></div>
                        <div class="thumb-text-holder thumb-text-holder--3">
                            <a href="{{route('frontend.post_list', ['festivals'])}}" target="_blank"
                                class="entry__meta-category entry__meta-category--label entry__meta-category--cyan">{{Session::get('lang')
                                == 'hi' ? 'त्योहार':'Festival'}}</a>
                            <h2 class="thumb-entry-title">
                                <a href="{{route('frontend.view.post', [$second_slider_festival->slug])}}"
                                    target="_blank">{{$second_slider_festival->meta_title}}</a>
                            </h2>
                        </div>
                        <a href="{{route('frontend.view.post', [$second_slider_festival->slug])}}"
                            target="_blank" class="thumb-url"></a>
                    </div>
                </article>

                <div class="row">
                    <div class="col-lg-6">
                        <article class="entry thumb thumb--size-1">
                            <div class="entry__img-holder thumb__img-holder"
                                style="background-image: url('{{url('public/build/assets/upload/thumbnail')}}/{{$fifth_slider->thumbnail_image}}');">
                                <div class="bottom-gradient"></div>
                                @php
                                $ancient_history_page_detail = App\Models\backend\MainCategory::where('id',
                                57)->first();
                                $ancient_history_column_name = 'main_category_name_'.$lang;
                                @endphp
                                <div class="thumb-text-holder thumb-text-holder--4">
                                    <a
                                        href="{{route('frontend.post_list', [$ancient_history_page_detail->slug])}}">
                                        <h5><span
                                                class="badge bg-secondary entry__meta-category entry__meta-category--label entry__meta-category--cyan">{{$ancient_history_page_detail->$ancient_history_column_name}}</span>
                                    </a>
                                    </h5>
                                    <h2 class="thumb-entry-title">
                                        <a href="{{route('frontend.view.post', [$fifth_slider->slug])}}"
                                            target="_blank">{{$fifth_slider->meta_title}}</a>
                                    </h2>
                                </div>
                                <a href="{{route('frontend.view.post', [$fifth_slider->slug])}}"
                                    target="_blank" class="thumb-url"></a>
                            </div>
                        </article>
                    </div>
                    @if(!empty($forth_slider))
                    <div class="col-lg-6">
                        <article class="entry thumb thumb--size-1">
                            <div class="entry__img-holder thumb__img-holder"
                                style="background-image: url('{{url('public/build/assets/upload/thumbnail')}}/{{$forth_slider->thumbnail_image}}');">
                                <div class="bottom-gradient"></div>
                                @php
                                $handy_tips_page_detail = App\Models\backend\MainCategory::where('id', 61)->first();
                                $handy_tpips_column_name = 'main_category_name_'.$lang;
                                @endphp
                                <div class="thumb-text-holder thumb-text-holder--4">
                                    <a
                                        href="{{route('frontend.post_list', [$handy_tips_page_detail->slug])}}">
                                        <h5><span
                                                class="badge bg-secondary entry__meta-category entry__meta-category--label entry__meta-category--cyan">
                                                {{$handy_tips_page_detail->$handy_tpips_column_name}}</span>
                                        </h5>
                                    </a>
                                    <h2 class="thumb-entry-title">
                                        <a href="{{route('frontend.view.post', [$forth_slider->slug])}}"
                                            target="_blank"> {{$forth_slider->meta_title}}</a>
                                    </h2>
                                </div>
                                <a href="{{route('frontend.view.post', [$forth_slider->slug])}}"
                                    target="_blank" class="thumb-url"></a>
                            </div>
                        </article>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------------------------------- Top Verticle ads (large) - (start) --------------------------------------------------->
<div class="text-center pb-48">
    @if(!empty($top_ads_large))
    @foreach($top_ads_large as $ads)
    <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
    @endforeach
    @endif
</div>
<!-------------------------------------------------- Top Verticle ads (large) - (end) ------------------------------------------------------>

<div class="main-container container pt-24" id="main-container">
    <div class="row">
        <div class="col-lg-8 blog__content">
            <section class="section tab-post mb-16">
                <div class="title-wrap title-wrap--line">
                    <h3 class="section-title">{{$lang == 'en'?'Festival':'त्योहार'}}</h3>
                </div>
                <div class="tabs__content tabs__content-trigger tab-post__tabs-content">
                    <div class="tabs__content-pane tabs__content-pane--active" id="tab-religion">
                        <div class="row card-row">
                            @foreach($festival_post as $f_post)
                            @php
                            $user = App\Models\User::where('id', $f_post->post_by)->first();
                            @endphp

                            <div class="col-md-6">
                                <article class="entry card">
                                    <div class="entry__img-holder card__img-holder">
                                        <a>
                                            <div class="thumb-container thumb-70">
                                                <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$f_post->thumbnail_image}}"
                                                    class="entry__img lazyload" alt="" />
                                            </div>
                                        </a>

                                    </div>
                                    <div class="entry__body card__body">
                                        <div class="entry__header">
                                            <h2 class="entry__title" style="word-wrap:break-word;">
                                                <a href="{{route('frontend.view.post', [$f_post->slug])}}"
                                                    target="_blank">{{Str::limit($f_post->meta_title, 75)}}</a>
                                            </h2>
                                        </div>
                                        <div class="entry__excerpt">
                                            <p align="justify">{!! Str::limit($f_post->short_description, 300) !!}</p>
                                        </div>
                                    </div>

                                </article>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <aside class="col-lg-4 sidebar sidebar--right">
            <!----------------------------------------------- Top Square ads (small) - (start) --------------------------------------------------------->

            <aside class="widget widget_media_image fest_custom_margin">
                @if(!empty($top_ads_small))
                @foreach($top_ads_small as $ads)
                <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"><img src="{{url($ads->image)}}" alt="{{$ads->title}}"> </a><br><br>
                @endforeach
                @endif
            </aside>
            <!---------------------------------------------- Top Square ads (small) - (end) -------------------------------------------------------------->


            <aside class="widget widget-rating-posts">
                <h4 class="widget-title">{{$lang == 'hi'?'आध्यात्मिक संग्रह':'Spiritual Collection'}}</h4>
                @foreach($spiritual_collection_pdf as $s_c_pdf)
                <article class="entry">
                    <div class="entry__img-holder">
                        <a>
                            <div class="thumb-container thumb-60">
                                <img src="{{url('public/build/assets/upload/thumbnail/pdf_file_thumbnail')}}/{{$s_c_pdf->thumbnail ?? ''}}"
                                    class="entry__img lazyload" alt="Corona Effect">
                            </div>
                        </a>
                    </div>
                    <div class="entry__body">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                <a href="{{url('public/magazine')}}/{{$s_c_pdf->year}}/{{$s_c_pdf->pdf_file}}"
                                    target="_blank">{{$s_c_pdf->pdf_file_title ?? ''}}</a>
                            </h2>
                        </div>
                    </div>
                </article>
                @endforeach
            </aside>
            <aside class="widget widget-popular-posts fest_cstm_padd">
                <h4 class="widget-title">{{$lang == 'hi'?'लोकप्रिय लेख':'Popular Article'}}</h4>
                <ul class="post-list-small">
                    @foreach($popular_article as $p_article)
                    @php
                    $user = App\Models\User::where('id', $p_article->post_by)->first();
                    $username_slug = Str::slug($user->name);
                    @endphp
                    <li class="post-list-small__item">
                        <article class="post-list-small__entry clearfix">
                            <div class="post-list-small__img-holder">
                                <div class="thumb-container thumb-100">
                                    <a href="{{route('frontend.view.post', [$p_article->slug])}}"
                                        target="_blank">
                                        <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$p_article->thumbnail_image}}"
                                            alt="Maharshtra ki Mahalaxmi" class=" lazyload">
                                    </a>
                                </div>
                            </div>
                            <div class="post-list-small__body">
                                <h3 class="post-list-small__entry-title">
                                    <a href="{{route('frontend.view.post', [$p_article->slug])}}"
                                        target="_blank">{{$p_article->meta_title}}</a>
                                </h3>
                                <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                        <a href="{{route('frontend.writer_profile', [$username_slug, $user->id])}}"
                                            target="_blank" style="">{{$user->name}}</a>
                                    </li>
                                    <li class="entry__meta-date">
                                        {{date('F m, Y', strtotime($p_article->publish_on))}}
                                    </li>
                                </ul>
                            </div>
                        </article>
                    </li>
                    @endforeach
                </ul>
            </aside>
        </aside>
    </div>
    <!------------------------------------------------ bottom ads verticle(larg) start  -------------------------------------------------------->
    <div class="text-center pb-48">
        @if(!empty($middle_ads_large))
        @foreach($middle_ads_large as $ads)
        <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
        @endforeach
        @endif
    </div>
    <!------------------------------------------------ bottom ads verticle(larg) end  ------------------------------------------------------------>
    @if($m_cat_places_to_visit_cat != null)
    <section class="section mb-0">
        <div class="title-wrap title-wrap--line title-wrap--pr">
            <h3 class="section-title">{{$lang == 'en'?'Place to Visit':'दर्शनीय स्थल'}}</h3>
        </div>
        @php
        $p_visit_column_name = 'category_name_'.Session::get('lang');
        $m_cat_column_name = 'main_category_name_'.Session::get('lang');
        @endphp
        <div id="owl-posts" class="owl-carousel owl-theme owl-carousel--arrows-outside">
            @foreach($places_to_visit_cat as $p_visit_cat)
            <article class="entry thumb thumb--size-1">
                <div class="entry__img-holder thumb__img-holder"
                    style="background-image: url('{{url('public/build/assets/upload/category_thumbnail')}}/{{$p_visit_cat->category_thumbnail}}');">
                    <div class="bottom-gradient"></div>
                    <div class="thumb-text-holder">
                        <h2 class="thumb-entry-title">
                            <a href="{{route('frontend.post_list', [$m_cat_places_to_visit_cat->slug, $p_visit_cat->slug])}}">{{$p_visit_cat->$p_visit_column_name}}</a>
                        </h2>
                    </div>
                    <a href="{{route('frontend.post_list', [$m_cat_places_to_visit_cat->slug, $p_visit_cat->slug])}}"
                        class="thumb-url"></a>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @endif
    
    <div class="row">
        <div class="col-lg-8 blog__content">
            <section class="section tab-post mb-16">
                <div class="title-wrap title-wrap--line">
                    <h3 class="section-title">{{$lang == 'en'?'Ancient History':'प्राचीन इतिहास'}}</h3>
                    @php
                    $category_name_column = 'category_name_'.Session::get('lang');
                    $m_category_name_column = 'main_category_name_'.Session::get('lang');
                    @endphp
                    <div class="tabs tab-post__tabs">
                        <ul class="tabs__list">
                            @foreach($ancient_history as $a_history)
                            <li class="tabs__item tabs__item--active">
                                <a href="#tab_{{$a_history->id}}"
                                    class="tabs__trigger">{{$a_history->$category_name_column}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tabs__content tabs__content-trigger tab-post__tabs-content">
                    @foreach($ancient_history as $index => $a_history)
                    <div class="tabs__content-pane tabs__content-pane--active" id="tab_{{$a_history->id}}"
                        style="display:{{$index != 0 ?'none':''}}">
                        <div class="row card-row">
                            @php
                            $post_list = App\Models\backend\Post::whereJsonContains('category_id',
                            $a_history->id)->where('post_approval_status', 1)->where('post_language', $lang)->orderBy('id', 'desc')->paginate(2);
                            @endphp
                            @foreach($post_list as $post_data)
                            @php
                            $user = App\Models\User::where('id', $post_data->post_by)->first();
                            $cat = App\Models\backend\Category::where('id', $post_data->category_id)->first();
                            @endphp
                            <div class="col-md-6">
                                <article class="entry card">
                                    <div class="entry__img-holder card__img-holder">
                                        <a>
                                            <div class="thumb-container thumb-70">
                                                <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$post_data->thumbnail_image}}"
                                                    class="entry__img lazyload" alt="" />
                                            </div>
                                        </a>
                                        <a href="{{route('frontend.post_list', [Str::slug($ancient_history_m_cat->slug), $cat->slug])}}"
                                            target="_blank"
                                            class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$cat->$category_name_column}}</a>
                                    </div>
                                    <div class="entry__body card__body">
                                        <div class="entry__header">
                                            <h2 class="entry__title" style="word-wrap:break-word;"> <a
                                                    href="{{route('frontend.view.post', [$post_data->slug])}}"
                                                    target="_blank">{!! Str::limit($post_data->meta_title, 75) !!}</a>
                                            </h2>
                                        </div>
                                        <div class="entry__excerpt">
                                            <p align="justify">{!! Str::limit($post_data->short_description , 300) !!}
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!------------------------------------------------------- Top Verticle Google ads (large) - (start) -------------------------------------------------->

            <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> 
              <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-9148274628956787"
                 data-ad-slot="8363607966"
                 data-ad-format="auto"
                 data-full-width-responsive="true">
                </ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script> -->
            <!------------------------------------------------------- Top Verticle Google ads (large) - (end) -------------------------------------------------->
        </div>
        <aside class="col-lg-4 sidebar sidebar--right">
            <!---------------------------------------------------- middle ads square(small) start  ------------------------------------------------------------->
            <!--<div class="text-center pb-48">-->
            <!--    @if(!empty($middle_ads_small))-->
            <!--    @foreach($middle_ads_small as $ads)-->
            <!--    <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>-->
            <!--    @endforeach-->
            <!--    @endif-->
            <!--</div>-->
            <!-------------------------------------------------- middle ads square(small)  end  ------------------------------------------------------->
            @php
            $user = App\Models\User::where('id', $health_post->post_by)->first();

            @endphp
            <aside class="widget widget-rating-posts">
                <h4 class="widget-title">{{$health_post->meta_title ?? ''}}</h4>
                <article class="entry">
                    <div class="entry__img-holder">
                        <a>
                            <div class="thumb-container thumb-60">
                                <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$health_post->thumbnail_image ?? ''}}"
                                    class="entry__img lazyload" alt="Corona Effect">
                            </div>
                        </a>
                    </div>
                    <div class="entry__body">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                <a href="{{route('frontend.view.post', [$health_post->slug])}}"
                                    target="_blank">{{$health_post->meta_description ?? ''}}</a>
                            </h2>
                        </div>
                    </div>
                </article>
            </aside>
        </aside>
    </div>


    <div class="row">
        <div class="col-lg-8 blog__content">
            <section class="section tab-post mb-16">
                <div class="title-wrap title-wrap--line">
                    <h3 class="section-title">{{$lang == 'en'?'Handy Tips':'उपयोगी सुझाव'}}</h3>
                    @php
                    $name_column = 'category_name_'.Session::get('lang');
                    
                    @endphp
                    <div class="tabs tab-post__tabs">
                        <ul class="tabs__list">
                            @foreach($handy_tips as $index => $tips)
                            @if($index == 0 || $index == 1 || $index == 2 || $index == 3 || $index == 5)
                            <li class="tabs__item tabs__item--active">
                                <a href="#tab-home-{{$tips->id}}" class="tabs__trigger"
                                    style="font-size: 14px;">{{$tips->$name_column}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="tabs__content tabs__content-trigger tab-post__tabs-content"> 
                    @foreach($handy_tips as $index => $tips)
                    <div class="tabs__content-pane tabs__content-pane--active" id="tab-home-{{$tips->id}}"
                        style="display:{{$index != 0 ?'none':''}}">
                        <div class="row card-row">
                            @php
                            $post_list = App\Models\backend\Post::whereJsonContains('category_id',
                            $tips->id)->where('post_approval_status', 1)->where('post_language', $lang)->orderBy('id', 'desc')->paginate(2);
                            @endphp
                            @foreach($post_list as $post_data)
                            @php
                            $user = App\Models\User::where('id', $post_data->post_by)->first();
                            $cat = App\Models\backend\Category::where('id', $post_data->category_id)->first();
                            @endphp

                            <div class="col-md-6">
                                <article class="entry card">
                                    <div class="entry__img-holder card__img-holder">
                                        <a>
                                            <div class="thumb-container thumb-70">
                                                <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$post_data->thumbnail_image}}"
                                                    class="entry__img lazyload" alt="" />
                                            </div>
                                        </a>
                                        <a href="{{route('frontend.post_list', [Str::slug($handy_tips_m_cat->slug), $cat->slug])}}"
                                            target="_blank"
                                            class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$cat->$category_name_column}}</a>
                                    </div>
                                    <div class="entry__body card__body">
                                        <h2 class="entry__title" style="word-wrap:break-word;"> <a
                                                href="{{route('frontend.view.post', [$post_data->slug])}}"
                                                target="_blank">{{Str::limit($post_data->meta_title, 75)}}</a> </h2>
                                        <div class="entry__excerpt">
                                            <p align="justify">{!! Str::limit($post_data->short_description, 300) !!}
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
        <aside class="col-lg-4 sidebar sidebar--right"> 
            <aside class="widget widget-rating-posts">
                <h4 class="widget-title">{{$lang == 'hi'?'आज का सुझाव':'Tips Of The Day'}} </h4>

                @if(!empty($motivation_tips_post))
                <article class="entry">
                    <div class="entry__img-holder">
                        <a>
                            <div class="thumb-container thumb-60">
                                <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$motivation_tips_post->thumbnail_image}}"
                                class="entry__img lazyload" alt="What is the success?">
                            </div>
                        </a>
                    </div>
                    <div class="entry__body">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                <a
                                    href="{{route('frontend.view.post', [$motivation_tips_post->slug])}}">{{$motivation_tips_post->meta_title}}</a>
                            </h2>
                        </div>
                    </div>
                </article>
                @endif

            </aside>

            <!-- ---------------------------------------- Google Square (start) --------------------------------------------------------->
             <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9148274628956787" crossorigin="anonymous"></script>
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-9148274628956787"
                    data-ad-slot="8363607966"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>  
            <!-- ---------------------------------------- Google Square (end) --------------------------------------------------------->

        </aside>
    </div>


    <div class="row">
        <div class="col-lg-8 blog__content">
            <section class="section">
                <div class="title-wrap title-wrap--line">
                    <h3 class="section-title">{{$lang == 'en'?'Popular Videos':'लोकप्रिय वीडियो'}}</h3>
                </div>
                @php
                $video_title_column = 'title_'.$lang;
                @endphp
                @foreach($video_list as $index => $video)
                @if($index > 0)
                @break;
                @endif
                <article class="entry thumb thumb--size-5 thumb--mb-20">
                    <div class="entry__img-holder thumb__img-holder"
                        style="background-image: url('{{url('')}}/{{$video->thumbnail}}');">
                        <div class="bottom-gradient"></div>
                        <div class="thumb-text-holder thumb-text-holder--3">
                            <a href="{{route('frontend.post_list', ['festivals'])}}" target="_blank"
                                class="entry__meta-category entry__meta-category--label entry__meta-category--violet">{{$lang == 'hi'?'त्योहार':'Festivals'}}</a>
                            <h2 class="thumb-entry-title">
                                @if($video->type == 'file')
                                <a href="{{url('')}}/{{$video->video_link}}" target="_blank"> {!!
                                    Str::limit($video->$video_title_column, 30) !!}</a>
                                @elseif($video->type == 'url')
                                <a href="{{$video->video_link}}" target="_blank">{{$video->$video_title_column}}</a>
                                @endif
                            </h2>
                        </div>
                        @if($video->type == 'file')
                        <a href="{{url('')}}/{{$video->video_link}}" target="_blank" class="thumb-url"></a>
                        @elseif($video->type == 'url')
                        <a href="{{$video->video_link}}" target="_blank" class="thumb-url"></a>
                        @endif
                    </div>
                </article>
                @endforeach


                <div class="row row-20">
                    @foreach($video_list as $index => $video)
                    @if($index > 0)
                    <div class="col-md-4 my-2">
                        <article class="entry">
                            <div class="entry__img-holder">
                                <a href="{{$video->video_link}}" target="_blank">
                                    <div class="thumb-container thumb-65">
                                        <img src="{{url('')}}/{{$video->thumbnail}}" class="entry__img lazyload"
                                            alt="{{$video->$video_title_column}}" />
                                        <div class="play-btn"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="entry__body">
                                <div class="entry__header">
                                    <h2 class="entry__title entry__title--sm">
                                        @if($video->type == 'file')
                                        <a href="{{url('')}}/{{$video->video_link}}"
                                            target="_blank">{{$video->$video_title_column}}</a>
                                        @elseif($video->type == 'url')
                                        <a href="{{$video->video_link}}" target="_blank">{{$video->title}}</a>
                                        @endif
                                    </h2>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endif
                    @endforeach
                </div>
                
                <a href="https://www.youtube.com/@bhartiyaparampara4366" target="_blank" class="btn btn-sm btn-color">
                                <span>View All </span>
                            </a>
            </section>
        </div>
        <aside class="col-lg-4 sidebar sidebar--right">
            <aside class="widget widget-rating-posts">
                <h4 class="widget-title"> {{$lang == 'en'?'Recommended':'यह भी जरूर देखे'}} </h4>

                <article class="entry">
                    <div class="entry__img-holder">
                        <a
                            href="{{route('frontend.view.post', [$festival_post_most_view->slug])}}">
                            <div class="thumb-container thumb-60">
                                <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$festival_post_most_view->thumbnail_image}}"
                                    class="entry__img lazyload" alt="{{$festival_post_most_view->meta_title}}">
                            </div>
                        </a>
                    </div>
                    <div class="entry__body">
                        <div class="entry__header">

                            <h2 class="entry__title">
                                <a href="{{route('frontend.view.post', [$festival_post_most_view->slug])}}"
                                    target="_blank">{{$festival_post_most_view->meta_title}}</a>
                            </h2>
                            <ul class="entry__meta">
                                <li class="entry__meta-author">
                                    <a href="{{route('frontend.writer_profile', [Str::slug($festival_post_most_view->getUser->name), $festival_post_most_view->getUser->id])}}"
                                        target="_blank">{{$festival_post_most_view->getUser->name}}</a>
                                </li>
                                <li class="entry__meta-date">
                                    {{date('F m, Y', strtotime($festival_post_most_view->publish_on))}}
                                </li>
                            </ul>

                        </div>
                    </div>
                </article>
                <ul class="post-list-small post-list-small--2">
                    @foreach($culture_post_list as $culture_post)
                    <li class="post-list-small__item">
                        <article class="post-list-small__entry clearfix">
                            <div class="post-list-small__img-holder">
                                <div class="thumb-container thumb-70">
                                    <a href="{{route('frontend.view.post', [$culture_post->slug])}}"
                                        target="_blank">
                                        <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$culture_post->thumbnail_image}}"
                                            alt="{{$culture_post->meta_title}}" class=" lazyload">
                                    </a> 
                                </div>
                            </div>
                            <div class="post-list-small__body">
                                <h3 class="post-list-small__entry-title">
                                    <a href="{{route('frontend.view.post', [$culture_post->slug])}}"
                                        target="_blank">{{$culture_post->meta_title}}</a>
                                </h3>
                                <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                        <a href="{{route('frontend.writer_profile', [Str::slug($culture_post->getUser->name), $culture_post->getUser->id])}}"
                                            target="_blank">{{$culture_post->getUser->name}}</a>
                                    </li>
                                    <li class="entry__meta-date">
                                        {{date('F m, Y', strtotime($culture_post->publish_on))}}
                                    </li>
                                </ul>
                            </div>
                        </article>
                    </li>
                    @endforeach
                </ul>
            </aside>
            <!--------------------------------------------------- Bottom ads square(small) end  ------------------------------------------------------>
            <aside class="widget widget_media_image">
                @if(!empty($bottom_ads_small))
                @foreach($bottom_ads_small as $ads)
                <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                @endforeach
                @endif
            </aside>
            <!------------------------------------------------- Bottom ads square(small) end  ----------------------------------------------------------->
        </aside>
    </div>

    @php
    $cat = App\Models\backend\MainCategory::where('id', 54)->where('main_category_status', 1)->first();
    @endphp
    @if($cat != null)
    <div class="row">
        <div class="col-lg-8 blog__content ">
            <section class="section">
                <div class="title-wrap title-wrap--line">
                    <h3 class="section-title">{{$lang == 'en'?'Latest Blogs':'नवीनतम ब्लॉग'}}</h3>
                
                    <a href="{{route('frontend.post_list', [$cat->slug])}}"
                        class="all-posts-url">सभी को देखें</a>
                </div>
                
                @foreach($letest_blog as $blog)
                <article class="entry card post-list mb-5">
                    <div class="entry__img-holder post-list__img-holder card__img-holder"
                        style="background-image: url({{url('public/build/assets/upload/thumbnail')}}/{{$blog->thumbnail_image}})">
                        <a class="thumb-url"></a>
                        <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$blog->thumbnail_image}}"
                            alt="What is Success" class="entry__img d-none">
                    </div>
                    <div class="entry__body post-list__body card__body custom_cbody">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                <a> {{Str::limit($blog->meta_title, 60)}} </a>
                            </h2>
                            <ul class="entry__meta">
                                <li class="entry__meta-author">
                                    <a href="{{route('frontend.writer_profile', [Str::slug($blog->getUser->name), $blog->getUser->id])}}"
                                        target="_blank">{{$blog->getUser->name}}</a>
                                </li>
                                <li class="entry__meta-date">
                                    {{date('F m, Y', strtotime($blog->publish_on))}}
                                </li>
                            </ul>
                        </div>
                        <div class="entry__excerpt">
                            <p align="justify"> {!! Str::limit($blog->short_description, 250) !!}</p>
                        </div>
                        <div align="right" class="mt-2">
                            <a href="{{route('frontend.view.post', [$blog->slug])}}"
                                target="_blank" class="btn btn-sm btn-color">
                                <span>पूरा पढ़े </span>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
             

            </section>
        </div>
        <aside class="col-lg-4 sidebar sidebar--1 sidebar--right">
            <aside class="widget widget_media_image mt-3" style="background: #fff !important;padding: 30px !important;">
                <h4 class="widget-title">{{$lang == 'en'?'Our Respected Writers':'हमारे सम्मानित लेखक'}}</h4>
                <aside class="respected-writers widget widget_media_image">
                    <div class="writer_intro">
                        @foreach($usersWithMostPosts as $writers)
                        @if(!empty($writers->profile_image)) 
                        <a href="{{route('frontend.writer_profile', [Str::slug($writers->name), $writers->id])}}" class=" myfun w3-animate-fading" style="display:none"
                            target="_blank"><img src="{{url('public/build/assets/upload/user/profile_image')}}/{{$writers->profile_image}}"><p >{{$writers->name}}</p></a>   
                                @else
                                <a href="{{route('frontend.writer_profile', [Str::slug($writers->name), $writers->id])}}"
                                    class=" myfun w3-animate-fading" style="display:none" target="_blank"><img
                                        src="{{url('public/build/assets/frontend/img/full_user_image.png')}}">
                                    <p>{{$writers->name}}</p>
                                </a>
                        @endif
                        @endforeach
                    </div>
                </aside>

            </aside>

            <aside class="widget widget-rating-posts">
                <!-- writers post with most views -->
                <h4 class="widget-title">{{$lang == 'en'?'Writer\'s Corner':'लेखक की क़लम से'}}</h4>
                @foreach($writers_corner as $w_corner)
                <article class="entry">
                    <div class="entry__img-holder">
                        <a>
                            <div class="thumb-container thumb-60">
                                <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$w_corner->thumbnail_image}}"
                                    class="entry__img lazyload" alt="Poem - Maa">
                            </div>
                        </a>
                    </div>
                    <div class="entry__body">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                <a href="{{route('frontend.view.post', [$w_corner->slug])}}"
                                    target="_blank">{{Str::limit($w_corner->meta_title, 40)}}</a>
                            </h2>
                        </div>
                    </div>
                </article>
                @endforeach
            </aside>
        </aside>
    </div>
    @endif
    <section>
        <div class="title-wrap title-wrap--line title-wrap--pr">
            <h3 class="section-title">{{$lang == 'en'?'Literary and Spiritual Collection ':'साहित्यिक एवं आध्यात्मिक
                संग्रह '}}</h3>
        </div>

        <div class="owl-carousel unique-carousel">
            @foreach($pdf_page_list as $index => $pdf_page)
            <article class="entry thumb thumb--size-1">
                <div class="entry__img-holder thumb__img-holder"
                    style="background-image: url({{url('public/build/assets/upload/pdf_pages/thumbnail')}}/{{$pdf_page->thumbnail_image}})">
                    <div class="bottom-gradient"></div>
                    <div class="thumb-text-holder">
                        <h2 class="thumb-entry-title">
                            <a
                                href="{{route('frontend.pdf_page.index', [$pdf_page->slug])}}">{{$pdf_page->$pdf_page_name}}</a>
                        </h2>
                    </div>
                </div>
            </article>
            @endforeach

            @php
            $top_menu = App\Models\backend\MainCategory::where('main_category_status', 1)->where('page_type',
            3)->get();
            @endphp

            @foreach($top_menu as $index => $menu)
            <article class="entry thumb thumb--size-1">

                <div class="entry__img-holder thumb__img-holder"
                    style="background-image: url({{url('public/build/assets/upload/main_cat_thumbnail')}}/{{$menu->thumbnail}})">
                    <div class="bottom-gradient"></div>
                    <div class="thumb-text-holder">
                        <h2 class="thumb-entry-title">
                            <a
                                href="{{route('frontend.post_list', [$menu->slug])}}">{{$menu->$top_header_menu_page_name}}</a>
                        </h2>
                    </div>

                </div>
            </article>
            @endforeach
        </div>
    </section> 
</div>


@section('javascript-section')
@if(Session::has('user_registered'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Successfully Registered!",
            text: "Your account is under review!!",
            icon: "success",
            button: "Ok"
        });
    });
</script>
@endif

<script>
    var slideIndex = 1;
    showSlides(slideIndex);
    var slideInterval = setInterval(function ()
    {
        plusSlides(1);
    }, 2000);
    $('#side-top-side').hover(
        function ()
        {
            clearInterval(slideInterval);
        },
        function ()
        {
            slideInterval = setInterval(function ()
            {
                plusSlides(1);
            }, 2000);
        }
    );

    function plusSlides(n)
    {
        showSlides(slideIndex += n);
    }

    function currentSlide(n)
    {
        showSlides(slideIndex = n);
    }

    function showSlides(n)
    {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        if (n > slides.length)
        {
            slideIndex = 1
        }
        if (n < 1)
        {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++)
        {
            slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
    }

</script>
<script>
    $(document).ready(function ()
    {
        var owl = $('#owl-posts');
        owl.owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
        // Custom function to handle continuous scrolling
        owl.on('translated.owl.carousel', function (event)
        {
            var current = event.item.index;
            var items = event.item.count;
            // If it's the last item, jump to the first one without animation
            if (current === items - 1)
            {
                owl.trigger('to.owl.carousel', [0, 100, true]);
            }
        });
    });
</script>

<script>
    $(document).ready(function ()
    {
        $(".unique-carousel").owlCarousel({
            items: 1, // Number of items to display
            loop: true, // Infinite loop
            margin: 10, // Margin between items
            nav: true, // Display navigation arrows
            dots: true, // Display dots navigation
            autoplay: true, // Autoplay the carousel
            autoplayTimeout: 3000, // Autoplay interval in milliseconds
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endsection
@endsection