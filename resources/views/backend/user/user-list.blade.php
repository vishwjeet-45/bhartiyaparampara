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
          <h3>Users List</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Users List</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid user-card">
    <div class="row">
      <div class="card">
        <div class="d-flex justify-content-between">
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
                  <option value="0">Unblocked</option>
                  <option value="1">Blocked</option>
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
    <div class="row">

      @foreach($user_list as $user)
      <div class="col-md-6 col-lg-6 col-xl-4 box-col-6">

        <div class="card custom-card mind">

          <div class="card-header p-0">
            @if($user->is_block == 1)
            <div class="ribbon ribbon-danger">Blocked</div>
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
                      <li><a href="{{route('admin.user.edit', [$user->id])}}" class="link">Edit</a></li>
                      <li><a href="{{route('admin.user.view', [$user->id])}}" class="link">View</a></li>
                      <li>
                        @if($user->is_block == 1)
                        <button type="button" value="{{$user->id}}" class="block_button link del-btn">Unblock</button>
                        @else
                        <button type="button" value="{{$user->id}}" class="block_button link del-btn">Block</button>
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
              src="{{url('public/build/assets/upload/user/profile_image')}}/{{$user->profile_image != '' ? $user->profile_image:'default_user.png'}}"
              alt="">
          </div>

          <div class="text-center profile-details">

          
              <h4>{{$user->name}}</h4>
            
            <h6>{{$user->user_type == 2 ? 'Writer':'User'}}</h6>
          </div>

        </div>
      </div>
      @endforeach





    </div>

    <div>
      {{$user_list->links('pagination::bootstrap-5')}}<br>
    </div>
  </div>
  @if($user_list->count() == 0)
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
        text: "You want to block this User ?",
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
            url: "{{route('admin.user.block')}}",
            method: "GET",
            data: { 'id': id },
            success: function ()
            {
              swal({
                title: "Done",
                text: "Successfully Blocked !",
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
          swal("Cancelled", "You dont block any user !", "error");
        }
      })
    });

    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('admin.user.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });

  });


</script>

@endsection

@endsection