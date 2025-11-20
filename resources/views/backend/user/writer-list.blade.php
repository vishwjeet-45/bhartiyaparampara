@extends('layouts/backend/main')
@section('main-section')

<style>
  .del-btn {
    border: 0;
    padding: 0;
    background: transparent;
  }

  .del-btn:focus {
    outline: none;
    box-shadow: none;
  }
</style>
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Writer List</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">@if(Auth::user()->user_type == 1)
              Admin
              @elseif(Auth::user()->user_type == 2)
              Writer
              @elseif(Auth::user()->user_type == 3)
              User
              @endif
            </li>
            <li class="breadcrumb-item active">Writers List</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid user-card">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="set d-flex justify-content-between">
            <div class="col-md-3">
              <div class="card-body">
                <label class="col-form-label">Row:</label>
                <select class="js-example-basic-single col-sm-4" name="qty" id="qty">
                  <option value="10" {{isset($_GET['qty']) && $_GET['qty']=='10' ? 'selected' : '' }}>10</option>
                  <option value="20" {{isset($_GET['qty']) && $_GET['qty']=='20' ? 'selected' : '' }}>20</option>
                  <option value="50" {{isset($_GET['qty']) && $_GET['qty']=='50' ? 'selected' : '' }}>50</option>
                  <option value="100" {{isset($_GET['qty']) && $_GET['qty']=='100' ? 'selected' : '' }}>100</option>
                  <option value="250" {{isset($_GET['qty']) && $_GET['qty']=='250' ? 'selected' : '' }}>250</option>
                  <option value="500" {{isset($_GET['qty']) && $_GET['qty']=='500' ? 'selected' : '' }}>500</option>
                </select>
              </div>
            </div>
            <form class="col-md-5">
              <div class="">
                <div class="card-body">
                  <label class="col-form-label">Status:</label>
                  <select class="js-example-basic-single col-sm-4" name="status" id="status">
                    <option value="">All</option>
                    <option value="0">Rejected</option>
                    <option value="1">Approve</option>
                    <option value="2">Pending</option>
                    <option value="blocked">Blocked</option>
                  </select>
                  <button type="submit" class="btn btn-primary">Apply</button>
                </div>
              </div>
            </form>

            <div class="col-md-4">
              <div class="card-body">
                <form class="theme-form" method="GET" action="{{URL::full()}}">
                  <div class="form-group d-flex justify-content-end">
                    <input class="form-control" name="search" type="text" placeholder="Writer Name"
                      value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                    <button type="submit" class="btn btn-primary">Search</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      @foreach($writer_list as $writer)
      <div class="col-md-6 col-lg-6 col-xl-4 box-col-6">

        <div class="card custom-card mind">

          <div class="card-header p-0">

            @if($writer->is_block == 1)
            <div class="ribbon ribbon-danger">Blocked </div>
            @else
            @if($writer->writer_account_status == 0)
            <div class="ribbon ribbon-danger">Rejected </div>
            @elseif($writer->writer_account_status == 1)
            <div class="ribbon ribbon-success">Approved</div>
            @elseif($writer->writer_account_status == 2)
            <div class="ribbon ribbon-warning">Pending</div>
            @endif
            @endif


            <div id="container">

              <div id="menu-wrap">
                <input type="checkbox" class="toggler" />
                <div class="dots">
                  <div></div>
                </div>
                <div class="menu">
                  <div>
                    <ul>
                      <li><a href="{{route('admin.writer.edit', [$writer->id])}}" class="link">Edit</a></li>
                      <li><a href="{{route('admin.writer.view', [$writer->id])}}" class="link">View</a></li>
                      <li>
                        @if($writer->is_block == 1)
                        <button type="button" value="{{$writer->id}}" class="block_button link del-btn">Unblock</button>
                        @else
                        <button type="button" value="{{$writer->id}}" class="block_button link del-btn">Block</button>
                        @endif
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <img class="img-fluid" src="{{url('public/build/assets/upload/user/poster_image/default_poster.jpg')}}"
              alt="">
          </div>
          <div class="card-profile">

            <img class="rounded-circle"
              src="{{url('public/build/assets/upload/user/profile_image')}}/{{$writer->profile_image != '' ? $writer->profile_image:'default_user.png'}}"
              alt="">
          </div>
          <ul class="card-social">


            @if($writer->SocialMedia->instagram_status == 1)
            <li><a href="{{$writer->SocialMedia->instagram}}" target="_blank"><i class="fab fa-instagram mx-2"
                  style="color: #E4405F;"></i></a></li>
            @endif

            @if($writer->SocialMedia->facebook_status == 1)
            <li> <a href="{{$writer->SocialMedia->facebook}}" target="_blank"><i class="fab fa-facebook mx-2"
                  style="color: #1877F2;"></i></a></li>
            @endif

            @if($writer->SocialMedia->x_status == 1)
            <li><a href="{{$writer->SocialMedia->x}}" target="_blank"><i class="fa-brands fa-x-twitter mx-2"></i></a>
            </li>
            @endif

            @if($writer->SocialMedia->youtube_status == 1)
            <li><a href="{{$writer->SocialMedia->youtube}}" target="_blank"><i class="fab fa-youtube mx-2"
                  style="color: #FF0000;"></i></a></li>
            @endif

            @if($writer->SocialMedia->whatsapp_status == 1)
            <li><a href="https://wa.me/91{{$writer->SocialMedia->whatsapp}}" target="_blank"><i
                  class="fab fa-whatsapp mx-2" style="color: #25D366;"></i></a></li>
            @endif

            @if($writer->SocialMedia->telegram_status == 1)
            <li><a href="{{$writer->SocialMedia->telegram}}" target="_blank"><i class="fab fa-telegram mx-2"
                  style="color: #0088cc;"></i></a></li>
            @endif

            @if($writer->SocialMedia->linkedin_status == 1)
            <li><a href="{{$writer->SocialMedia->linkedin}}" target="_blank"><i class="fab fa-linkedin mx-2"
                  style="color: #0077B5;"></i></a></li>
            @endif

            @if($writer->SocialMedia->thread_status == 1)
            <li><a href="{{$writer->SocialMedia->thread}}" target="_blank"><i class="fa-brands fa-threads mx-2"></i></a>
            </li>
            @endif
          </ul>
          <div class="text-center profile-details">
            <div class="batch">
              @if($total_post[$writer->id] >= 0 && $total_post[$writer->id] <= 25) <i class="fa-solid fa-medal"
                style="color: #3d99f0;"></i>
                <p>Silver</p>
                @elseif($total_post[$writer->id] >= 26 && $total_post[$writer->id] <= 50) <i class="fa-solid fa-medal"
                  style="color: silver;"></i>
                  <p>Gold</p>
                  @elseif($total_post[$writer->id] > 50)
                  <i class="fa-solid fa-medal" style="color: gold;"></i>
                  <p>Diamond</p>
                  @endif
            </div>

            <a href="">
              <h4>{{$writer->name}}</h4>
            </a>
            <h6>{{$writer->user_type == 2 ? 'Writer':'User'}}</h6>
          </div>
          <div class="card-footer row">
            <div class="col-4 col-sm-4">
              <h6>Total Post</h6>
              <h3 class="counter">{{$total_post[$writer->id]}}</h3>
            </div>
            <div class="col-4 col-sm-4">
              <h6>Approved</h6>
              <h3><span class="counter">{{$approve_post[$writer->id]}}</span></h3>
            </div>
            <div class="col-4 col-sm-4">
              <h6>Pending</h6>
              <h3><span class="counter">{{$pending_post[$writer->id]}}</span></h3>
            </div>
          </div>
        </div>
      </div>
      @endforeach





    </div>
    <div>
      {{$writer_list->links('pagination::bootstrap-5')}}<br>
    </div>
  </div>

  @if($writer_list->count() == 0)
  <div class="pt-4">
    <h5 class="text-center">No Data Available</h5>
  </div>
  @endif
  <!-- Container-fluid Ends-->
</div>


@section('javascript-section')
@if(Session::has('user_updated'))
<script>
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
<script>
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


<script>
  $(document).ready(function ()
  {
    $(document).on('click', '.block_button', function ()
    {
      var id = $(this).val();
      swal({
        title: "Are you sure?",
        text: "You want to block this writer ?",
        icon: "warning",
        buttons: [
          'No, cancel it!',
          'Yes, I am sure!'
        ],
        dangerMode: true,
      }).then(function (isConfirm)
      {
        if (isConfirm)
        {

          $.ajax({
            url: "{{route('admin.writer.block')}}",
            method: "GET",
            data: { 'id': id },
            success: function ()
            {
              swal({
                title: "Done",
                text: "Successfully Deleted !",
                icon: "success",
                button: "Ok"
              }).then(function ()
              {
                window.location.reload();
              });
            },
          });
        } else
        {
          swal("Cancelled", "You dont delete any writer !", "error");
        }
      })
    });


    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('admin.writer.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });
  });



</script>

@endsection

@endsection