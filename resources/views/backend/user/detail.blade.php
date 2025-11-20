@extends('layouts/backend/main')
@section('main-section')

<style>
   .cert{
    height: 200px;
}
   .cert iframe{
    height: 100%;
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
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
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
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">

            <div class="card-body">
              <div>
                <div class="row mb-2">
                  <div class="profile-title">
                    <div class="media">
                      <img class="img-70 rounded-circle" alt=""
                        src="{{url('public/build/assets/upload/user/profile_image')}}/{{$user_detail->profile_image != '' ? $user_detail->profile_image:'default_user.png'}}">
                      <div class="media-body">
                        <h3 class="mb-1 f-20 txt-primary">{{$user_detail->name}}</h3>
                        @if($user_detail->user_type == 1)
                        <p>Admin</p>
                        @elseif($user_detail->user_type == 2)
                        <p>Writer</p>
                        @elseif($user_detail->user_type == 3)
                        <p>User</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <h6 class="form-label">Profile (en)</h6>
                  <p>{{$user_detail->bio_en}}</p>
                </div>
                <div class="mb-3">
                  <h6 class="form-label">Profile (hi)</h6>
                  <p>{{$user_detail->bio_hi}}</p>
                </div>

                @if($user_detail->user_type == 2)
                @if($user_detail->certificate != '')
                <div class="col-sm-12">
                  <h5>Certificate</h5>
                  <div class="cert"> 
                    <iframe id="pdfViewer"
                      src="{{url('public/build/assets/upload/writer/certificate')}}/{{$user_detail->certificate}}"
                      width="100%"></iframe>
                  </div>

                  <div class="pdf-btns">
                    <a href="{{url('public/build/assets/upload/writer/certificate')}}/{{$user_detail->certificate}}"
                      target=_blank> <span class="btn btn-sm btn-color">View</span></a>
                    <a href="{{url('public/build/assets/upload/writer/certificate')}}/{{$user_detail->certificate}}"
                      download> <span class="btn btn-sm btn-color">Download</span></a>
                  </div>
                </div>
                @else
                <p>Certificate not uploaded !</p>
                @endif

                
                @endif
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
                    <p>{{$user_detail->email}}</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <p>{{$user_detail->gender}}</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label class="form-label">Phone No.</label>
                    <p>{{$user_detail->phone_number}}</p>
                  </div>
                </div>
                <!-- <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Country</label>
                            <p>{{$user_detail->country}}</p>
                          </div>
                        </div>    -->
                <div class="col-md-6">
                  <div>
                    <label class="form-label">City</label>
                    <p>{{$user_detail->city}}</p>
                  </div>
                </div>
                @if($user_detail->user_type == 2)
                <div class="col-sm-6">
                  <label class="form-label">Account Status</label>
                  @if($user_detail->writer_account_status == 0)
                  <div class="ribbon-danger"
                    style="width: fit-content; padding: 1px 29px; border-radius: 5px; color: #fff;font-weight: bold;">
                    Rejected</div>
                  @elseif($user_detail->writer_account_status == 1)
                  <div class="ribbon-success"
                    style="width: fit-content; padding: 1px 29px; border-radius: 5px; color: #fff;font-weight: bold;">
                    Approved</div>
                  @elseif($user_detail->writer_account_status == 2)
                  <div class="ribbon-warning"
                    style="width: fit-content; padding: 1px 29px; border-radius: 5px; color: #fff;font-weight: bold;">
                    Pending</div>
                  @endif
                </div>
                @endif



              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
<!-- footer start-->


@endsection