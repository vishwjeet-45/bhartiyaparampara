@extends('layouts/backend/main')
@section('main-section')

<style>
    td i {
        font-size: 25px;
    }
</style>

@php
$user_type = Auth::user()->user_type;
@endphp
<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Social Media</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Social Media</li>
                    </ol>
                </div>
                 
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="card-body">
                                        <label class="col-form-label">Row:</label>
                                        <select class="js-example-basic-single col-sm-4" name="qty" id="qty">
                                            <option value="10" {{isset($_GET['qty']) && $_GET['qty']=='10' ? 'selected'
                                                : '' }}>10</option>
                                            <option value="20" {{isset($_GET['qty']) && $_GET['qty']=='20' ? 'selected'
                                                : '' }}>20</option>
                                            <option value="50" {{isset($_GET['qty']) && $_GET['qty']=='50' ? 'selected'
                                                : '' }}>50</option>
                                            <option value="100" {{isset($_GET['qty']) && $_GET['qty']=='100'
                                                ? 'selected' : '' }}>100</option>
                                            <option value="250" {{isset($_GET['qty']) && $_GET['qty']=='250'
                                                ? 'selected' : '' }}>250</option>
                                            <option value="500" {{isset($_GET['qty']) && $_GET['qty']=='500'
                                                ? 'selected' : '' }}>500</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-6">
                                    <div class="card-body">
                                        <form class="theme-form" method="GET" action="{{URL::full()}}">
                                            <div class="form-group d-flex justify-content-end">
                                                <input class="form-control" name="search" type="text"
                                                    placeholder="Search Social Media"
                                                    value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->
                            </div>

                            <div class="table-responsive">
                                
                                <table class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th scope="col">S.NO</th>
                                            <th scope="col"> Name</th>
                                            <th scope="col">Icon</th> 
                                            <th scope="col">Status</th>
                                            <th scope="col" class="d-flex justify-content-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="{{$social_media_list->instagram_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>1.</td>
                                            <td>Instagram</td>
                                            <td><a href="{{$social_media_list->instagram}}"><i class="fab fa-instagram mx-2"
                                                        style="color: #E4405F;"></i></a> 
                                                    </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="instagram" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->instagram_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="instagram" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button> 
                                            </td>
                                        </tr>
                                        <tr class="{{$social_media_list->facebook_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>2.</td>
                                            <td>Facebook</td>
                                            <td>
                                                <a href="{{$social_media_list->facebook}}"><i class="fab fa-facebook mx-2" style="color: #1877F2;"></i></a>
                                             </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="facebook" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->facebook_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="facebook" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button> 
                                            </td>
                                        </tr>
                                        <tr class="{{$social_media_list->x_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>3.</td>
                                            <td>X</td>
                                            <td><a href="{{$social_media_list->x}}"><i
                                                        class="fa-brands fa-x-twitter mx-2"></i></a></td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="x" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->x_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="x" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button> 
                                            </td>
                                        </tr>
                                        <tr class="{{$social_media_list->youtube_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>4.</td>
                                            <td>Youtube</td>
                                            <td><a href="{{$social_media_list->youtube}}"><i class="fab fa-youtube mx-2" style="color: #FF0000;"></i></a> </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="youtube" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->youtube_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="youtube" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button> 
                                            </td>
                                        </tr>
                                        <tr class="{{$social_media_list->whatsapp_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>5.</td>
                                            <td>Whatsapp</td>
                                            <td><a href="https://wa.me/91{{$social_media_list->whatsapp}}"><i class="fab fa-whatsapp mx-2" style="color: #25D366;"></i></a> </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="whatsapp" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->whatsapp_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="whatsapp" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button> 
                                            </td>
                                        </tr>
                                        <tr class="{{$social_media_list->telegram_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>6.</td>
                                            <td>Telegram</td>
                                            <td><a href="{{$social_media_list->telegram}}"><i class="fab fa-telegram mx-2" style="color: #0088cc;"></i></a> </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="telegram" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->telegram_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="telegram" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button> 

                                            </td>
                                        </tr>
                                        <tr class="{{$social_media_list->linkedin_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>7.</td>
                                            <td>Linkedin</td>
                                            <td><a href="{{$social_media_list->linkedin}}"><i class="fab fa-linkedin mx-2" style="color: #0077B5;"></i></a> </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="linkedin" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->linkedin_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="linkedin" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button> 

                                            </td>
                                        </tr>
                                        <tr class="{{$social_media_list->thread_status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <td>8.</td>
                                            <td>Threads</td>
                                            <td><a href="{{$social_media_list->thread}}"><i class="fa-brands fa-threads mx-2"></i></i></a> </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="thread" class="form-check-input sm_status_checkbox" type="checkbox" role="switch" id="sm_status_checkbox" {{$social_media_list->thread_status == '1'?'checked':''}}>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button value="thread" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button>  
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    {{-- {{$c_list->links('pagination::bootstrap-5')}}<br> --}}
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- tap on top starts-->
<div class="tap-top"><i class="icon-control-eject"></i></div>
<!-- tap on tap ends-->
<!-- Modal -->
 

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Social Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{$user_type == 1 ?route('admin.social_media.update'):route('writer.social_media.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="social_media_name" id="social_media_name">
                    <div class="col-md-12">
                        <label class="form-label edit_form_label" for="edit_social_media_url">Enter Url</label>
                        <input class="form-control" id="edit_social_media_url" type="text" name="edit_social_media_url"
                            placeholder="Category Name" required="">
                    </div> 

                    <div class="col-md-12">
                        <label class="form-label" for="edit_social_media_status">Select Status</label>
                        <select class="form-select" id="edit_social_media_status" name="edit_social_media_status">
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@section('javascript-section')

<script>
      $(document).ready(function () {
    $(document).on('click', '.edit_button', function () {
      var social_media_name = $(this).val(); 
      $('#editModal').modal('show');
      $.ajax({
        type: "GET",
        url: "social-media/edit/" + social_media_name,
        success: function (response) {  
            if(social_media_name == 'whatsapp') {
                var labelElement = document.querySelector('.edit_form_label');
                labelElement.textContent = 'Enter Your Whatsapp Number';
            }
          $('#social_media_name').val(social_media_name);
          $('#edit_social_media_url').val(response.url);  
          $('#edit_social_media_status').val(response.status); 
        }
      });
    });


    $(document).on('change', '.sm_status_checkbox', function () {
      var $toggleButton = $(this);
      var sm_status = $toggleButton.prop('checked') ? 1 : 0;
      var sm_name = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{$user_type == 1 ? route('admin.social_media.update_status'):route('writer.social_media.update_status')}}",
        data: { 'sm_status': sm_status, 'sm_name': sm_name },
        success: function (data) {
          if (data.status == 200 && data.message == 'status_updated') {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (sm_status == 1) {
              // Enable the row (remove the disabled class)
              row.removeClass('tr_disable');
            } else {
              // Disable the row (add the disabled class)
              row.addClass('tr_disable');
            }
          }
        }
      });
    });

});
</script>

@if(Session::has('update_success'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Success",
      text: "{{(Session::get('update_success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif
@endsection

@endsection