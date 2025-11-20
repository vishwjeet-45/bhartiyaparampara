@extends('layouts/frontend/main')
@section('meta-title')
{{$post->meta_title}}
@endsection

@section('ogimage')
 <meta property="og:image" content="{{url('public/build/assets/upload/thumbnail')}}/{{$post->thumbnail_image}}"/>
@endsection

@section('meta-description'){{$post->meta_description}}@endsection
@section('main-section')
@php
$lang = Session::get('lang');
$user = App\Models\User::where('id', $post->post_by)->first();
$username_slug = Str::slug($user->name);
@endphp

<style>
  .like-btn,
  .heart-btn {
    font-size: 20px;
    border: none;
    background: none;
    text-decoration: none;
  }

  .like-btn {
    color: #4267B2;
  }

  .like-btn:hover {
    color: #4267B2;
  }

  .like-btn .fas {
    color: #4267B2 !important;
  }

  .heart-btn {
    color: red;
  }

  .heart-btn:hover {
    color: red;
  }

  .heart-btn .fas {
    color: red !important;
  }

  input[type="number"] {
    -moz-appearance: textfield;
    /* Firefox */
  }

  input[type="number"]::-webkit-inner-spin-button,
  input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    /* Chrome, Safari */
    margin: 0;
    /* Optional: remove the margin */
  }

  input[type="number"].like_heart_val {
    background-color: transparent;
    /* Optional: set background color */
    border: none;
    /* Optional: remove border */
    font-family: inherit;
    /* Inherit font from parent */
    font-size: inherit;
    /* Inherit font size from parent */
    color: inherit;
    /* Inherit text color from parent */
    pointer-events: none;
    /* Disable interaction with the input */
  }

  .like_heart_val {
    padding: 0 3px 0px 0px;
    width: 50px;
    float: right !important;
    text-align: right;
    font-size: 24px;
    border: none;
    font-size: 21px;
    padding: 0px 5px 0px 0px;
  }

  .view-icon {
    font-size: 20px;
    border: none;
    background: none;
    text-decoration: none;
  }

  .icon-container input {
    height: 30px
  }

  .swal-title {
    font-size: 26px !important;
  }

  .social-telegram {
    background-color: #55ACEE;
    ;
  }

  .social-threads {
    background-color: darkseagreen;
  }

  input#like_no {
    margin-left: -28px;
  }

  input#heart_no {
    margin-left: -28px;

  }

  a#heartButton {
    font-size: 12px !important;
    margin-top: 7px;
  }

  .comment-reply {
    background-color: green;
    color: #fff;
  }

  .comment-reply:hover {
    color: #fff;
    background-color: green !important;
  }

  .comment-submit {
    background-color: red;
    color: #fff;
  }

  .comment-submit:hover {
    background-color: red;
    color: #fff;
  }
</style>

<!-- end navigation -->
<!-- Breadcrumbs -->
<div class="container">
  <ul class="breadcrumbs">
    <li class="breadcrumbs__item">
      <a href="/" target="_blank" class="breadcrumbs__url">होम</a>
    </li>
    @php
    $main_cat_id = $post->main_category_id;
    $main_cat_column = 'main_category_name_'.$lang;

    $cat_id = $post->category_id;
    $cat_column = 'category_name_'.$lang;

    $cat = $post->category_id;
    $sub_cat = $post->sub_category_id;
    @endphp

    @if($main_cat_id != '')
    @php
    $main_cat_name = App\Models\backend\MainCategory::where('id', $main_cat_id)->first();
    @endphp
    <li class="breadcrumbs__item">
      <a href="{{route('frontend.post_list', [Str::slug($main_cat_name->main_category_name_en)])}}"
        class="breadcrumbs__url">{{$main_cat_name->$main_cat_column}}</a>
    </li>
    @endif




    <li class="breadcrumbs__item">
      <a href="#" class="breadcrumbs__url">{{$post->meta_title}}</a>
    </li>
  </ul>
</div>

<div class="main-container container pt-10" id="main-container">
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

            <h1 class="single-post__entry-title">{{$post->meta_title}}</h1>
            <input type="hidden" value="{{$post->id}}" name="post_id" id="post_id">


            <div class="row d-flex" style="width: 100%;justify-content: space-between;">
              <div class="date-container">
                <ul class="entry__meta" style="padding-left: 17px !important;">
                  <li class="entry__meta-author">

                    <a
                      href="{{route('frontend.writer_profile', [$username_slug, $user->id])}}">{{$post->getUser->name}}</a>
                  </li>
                  <li class="entry__meta-date">{{date('M j, Y', strtotime($post->publish_on))}}</li>

                </ul>
              </div>
              <div class="icon-container">
                <div class="d-flex row">
                  <input type="number" class="like_heart_val " value="{{$post->views}}">
                  <a class="view-icon" href="javascript:void(0)" style="font-size:12px; line-height: 30px;"><i
                      class="fa-regular fa-eye" style="color:gray; "></i></a>

                  @if(auth::check())
                  <input type="number" id="like_no" class="like_heart_val" value="{{$like_count}}">
                  <a class="like-btn" id="likeButton" href="javascript:void(0)"><i id="like-icon"
                      class="{{$action_type == 'like'?'fas':'far'}} fa-thumbs-up"
                      style="font-size:12px; line-height: 28px;"></i></a>
                  <input type="number" id="heart_no" class="like_heart_val" value="{{$heart_count}}">
                  <a class="heart-btn" id="heartButton" href="javascript:void(0)" style="    "><i id="heart-icon"
                      class="{{$action_type == 'heart'?'fas':'far'}}  fa-heart"></i></a>
                  @else
                  <input type="number" id="like_no" class="like_heart_val" value="{{$like_count}}">
                  <a class="like-btn" id="likeButton"
                    href="{{route('user.login.view', ['redirect' => url()->current()])}}"><i id="like-icon"
                      class="{{$action_type == 'like'?'fas':'far'}} fa-thumbs-up"
                      style="font-size:17px !important; line-height: 28px;"></i></a>
                  <input type="number" id="heart_no" class="like_heart_val" value="{{$heart_count}}">
                  <a class="heart-btn" id="heartButton"
                    href="{{route('user.login.view', ['redirect' => url()->current()])}}"><i id="heart-icon"
                      class="{{$action_type == 'heart'?'fas':'far'}}  fa-heart "></i></a>
                  @endif
                </div>
              </div>

            </div>
          </div>
          <!-- end entry header -->

          <div class="entry__img-holder">
            <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$post->thumbnail_image}}" alt=""
              class="entry__img">
          </div>
          <div class="entry__share">
            <div class="sticky-col">
              <div class="socials socials--rounded socials--large">
                <a class="social social-whatsapp"
                  href="https://api.whatsapp.com/send?text={{url('/')}}/article/{{Str::slug($post->getUser->name)}}/{{$post->slug}}"
                  title="whatsapp" target="_blank" aria-label="whatsapp" data-action="share/whatsapp/share"
                  style="height: 40px;width: 40px;line-height: 40px;font-size: 14px;">
                  <i class="ui-whatsapp"></i>
                </a>
                <a class="social social-telegram"
                  href="https://t.me/share/url?url={{url('/')}}/article/{{Str::slug($post->getUser->name)}}/{{$post->slug}}&text={{$post->meta_title}}"
                  target="_blank" title="Telegram" style="height: 40px;width: 40px;line-height: 40px;font-size: 14px;">
                  <i class="fa fa-telegram"></i>



                </a>
                <a class="social social-facebook"
                  href="https://www.facebook.com/sharer.php?u={{url('/')}}/article/{{Str::slug($post->getUser->name)}}/{{$post->slug}}&amp;title={{$post->meta_title}}"
                  title="facebook" target="_blank" aria-label="facebook"
                  style="height: 40px;width: 40px;line-height: 40px;font-size: 14px;">
                  <i class="ui-facebook"></i>
                </a>

                <a class="social social-threads"
                  href="https://www.addtoany.com/add_to/threads?linkurl={{url('/')}}/article/{{Str::slug($post->getUser->name)}}/{{$post->slug}}"
                  target="_blank" title="instagram" aria-label="instagram"
                  style="height: 40px;width: 40px;line-height: 40px;font-size: 14px;">
                  <i class="fa-brands fa-threads"></i>
                </a>
                <a class="social social-twitter"
                  href="https://twitter.com/intent/tweet?url={{url('/')}}/article/{{Str::slug($post->getUser->name)}}/{{$post->slug}}"
                  title="Twitter" target="_blank" aria-label="twitter"
                  style="height: 40px;width: 40px;line-height: 40px;font-size: 14px;">
                  <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a class="social social-linkedin"
                  href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{url('/')}}/article/{{Str::slug($post->getUser->name)}}/{{$post->slug}}&amp;title={{$post->meta_title}}"
                  title="linkedin" target="_blank" aria-label="linkedin"
                  style="height: 40px;width: 40px;line-height: 40px;font-size: 14px;">
                  <i class="ui-linkedin"></i>
                </a>





              </div>
            </div>
          </div>
          <div class="entry__article-wrap">
            <!-- Share -->



            <!-- share -->
            <div class="entry__article">
              {!! $post->post_data !!}
            </div> <!-- end entry article -->
          </div> <!-- end entry article wrap -->

          <section class="comment_section">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  @guest
                  <h5>Login to Leave Comment</h5>
                  <a href="{{route('user.login.view', ['redirect' => url()->current()])}}"
                    class="btn btn-color btn-button" style="padding: 7px 40px;">Login</a>
                  @endguest

                  @auth
                  @if(Auth::user()->is_block == 1)
                  <p style="color:red;"><b>Your account is blocked</b></p>
                  @else

                  @if(Auth::user()->writer_account_status === 0)
                  <p style="color:red;"><b>Your account is rejected</b></p>
                  @else

                  <div id="respond" class="comment-respond">
                    <div class="title-wrap">
                      <h5 class="comment-respond__title section-title">{{Session::get('lang') == 'hi'?'टिप्पणी छोड़
                        दें':'Leave Comment'}}</h5>
                    </div>
                    <form id="form" class="comment-form" method="POST" action="{{route('store_comment')}}">
                      @csrf
                      <input type="hidden" name="post_id" value="{{$post->id}}">
                      <div class="comment-form-comment">
                        <label for="comment">Comment *</label>
                        <textarea id="comment" name="comment" rows="5" required></textarea>
                      </div>
                      <div class="comment-form-submit">
                        <input type="submit" class="btn btn-lg btn-color btn-button" value="Post Comment"
                          id="submit-message">
                      </div>
                    </form>
                  </div>

                  @endif
                  @endif
                  @endauth

                  @if(count($post->comments) === 0)
                  <h5 class="pt-3">No Comments Found</h5>
                  @else
                  <div class="card comment-box mt-3">
                    <div class="card-body">
                      <h4>Comment</h4>
                      <ul>
                        @foreach($post->comments as $comment)
                        <li>
                          <div class="media mt-5">
                            <img class=""
                              src="{{url('public/build/assets/upload/user/profile_image')}}/{{$comment->user->profile_image == '' ? 'default_user.png':$comment->user->profile_image}}"
                              alt="Generic placeholder image" class="mr-3 rounded" alt="User Avatar" width="50"
                              height="25">&nbsp&nbsp&nbsp
                            <div class="media-body">
                              <div class="row">
                                <div class="col-md-4"><a href="#">
                                    <h6 class="mt-0" style="font-size: 13px;">{{$comment->user->name}}</h6>
                                  </a></div>
                                <!--<div class="col-md-8">
                                <ul class="comment-social"> 
                                    <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                  </ul>
                                </div>-->
                              </div>

                              <p class="tex" style="font-size: 13px;">{{$comment->comment}}</p>&nbsp
                              <button class="btn btn-link comment-reply" id="replyButton_{{$comment->id}}"
                                onclick="openreply({{$comment->id}})">Reply</button>
                              <div class="" id="replyForm_{{$comment->id}}" style="display: none;">
                                <form method="POST" action="{{route('store_reply')}}">
                                  @csrf
                                  <input type="hidden" value="{{$comment->id}}" name="parent_id">
                                  <input type="hidden" value="{{$post->id}}" name="post_id">

                                  <textarea class="form-control mt-4" placeholder="Your reply..." name="reply"
                                    id="reply"></textarea>
                                  <button class="btn btn-primary mt-2 text-white comment-submit" type="submit">Submit
                                    Reply</button>
                                </form>
                              </div>

                              @foreach($comment->replies as $reply)
                              <div class="media pt-4">
                                <img class=""
                                  src="{{url('public/build/assets/upload/user/profile_image')}}/{{$reply->user->profile_image == '' ? 'default_user.png':$reply->user->profile_image}}"
                                  alt="Generic placeholder image" class="mr-3 rounded" alt="User Avatar" width="50"
                                  height="25">&nbsp&nbsp&nbsp
                                <div class="media-body">
                                  <h5 class="" style="font-size: 13px;">{{$reply->user->name}}</h5>
                                  <p style="font-size: 13px;">{{$reply->comment}}</p> 
                                </div>
                              </div>
                              @endforeach

                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
          </section>
        </article> <!-- end standard post -->
        <!-- Related Posts -->
        <section class="section related-posts mt-40 mb-0">
          <div class="title-wrap title-wrap--line title-wrap--pr">
            <h3 class="section-title">{{$lang == 'hi' ? 'संबंधित आलेख' : 'Related Articles'}}</h3>
          </div>

          <!-- Slider -->
          <div id="owl-posts-3-items" class="owl-carousel owl-theme owl-carousel--arrows-outside">
            @foreach($related_post as $related)
            <article class="entry thumb thumb--size-1">
              <div class="entry__img-holder thumb__img-holder"
                style="background-image: url('{{url('public/build/assets/upload/thumbnail')}}/{{$related->thumbnail_image}}');">
                <div class="bottom-gradient"></div>
                <div class="thumb-text-holder">
                  <h2 class="thumb-entry-title">
                    <a href="{{route('frontend.view.post', [Str::slug($related->getuser->name), $related->slug])}}"
                      target="_blank">{{$related->meta_title}}</a>
                  </h2>
                </div>
                <a href="{{route('frontend.view.post', [Str::slug($related->getuser->name), $related->slug])}}"
                  class="thumb-url"></a>
              </div>
            </article>
            @endforeach

          </div> <!-- end slider -->
        </section> <!-- end related posts -->



        <section class="section related-posts mt-40 mb-0">
          <div class="title-wrap title-wrap--line title-wrap--pr">
            <h3 class="section-title">{{$lang == 'hi' ? 'लेखक के अन्य आलेख' : 'Writer’s Other Articles'}}</h3>
          </div>

          <!-- Slider with Navigation Controls -->
          <div class="owl-carousel owl-theme owl-carousel--arrows-outside" id="owl-posts-4-items">
            @foreach($users_all_post as $users_post)
            <article class="entry thumb thumb--size-1">
              <div class="entry__img-holder thumb__img-holder"
                style="background-image: url('{{url('public/build/assets/upload/thumbnail')}}/{{$users_post->thumbnail_image}}');">
                <div class="bottom-gradient"></div>
                <div class="thumb-text-holder">
                  <h2 class="thumb-entry-title">
                    <a href="{{route('frontend.view.post', [Str::slug($users_post->getuser->name), $users_post->slug])}}"
                      target="_blank">{{$users_post->meta_title}}</a>
                  </h2>
                </div>
                <a href="{{route('frontend.view.post', [Str::slug($users_post->getuser->name), $users_post->slug])}}"
                  class="thumb-url"></a>
              </div>
            </article>
            @endforeach
          </div>

        </section> <!-- end related posts -->




      </div> <!-- end content box -->
    </div> <!-- end post content -->
    <!-- Sidebar -->
    <aside class="col-lg-4 sidebar sidebar--right">
      <!-- Top Square ads (small) - (start)-->
      <aside class="widget widget_media_image">
        @if(!empty($top_ads_small))
        @foreach($top_ads_small as $ads)
        <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"><img src="{{url($ads->image)}}" alt="{{$ads->title}}"> </a><br><br>
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
        <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
        @endforeach
        @endif
      </div>
      <!-- middle ads square(small)  end  -->
      <!-- Widget Popular Posts -->
      <aside class="widget widget-popular-posts">
        <h4 class="widget-title">{{$lang == 'hi' ? 'लोकप्रिय लेख' : 'Popular Artical'}} </h4>
        <ul class="post-list-small">
          @foreach($popular_post as $popular)
          <li class="post-list-small__item">
            <article class="post-list-small__entry clearfix">
              <div class="post-list-small__img-holder">
                <div class="thumb-container thumb-100">
                  <a href="{{route('frontend.view.post', [$popular->slug])}}" target="_blank">
                    <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$popular->thumbnail_image}}"
                      alt="{{$popular->meta_title}}" class=" lazyload">
                  </a>
                </div>
              </div>
              <div class="post-list-small__body">
                <h3 class="post-list-small__entry-title">
                  <a href="{{route('frontend.view.post', [$popular->slug])}}"
                    target="_blank">{{$popular->meta_title}}</a>
                </h3>
                <ul class="entry__meta">
                  <li class="entry__meta-author">
                    <a href="{{route('frontend.writer_profile', [Str::slug($popular->getUser->name), $popular->getUser->id])}}"
                      target="_blank">{{$popular->getUser->name}}</a>
                  </li>
                  <li class="entry__meta-date">
                    {{date('M j, Y', strtotime($popular->publish_on))}}
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
        <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
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
@if(Session::has('comment_updated'))
<script>
  $(document).ready(function ()
  {
    swal({
      title: "Comment Received",
      text: "{{(Session::get('comment_updated'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('comment_faild'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Failed",
      text: "{{(Session::get('comment_faild'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif

@if(Session::has('reply_updated'))
<script>
  $(document).ready(function ()
  {
    swal({
      title: "Thank you for your insightful comment!",
      text: "{{(Session::get('reply_updated'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif


<script>
  document.getElementById("replyButton").addEventListener("click", function ()
  {
    document.getElementById("replyForm").style.display = "block";
  });

  function openreply(id)
  {
    var x = document.getElementById("replyForm_" + id);
    if (x.style.display === "none")
    {
      x.style.display = "block";
    } else
    {
      x.style.display = "none";
    }
  }
</script>

@if(auth::check())
<script>
  document.addEventListener('DOMContentLoaded', function ()
  {
    const isAuthenticated = {{ auth() -> check() ? 'true' : 'false'
  }};
  const likeIcon = document.getElementById('like-icon');
  const heartIcon = document.getElementById('heart-icon');
  var likeBtn = document.getElementById('likeButton');
  var heartBtn = document.getElementById('heartButton');
  var heartElement = document.getElementById('heart_no');
  var likeElement = document.getElementById('like_no');
  const userId = {{ auth() -> check() ? Auth :: user() -> id : '0' }};
  const postId = {{ $post-> id}};
  // var csrfToken = $('meta[name="csrf-token"]').attr('content'); 
  likeBtn.addEventListener('click', function ()
  {
    var likeValue = likeElement.value;
    var heartValue = heartElement.value;
    const likeType = 'like';
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      type: 'POST',
      url: '{{route('action.like')}}',
      data: {
        user_id: userId,
        post_id: postId,
        like_type: likeType
      },
      success: function (response)
      {
        if (response.message == 'new_like_created')
        {
          likeIcon.classList.remove('far');
          likeIcon.classList.add('fas');
          heartIcon.classList.remove('fas');
          heartIcon.classList.add('far');
          likeElement.value = Math.max(parseInt(likeValue) + 1);
        } else if (response.message == 'like_removed')
        {
          likeIcon.classList.remove('fas');
          likeIcon.classList.add('far');
          heartIcon.classList.remove('fas');
          heartIcon.classList.add('far');
          likeElement.value = Math.max(parseInt(likeValue) - 1);
        } else if (response.message == 'heart_removed_and_like_created')
        {
          likeIcon.classList.remove('far');
          likeIcon.classList.add('fas');
          heartIcon.classList.remove('fas');
          heartIcon.classList.add('far');
          likeElement.value = Math.max(parseInt(likeValue) + 1);
          heartElement.value = Math.max(parseInt(heartValue) - 1);
        }
      }
    });
  });


  heartBtn.addEventListener('click', function ()
  {
    var likeValue = likeElement.value;
    var heartValue = heartElement.value;
    const likeType = 'heart';
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      type: 'POST',
      url: '{{route('action.like')}}',
      data: {
        user_id: userId,
        post_id: postId,
        like_type: likeType
      },
      success: function (response)
      {
        if (response.message == 'new_heart_created')
        {
          likeIcon.classList.remove('fas');
          likeIcon.classList.add('far');
          heartIcon.classList.remove('far');
          heartIcon.classList.add('fas');
          heartElement.value = Math.max(parseInt(heartValue) + 1);
        } else if (response.message == 'heart_removed')
        {
          likeIcon.classList.remove('fas');
          likeIcon.classList.add('far');
          heartIcon.classList.remove('fas');
          heartIcon.classList.add('far');
          heartElement.value = Math.max(parseInt(heartValue) - 1);
        } else if (response.message == 'like_removed_and_heart_created')
        {
          likeIcon.classList.remove('fas');
          likeIcon.classList.add('far');
          heartIcon.classList.remove('far');
          heartIcon.classList.add('fas');
          likeElement.value = Math.max(parseInt(likeValue) - 1);
          heartElement.value = Math.max(parseInt(heartValue) + 1);
        }
      }
    });
  }); 
  }); 
</script>
@endif

<script>
  $(document).ready(function ()
  {
    $("#owl-posts-4-items").owlCarousel({
      items: 3,
      loop: true,
      autoplay: true, // Autoplay enabled
      autoplayTimeout: 2500,
      margin: 20,
      nav: true,
      dots: false,
      navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        },
        992: {
          items: 3
        }
      }
    });
  });
</script>
@endsection

@endsection