@extends('layouts/frontend/main')
@php
$lang = Session::get('lang');
$bio_column = 'bio_'.$lang;
@endphp

@section('meta-title')
@if($lang == 'hi')
{{$user->meta_title_hi}}
@else
{{$user->meta_title_en}}
@endif
@endsection


@section('meta-description')
@if($lang == 'hi')
{{$user->meta_description_hi}}
@else
{{$user->meta_description_en}}
@endif
@endsection
 
@section('main-section')


<style>
    .post-list-small__entry-title {
        text-align: left;
    }
    .btn-single-post-left a {
    pointer-events: none;
    background-color: grey;
    
    
  }
  
  .writer-img {
    position: relative;
}

.batch-writer {
       position: absolute;
    bottom: 14px;
    left: 90%;
    background: #f9ff5a;
    width: 40px;
    text-align: center;
    height: 40px;
    border-radius: 100%;
    line-height: 30px;
    padding: 9px;
}
</style>

<div class="main-container container pt-40" id="main-container" style="height: auto !important;">


    <!-- Content -->
    <div class="row" style="height: auto !important;">

        <!-- Posts -->
        <!-- post content -->
        <div class="col-lg-8 blog__content mb-72" style="height: auto !important; min-height: 0px !important;">
            <div class="content-box" style="height: auto !important;">
                @if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == 1))
                <!-- standard post -->
                <article class="entry mb-0">

                    <div class="single-post__entry-header entry__header">
                        <a href="{{route('frontend.writers_corner_list')}}"
                            class="entry__meta-category entry__meta-category--label entry__meta-category--green">
                            {{($lang == 'hi' ? 'लेखक की क़लम से' : 'Writers Corner')}}</a>
                        <h1 class="single-post__entry-title">{{$user->name}}</h1>
                     
                        <figure class="alignleft writer-img" style="width: 50%;">
                               @if($user->profile_image == "")
                            <img src="{{url('public/build/assets/frontend/img/full_user_image.png')}}">
                             
                              @else
                               <img src="{{url('public/build/assets/upload/user/profile_image')}}/{{$user->profile_image}}"
                                alt="{{$user->name}}" class=" lazyloaded">
                                
                              @endif
                               <figcaption>{{$user->name}} </figcaption>
                               <div class="batch-writer">
                                    @if($total_post_count >= 0 && $total_post_count <= 25) 
                                      <i class="fa-solid fa-medal" style="color: #3d99f0;"></i> 
                                    
                                    @elseif($total_post_count >= 26 && $total_post_count <= 50) 
                                       <i class="fa-solid fa-medal" style="color: silver;"></i> 
                                    
                                      @elseif($total_post_count > 50)
                                        <i class="fa-solid fa-medal" style="color: gold;"></i> 
                                      
                                      @endif
                            </div>
                               
                        </figure>
                       
                        
                       

                        <p align="justify">{!! $user->$bio_column !!}</p>
                    </div>

                    <div class="entry__share">
                        <p align="justify"> <b>{{$user->email}}</b> </p>
                        <p align="justify"> <b>{{$user->phone_number }}</b> </p>
                        @if($user->user_type != 3)
                        <div class="socials socials--large socials--rounded mb-24">

                            @if($writer_social_media->whatsapp_status == 1)
                            <a class="social social-whatsapp" href="{{$writer_social_media->whatsapp}}" target="_blank"
                                aria-label="whatsapp">
                                <i class="ui-whatsapp"></i>
                            </a>
                            @endif

                            @if($writer_social_media->telegram_status == 1)
                            <a class="social social-telegram icoex" href="{{$writer_social_media->telegram}}"
                                target="_blank" aria-label="telegram">
                                <i class="fab fa-telegram"></i>
                            </a>
                            @endif

                            @if($writer_social_media->youtube_status == 1)
                            <a class="social social-youtube" href="{{$writer_social_media->youtube}}" target="_blank"
                                aria-label="youtube">
                                <i class="ui-youtube"></i>
                            </a>
                            @endif

                            @if($writer_social_media->linkedin_status == 1)
                            <a class="social social-linkedin" href="{{$writer_social_media->linkedin}}" target="_blank"
                                aria-label="linkedin">
                                <i class="ui-linkedin"></i>
                            </a>
                            @endif

                            @if($writer_social_media->x_status == 1)
                            <a class="social social-x icoexx" href="{{$writer_social_media->x}}" target="_blank"
                                aria-label="x">
                                <i class="fa-brands fa-x-twitter"></i></i>
                            </a>
                            @endif

                            @if($writer_social_media->facebook_status == 1)
                            <a class="social social-facebook" href="{{$writer_social_media->facebook}}" target="_blank"
                                aria-label="facebook">
                                <i class="ui-facebook"></i>
                            </a>
                            @endif

                            @if($writer_social_media->instagram_status == 1)
                            <a class="social social-instagram" href="{{$writer_social_media->instagram}}"
                                target="_blank" aria-label="instagram">
                                <i class="ui-instagram"></i>
                            </a>
                            @endif

                            @if($writer_social_media->thread_status == 1)
                            <a class="social social-thread icoexx " href="{{$writer_social_media->thread}}"
                                target="_blank" aria-label="thread">
                                <i class="fa-brands fa-threads"></i>
                            </a>
                            @endif

                           

                        </div>
                        @endif
                    </div>
                </article>  
                @endif
                


                @foreach($post_list as $index => $post)
                @php
                $like_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type', 'like')->count();
                $heart_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type',
                'heart')->count();
                @endphp 
                @if($index == 4 || $index == 8)
                <!-- Top Verticle ads (large) - (start) -->
                <div class="text-center pb-48">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Vertical Ad 2 -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9148274628956787"
                    data-ad-slot="8363607966" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                </div>
                <!-- Top Verticle ads (large) - (end) -->
                @endif 
                <article class="entry card post-list">
                    <div class="entry__img-holder post-list__img-holder card__img-holder"
                        style="background-image: url(../../img/content/writer-corner/yogita-sadani/maheshwari1.jpg)">
                        <a class="thumb-url"></a>
                        <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$post->thumbnail_image}}"
                            alt="{{$post->meta_title}}" class="entry__img ">
                    </div>

                    <div class="entry__body post-list__body card__body custom_cbody">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                <a href="{{route('frontend.view.post', [Str::slug($post->getUser->name), $post->slug])}}" target="_blank">{{$post->meta_title}}</a>
                            </h2>
                            <ul class="entry__meta">
                                <li class="entry__meta-author"> 
                                    <a href="{{route('frontend.writer_profile', [Str::slug($post->getUser->name), $post->getUser->id])}}">{{$post->getUser->name}}</a>
                                </li>
                                <li class="entry__meta-date">
                                    {{date('F d, Y', strtotime($post->publish_on))}}
                                </li>
                            </ul>
                        </div>
                        <div class="entry__excerpt">
                            <p align="justify">{!! Str::limit($post->short_description, 200) !!}</p>
                        </div>
                        <div align="right " style="margin-top: 10px;">
                        <div class="btn-container d-flex justify-content-between">
                            <div class="btn-single-post-left">
                                <a href="javascript:void(0);" class="btn btn-sm btn-color">
                                    <i class="ui-eye"></i> {{$post->views}}
                                </a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-color">
                                    <i class="fa fa-thumbs-up"></i> {{$like_count}}
                                </a>
                                
                                <a href="javascript:void(0);" class="btn btn-sm btn-color">
                                    <i class="fa fa-heart-o"></i> {{$heart_count}}
                                </a>
                            </div>
                            <div class="btn-single-post-right">
                                <a href="{{route('frontend.view.post', [$post->slug])}}" target="_blank"
                                    class="btn btn-sm btn-color">
                                    <span>{{$lang == 'en'?'Read More':'पूरा पढ़े'}}</span>
                                </a>
                            </div>
                        </div>
                           
                            
                        </div>
                    </div>
                </article>
                @endforeach

                <div class="my_pagination">
                    {{ $post_list->links('pagination::bootstrap-4') }}
                </div>
            </div> <!-- end content box -->

        </div> <!-- end post content -->


        <!-- Sidebar -->
        <aside class="col-lg-4 sidebar sidebar--right">
            <!-- Widget Ad 300 -->
            <aside class="widget widget_media_image">
                <aside class="widget widget_media_image">
                    <!-- Top Square ads (small) - (start)-->
                    <aside class="widget widget_media_image">
                        @if(!empty($top_ads_small))
                        @foreach($top_ads_small as $ads)
                        <a href="" target="_blank"><img src="{{url($ads->image)}}" alt="{{$ads->title}}"> </a><br><br>
                        @endforeach
                        @endif
                    </aside>
                    <!-- Top Square ads (small) - (end)-->
                </aside>
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
                <!-- middle ads square(small) start  -->
                <div class="text-center pb-48">
                    @if(!empty($middle_ads_small))
                    @foreach($middle_ads_small as $ads)
                    <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                    @endforeach
                    @endif
                </div>
                <!-- middle ads square(small)  end  -->
                <!-- Widget Popular Posts -->
                <aside class="widget widget-popular-posts">
                    <h4 class="widget-title">{{$lang == 'hi'?'लोकप्रिय लेख':'Popular Articles'}}
                    </h4>
                    <ul class="post-list-small">
                        @foreach($popular_article as $article)
                        @php
                        $username_slug = Str::slug($article->getUser->name);
                        @endphp
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-100">
                                        <a href="{{route('frontend.view.post', [$article->slug])}}"
                                            target="_blank">
                                            <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$article->thumbnail_image}}"
                                                alt="Maharshtra ki Mahalaxmi" class=" lazyloaded">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="{{route('frontend.view.post', [$article->slug])}}"
                                            target="_blank">{{$article->meta_title}}</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <a href="{{route('frontend.writer_profile', [Str::slug($article->getUser->name), $article->getUser->id])}}"
                                                target="_blank">{{$article->getUser->name}}</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            {{date('F m, Y', strtotime($article->publish_on))}}
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        @endforeach
                    </ul>
                </aside> <!-- end widget popular posts -->

                <!-- bottom ads square(small) end  -->
                <aside class="widget widget_media_image">
                    @if(!empty($bottom_ads_small))
                    @foreach($bottom_ads_small as $ads)
                    <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                    @endforeach
                    @endif
                </aside>
                <!-- bottom ads square(small) end  -->
            </aside> <!-- end sidebar -->

    </div> <!-- end content -->
</div>


@endsection