@extends('layouts/backend/main')
@section('main-section')
@php
$user_type = Auth::user()->user_type;
@endphp

<style>
  .social {
    margin: 10px 0;
  }

  .social a i {
    font-size: 25px;
    margin: 10px;
  }
</style>

<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item"><a
                href="{{$user_type == 1 ? route('admin.post.index'):route('writer.post.index')}}">Post</a></li>
            <li class="breadcrumb-item active">{{$post_detail->meta_title}}</li>
          </ol>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
        </div>

      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="blog-single">
          <div class="blog-box blog-details">
            <div class="banner-wrraper"><img class="img-fluid w-100 bg-img-cover"
                src="{{url('public/build/assets/upload/thumbnail')}}/{{$post_detail->thumbnail_image}}  "
                alt="blog-main"></div>
            <div class="card">
              <div class="card-body">
                <div class="blog-details">
                  @php
                  $like_count = App\Models\backend\Like::where('post_id', $post_detail->id)->where('like_type',
                  'like')->count();
                  $heart_count = App\Models\backend\Like::where('post_id', $post_detail->id)->where('like_type',
                  'heart')->count();
                  $comment_count = App\Models\backend\Comment::where('post_id', $post_detail->id)->where('parent_id',
                  null)->count();

                  @endphp
                  <ul class="blog-social">
                    <li>{{date('M j, Y', strtotime($post_detail->publish_on))}}</li>
                    <li><i class="icofont icofont-user"></i><span>{{$post_detail->getUser->name}} </span></li>
                    <li><i class="fa fa-eye"></i>{{$post_detail->views}}<span> View</span></li>
                    <li><i class="icofont icofont-ui-chat"></i>{{$comment_count}} Comments</li>
                    <li><i class="fas fa-thumbs-up"></i>{{$like_count}} Likes</li>
                    <li><i class="fas fa-heart"></i>{{$heart_count}} Hearts</li>
                    <li>
                      @if($post_detail->post_approval_status == 0)
                      <div class="ribbon-danger" style="color: #fff; padding: 2px 5px; border-radius: 5px;">Disapproved
                      </div>
                      @elseif($post_detail->post_approval_status == 1)
                      <div class="ribbon-success" style="color: #fff; padding: 2px 5px; border-radius: 5px;">Approved
                      </div>
                      @elseif($post_detail->post_approval_status == 2)
                      <div class="ribbon-warning" style="color: #fff; padding: 2px 5px; border-radius: 5px;">Approval
                        Pending</div>
                      @endif
                    </li>
                  </ul>
                  <div class="social">
                    @if($social_media->facebook_status == 1)
                    <a class="social social-facebook"
                      href="https://www.facebook.com/sharer/sharer.php?u={{route('frontend.view.post', [$post_detail->getUser->name, $post_detail->slug])}}"
                      target="_blank" aria-label="facebook">
                      <i class="fab fa-facebook custom-darkblue"></i>
                    </a>
                    @endif

                    @if($social_media->x_status == 1)
                    <a class="social social-youtube" href="{{$social_media->x}}" target="_blank" aria-label="youtube">
                      <i class="fab fa-x" style="color: #1DA1F2;"></i>
                    </a>
                    @endif

                    @if($social_media->youtube_status == 1)
                    <a class="social social-x icoexx" href="{{$social_media->youtube}}" target="_blank" aria-label="x">
                      <i class="fab fa-youtube" style="color: red;"></i>
                    </a>
                    @endif

                    @if($social_media->whatsapp_status == 1)
                    <a class="social social-whatsapp"
                      href="https://api.whatsapp.com/send?&text={{$social_media->whatsapp}}" target="_blank"
                      aria-label="whatsapp">
                      <i class="fab fa-whatsapp" style="color: green;"></i>
                    </a>
                    @endif


                    @if($social_media->linkedin_status == 1)
                    <a class="social social-linkedin"
                      href="https://www.linkedin.com/shareArticle?mini=true&url={{$social_media->linkedin}}"
                      target="_blank" aria-label="linkedin">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    @endif

                    @if($social_media->instagram_status == 1)
                    <a class="social social-instagram"
                      href="https://www.instagram.com/share?url={{$social_media->instagram}}" target="_blank"
                      aria-label="instagram">
                      <i class="fab fa-instagram" style="color: #E4405F;"></i>
                    </a>
                    @endif

                    @if($social_media->thread_status == 1)
                    <a class="social social-thread icoexx " href="{{$social_media->thread}}" target="_blank"
                      aria-label="thread">
                      <i class="fa-brands fa-threads"></i>
                    </a>
                    @endif

                    @if($social_media->telegram_status == 1)
                    <a class="social social-telegram icoex"
                      href="https://t.me/share/url?url={{$social_media->telegram}}&text=Post Title" target="_blank"
                      aria-label="telegram">
                      <i class="fab fa-telegram"></i>
                    </a>
                    @endif

                    <h4>
                      {{$post_detail->meta_title}}
                    </h4>
                    <div class="single-blog-content-top">
                      {!! $post_detail->post_data !!}
                    </div>
                  </div>
                </div>
              </div>
              <div class="card comment-box">
                <div class="card-body">
                @if(count($post_detail->comments) === 0)
                <h4>No Comment Found</h4>
                @else
                  <h4>Comment</h4>
                  <ul>
                    @foreach($post_detail->comments as $comment)
                    <li>
                      <div class="media align-self-center"><img class="align-self-center"
                          src="{{url('public/build/assets/upload/user/profile_image')}}/{{$comment->user->profile_image}}"
                          alt="Profile Picture">
                        <div class="media-body">
                          <div class="row">
                            <div class="col-md-4">
                              <a href="#">
                                <h6 class="mt-0">{{$comment->user->name}}<span> (
                                    @if($comment->user->user_type == 1)
                                    Admin
                                    @elseif($comment->user->user_type == 2)
                                    Writer
                                    @elseif($comment->user->user_type == 3)
                                    User
                                    @endif
                                    )</span></h6>
                              </a>
                            </div>
                            <!-- <div class="col-md-8">
                            <ul class="comment-social">
                              <li><i class="icofont icofont-thumbs-up"></i>14-12-2023</li> 
                            </ul>
                          </div> -->
                          </div>
                          <p>{{$comment->comment}}</p>
                        </div>
                      </div>
                    </li>


                    <li>
                      <ul>
                        @foreach($comment->replies as $reply)
                        <li>
                          <div class="media"><img class="align-self-center"
                              src="{{url('public/build/assets/upload/user/profile_image')}}/{{$reply->user->profile_image}}"
                              alt="Profile Picture">
                            <div class="media-body">
                              <div class="row">
                                <div class="col-md-4">
                                  <a href="user-profile.html">
                                    <h6 class="mt-0">{{$reply->user->name}}<span> (
                                        @if($reply->user->user_type == 1)
                                        Admin
                                        @elseif($reply->user->user_type == 2)
                                        Writer
                                        @elseif($reply->user->user_type == 3)
                                        User
                                        @endif )
                                      </span></h6>
                                  </a>
                                </div>
                                <!-- <div class="col-md-8">
                            <ul class="comment-social">
                              <li><i class="icofont icofont-thumbs-up"></i>14-12-2023</li> 
                            </ul>
                          </div>  -->
                              </div>
                              <p>{{$reply->comment}}</p>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </li>

                    @endforeach

                  </ul>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>
  </div>
</div>
@endsection