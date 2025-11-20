@extends('layouts/backend/main')
@section('main-section') 

@php
    $user_type = Auth::user()->user_type;
    @endphp
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Edit Profile</h3>
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
                    <li class="breadcrumb-item active">Edit Profile</li>
                  </ol>
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
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">My Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div>
                        <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media">                  
                           <img class="img-70 rounded-circle" alt="" src="{{url('public/build/assets/upload/user/profile_image')}}/{{$user_detail->profile_image != '' ? $user_detail->profile_image:'default_user.png'}}">
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
                          
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <form class="card" action="
                  @if($user_type==1)
                  {{route('admin.edit.edit_my_profile')}}
                  @elseif($user_type==2)
                  {{route('writer.edit.edit_my_profile')}}
                 @else
                 {{route('user.edit.edit_my_profile')}}
                 @endif
                  " method="POST" enctype="multipart/form-data">
                  @csrf  
                  <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Full Name</label>
                           <p>{{$user_detail->name}}</p>
                           <input type="hidden" name="name" value="{{$user_detail->name}}">
                          </div>
                        </div>
                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                           <p>{{$user_detail->email}}</p>
                          </div>
                        </div>
                        
 

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-control btn-square" name="gender" id="gender"> 
                              <option value="Male" {{$user_detail->gender == 'Male' ? 'selected':''}}>Male</option>
                              <option value="Female" {{$user_detail->gender == 'Female' ? 'selected':''}}>Female</option>
                              <option value="Other" {{$user_detail->gender == 'Other' ? 'selected':''}}>Other</option> 
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input class="form-control" type="number" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{$user_detail->phone_number}}">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" name="city" id="city" placeholder="Enter City" value="{{$user_detail->city}}">
                          </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="mb-3">
                            <label class="form-label">Upload Profile Picture df</label>
                            <input class="form-control"  type="file" name="profile_picture" id="profile_picture">
                            <p>Recommended image size: 300px (W) × 300px (H)</p>
                            @error('profile_picture')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        
                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Profile (English)</label>
                            <textarea class="form-control" rows="5" name="bio_en" id="bio_en" placeholder="Enter About yourself">{{$user_detail->bio_en}}</textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Profile (Hindi)</label>
                            <textarea class="form-control" rows="5" name="bio_hi" id="bio_hi" placeholder="Enter About yourself">{{$user_detail->bio_en}}</textarea>
                          </div>
                        </div>

                        @if($user_detail->user_type == 1)
                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Title (Hindi)</label>
                            <input class="form-control" type="text" name="meta_title_hi" id="meta_title_hi" placeholder="Enter Meta Title" value="{{$user_detail->meta_title_hi}}">

                           </div>
                        </div>

                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Description (Hindi)</label>
                            <textarea class="form-control" rows="5" name="meta_description_hi" id="meta_description_hi" placeholder="Enter Meta Description">{{$user_detail->meta_description_hi}}</textarea>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Title (English)</label>
                            <input class="form-control" type="text" name="meta_title_en" id="meta_title_en" placeholder="Enter Meta Title (en)" value="{{$user_detail->meta_title_en}}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Description (English)</label>
                            <textarea class="form-control" rows="5" name="meta_description_en" id="meta_description_en" placeholder="Enter Meta Description (English)">{{$user_detail->meta_description_en}}</textarea>
                          </div>
                        </div>
                        @endif


                      </div>
                    </div>
                    <div class="card-footer text-end pt-0">
                      <button class="btn btn-primary" type="submit">Update Profile</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        

@endsection