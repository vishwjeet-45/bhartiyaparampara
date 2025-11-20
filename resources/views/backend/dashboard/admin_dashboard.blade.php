@extends('layouts/backend/main')
@section('main-section')
<style>
  /* Custom styling for rounded corners and colorful cards */
  .custom-card {
    border-radius: 15px;
    overflow: hidden;
  }

  .custom-card a {
    text-align: center !important;
  }

  .custom-card a span {
    cursor: pointer !important;
  }

  .mycard-header {
    justify-content: space-between;
    align-items: center;
  }

  .mycard-header i {
    font-size: 20px;
    color: #4D8AFF;
  }

  .card-body {
    color: #000;
  }
</style>

<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header dash-breadcrumb">
      <div class="row">
        <div class="col-6">
          <h3 class="f-w-600">Dashboard</h3>
        </div>
        <div class="col-6">
          <div class="breadcrumb-sec">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Dashboard</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="container">
    <div class="row">
      <div class="col-md-4 ">
        <div class="card custom-card">
          <div class="mycard-header d-flex">
            <h6 class="card-title fw-bold">Total Posts</h6>
            <i class="fas fa-newspaper "></i>
          </div>
          <div class="card-body">
            <h3 class="card-text text-center counter">{{$total_post}}</h3>
          </div>
          <a class="social" href="{{route('admin.post.index')}}"> <span class="social__text">View All</span></a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card custom-card ">
          <div class="mycard-header d-flex">
            <h6 class="card-title fw-bold">Approved Posts</h6>
            <i class="fas fa-check-circle"></i>
          </div>
          <div class="card-body">
            <h3 class="card-text text-center counter">{{$approved_post}}</h3>
          </div>
          <a class="social" href="{{route('admin.post.index')}}?select_filter=default&sort_by_status=1&writer_name="> <span class="social__text">View All</span></a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card custom-card">
          <div class="mycard-header d-flex">
            <h6 class="card-title fw-bold">Rejected Posts</h6>
            <i class="fas fa-times-circle"></i>
          </div>
          <div class="card-body">
            <h3 class="card-text text-center counter">{{$rejected_post}}</h3>
          </div>
          <a class="social" href="{{route('admin.post.index')}}?select_filter=default&sort_by_status=0&writer_name=""> <span class="social__text">View All</span></a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card custom-card">
          <div class="mycard-header d-flex">
            <h6 class="card-title fw-bold">Pending Posts</h6>
            <i class="fas fa-hourglass-half"></i>
          </div>
          <div class="card-body">
            <h3 class="card-text text-center counter">{{$pending_post}}</h3>
          </div>
          <a class="social" href="{{route('admin.post.index')}}?select_filter=default&sort_by_status=2&writer_name=""> <span class="social__text">View All</span></a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card custom-card">
          <div class="mycard-header d-flex">
            <h6 class="card-title fw-bold">Total Users</h6>
            <i class="fas fa-users"></i>
          </div>
          <div class="card-body">
            <h3 class="card-text text-center counter">{{$total_users}}</h3>
          </div>
          <a class="social" href="{{route('admin.user.index')}}"> <span class="social__text">View All</span></a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card custom-card">
          <div class="mycard-header d-flex">
            <h6 class="card-title fw-bold">Total Writers</h6>
            <i class="fas fa-users"></i>
          </div>
          <div class="card-body">
            <h3 class="card-text text-center counter">{{$total_writers}}</h3>
          </div>
          <a class="social" href="{{route('admin.writer.index')}}"> <span class="social__text">View All</span></a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card custom-card">
          <div class="mycard-header d-flex">
            <h6 class="card-title fw-bold">Total Newsletter Subscription</h6>
            <i class="fas fa-envelope"></i>
          </div>
          <div class="card-body">
            <h3 class="card-text text-center counter">{{$total_newsletter}}</h3>
          </div>
          <a class="social" href="{{route('admin.newsletter.index')}}"> <span class="social__text">View All</span></a>
        </div>
      </div>

       
      
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <div class="card custom-card">
          <h5 class="card-header fw-bold mb-2">
            Latest Comments
          </h5>
          <ul class="list-group list-group-flush">
            @foreach($latest_comment as $comment)
            <li class="list-group-item d-flex justify-content-between">
              <h6>{{$comment->comment}}</h6>
              <h6> {{$comment->user->name}}</h6>
            </li>
            @endforeach
          </ul>
          <a class="social" href="{{route('admin.comment.index')}}"> <span class="social__text">View All</span></a>
        </div>
      </div>

      <!-- Latest Updates Card -->
      <div class="col-md-6">
                <div class="card custom-card">
                  <h5 class="card-header fw-bold mb-2">
                    Latest Question
                  </h5>
                  <ul class="list-group list-group-flush">
                    @foreach($letest_question as $que)
                    <li class="list-group-item"> <h6>{{$que->question_en}}</h6></li> 
                    @endforeach
                  </ul>
                  <a class="social" href="{{route('admin.question_and_answer.index')}}"> <span class="social__text">View All</span></a>

                </div>
              </div>  
    </div>
  </div>
</div>
@endsection