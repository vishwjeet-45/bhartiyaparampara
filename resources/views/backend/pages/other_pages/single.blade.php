@extends('layouts/frontend/main')

@section('meta-title')
{{$other_page->meta_title}}
@endsection
@section('meta-description')
{{$other_page->meta_description}}
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
          <a href="#" class="breadcrumbs__url">{{$other_page->meta_title}}</a>
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

            <h1 class="single-post__entry-title">{{$other_page->meta_title}}</h1>

            <div class="entry__meta-holder">
              <ul class="entry__meta">

                <!-- <li class="entry__meta-date">{{$other_page->created_at->format('F j, Y')}}</li> -->
              </ul>

              <!-- <ul class="entry__meta">
                    <li class="entry__meta-views">
                      <i class="ui-eye"></i>
                      <span>1356</span>
                    </li>
                    <li class="entry__meta-comments">
                      <a href="#">
                        <i class="ui-chat-empty"></i>13
                      </a>
                    </li>
                  </ul>-->
            </div>
          </div> <!-- end entry header -->

          <!-- <div class="entry__img-holder">
            <img src="{{url('public/build/assets/upload/thumbnail/other_pages')}}/{{$other_page->thumbnail_image}}"
              alt="" class="entry__img">
          </div> -->

          <div class="entry__article-wrap">


            <div class="entry__article">
              {!! $other_page->page_data !!}
            </div>
          </div>


          @if(request()->is('pages/contact-us'))
          <form method="POST" action="{{route('contact_us.enquiry')}}">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <label for="text">Name:</label>
                <input type="text" name="name" id="name" value="{{old('name')}}">
                @error('name')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="text">Email:</label>
                <input type="email" name="email_id" id="email_id" value="{{old('email_id')}}">
                @error('email_id')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="text">Phone no.</label>
                <input type="text" name="phone" id="phone" value="{{old('phone')}}">
                @error('phone')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="subject"> Subject:</label>
                <input type="text" name="subject" id="subject" value="{{old('subject')}}">
                @error('subject')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="comment"> Comment:</label>
                <textarea name="comment" id="comment" rows="4" cols="50">{{old('comment')}}</textarea>
                @error('comment')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="comment"> Captcha:</label>
                <div class="captcha">
                    <span>{!! captcha_img('flat') !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                        &#x21bb;
                    </button>
              </div>
            </div>
            <div class="col-md-4">
              <label for="comment"> Enter Captcha Here:</label>
                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
            </div>
            @error('captcha')
            @if($message == 'validation.captcha') 
            <p style="color:red;">Invalid Captcha</p>
            @else
                <p style="color:red;">{{$message}}</p>
                @endif
                @enderror
            </div>

            <p class="comment-form-submit">
              <input type="submit" class="btn btn-lg btn-color btn-button" value="Send" id="submit-message">
            </p>
          </form>
          @endif


          @if(request()->is('pages/advertise-with-us'))
          <form method="POST" action="{{route('advertisement.enquiry')}}">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <label for="text">Name:</label>
                <input type="text" name="name" id="name" value="{{old('name')}}">
                @error('name')
                <p style="color:red;">{{$message}}</p>
                @enderror

              </div>
              <div class="col-md-4">
                <label for="text">Email:</label>
                <input type="text" name="email_id" id="email_id" value="{{old('email_id')}}">
                @error('email_id')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="text">Phone no.</label>
                <input type="text" name="phone" id="phone" value="{{old('phone')}}"> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="{{old('city')}}">
                @error('city')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="category">Category:</label>
                <input type="text" name="category" id="category" value="{{old('category')}}">
                @error('category')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="duration">Duration (in months):</label>
                <input type="number" name="duration" id="duration" value="{{old('duration')}}">
                @error('duration')
                <p style="color:red;">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="size">Ad Size:</label>
                <select name="size" id="size">
                  <option value="Large" {{(old('size') == 'Large'?'selected':'')}}>Large</option>
                  <option value="Small" {{(old('size') == 'Small'?'selected':'')}}>Small</option>
                </select>
               
              </div>
              <div class="col-md-6">
                <label for="position">Ad Position:</label>
                <select name="position" id="position">
                  <option value="Top" {{old('position') == 'Top'?'selected':''}}>Top</option>
                  <option value="Middle" {{old('position') == 'Middle'?'selected':''}}>Middle</option>
                  <option value="Bottom" {{old('position') == 'Bottom'?'selected':''}}>Bottom</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="comment"> Comment:</label>
                <textarea name="comment" id="comment" rows="4" cols="50">{{old('comment')}}</textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="comment"> Captcha:</label>
                <div class="captcha">
                    <span>{!! captcha_img('flat') !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                        &#x21bb;
                    </button>
              </div>
            </div>
            <div class="col-md-4">
              <label for="comment"> Enter Captcha Here:</label>
                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                @error('captcha')
            @if($message == 'validation.captcha') 
            <p style="color:red;">Invalid Captcha</p>
            @else
                <p style="color:red;">{{$message}}</p>
                @endif
                @enderror
            </div>
            
            </div>
            
            <p class="comment-form-submit">
              <input type="submit" class="btn btn-lg btn-color btn-button" value="Send" id="submit-message">
            </p>
          </form>
          @endif 
        </article>  
      </div>  
    </div>  


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

      <!-- Widget Socials -->

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
            </aside> <!-- end widget socials -->
  
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
        <h4 class="widget-title">{{$lang == 'hi'?'लोकप्रिय लेख':'Popular Articles'}}</h4>
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
                  <a href="{{route('frontend.view.post', [$p_article->getuser->name, $p_article->slug])}}"
                    target="_blank">
                    <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$p_article->thumbnail_image}}"
                      alt="Maharshtra ki Mahalaxmi" class=" lazyload">
                  </a>
                </div>
              </div>
              <div class="post-list-small__body">
                <h3 class="post-list-small__entry-title">
                  <a href="{{route('frontend.view.post', [$p_article->getuser->name, $p_article->slug])}}"
                    target="_blank">{{$p_article->meta_title}}</a>
                </h3>
                <ul class="entry__meta">
                  <li class="entry__meta-author">
                    <a href="{{route('frontend.writer_profile', [$username_slug, $user->id])}}"
                      target="_blank">{{$user->name}}</a>
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
</div> <!-- end main container -->
<div class="flex-child text-center">
  <!-- Ad Banner 728 -->
</div>

@section('javascript-section')
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: "{{route('reload_captcha')}}",
            success: function (data) {
              console.log(data);
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>

@if(Session::has('not_sent'))
<!-- <script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('not_sent'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script> -->
@endif

  @if(Session::has('sent'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Success",
      text: "{{(Session::get('sent'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif  

@endsection



@endsection