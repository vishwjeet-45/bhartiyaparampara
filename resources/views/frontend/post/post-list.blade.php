@extends('layouts/frontend/main')
@php
$lang = Session::get('lang');
$m_cat_column = 'main_category_name_'.$lang;
$cat_column = 'category_name_'.$lang;
$sub_cat_column = 'sub_category_name_'.$lang;
$cat_desc_column = 'category_short_description_'.$lang;
$sub_cat_desc_column = 'sub_category_short_description_'.$lang;
@endphp

@section('meta-title')
@if($lang == 'hi')
@if(empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['main_cat_detail']['meta_title_hi'] }}
@elseif(!empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['cat_detail']['meta_title_hi'] }}
@else
{{ $category_detail['sub_cat_detail']['meta_title_hi'] }}
@endif

@else
@if(empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['main_cat_detail']['meta_title_en'] }}
@elseif(!empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['cat_detail']['meta_title_en'] }}
@else
{{ $category_detail['sub_cat_detail']['meta_title_en'] }}
@endif
@endif
@endsection

@section('meta-description')
@if($lang == 'hi')
@if(empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['main_cat_detail']['meta_description_hi'] }}
@elseif(!empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['cat_detail']['meta_description_hi'] }}
@else
{{ $category_detail['sub_cat_detail']['meta_description_hi'] }}
@endif

@else
@if(empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['main_cat_detail']['meta_description_en'] }}
@elseif(!empty($category_detail['cat_detail']) && empty($category_detail['sub_cat_detail']))
{{ $category_detail['cat_detail']['meta_description_en'] }}
@else
{{ $category_detail['sub_cat_detail']['meta_description_en'] }}
@endif
@endif
@endsection

@section('main-section')
<style>
  .btn-single-post-left a {
    pointer-events: none;
    background-color: grey;
  }
</style>
<div class="container">
  <ul class="breadcrumbs">
    <li class="breadcrumbs__item">
      <a href="/" target="_blank" class="breadcrumbs__url">{{Session::get('lang') == 'en' ? 'Home':'होम'}}</a>
    </li>
    <li class="breadcrumbs__item">
      <a href="{{route('frontend.post_list', [Str::slug($bread_crumb1->main_category_name_en)])}}"
        class="breadcrumbs__url">{{$bread_crumb1->$m_cat_column}}</a>
    </li>
    @if($bread_crumb2 != '')
    <li class="breadcrumbs__item">
      <a href="{{route('frontend.post_list', [Str::slug($bread_crumb1->main_category_name_en), Str::slug($bread_crumb2->category_name_en)])}}"
        class="breadcrumbs__url">{{$bread_crumb2->$cat_column}}</a>
    </li>
    @endif
    @if($bread_crumb3 != '')
    <li class="breadcrumbs__item">
      <a href="{{route('frontend.post_list', [Str::slug($bread_crumb1->main_category_name_en), Str::slug($bread_crumb2->category_name_en), Str::slug($bread_crumb3->sub_category_name_en)])}}"
        class="breadcrumbs__url">{{$bread_crumb3->$sub_cat_column}}</a>
    </li>
    @endif
  </ul>
</div>
<div class="main-container container pt-40" id="main-container">
  @if($bread_crumb1->page_type == 1 && $bread_crumb2 != '' && !$sub_cat_list->isEmpty())
    <nav class="pagination mb-16">
        <a href="#"> <span class="btn btn-sm btn-color">All</span></a>
        @foreach($sub_cat_list as $sub_cat)
            <a href="{{route('frontend.post_list', [Str::slug($m_cat_name), Str::slug($cat_name), Str::slug($sub_cat->sub_category_name_en)])}}" target="_blank" class="btn btn-sm btn-color">{{$sub_cat->$sub_cat_column}}</a>
        @endforeach
    </nav>
  @endif

<!-- Content -->
  <div class="row">
    <!-- Posts -->
    <div class="col-lg-8 blog__content mb-72">
      <!-- for only single category in url (start)-->
      @if(($bread_crumb1->page_type == '1' || $bread_crumb1->page_type == '0') && $bread_crumb2 == '' && $bread_crumb3 == '')
      <div class="row card-row">
        @foreach($cat_list as $cat)
        <div class="col-md-6">
          <article class="entry card">
            <div class="entry__img-holder card__img-holder">
              <a href="
                  @if(!$cat->subCategories->isEmpty())
                      {{route('frontend.post_list', [$m_cat_name, Str::slug($cat->category_name_en)])}}
                      @else
                      {{route('frontend.post_list', [$m_cat_name, Str::slug($cat->category_name_en)])}}
                      @endif
                      " target="_blank">
                <div class="thumb-container thumb-70">
                  <img data-src="{{url('public/build/assets/upload/category_thumbnail')}}/{{$cat->category_thumbnail}}"
                    class="entry__img lazyload" alt="{{$cat->$cat_column}}" />
                </div>
              </a>
            </div>

            <div class="entry__body card__body">
              <div class="entry__header">
                <h2 class="entry__title"><a href="{{route('frontend.post_list', [$m_cat_name, Str::slug($cat->category_name_en)])}}" target="_blank">{{$cat->$cat_column}}</a></h2>
              </div>
              <div class="entry__excerpt">
                <p align="justify">{{$cat->$cat_desc_column}}</p>
              </div>
              <div align="right" class="mt-3">
                <a href="
                      @if(!$cat->subCategories->isEmpty())
                      {{route('frontend.post_list', [$m_cat_name, Str::slug($cat->category_name_en)])}}
                      @else
                      {{route('frontend.post_list', [$m_cat_name, Str::slug($cat->category_name_en)])}}
                      @endif
                      " target="_blank" class="btn btn-sm btn-color mt-3"><span>{{$lang == 'en'?'Read More':'पूरा
                    पढ़े'}}</span>
                </a>
              </div>
            </div>
          </article>
        </div>
        @endforeach
      </div>
      <!-- for only single category in url (end)-->

      <!-- for two category in url (start)-->
      @elseif($bread_crumb1->page_type == '1' && $bread_crumb2 != '' && $bread_crumb3 == '')
      <div class="row card-row">
        @foreach($sub_cat_list as $sub_cat)
        <div class="col-md-6">
          <article class="entry card">

            <div class="entry__img-holder card__img-holder">
              <a href="{{route('frontend.post_list', [Str::slug($m_cat_name), Str::slug($cat_name), Str::slug($sub_cat->sub_category_name_en)])}}"
                target="_blank">
                <div class="thumb-container thumb-70">
                  <img
                    data-src="{{url('public/build/assets/upload/sub_cat_thumbnail')}}/{{$sub_cat->sub_category_thumbnail}}"
                    class="entry__img lazyload" alt="{{$sub_cat->$sub_cat_column}}" />
                </div>
              </a>
            </div>

            <div class="entry__body card__body">
              <div class="entry__header">
                <h2 class="entry__title"><a href="#" target="_blank">{{$sub_cat->$sub_cat_column}}</a></h2>
              </div>
              <div class="entry__excerpt">
                <p align="justify">{{$sub_cat->$sub_cat_desc_column}}</p>
              </div>
              <div align="right" class="mt-3">
                <a href="{{route('frontend.post_list', [Str::slug($m_cat_name), Str::slug($cat_name), Str::slug($sub_cat->sub_category_name_en)])}}"
                  target="_blank" class="btn btn-sm btn-color"><span>{{$lang == 'en'?'Read More':'पूरा पढ़े'}}</span>
                </a>
              </div>
            </div>
          </article>
        </div>
        @endforeach
      </div>
      <!-- for two category in url (ends)-->

      <!-- for three category in url (start)-->
    @elseif($bread_crumb1->page_type == '1' && $bread_crumb2 != '' && $bread_crumb3 != '')
        @foreach($post_list as $post)
            @php
                $like_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type', 'like')->count();
                $heart_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type', 'heart')->count();
            @endphp
            <article class="entry card post-list">
            <div class="entry__img-holder post-list__img-holder card__img-holder"
              style="background-image: url({{url('public/build/assets/upload/thumbnail')}}/{{$post->thumbnail_image}})">
            </div>
            <div class="entry__body post-list__body card__body custom_cbody">
              <div class="entry__header">
                <h2 class="entry__title"><a>{!! Str::limit($post->meta_title, 45) !!}</a></h2>
                <ul class="entry__meta">
                  <li class="entry__meta-author">
                    <a href="{{route('frontend.writer_profile', [Str::slug($post->getUser->name), $post->getUser->id])}}">{{$post->getUser->name}}</a>
                  </li>
                  <li class="entry__meta-date">{{date('M j, Y', strtotime($post->publish_on))}}</li>
                </ul>
              </div>
              <div class="entry__excerpt">
                <p align="justify">{!! Str::limit($post->short_description, 300) !!}</p>
              </div>
              <div class="mt-3">
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
                    <a href="{{route('frontend.view.post', [$post->slug])}}"
                      target="_blank" class="btn btn-sm btn-color" id="media-show-set">
                      <span>{{$lang == 'en'?'Read More':'पूरा पढ़े'}}</span>
                    </a>
                  </div>
                </div>
    
              </div>
            </div> 
          </article>
        @endforeach
        <!-- for three category in url (end)-->
     @endif

    @if((($bread_crumb1->page_type == '0' && $bread_crumb2 != '' && $bread_crumb3 == '') || ($bread_crumb1->page_type == '3' && $bread_crumb3 == '') || ($bread_crumb1->page_type == '4' && $bread_crumb2 == '' && $bread_crumb3 == '')))
          @if(!$post_list->isEmpty())
          @foreach($post_list as $index => $post)
          @php
          $like_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type', 'like')->count();
          $heart_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type', 'heart')->count();
          @endphp

    <!-- Top Verticle ads (large) - (start) -->
        @if($index == 4)
            <div class="text-center pb-48">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Vertical Ad 2 -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9148274628956787"
              data-ad-slot="8363607966" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
    
          </div>
        @endif
    <!-- Top Verticle ads (large) - (end) -->

    <!-- bottom ads verticle(larg) start  -->
        @if($index == 8)
            <div class="text-center pb-48">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Vertical Ad 2 -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9148274628956787"
          data-ad-slot="8363607966" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

      </div>
        @endif
    <!-- bottom ads verticle(large) end  -->

      <article class="entry card post-list">
        <div class="entry__img-holder post-list__img-holder card__img-holder" style="background-image: url({{url('public/build/assets/upload/thumbnail')}}/{{$post->thumbnail_image}})">
        </div>
        <div class="entry__body post-list__body card__body custom_cbody">
          <div class="entry__header">
            <h2 class="entry__title"><a>{!! Str::limit($post->meta_title, 45) !!}</a></h2>

            <ul class="entry__meta">
              <li class="entry__meta-author">
                <a
                  href="{{route('frontend.writer_profile', [Str::slug($post->getUser->name), $post->getUser->id])}}">{{$post->getUser->name}}</a>
              </li>
              <li class="entry__meta-date">{{date('M j, Y', strtotime($post->publish_on))}}</li>
            </ul>
          </div>
          <div class="entry__excerpt">
            <p align="justify">{!! Str::limit($post->short_description, 300) !!}</p>
          </div>
          <div class="mt-3" style="text-align: right;">

            @if (!in_array(35, $post->category_id) && !in_array(36, $post->category_id) && !in_array(37,
            $post->category_id))
            <div class="btn-container d-flex justify-content-between">
              <div class="btn-single-post-left">
                <a href="javascript:void(0);" class="btn btn-sm btn-color ">
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
                <a href="{{route('frontend.view.post', [$post->slug])}}"
                  target="_blank" class="btn btn-sm btn-color">
                  <span>{{$lang == 'en'?'Read More':'पूरा पढ़े'}}</span>
                </a>
              </div>
            </div> 
            @endif
          </div>
        </div>
      </article>
      @endforeach
     @endif
    @endif
      <div class="my_pagination">
        {{ $post_list->links('pagination::bootstrap-4') }}
      </div>
    </div> <!-- end posts -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
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
                <img
                  src="{{url('public/build/assets/upload/thumbnail/pdf_file_thumbnail')}}/{{$s_c_pdf->thumbnail ?? ''}}"
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

              <a href="{{route('frontend.view.post', [$article->slug])}}"
                target="_blank">
                <div class="post-list-small__img-holder">
                  <div class="thumb-container thumb-100">

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
      <a href="{{route('frontend.writer_profile', [$username_slug, $article->getUser->id])}}"
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
</aside>

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

</div>
</div>

@endsection