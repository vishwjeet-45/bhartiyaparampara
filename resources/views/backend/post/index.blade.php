@extends('layouts/backend/main')
@section('main-section')
@php
$user_type = Auth::user()->user_type;
@endphp

<style>
  .blog-box .blog-wrraper {
    overflow: hidden;
    height: 300px;
    width: 100%;
    object-fit: cover;
  }

  .blog-box .blog-wrraper a img {
    object-fit: cover;
    width: 100%;
    height: 300px;
  }

  .wri {
    padding: 0 38px 0 1px !important;
  }

  .wri2 {
    padding: 0px 50px 0 23px !important;
  }
  .writer-input{
    width: 190px;
  }
/* #sort-writer .select2 {
    width: 10% !important;
    display: block;
  }
  #main-post .select2{
    width: 150px;
  } */

  span.select2.select2-container:nth-child(3) {
    width: 150px !important;
}
</style>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>All Post</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Post</li>
          </ol>
        </div>

        <div class="col-sm-6 d-flex justify-content-end">
          <!-- Button trigger modal -->
          @if(Auth::user()->is_block == 0)
          <a type="button" class="btn btn-primary" href="
            @if($user_type == 1)
                            {{route('admin.post.create')}}
                            @elseif($user_type == 2)
                            {{route('writer.post.create')}}
                            @elseif($user_type == 3)
                            {{route('user.post.create')}}
                            @endif ">Add New</a>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid blog-page">
    <div class="row">
      <div class="col-md-12">
        <div class="row mb-4 card"  >
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
                    <input class="form-control" name="search" type="text" placeholder="Search by title"
                      value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                    <button type="submit" class="btn btn-primary">Search</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="cont mb-3">
            <form class="theme-form" method="GET" action="{{URL::full()}}">
              <div class="row">
                <div class="card-body col-md-12 wri2 d-flex" >
                  <label class="col-form-label px-2">Sort:</label>
                  <select class="js-example-basic-single sorting-odr col-sm-4 select_filter" name="select_filter" id="sort-writer">
                    <option value="default" {{isset($_GET['select_filter']) && $_GET['select_filter']=='default'
                      ? 'selected' :''}}>Default</option>
                    <option value="date_desc" {{isset($_GET['select_filter']) && $_GET['select_filter']=='date_desc'
                      ? 'selected' :''}}>Date Latest to Oldest</option>
                    <option value="date_asc" {{isset($_GET['select_filter']) && $_GET['select_filter']=='date_asc'
                      ? 'selected' :''}}>Date Oldest to Latest</option>
                    <option value="view_desc" {{isset($_GET['select_filter']) && $_GET['select_filter']=='view_desc'
                      ? 'selected' :''}}>View High to Low</option>
                    <option value="view_asc" {{isset($_GET['select_filter']) && $_GET['select_filter']=='view_asc'
                      ? 'selected' :''}}>View Low to High</option>
                  </select>

                  <label class="col-form-label px-2"> Staus: </label>


                  <select class="js-example-basic-single col-sm-4 select_filter" name="sort_by_status">
                    <option value="all" {{isset($_GET['sort_by_status']) && $_GET['sort_by_status']=='default'
                      ? 'selected' :''}}>All</option>

                    <option value="0" {{isset($_GET['sort_by_status']) && $_GET['sort_by_status']=='0' ? 'selected'
                      :''}}>Rejected</option>

                    <option value="1" {{isset($_GET['sort_by_status']) && $_GET['sort_by_status']=='1' ? 'selected'
                      :''}}>Approved</option>

                    <option value="2" {{isset($_GET['sort_by_status']) && $_GET['sort_by_status']=='2' ? 'selected'
                      :''}}>Pending</option>
                  </select>
                  @if(Auth::user()->user_type == 1)
                  <!-- <label class="col-form-label">Sort by Writer name:</label> -->
                  <input class=" form-control writer-input " type="text" placeholder="Sort by Writer name" name="writer_name"
                    value="{{isset($_GET['select_filter']) ? $_GET['writer_name'] :''}}" style="margin-left: 17px;">
                    <label class="col-form-label mx-2">Main Category:</label>
                    <select class="js-example-basic-single col-sm-4 select_filter" name="main_category" id="main-post">
                      <option value="">All Main Category</option>
                      @foreach($main_category_list as $main_cat)
                      <option value="{{$main_cat->id}}" {{isset($_GET['main_category']) && $_GET['main_category']==$main_cat->id
                        ? 'selected' :''}}>{{$main_cat->main_category_name_en}}</option>
                      @endforeach
                    </select>
                    @endif
                    <button type="submit" class="btn btn-primary">Apply</button>  
                </div>
              </div>  
          </div>
          </form>
        </div>
      </div>


      @foreach($posts as $post)
      @php
      $like_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type', 'like')->count();
      $heart_count = App\Models\backend\Like::where('post_id', $post->id)->where('like_type', 'heart')->count();
      @endphp
      <div class="col-md-4">
        <div class="card">
          <div class="blog-box blog-grid">
            <div id="container">
              @if($post->post_approval_status == 0)
              <div class="ribbon ribbon-danger">Rejected</div>
              @elseif($post->post_approval_status == 1)
              <div class="ribbon ribbon-success">Approved</div>
              @elseif($post->post_approval_status == 2)
              <div class="ribbon ribbon-warning">Approval Pending</div>
              @endif
              <div id="menu-wrap">
                <input type="checkbox" class="toggler" />
                <div class="dots">
                  <div></div>
                </div>
                <div class="menu">
                  <div>
                    <ul>
                      <li><a href="
                            @if(Auth::user()->is_block == 0)
                            @if($user_type == 1)
                            {{route('admin.post.edit', [$post->id])}}
                            @elseif($user_type == 2)
                            {{route('writer.post.edit', [$post->id])}}
                            @elseif($user_type == 3)
                            {{route('user.post.edit', [$post->id])}}
                            @endif 
                            @else
                            #
                            @endif " class="link">
                          @if(Auth::user()->is_block == 1)
                          <s>Edit</s>
                          @else
                          Edit
                          @endif
                        </a></li>
                      <li><a href="
                            @if($user_type == 1)
                            {{route('admin.post.view', [$post->id])}}
                            @elseif($user_type == 2)
                            {{route('writer.post.view', [$post->id])}}
                            @elseif($user_type == 3)
                            {{route('user.post.view', [$post->id])}}
                            @endif " class="link">View</a></li>
                      <li>
                        <button type="button" value="{{$post->id}}" class="
                          @if(Auth::user()->is_block == 0)
                          delete_button
                          @endif
                           link del-btn">
                          @if(Auth::user()->is_block == 1)
                          <s>Delete</s>
                          @else
                          Delete
                          @endif
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="blog-wrraper">
              <a href="
              @if($user_type == 1)
                            {{route('admin.post.view', [$post->id])}}
                            @elseif($user_type == 2)
                            {{route('writer.post.view', [$post->id])}}
                            @elseif($user_type == 3)
                            {{route('user.post.view', [$post->id])}}
                            @endif 
                            ">
                <img class="img-fluid top-radius-blog"
                  src="{{url('public/build/assets/upload/thumbnail')}}/{{$post->thumbnail_image}}" alt=""></a>
            </div>
            <div class="blog-details-second">
              <div class="blog-post-date"><span
                  class="blg-month">{{\Carbon\Carbon::parse($post->publish_on)->format('M')}}</span><span
                  class="blg-date">{{\Carbon\Carbon::parse($post->publish_on)->format('d')}}</span></div><a
                href="
                @if($user_type == 1)
                            {{route('admin.post.view', [$post->id])}}
                            @elseif($user_type == 2)
                            {{route('writer.post.view', [$post->id])}}
                            @elseif($user_type == 3)
                            {{route('user.post.view', [$post->id])}}
                            @endif 
                            ">
                <h6 class="blog-bottom-details">{{Str::limit($post->meta_title, 30)}}</h6>
              </a>
              <p> {!! Str::limit($post->short_description, 200) !!}</p>
              <div class="detail-footer">
                <ul class="social-list">
                  <li><i class="fa fa-user-o"></i>{{$post->getUser->name}}</li>
                  <li><i class="fa fa-eye"></i>{{$post->views}}</li>
                  <li><i class="fa fa-thumbs-up"></i>{{$like_count}}</li>
                  <li><i class="fa fa-heart-o"></i>{{$heart_count}}</li>
                  <!-- <li><i class="fa fa-thumbs-o-up"></i>2 like</li> -->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach

      <div>
        {{$posts->links('pagination::bootstrap-5')}}<br>
      </div>

    </div>
  </div>
</div>
</div>
@if($posts->count() == 0)
<div class="pt-5 mt-5">
  <h5 class="text-center">No Data Available</h5>
</div>
@endif
<!-- Container-fluid Ends-->
</div>
@endsection

@section('javascript-section')
@if(Session::has('post_success'))
<script>
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('post_success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('post_fail'))
<script>
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('post_fail'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif


<script>
  $(document).ready(function ()
  {
    $(document).on('click', '.delete_button', function ()
    {
      var id = $(this).val();
      swal({
        title: "Are you sure?",
        text: "You want to delete this permanently ?",
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
            url: "{{route('post.destroy')}}",
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
          swal("Cancelled", "You dont delete any post !", "error");
        }
      })
    });




  });
</script>

@if(Auth::user()->user_type == 1)
<script>
  $(document).on('change', '#qty', function ()
  {
    const qty = $(this).val();
    var current_url = "{{route('admin.post.index')}}";
    window.location.replace(current_url + '?qty=' + qty);
  });
</script>
@else
<script>
  $(document).on('change', '#qty', function ()
  {
    const qty = $(this).val();
    var current_url = "{{route('writer.post.index')}}";
    window.location.replace(current_url + '?qty=' + qty);
  });
</script>
@endif

 
@endsection