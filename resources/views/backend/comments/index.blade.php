@extends('layouts/backend/main')
@section('main-section')


<style>
  #drop .select2 {
    width: 35% !important;
    display: block;
  } 
</style>
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Comments</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Comments</li>
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
                <div class="col-md-6">
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
                <div class="col-md-6">
                  <div class="card-body">
                    <form class="theme-form" method="GET" action="{{URL::full()}}">
                      <div class="form-group d-flex justify-content-end">
                        <input class="form-control" name="search" type="text" placeholder="Search with comment..."
                          value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </form>
                  </div>
                </div>

                <div>
                  <form class="theme-form d-flex" method="GET" action="{{URL::full()}}">
                    <div class=" col-md-12 ">
                      <div class="card-body">
                        <div class="row ">
                          <div class="col-md-4">
                            <label class="col-form-label">Sort By:</label>
                            <select class="js-example-basic-single  select_filter" name="select_filter">
                              <option value="default" {{isset($_GET['select_filter']) &&
                                $_GET['select_filter']=='default' ? 'selected' :''}}>
                                Default</option>
                              <opti value="date_desc" {{isset($_GET['select_filter']) &&
                                $_GET['select_filter']=='date_desc' ? 'selected' :''}}>
                                Date Latest to Oldest</opti<!-- -->on>
                                <option value="date_asc" {{isset($_GET['select_filter']) &&
                                  $_GET['select_filter']=='date_asc' ? 'selected' :''}}>
                                  Date
                                  Oldest to Latest</option>
                            </select>
                          </div>


                          @if(Auth::user()->user_type == 1)
                          <div class="col-md-4">
                            <select class="js-example-basic-single" name="user" id="user">
                              <option value="">All User</option>
                              @foreach($user_list as $user)
                              <option value="{{$user->id}}" {{isset($_GET['user']) && $_GET['user']==$user->id ?
                                'selected' :
                                '' }}>{{$user->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          @endif

                          <div class="col-md-4" id="drop">
                            <div class="d-flex" id="comment">
                              <select class="js-example-basic-single" name="post" id="post">
                                <option value="">All Post</option>
                                @foreach($post_list as $post)
                                <option value="{{$post->id}}" {{isset($_GET['post']) && $_GET['post']==$post->id ?
                                  'selected' :
                                  '' }}>{{$post->meta_title}}</option>
                                @endforeach
                              </select>
                              <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                </div>
                </form>
              </div>
            </div>

            <div class="mt-3">
              @if(Auth::user()->user_type != 1)
              <ul class="nav nav-tabs" id="myTabs">
                <li class="nav-item col-md-6 text-center">
                  <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#content1">Comments</a>
                </li>
                <li class="nav-item col-md-6 text-center">
                  <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#content2">My Replies</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="tab3" data-bs-toggle="tab" href="#content3">Tab 3</a>
                  </li> -->
              </ul>
              @endif

              <div class="tab-content mt-2">
                <div class="tab-pane fade show active px-4" id="content1">
                  <div class="table-responsive ">
                    @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count =
                    $page_number * 10 - 9; @endphp
                    <table class="table">
                      <thead class="bg-primary">
                        <tr>
                          <th scope="col">S.NO</th>
                          <th scope="col">Comment</th>
                          <th scope="col">User Name</th>
                          <th scope="col">Post</th>
                          <th scope="col">Status</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach($comment_list as $comment)
                        <tr class="{{$comment->comment_approval_status == '0' ? 'tr_disable':'tr_enable'}}">
                          <th scope="row">{{$count++}}</th>
                          <td>{{$comment->comment}}</td>
                          <td>{{$comment->user->name}}
                            @if($comment->user->user_type == 1)
                            (Admin)
                            @elseif($comment->user->user_type == 2)
                            (Writer)
                            @elseif($comment->user->user_type == 3)
                            (User)
                            @endif
                          </td>
                          <td> <a href="
                            @if(Auth::user()->user_type == 1)
                              {{route('admin.post.view', [$comment->post->id])}}
                              @elseif(Auth::user()->user_type == 2)
                              {{route('writer.post.view', [$comment->post->id])}}
                              @elseif(Auth::user()->user_type == 3)
                              {{route('user.post.view', [$comment->post->id])}}
                              @endif
                            " target="_blank">{{$comment->post->meta_title}}</a></td>

                          @if(Auth::user()->user_type == 1)
                          <td>
                            <div class="form-check form-switch">
                              <input data-id="{{$comment->id}}" class="form-check-input c_status_checkbox"
                                type="checkbox" role="switch" id="c_status_checkbox" {{$comment->comment_approval_status
                              == '1' ?
                              'checked':''}}>
                            </div>
                          </td>
                          @else
                          <td>
                            @if($comment->comment_approval_status == 0)
                            Not Approve
                            @elseif($comment->comment_approval_status == 1)
                            Approve
                            @elseif($comment->comment_approval_status == 2)
                            Pending
                            @endif
                          </td>
                          @endif
                        </tr>
                        @foreach($comment->replies_for_admin as $reply)
                        <tr>
                          <td>Reply:-</td>
                          <td>{{$reply->comment}}</td>
                          <td>{{$reply->user->name}}
                            @if($reply->user->user_type == 1)
                            (Admin)
                            @elseif($reply->user->user_type == 2)
                            (Writer)
                            @elseif($reply->user->user_type == 3)
                            (User)
                            @endif
                          </td>

                          <td> <a href="
                            @if(Auth::user()->user_type == 1)
                              {{route('admin.post.view', [$comment->post->id])}}
                              @elseif(Auth::user()->user_type == 2)
                              {{route('writer.post.view', [$comment->post->id])}}
                              @elseif(Auth::user()->user_type == 3)
                              {{route('user.post.view', [$comment->post->id])}}
                              @endif
                            " target="_blank">{{$comment->post->meta_title}}</a></td>


                          <td>
                            <div class="form-check form-switch">
                              <input data-id="{{$reply->id}}" class="form-check-input r_status_checkbox" type="checkbox"
                                role="switch" id="r_status_checkbox" {{$reply->comment_approval_status
                              == '1' ?
                              'checked':''}}>
                            </div>
                          </td>
                          <td>

                          </td>
                        </tr>
                        @endforeach


                        @endforeach

                      </tbody>
                    </table>
                  </div>
                  <div class="mt-2">
                    {{$comment_list->links('pagination::bootstrap-5')}}<br>
                  </div>
                </div>
                <div class="tab-pane fade" id="content2">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-block row">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                              <div class="table-responsive">
                                @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;}
                                $count =
                                $page_number * 10 - 9; @endphp
                                <table class="table">
                                  <thead class="bg-primary">
                                    <tr>
                                      <th scope="col">S.NO</th>
                                      <th scope="col">Comment</th>
                                      <th scope="col">User Name</th>
                                      <th scope="col">Post</th>
                                      <th scope="col">Status</th>


                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($my_reply as $m_reply)
                                    @if($m_reply->parentComment)
                                    <tr
                                      class="{{$m_reply->parentComment->comment_approval_status == '0' ? 'tr_disable':'tr_enable'}}">
                                      <th scope="row">{{$count++}}</th>
                                      <td>{{$m_reply->parentComment->comment}}</td>
                                      <td>{{$m_reply->parentComment->user->name}}(
                                        @if($m_reply->parentComment->user->user_type == 1)
                                        Admin
                                        @elseif($m_reply->parentComment->user->user_type == 2)
                                        Writer
                                        @elseif($m_reply->parentComment->user->user_type == 3)
                                        User
                                        @endif
                                        )
                                      </td>
                                      <td> {{$m_reply->parentComment->post->meta_title}}</td>
                                      @if(Auth::user()->user_type == 1)
                                      <td>
                                        <div class="form-check form-switch">
                                          <input data-id="{{$m_reply->id}}" class="form-check-input c_status_checkbox"
                                            type="checkbox" role="switch" id="c_status_checkbox"
                                            {{$m_reply->comment_approval_status == '1' ?
                                          'checked':''}}>
                                        </div>
                                      </td>
                                      @else
                                      <td>
                                        @if($m_reply->parentComment->comment_approval_status == 0)
                                        Not Approve
                                        @elseif($m_reply->parentComment->comment_approval_status == 1)
                                        Approve
                                        @elseif($m_reply->parentComment->comment_approval_status == 2)
                                        Pending
                                        @endif
                                      </td>
                                      @endif
                                    </tr>
                                    @if($m_reply->parentComment->replies_for_admin->isNotEmpty())
                                    @foreach($m_reply->parentComment->replies_for_admin as $sub_reply)
                                    <tr>
                                      <td>Reply:-</td>
                                      <td>{{$sub_reply->comment}}</td>
                                      <td>{{$sub_reply->user->name}} (
                                        @if($sub_reply->user->user_type == 1)
                                        Admin
                                        @elseif($sub_reply->user->user_type == 2)
                                        Writer
                                        @elseif($sub_reply->user->user_type == 3)
                                        User
                                        @endif
                                        )</td>
                                      <td></td>
                                      <td>
                                        @if($sub_reply->comment_approval_status == 0)
                                        Not Approve
                                        @elseif($sub_reply->comment_approval_status == 1)
                                        Approve
                                        @elseif($sub_reply->comment_approval_status == 2)
                                        Pending
                                        @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    @endif
                                    @endforeach

                                  </tbody>

                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="tab-pane fade" id="content3">
                    <p>Content for Tab 3 goes here.</p>
                  </div> -->
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- <div>
          {{$comment_list->links('pagination::bootstrap-5')}}<br>
        </div> -->
    </div>

    @if($comment_list->count() == 0)
    <div class="pt-4">
      <h5 class="text-center">No Data Available</h5>
    </div>
    @endif
  </div>
</div>
<!-- Container-fluid Ends-->


</div>
<!-- tap on top starts-->
<div class="tap-top"><i class="icon-control-eject"></i></div>
<!-- tap on tap ends-->
<!-- Modal -->
<!-- Edit Modal -->
@endsection

@section('javascript-section')
@if(Session::has('success'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('faild'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Failed",
      text: "{{(Session::get('faild'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif

@if(Session::has('update_success'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('update_success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('update_failed'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Failed",
      text: "{{(Session::get('update_failed'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif

<!-- some error accured when submit -->
@if(Session::has('error'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Failed",
      text: "{{(Session::get('error'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif

<script>
  // Edit modal setup value
  $(document).ready(function ()
  {

    $(document).on('change', '.c_status_checkbox', function ()
    {
      var $toggleButton = $(this);
      var category_status = $toggleButton.prop('checked') ? 1 : 0;
      var category_id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.comment.update_status')}}",
        data: { 'c_status': category_status, 'c_id': category_id },
        success: function (data)
        {
          if (data.status == 200 && data.message == 'status_updated')
          {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (category_status == 1)
            {
              // Enable the row (remove the disabled class)
              row.removeClass('tr_disable');
            } else
            {
              // Disable the row (add the disabled class)
              row.addClass('tr_disable');
            }
          }
        }
      });
    });


    $(document).on('change', '.r_status_checkbox', function ()
    {
      var $toggleButton = $(this);
      var category_status = $toggleButton.prop('checked') ? 1 : 0;
      var category_id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.reply.update_status')}}",
        data: { 'r_status': category_status, 'r_id': category_id },
        success: function (data)
        {
          if (data.status == 200 && data.message == 'status_updated')
          {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (category_status == 1)
            {
              // Enable the row (remove the disabled class)
              row.removeClass('tr_disable');
            } else
            {
              // Disable the row (add the disabled class)
              row.addClass('tr_disable');
            }
          }
        }
      });
    });





  });
</script>
<script>
  // jQuery code to handle click event on table row
  $(document).ready(function ()
  {
    $('.table-row').on('click', function ()
    {
      var id = $(this).data('id');
      var name = $(this).data('name');
      var content = 'ID: ' + id + ', Name: ' + name;

      // Update modal content
      $('#modalContent').text(content);

      // Show the modal
      $('#exampleModal').modal('show');
    });
  });
</script>



@if(Auth::user()->user_type == 1)
<script>
  $(document).ready(function ()
  {
    //  Select Row
    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('admin.comment.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });
  });
</script>
@elseif(Auth::user()->user_type == 2)
<script>
  $(document).ready(function ()
  {
    //  Select Row
    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('writer.comment.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });
  });
</script>
@elseif(Auth::user()->user_type == 3)
<script>
  $(document).ready(function ()
  {
    //  Select Row
    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('user.comment.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });
  });
</script>
@endif

@endsection