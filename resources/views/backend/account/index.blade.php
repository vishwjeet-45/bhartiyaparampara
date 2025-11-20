@extends('layouts/backend/main')
@section('main-section')
@php
$user_type = Auth::user()->user_type;
@endphp

<style>
  .profile-inner button {
    background-color: #ef4029;
    color: #fff;
  }

  .profile-inner button:hover {
    background-color: #000;
    color: #fff;
  }

  .batch i,
  .social a i {
    font-size: 30px;
  }
</style>
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>View Profile</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <!-- <li class="breadcrumb-item">@if(Auth::user()->user_type == 1)
              Admin
              @elseif(Auth::user()->user_type == 2)
              Writer
              @elseif(Auth::user()->user_type == 3)
              User
              @endif
            </li> -->
            <li class="breadcrumb-item active">View Profile</li>
          </ol>
        </div>
        <div class="col-sm-6">
          <!-- Bookmark Start-->

          <!-- Bookmark Ends-->
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">


    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
      </symbol>
      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
      </symbol>
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
      </symbol>
    </svg>

    @if(Auth::user()->is_block == 1)
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <div>
        Your account is blocked...
      </div>
    </div>
    @else
    @if($user_type != 3)
    @if(Auth::user()->writer_account_status == 0)
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <div>
        Your account is not approved...
      </div>
    </div>
    @elseif(Auth::user()->writer_account_status == 1)
    <div class="alert alert-success d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill" />
      </svg>
      <div>
        Your account is approved...!
      </div>
    </div>
    @elseif(Auth::user()->writer_account_status == 2)
    <div class="alert alert-warning d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <div>
        Your account is pending to review please wait...!
      </div>
    </div>
    @endif

    @endif
    @endif

    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">

            <div class="card-body">
              <div>
                <div class="row mb-2">
                  <div class="profile-title">
                    <div class="media">
                      <img class="img-70 rounded-circle  alt="" src="
                        {{url('public/build/assets/upload/user/profile_image')}}/{{Auth::user()->profile_image != '' ?
                      Auth::user()->profile_image:'default_user.png'}}" height="59">
                      <div class="media-body">
                        <h3 class="mb-1 f-20 txt-primary">{{Auth::user()->name}}</h3>
                        @if(Auth::user()->user_type == 1)
                        <p>Admin</p>
                        @elseif(Auth::user()->user_type == 2)
                        <p>Writer</p>
                        <div class="batch">
                          @if($no_of_post > 0 && $no_of_post <= 25) <i class="fa-solid fa-medal"
                            style="color: #3d99f0;"></i>
                            <p>Silver</p>
                            @elseif($no_of_post >= 26 && $no_of_post <= 50) <i class="fa-solid fa-medal"
                              style="color: silver;"></i>
                              <p>Gold</p>
                              @elseif($no_of_post > 50)
                              <i class="fa-solid fa-medal" style="color: gold;"></i>
                              <p>Diamond</p>
                              @endif
                        </div>
                        @elseif(Auth::user()->user_type == 3)
                        <p>User</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="  row ">


                  @if(Auth::user()->user_type == 2)
                  @if(Auth::user()->certificate != '')
                  <div class=" col-md-6">
                    <label class="form-label">Download Certificate</label>
                    <a class="ribbon-danger  "
                      style="   width: fit-content; padding: 3px 15px; border-radius: 5px; color: #fff;font-weight: bold;"
                      href="{{url('public/build/assets/upload/writer/certificate')}}/{{Auth::user()->certificate}}"
                      download>Download </a>
                  </div>
                  @endif
                  @endif
                  @if($user_type != 3)
                  <div class="col-md-6">
                    <label class="form-label">Account Status</label>
                    @if(Auth::user()->writer_account_status == 0)
                    <div class="ribbon-danger"
                      style="width: fit-content; padding: 1px 15px; border-radius: 5px; color: #fff;font-weight: bold;">
                      Rejected</div>
                    @elseif(Auth::user()->writer_account_status == 1)
                    <div class="ribbon-success"
                      style="width: fit-content; padding: 1px 15px; border-radius: 5px; color: #fff;font-weight: bold;">
                      Approved</div>
                    @elseif(Auth::user()->writer_account_status == 2)
                    <div class="ribbon-warning"
                      style="width: fit-content; padding: 1px 15px; border-radius: 5px; color: #fff;font-weight: bold;">
                      Pending</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="card">
            <!-- <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div> -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <p>{{Auth::user()->email}}</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <p>{{Auth::user()->gender}}</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label class="form-label">Phone No.</label>
                    <p>{{Auth::user()->phone_number}}</p>
                  </div>
                </div>

                <div class="col-md-6">
                  <div>
                    <label class="form-label">City</label>
                    <p>{{Auth::user()->city}}</p>
                  </div>
                </div>

                <div class="col-md-12 row">
                  <label class="form-label col-md-3">Connect With Us</label>
                  <div class="col-md-9">
                    <div class="social">
                      @if($social_media_list->instagram_status == 1)
                      <a href="{{$social_media_list->instagram}}"><i class="fab fa-instagram mx-2"
                          style="color: #E4405F;"></i></a>
                      @endif

                      @if($social_media_list->facebook_status == 1)
                      <a href="{{$social_media_list->facebook}}"><i class="fab fa-facebook mx-2"
                          style="color: #1877F2;"></i></a>
                      @endif

                      @if($social_media_list->x_status == 1)
                      <a href="{{$social_media_list->x}}"><i class="fa-brands fa-x-twitter mx-2"></i></a>
                      @endif

                      @if($social_media_list->youtube_status == 1)
                      <a href="{{$social_media_list->youtube}}"><i class="fab fa-youtube mx-2"
                          style="color: #FF0000;"></i></a>
                      @endif

                      @if($social_media_list->whatsapp_status == 1)
                      <a href="https://wa.me/91{{$social_media_list->whatsapp}}"><i class="fab fa-whatsapp mx-2"
                          style="color: #25D366;"></i></a>
                      @endif

                      @if($social_media_list->telegram_status == 1)
                      <a href="{{$social_media_list->telegram}}"><i class="fab fa-telegram mx-2"
                          style="color: #0088cc;"></i></a>
                      @endif

                      @if($social_media_list->linkedin_status == 1)
                      <a href="{{$social_media_list->linkedin}}"><i class="fab fa-linkedin mx-2"
                          style="color: #0077B5;"></i></a>
                      @endif

                      @if($social_media_list->thread_status == 1)
                      <a href="{{$social_media_list->thread}}"><i class="fa-brands fa-threads mx-2"></i></i></a>
                      @endif
                    </div>
                  </div>
                </div>
                @endif

                <div class="row mt-3">
                  <h6 class="form-label">Profile (en) - </h6>
                  <p>{{Auth::user()->bio_en}}</p>
                </div>

                <div class="row mt-3">
                  <h6 class="form-label">Profile (hi) - </h6>
                  <p>{{Auth::user()->bio_hi}}</p>
                </div>


              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
  @if($user_type == 3)
                        </div>
                        @endif
<!-- footer start-->

@section('javascript-section')

@if(Session::has('user_updated'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('user_updated'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('user_not_updated'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Failed",
      text: "{{(Session::get('user_not_updated'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif
@endsection


@endsection