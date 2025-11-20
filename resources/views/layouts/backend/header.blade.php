<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 
    <title>Bhartiya Parampara | Admin Panel</title>
  <meta name="description"
    content="Explore the rich tapestry of Indian culture with Bhartiya Parampara, offering comprehensive information on traditions,
festivals, rituals, scriptures, astrology, vastu, literature, and much more. Immerse yourself in the diverse facets of
India's heritage and">
<!--====== Favicon Icon ======-->
<meta name="apple-touch-fullscreen" content="yes">
  <meta name="format-detection" content="telephone=no">
  <link rel="apple-touch-icon" sizes="57x57"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-57x57.png')}}">
  <link rel="apple-touch-icon" sizes="60x60"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180"
    href="{{url('public/build/assets/frontend/img/favicon/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192"
    href="{{url('public/build/assets/frontend/img/favicon/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32"
    href="{{url('public/build/assets/frontend/img/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96"
    href="{{url('public/build/assets/frontend/img/favicon/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16"
    href="{{url('public/build/assets/frontend/img/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{url('public/build/assets/frontend/img/favicon/manifest.json')}}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
 
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/font-awesome.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/prism.css')}}">
    <!-- Plugins css Ends-->
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/select2.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{url('public/build/assets/backend/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/css/vendors/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/backend/easyimage/styles/easyimage.css')}}">
    <!-- my links
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        .dropdown-onclick { 
            height: 50vh;
            overflow: overlay;
            z-index: 444;
            position: fixed;
            /* padding:15px; */
        }

        .special-tag {
            background: red;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 13px;
        }

        .unread_notification {
            background: #f2f6fc;
            border-bottom: 1px solid #e0e2e5;
            font-weight: bold;
        }

        .read_notification {
            background: #ffff;
            border-bottom: 1px solid #e0e2e5
        }

        .search-val {
            background-color: #e1e1e1;
        }

       
        [data-notify] {
            display: none !important;
        }
    </style>
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="main-loader">
            <div class="bar-0"></div>
            <div class="bar-1"></div>
            <div class="bar-2"></div>
            <div class="bar-3"></div>
            <div class="bar-4"></div>
        </div>
        <div class="loading">Loading... </div>
    </div>
    <!-- Loader ends-->
    @php
    $user_type = Auth::user()->user_type;
    @endphp
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <div class="logo-wrapper"><a href="#"><img class="img-fluid"
                                src="{{url('public/build/assets/backend/images/logo/logo.png')}}" alt=""></a></div>
                </div>
                <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center"
                        id="sidebar-toggle"></i></div>
                @if(Auth::user()->user_type != 3)
                <div class="left-menu-header col">
                    <ul>
                        <li>
                            <!-- <form class="form-inline search-form">
                                <div class="search-bg"><i class="fa fa-search"></i></div>
                                <input class="form-control-plaintext search_bar" placeholder="Search here.....">
                            </form>
                                <div class="dropdown-onclick top_search_list">  
                                </div> -->
                            <form class="form-inline search-form">
                                <div class="search-bg"><i class="fa fa-search"></i></div>
                                <input class="form-control-plaintext search_bar" id="searchInput"
                                    placeholder="Search here.....">
                            </form>
                            <div class="dropdown-onclick top_search_list"></div>

                            <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
                        </li>
                    </ul>
                </div>
                @endif
                <div class="nav-right col pull-right right-menu">
                    <ul class="nav-menus">
                        @if(Auth::user()->user_type == 1)
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <i data-feather="bell"></i>
                                <span
                                    class="badge badge-pill badge-primary">{{count($admin_unread_notification_count)}}</span>
                            </div>
                            <div class="notification-dropdown onhover-show-div">
                                <div class=""><a class="btn btn-dark w-100" href="#">You have
                                        {{count($admin_unread_notification_count)}} notifications</a></div>
                                <ul class="border-top">
                                    @foreach($admin_notification_list as $notification)
                                    <li class="{{$notification->is_read == 0 ? 'unread_notification' : 'read_notification'}}"
                                        id="noti_li">
                                        <p class="mb-0 ps-4 p-relative modal_notification d-flex"
                                            data-id="{{$notification->id}}" data-bs-toggle="modal"
                                            data-bs-target="#viewNotificationModal"><i
                                                class="fa fa-circle me-3 font-primary">
                                            </i>{{$notification->title}}<span class="pull-right">{{
                                                $notification->created_at->diffForHumans() }}</span>
                                        </p>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class=" v-btn"><a class="btn btn-light w-100" href="{{route('admin.all_notification')}}">View all</a></div>
                            </div>
                        </li>
                        @else
                        @php
                        $notification_list = App\Models\backend\Notification::where('user_id',
                        Auth::user()->id)->orderBy('id', 'desc')->get();

                        $notification_count = App\Models\backend\Notification::where('user_id',
                        Auth::user()->id)->where('is_read', 0)->orderBy('id', 'desc')->get();
                        @endphp
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <i data-feather="bell"></i>
                                <span class="badge badge-pill badge-primary">{{count($notification_count)}}</span>
                            </div>
                            <div class="notification-dropdown onhover-show-div ">
                                <div class="m-3"><a class="btn btn-dark w-100" href="#">You have
                                        {{count($notification_count)}}
                                        notifications</a></div>
                                <ul class="border-top">
                                    @foreach($notification_list as $notification)
                                    <li class="{{$notification->is_read == 0 ? 'unread_notification' : 'read_notification'}}"
                                        id="notificationListItem">
                                        <p class="mb-0 ps-4 p-relative modal_notification"
                                            data-id="{{$notification->id}}" data-bs-toggle="modal"
                                            data-bs-target="#viewNotificationModal"><i
                                                class="fa fa-circle me-3 font-primary">
                                            </i>{{$notification->title}}<span class="pull-right">{{
                                                $notification->created_at->diffForHumans() }}</span>
                                        </p>
                                    </li>
                                    @endforeach
                                </ul>
                                @if(Auth::user()->user_type == 2)
                                <div class="v-btn"><a class="btn btn-light w-100" href="{{route('writer.all_notification')}}">View all</a>
                                @elseif(Auth::user()->user_type == 3)
                                <div class="v-btn"><a class="btn btn-light w-100" href="{{route('user.all_notification')}}">View all</a>
                                @endif
                                </div>
                            </div>
                        </li>

                        @endif
                        <!-- <li>
                            <div class="mode"><i class="fa fa-moon-o"></i></div>
                        </li> -->
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    data-feather="maximize"></i></a></li>
                        <li class="onhover-dropdown">
                            <div class="media profile-media">
                                @if(Auth::user()->profile_image == '')
                                <img class="rounded-circle" src="{{url('public/build/assets/upload/user/profile_image')}}/default_user.png" alt="" width="25" height="25">
                                @else
                                <img class="rounded-circle" src="{{url('public/build/assets/upload/user/profile_image')}}/{{Auth::user()->profile_image}}" alt="" width="25" height="25">
                                @endif
                                </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href=""><i data-feather="user"></i><span>{{Auth::user()->name}} </span></a></li>
                                <!-- <li><a href="user-profile.html"><i data-feather="user"></i><span>Account </span></a></li> -->
                                <li><a href=" 
                                    @if($user_type==1)
                                    {{route('admin.view.edit_my_profile')}}
                                    @elseif($user_type==2)
                                    {{route('writer.view.edit_my_profile')}}
                                    @else
                                    {{route('user.view.edit_my_profile')}}
                                    @endif "><i data-feather="edit"></i><span>Edit Profile</span></a></li>
                                <li><i data-feather="globe"></i><a href="/" target="_blank"><span>Go To
                                            Website</span></a></li>
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <li><button class="btn btn-light w-100" type="submit"> <svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-log-in">
                                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                                <polyline points="10 17 15 12 10 7"></polyline>
                                                <line x1="15" y1="12" x2="3" y2="12"></line>
                                            </svg>Logout</button></li>
                                </form>
                        </li>
                    </ul>
                </div>
                <div class="d-lg-none col mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
        <!-- Page Header Ends  -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            <header class="main-nav">
                <div class="logo-wrapper"><a href="{{route('user.login.view')}}"><img class="img-fluid"
                            src="{{url('public/build/assets/backend/images/logo/bharitya_prampara_logo.png')}}"
                            alt=""></a></div>
                <!-- <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid"
                            src="{{url('public/build/assets/backend/images/logo/logo-icon.png')}}" alt=""></a></div> -->
                <!-- <div class="morden-logo"><a href="index.html"><img class="img-fluid"
                            src="{{url('public/build/assets/backend/images/logo/morden-logo.png')}}" alt=""></a></div> -->
                <nav>
                    <div class="main-navbar">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="mainnav">
                            <ul class="nav-menu custom-scrollbar">
                                <li class="back-btn">
                                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                            aria-hidden="true"></i></div>
                                </li>
                                @if(Auth::user()->user_type == 3)
                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/account') ? 'active' : '' }}" href="
                             @if($user_type==1)
                             {{route('admin.account.status')}}
                             @elseif($user_type==2)
                             {{route('writer.account.status')}}
                             @else
                             {{route('user.account.status')}}
                             @endif "><i data-feather="user"></i><span>My Profile</span></a></li>
                            @endif

                                @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2 )
                                <li class="dropdown "><a class="nav-link menu-title link-nav {{Route::currentRouteName() == 'admin.dashboard'?'active':''}}
                                {{Route::currentRouteName() == 'writer.dashboard'?'active':''}}
                                {{Route::currentRouteName() == 'user.dashboard'?'active':''}}"
                                        href="{{route('user.login.view')}}"><i
                                            data-feather="home"></i><span>Dashboard</span></a>
                                </li>
                                @endif

                                @if(Auth::user()->user_type == 1)
                                <li class="dropdown"><a class="nav-link menu-title {{ str_contains(request()->url(), 'category') ? 'active' : '' }}" href="javascript:void(0)"><i
                                            data-feather="airplay"></i><span>Category</span></a>
                                    <ul class="nav-submenu menu-content">
                                        <li><a href="{{route('admin.main_category.index')}}">Main Category</a></li>
                                        <li><a href="{{route('admin.category.index')}}">Category</a></li>
                                        <li><a href="{{route('admin.sub_category.index')}}">Sub Category</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2 || Auth::user()->is_team == 1)
                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/post') ? 'active' : '' }}"
                                        href="
                                        @if($user_type==1)
                                        {{route('admin.post.index')}}
                                         @elseif($user_type==2)
                                        {{route('writer.post.index')}} 
                                        @elseif($user_type == 3)
                                        {{route('user.post.index')}} 
                                        @endif 
                                        "><i data-feather="layout"></i><span>Post</span></a></li> 
                                @endif

                                @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/social-media') ? 'active' : '' }}" href="
                                @if($user_type==1)
                                {{route('admin.social_media.index')}}
                                @elseif($user_type==2)
                                {{route('writer.social_media.index')}}
                                @endif
                                "><i data-feather="message-circle"></i><span>Social Media</span></a></li>
                                @endif

                                @if(Auth::user()->user_type == 1)
                                <li class="dropdown"><a class="nav-link menu-title 
                                {{ str_contains(request()->url(), '/writer') ? 'active' : '' }}
                                {{ str_contains(request()->url(), '/user') ? 'active' : '' }}
                                {{ str_contains(request()->url(), '/team') ? 'active' : '' }}" href="javascript:void(0)"><i
                                            data-feather="users"></i><span>All User</span></a>
                                    <ul class="nav-submenu menu-content">
                                        <li><a href="{{route('admin.writer.index')}}">Writers</a></li>
                                        <li><a href="{{route('admin.user.index')}}">Users</a></li>
                                        <li class="dropdown"><a class="nav-link menu-title link-nav"
                                                href="{{route('admin.team.index')}}"><span>Team</span></a></li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a class="nav-link menu-title 
                                {{ str_contains(request()->url(), '/pages') ? 'active' : '' }}
                                {{ str_contains(request()->url(), '/other-pages') ? 'active' : '' }}
                                {{ str_contains(request()->url(), '/pdf-page') ? 'active' : '' }}" href="javascript:void(0)"><i
                                            data-feather="file"></i>
                                        <span>Pages</span></a>
                                    <ul class="nav-submenu menu-content">
                                        <li><a href="{{route('admin.pages.index')}}">Menu Pages</a></li>
                                        <li><a href="{{route('admin.other_pages.index')}}">Other Pages</a></li>
                                        <li><a href="{{route('admin.pdf_page.index')}}">PDF Pages</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/advertisement') ? 'active' : '' }}"
                                        href="{{route('admin.advertisement.index')}}"><i
                                            data-feather="image"></i><span>Advertisement</span></a></li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/gallery') ? 'active' : '' }}"
                                        href="{{route('admin.gallery.index')}}"><i
                                            data-feather="image"></i><span>Gallery</span></a></li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/upload_pdf') ? 'active' : '' }}"
                                        href="{{route('admin.upload_pdf.index')}}"><i
                                            data-feather="upload"></i></i><span>Upload PDF</span></a></li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/newsletter') ? 'active' : '' }}"
                                        href="{{route('admin.newsletter.index')}}"><i
                                            data-feather="mail"></i><span>Newsletter</span></a></li>
                               

                                <li class="dropdown"><a class="nav-link menu-title {{ str_contains(request()->url(), '/widget') ? 'active' : '' }}" href="javascript:void(0)"><i
                                            data-feather="grid"></i><span>Widgets</span></a>
                                    <ul class="nav-submenu menu-content">
                                        <li><a href="{{route('admin.widget.first_slider.index')}}">First Slider
                                                Section</a></li>
                                        <li><a href="{{route('amdin.widget.video_section.index')}}">Video Section</a>
                                        </li>
                                    </ul>
                                </li>
                                @endif

                                @php
                                $total_q_a = App\Models\backend\Question::count();
                                $total_a = App\Models\backend\Answer::where('user_id', Auth::user()->id)->count();
                                @endphp


                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav d-flex {{ str_contains(request()->url(), '/question-and-answer') ? 'active' : '' }}"
                                        href="
                                        @if(Auth::user()->user_type == 1)
                                        {{route('admin.question_and_answer.index')}}
                                        @elseif(Auth::user()->user_type == 2)
                                        {{route('writer.question_and_answer.index')}} 
                                        @elseif(Auth::user()->user_type == 3)
                                        {{route('user.question_and_answer.index')}} 
                                        @endif
                                        "><i
                                            data-feather="help-circle"></i><span>Que & Ans</span>
                                            @if(Auth::user()->user_type == 1)
                                        <span class="special-tag mx-3">{{$total_q_a}}</span>
                                        @else
                                        <span class="special-tag mx-3">{{$total_a}}</span>
                                        @endif
                                    </a>
                                </li>

                                @if(Auth::user()->user_type == 1)
                                @php
                                $total_comment = App\Models\backend\Comment::count();
                                @endphp
                                @else
                                @php
                                $total_comment = App\Models\backend\Comment::where('user_id',
                                Auth::user()->id)->where('parent_id', null)->count();
                                @endphp
                                @endif
                                <li class="dropdown"><a class="nav-link menu-title link-nav d-flex {{ str_contains(request()->url(), '/comment') ? 'active' : '' }}" href="
                                    @if($user_type==1)
                                    {{route('admin.comment.index')}}
                                    @elseif($user_type==2)
                                    {{route('writer.comment.index')}}
                                    @else
                                    {{route('user.comment.index')}}
                                    @endif "><i data-feather="message-square"></i><span>Comments</span>
                                        <span class="special-tag mx-3">{{$total_comment}}</span>
                                    </a></li>


                                    @if(Auth::user()->user_type != 3)
                                <li class="dropdown"><a class="nav-link menu-title link-nav {{ str_contains(request()->url(), '/account') ? 'active' : '' }}" href="
                             @if($user_type==1)
                             {{route('admin.account.status')}}
                             @elseif($user_type==2)
                             {{route('writer.account.status')}}
                             @else
                             {{route('user.account.status')}}
                             @endif "><i data-feather="user"></i><span>Profile</span></a></li>
                             @endif
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </div>
                </nav>
            </header>


            <div class="modal fade" id="viewNotificationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="noti_title">Title</p>
                            <p id="noti_desc">Description</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div> 
 