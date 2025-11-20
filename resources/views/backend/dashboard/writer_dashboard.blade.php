@extends('layouts/backend/main')
@section('main-section')
  <style>
    /* Custom styling for rounded corners and colorful cards */
    .custom-card {
      border-radius: 15px;
      overflow: hidden;
    }
    .custom-card a{
      text-align: center !important;
    }
    .custom-card a span{
      cursor: pointer !important;
    }
  
 .mycard-header {
          justify-content: space-between;
    align-items: center;
 }
 .mycard-header i{
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
              <!-- Card 1 -->
              <div class="col-md-4 ">
                <div class="card custom-card">
                  <div class="mycard-header d-flex">
                    <h5 class="card-title">Total Posts</h5>
                    <i class="fas fa-newspaper "></i>
                  </div>
                  <div class="card-body">
                    <h3 class="card-text text-center counter">{{$total_post}}</h3>
                  </div>
                  <a class="social" href="{{route('writer.post.index')}}"> <span class="social__text">View All</span></a>
                </div>
              </div>
          
              <!-- Card 2 -->
            <div class="col-md-4">
              <div class="card custom-card ">
                <div class="mycard-header d-flex">
                  <h5 class="card-title">Approved Posts</h5>
                  <i class="fas fa-check-circle"></i>
                </div>
                <div class="card-body">
                  <h3 class="card-text text-center counter">{{$approved_post}}</h3>
                </div>
                <a class="social" href="{{route('writer.post.index')}}"> <span class="social__text">View All</span></a>
              </div>
            </div>
          
              <!-- Card 3 -->
              <div class="col-md-4">
                <div class="card custom-card">
                  <div class="mycard-header d-flex">
                    <h5 class="card-title">Rejected Posts</h5>
                   <i class="fas fa-times-circle"></i>
                  </div>
                  <div class="card-body">
                    <h3 class="card-text text-center counter">{{$rejected_post}}</h3>
                  </div>
                  <a class="social" href="{{route('writer.post.index')}}"> <span class="social__text">View All</span></a>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card custom-card">
                  <div class="mycard-header d-flex">
                    <h5 class="card-title">Pending Posts</h5>
                    <i class="fas fa-hourglass-half"></i>
                  </div>
                  <div class="card-body">
                    <h3 class="card-text text-center counter">{{$pending_post}}</h3>
                  </div>
                  <a class="social" href="{{route('writer.post.index')}}"> <span class="social__text">View All</span></a>
                </div>
              </div>

            </div>
          </div>


          <div class="container mt-5">
            <div class="row">
              <!-- Latest Comments Card -->
                <div class="col-md-6">
                <div class="card custom-card">
                  <h3 class="card-header">
                    Latest Comments
                  </h3>
                  <ul class="list-group list-group-flush">
                    @foreach($latest_comment as $comment)
                    <li class="list-group-item d-flex justify-content-between"> <h6>{{$comment->comment}}</h6> <h6> {{$comment->user->name}}</h6></li>
                   @endforeach
                  </ul>
                  <a class="social" href="{{route('writer.comment.index')}}"> <span class="social__text">View All</span></a>
                </div>
              </div>
          
            
            </div>
          </div>
 
        </div>
@endsection