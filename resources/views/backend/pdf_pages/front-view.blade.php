@extends('layouts/frontend/main')
@php
$lang = Session::get('lang');
$m_cat_column = 'main_category_name_'.$lang;
$cat_column = 'category_name_'.$lang;
$sub_cat_column = 'sub_category_name_'.$lang;
$cat_desc_column = 'category_short_description_'.$lang;
$sub_cat_desc_column = 'sub_category_short_description_'.$lang;
$pdf_file_title_column = 'pdf_file_title_'.$lang;
$short_description_column = 'short_description_'.$lang;
@endphp

@section('meta-title')
@if($lang == 'hi')
{{$page_detail->meta_title_hi}}
@else
{{$page_detail->meta_title_en}}
@endif
@endsection

@section('meta-description')
@if($lang == 'hi')
{{$page_detail->meta_description_hi}}
@else
{{$page_detail->meta_description_en}}
@endif
@endsection
@section('main-section')

<!-- end navigation -->
<!-- Breadcrumbs -->

<style>
    .left-btn-container a{
        pointer-events:none;
        background-color:grey;
    }
</style>
<div class="container">
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="" target="_blank" class="breadcrumbs__url">{{Session::get('lang') == 'en' ? 'Home':'होम'}}</a>
        </li>
        <li class="breadcrumbs__item">
            <p class="breadcrumbs__url">{{Session::get('lang') == 'en' ? $page_detail->page_name_en:$page_detail->page_name_hi}}</p>
        </li>
    </ul>
</div>


<div class="main-container container pt-40" id="main-container">
    <!-- Content -->
    <div class="row">
        <!-- Posts -->
        <div class="col-lg-8 blog__content mb-72">
            <!-- for only single category in url (start)-->

            <!-- for two category in url (start)-->


            @foreach($pdf_file_list as $index => $pdf_file)

            @if($index == 4)
            <!-- Top Verticle ads (large) - (start) -->
            <div class="text-center pb-48">
                @if(!empty($top_ads_large))
                @foreach($top_ads_large as $ads)
                <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                @endforeach
                @endif
            </div>
            <!-- Top Verticle ads (large) - (end) -->
            @endif

            @if($index == 8)
            <!-- bottom ads verticle(larg) start  -->
            <div class="text-center pb-48">
                @if(!empty($middle_ads_large))
                @foreach($middle_ads_large as $ads)
                <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                @endforeach
                @endif
            </div>
            <!-- bottom ads verticle(larg) end  -->
            @endif

            <article class="entry card post-list">
                <div class="entry__img-holder post-list__img-holder card__img-holder"
                    style="background-image: url({{url('public/build/assets/upload/thumbnail/pdf_file_thumbnail')}}/{{$pdf_file->thumbnail}});height:200px">
                </div>
                <div class="entry__body post-list__body card__body">
                    <div class="entry__header">
                        <h2 class="entry__title"><a>{{$pdf_file->$pdf_file_title_column}}</a></h2>
                        <ul class="entry__meta">
                            <li class="entry__meta-date">{{$pdf_file->created_at->format('d, M Y')}}</li>
                        </ul>
                    </div>
                    <div class="entry__excerpt">
                        <p align="justify">{!! $pdf_file->$short_description_column !!}</p>
                    </div>
                    <div class="entry_buttons">
                        <div class="entry_buttons mt-3 d-flex justify-content-between">
                            <div class="left-btn-container">
                                <a href="javascript:void(0);" class="btn btn-sm btn-color">
                                    <i class="fa fa-download"></i> {{$pdf_file->downloads}}
                                </a>
                            </div>
                            <div class="right-btn-container">
                                <button id="download_pdf_btn" class="btn btn-sm btn-color"
                                    data-file-id="{{ $pdf_file->id }}"><span>{{$lang ==
                                        'en'?'Download':'Download'}}</span></button>
                                <a id="file_download_{{$pdf_file->id}}"
                                    href="{{url('public/magazine')}}/{{$pdf_file->year}}/{{$pdf_file->pdf_file}}"
                                    download style="display:none;">download</a>
                                <a href="{{url('public/magazine')}}/{{$pdf_file->year}}/{{$pdf_file->pdf_file}}"
                                    target="_blank" class="btn btn-sm btn-color">
                                    <span>{{$lang == 'en'?'Read More':'Read More'}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
            </article>
            @endforeach

            <!-- for three category in url (end)-->

            <div class="my_pagination">
                {{ $pdf_file_list->links('pagination::bootstrap-4') }}
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
                                    <a href="{{route('frontend.view.post', [Str::slug($article->getUser->name), $article->slug])}}"
                                        target="_blank">
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
            <!-- bottom ads square(small) end -->
            <aside class="widget widget_media_image">
                @if(!empty($bottom_ads_small))
                @foreach($bottom_ads_small as $ads)
                <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                @endforeach
                @endif
            </aside>
            <!-- bottom ads square(small) end  -->
        </aside> <!-- end widget socials -->


        </aside>
        <!-- end posts -->
    </div>
</div> <!-- end content -->
<!-- end main container -->


@section('javascript-section')
<script>


    $(document).ready(function ()
    {
        $(document).on('click', '#download_pdf_btn', function ()
        {
            var fileId = $(this).data('file-id');

            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request to update the download count
            $.ajax({
                type: 'POST',
                url: '{{ route('updateDownloadCount') }}',
                data: {
                    file_id: fileId,
                    _token: csrfToken, // Include the CSRF token in the request
                },
                success: function (response)
                {
                    if (response.success)
                    {
                        // window.location.href = '../public/build/assets/upload/pdf_pages/pdf_files/1699360207.pdf'; // Replace with the actual file path
                        $('#file_download_' + fileId)[0].click();
                    }
                },
                error: function ()
                {
                    alert('Failed to update the download count.');
                }
            });
        });
    });



</script>
@endsection

@endsection