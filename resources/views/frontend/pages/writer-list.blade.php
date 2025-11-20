@extends('layouts/frontend/main')
@php
$lang = Session::get('lang');
$bio_column = 'bio_'.$lang;
@endphp

@section('meta-title')
@if($lang == 'hi')
हमारे सम्मानित लेखक: प्रेरणादायक लेख एवं रचनाये 
@else
Creative Minds Unleashed: Explore Our Writers' Page for Inspiring Content
@endif
@endsection

@section('meta-description')
@if($lang == 'hi')
हमारे सम्मानित लेखकों द्वारा रचित प्रेरणादायक लेख औ रचनाएं। जो साहित्यिक गरिमा और विचारशीलता से भरपूर है, जिससे आपको विभिन्न त्योहारों, संस्कृति, दैनिक जीवन के उपाय, दार्शनिक स्थल और विभिन्न विषयों की जानकारी प्राप्त होगी।
@else
Inspirational articles and creations written by our respected writers. Which is full of literary dignity and thoughtfulness, through which you will get information about various festivals, culture, daily life tips, philosophical sites and various subjects.
@endif
@endsection


@section('main-section')
@php
$lang = Session::get('lang');
$bio_column = 'bio_'.$lang;
@endphp

<style>
    .my_pagination ul li.active {
    font-size: 20px;
    text-align: center;
    justify-content: center;
    align-items:center;
    display: flex;
    border: 1px solid gray;
    width: 35px;
}
.my_pagination ul li a.page-link {
    font-size: 20px;
    text-align: center;
    justify-content: center;
    align-items:center;
    display: flex;
    border: 1px solid gray;
    width: 35px;
}
.my_pagination ul li.disabled {
    font-size: 25px;
    text-align: center;
    justify-content: center;
    display: flex;
    border: 1px solid gray;
    width: 35px;
}
</style>
     <!-- Breadcrumbs -->
     <div class="container">
      <ul class="breadcrumbs">
      <li class="breadcrumbs__item">
            <a href="/" target="_blank" class="breadcrumbs__url">{{$lang == 'hi' ? 'होम' : 'Home'}}</a>
        </li>
        <li class="breadcrumbs__item">
            <a href="#" class="breadcrumbs__url">{{$lang == 'hi' ? 'लेखक की क़लम से' : 'Writer\'s Corner'}} </a>
        </li>
       
      </ul>
    </div>

<div class="main-container container" id="main-container">         

      <!-- Content -->
      <div class="row">

        <!-- Posts -->
      <div class="col-lg-8 blog__content mb-72">
         <!-- <h1 class="page-title">Our Respected Team Members</h1>-->
            @foreach($all_writer_list as $writer)
          <article class="entry card post-list">
            <div class="entry__img-holder post-list__img-holder card__img-holder">
              <a class="thumb-url"></a>
              @if($writer->profile_image != '')
                    <img src="{{url('public/build/assets/upload/user/profile_image')}}/{{$writer->profile_image}}"
                        alt="{{$writer->name}}" class="entry__img" width="80%">
                    @else
                    <img src="{{url('public/build/assets/frontend/img')}}/full_user_image.png" alt="{{$writer->name}}"
                        class="" width="60%">

                    @endif
            </div>

            <div class="entry__body post-list__body card__body custom_cbody">
              <div class="entry__header">
                <h2 class="entry__title">
                  <a href="{{route('frontend.writer_profile', [Str::slug($writer->name), $writer->id])}}" target="_blank">{{$writer->name}}</a>
                </h2>
                <ul class="entry__meta">
                  <li class="entry__meta-author">
                    <span style="color:red">{{$writer->city}}</span>
                  </li>
                </ul>
              </div>        
              <div class="entry__excerpt"> 
                    {!!Str::limit($writer->$bio_column, 270)!!}
              </div>
              <div align="right" class="mt-3">
              <a href="{{route('frontend.writer_profile', [Str::slug($writer->name), $writer->id])}}" target="_blank" class="btn btn-sm btn-color">
                <span>{{$lang == 'hi'?'पूरा पढ़े':'Read More'}}</span>
              </a>
            </div>
            </div>
          </article>

          @endforeach
           
          <div class="my_pagination">
        {{ $all_writer_list->links('pagination::bootstrap-4') }}
      </div>
           

</div>

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
        </aside>
         <!-- end sidebar -->
</div>
</div>
</div>





@endsection