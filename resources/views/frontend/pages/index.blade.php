@extends('layouts/frontend/main')
@section('meta-title')
{{$page->meta_title}}
@endsection
@section('meta-description')
{{$page->meta_description}}
@endsection
@section('main-section')

@php
$lang = Session::get('lang');
@endphp

     <!-- end navigation -->
      <!-- Breadcrumbs -->
      <!-- <div class="container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
          <a href="#" target="_blank" class="breadcrumbs__url">होम</a>
        </li> 
         <li class="breadcrumbs__item">
          <a href="#" class="breadcrumbs__url">{{$page->meta_title}}</a>
        </li>
       </ul>
    </div> -->
        
    <div class="main-container container pt-40" id="main-container">
  <!-- Content -->
  <div class="row">

    <!-- Posts -->
    <!-- post content -->
    <div class="col-lg-8 blog__content mb-72">
      <div class="content-box">

        <!-- standard post -->
        <article class="entry mb-0">

          <div class="single-post__entry-header entry__header">
            <!-- <a href="culture/customs-and-traditions.html" class="entry__meta-category entry__meta-category--label entry__meta-category--orange">रिवाज और परंपराएँ</a> -->

            <h1 class="single-post__entry-title">{{$page->meta_title}}</h1>
              
          </div>
          <div class="entry__img-holder">
            <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$page->thumbnail_image}}" alt=""
              class="entry__img">
          </div>
          <!-- end entry header --> 
          <div class="entry__article-wrap">
            <!-- Share --> 
            <!-- share -->
            <div class="entry__article">
              {!! $page->page_data !!}
            </div> <!-- end entry article -->
          </div> <!-- end entry article wrap -->

           
        </article> <!-- end standard post -->
   

      </div> <!-- end content box -->
    </div> <!-- end post content -->
    <!-- Sidebar -->
    <aside class="col-lg-4 sidebar sidebar--right">
            <!-- Top Square ads (small) - (start)-->
            <aside class="widget widget_media_image">
                @if(!empty($top_ads_small))
                @foreach($top_ads_small as $ads)
                <a href="" target="_blank"><img src="{{url($ads->image)}}" alt="{{$ads->title}}"> </a><br><br>
                @endforeach
                @endif
            </aside>
            <!-- Top Square ads (small) - (end)-->

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
                                    <a href="{{route('frontend.view.post', [Str::slug($article->getUser->name), $article->slug])}}" target="_blank">
                                        <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$article->thumbnail_image}}"
                                            alt="Maharshtra ki Mahalaxmi" class=" lazyloaded">
                                    </a>
                                </div>
                            </div>
                            <div class="post-list-small__body">
                                <h3 class="post-list-small__entry-title">
                                    <a href="{{route('frontend.view.post', [Str::slug($article->getUser->name), $article->slug])}}"
                                        target="_blank">{{$article->meta_title}}</a>
                                </h3>
                                <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                        <a href="{{route('frontend.writer_profile', [$username_slug, $article->getUser->id])}}" target="_blank">{{$article->getUser->name}}</a>
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
</div> <!-- end main container --><div class="flex-child text-center">
            <!-- Ad Banner 728 --> 
          </div>
          
    
   

@endsection