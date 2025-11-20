<!DOCTYPE html>
<html lang="en">
@php
$lang = Session::get('lang');
@endphp
<head>
  <meta charset="utf-8">
  <title>
    @yield('meta-title')
  </title>
  @yield('ogimage')
  <meta name="description" content="
  @yield('meta-description')
  ">
  <meta name="author" content="Bhartiya Parampara" />
  <meta name="robots" content="index, follow" />
  <meta name="googlebot" content="NOODP" />
  <meta name="revisit-after" content="7 days" />
  <meta name="dcterms.audience" content="Global" />
  <meta name="rating" content="General" />
  <meta name="application-name" content="Bhartiya Parampara" />
  <meta name="apple-mobile-web-app-title" content="Bhartiya Parampara">
  <meta name="apple-mobile-web-app-capable" content="yes">
  @if($lang == 'en')
  <meta name="language" content="english" />
  <meta https-equiv="content-language" content="en-us">
  @else
  <meta name="language" content="hindi" />
  <meta https-equiv="content-language" content="hi">
  @endif

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <script data-ad-client="pub-9148274628956787" async src="../pagead2.googlesyndication.com/pagead/js/f.txt"></script>

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,600,700%7CSource+Sans+Pro:400,600,700'
    rel='stylesheet'>

  <!-- Css -->
  <link rel="stylesheet" href="{{url('public/build/assets/frontend/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{url('public/build/assets/frontend/css/font-icons.css')}}" />
  <link rel="stylesheet" href="{{url('public/build/assets/frontend/css/style.css')}}" />


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
  <meta name="theme-color" content="#ffffff">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

  <!-- Lazyload (must be placed in head in order to work) -->
  <script src="{{url('public/build/assets/frontend/js/lazysizes.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!--Personal Counter  -->

  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N99MQ6ZL');</script>
<!-- End Google Tag Manager -->

	<script data-ad-client="pub-9148274628956787" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7JEBFY5KYV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7JEBFY5KYV');
</script><script data-ad-client="pub-9148274628956787" async src="https://pagead2.googlesyndication.com/
pagead/js/adsbygoogle.js"></script>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KJVXXN8Y9X"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KJVXXN8Y9X');
</script>


<!-- microsoft code -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "ta0u546qg0");
</script>


  <style>
    .head_width{
         max-width: 1257px !important;
             text-align: center;
    }

    .counter {
      background-color: black;
      color: #ef4029;
      font-weight: bold;
    }

    /* Add some basic styles for the dropdown */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      top: 30px;
      right: 40px;
    }

    .dropdown-content a:hover {
      color: #000;
    }

    .active {
      display: inline-block;
      /* Show the dropdown content when 'active' class is present */
    }

    .dropdown-content a {
      padding: 6px 16px;
    }

    .social {
      margin: 0 3px;
    }
    #header-top-set {
  /* Your header styles go here */
  /* For instance: */
  background-color: #ffffff;
  padding: 10px;
  width: 100%;
  transition: all 0.3s ease;
}

.fixed-hed {
  /* Sticky header styles */
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


.nav--sticky.sticky {
    /* Set initial position */
    top: 103px;
    /* Apply transition for smooth animation */
    /* transition: top 1s ease; */
     /* You can adjust the duration and timing function as needed */
     transition: top 2s ease, opacity 2s ease;
}


.nav--sticky.sticky {
    /* Set the final position */
    top: 103px;
    /* Set final opacity */
    opacity: 1;
}




    .sticky-header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      background-color: #ffffff;
      /* Change the background color as needed */
      transition: 0.3s ease;
    }

    .social-sidenav {
      display: inline-block;
      /* line-height: 32px;
	width: 16px;
	height: 32px; */
      color: #fff;
      text-align: center;
      margin-right: 8px;
      margin-bottom: 8px;
      font-size: 13px;
      -webkit-transition: all 0.1s ease-in-out;
      transition: all 0.1s ease-in-out;
      padding: 10px;
      border-radius: 5px;
      width: 40px;
    }
  </style>
  <style>
    .sidenav__menu-dropdown {
      display: none;
    }

    .sidenav__menu-dropdown.show {
      display: block;
    }

    .sidenav__menu li {
      padding: 12px 22px;
    }

    .sidenav__menu .active .sidenav__menu-url{
      color:#ef4029;
    }


    .socials {
      /* justify-content: center !important; */
      display: flex;
    }

    .social-top-header {
      justify-content: center !important;
    }

    .sticky-header {
      z-index: 100;
    }

    .sidenav__menu li i {
      cursor: pointer;
    }

    .social-threads {
      background-color: purple;
    }

    .social-telegram {
      background-color: #0e76a8;
    }

    .social-sidenav:hover {
      color: #fff !important;
    }
    .logo-mob-front{
      display:none;
    }

    @media only screen and (max-width: 450px) {
      .social-div {
        justify-content: center;
        display: flex;
      }

      .dropdown-content {
        z-index: 999;
        top: 55px;
        left: 125px;
        width: 165px;
      }
    }

    /* .visiblity-resopnsive{
      display:none;
    } */
    @media only screen and (max-width: 996px) {
      .nav--sticky.sticky {
        top: 0px !important;
      }
      .logo-mob-front{
      width: 80px;
      display:block;
    }
    .logo-mob-front img{
      width:100%;
    }
    }




    .top-menu li.active a{
      color:#ef4029;
    }


  </style>

<style>
              .nav__dropdown>a:after {
                content: '' !important;
              }

              .drop-icon>a:after {
                content: '\f123' !important;
                font-family: 'ui-icons';
                margin-left: 7px;
                font-size: 10px;
                line-height: 1;
              }

              .nav--sticky.sticky {
                box-shadow: 0 0 0 rgba(0, 0, 0, 0.1) !important;
            }
            .nav__holder {
              box-shadow: 0 0 0 rgba(0, 0, 0, 0.1) !important;
            }

            .tm{
              color:#ef4029;
            }


            </style>
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
  <!-- <script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script> -->

</head>

<body class="bg-light style-default style-rounded" onselectstart = 'return false' oncopy = 'return false' oncut = 'return false'>
  @php
  $lang = Session::get('lang');
  $main_category_name = 'main_category_name_'.Session::get('lang');
  $category_name = 'category_name_'.Session::get('lang');
  $sub_category_name = 'sub_category_name_'.Session::get('lang');
  $pdf_page_name = 'page_name_'.Session::get('lang');
  $top_header_menu_page_name = 'main_category_name_'.Session::get('lang');

  @endphp

  @auth
  @php
  $user_type = Auth::user()->user_type;
  @endphp
  @endauth
  <!-- Preloader -->
  <div class="loader-mask">
    <div class="loader">
      <div></div>
    </div>
  </div>

  <!-- Bg Overlay -->
  <div class="content-overlay"></div>

  <!-- Sidenav -->
  <header class="sidenav" id="sidenav">
    <div class="logo-img-sidenav " style="width:230px;">
      <a href="/" class="logo-sidenav">
        <img class="logo__img-sidenav img-fluid" src="{{url('public/build/assets/frontend/img/logo.png')}}"
          alt="Bhartiya Parmapara">
      </a>
    </div>
    <!-- <p align="center">
      <font color="#CC3300">{{$lang == 'en'?'Bhartiya Parampara':'भारतीय परम्परा'}}</font>
    </p> -->
    <!-- close -->
    <div class="sidenav__close">
      <button class="sidenav__close-button" id="sidenav__close-button" aria-label="close sidenav">
        <i class="ui-close sidenav__close-icon"></i>
      </button>
    </div>

    <!-- Nav -->
    <nav class="sidenav__menu-container">
      <ul class="sidenav__menu" role="menubar">
        <li class="{{Route::currentRouteName() == 'frontend.home.index'?'active':''}}"><a href="/" class="sidenav__menu-url">{{$lang == 'en'?'Home':'होम'}}</a></li>
        @foreach($main_categories as $m_category)
        <li class="{{$m_category->slug}}" onclick="activeFrontMenu('{{$m_category->slug}}')">
          <a href="
          @if($m_category->page_type == '0' || $m_category->page_type == '1' || $m_category->page_type == '3' || $m_category->page_type == '4')
                 {{route('frontend.post_list', [$m_category->slug])}}
                 @else
                  {{route('frontend.view.page', [$m_category->slug])}}
                  @endif " class="sidenav__menu-url">{{$m_category->$main_category_name}}
          </a>
          @if(!$m_category->getCategories->isEmpty())
          <i class="fas fa-chevron-down" onclick="toggleDropdown('dropdownContent_{{$m_category->id}}')"></i>
          @endif
          <ul class="sidenav__menu-dropdown" id="dropdownContent_{{$m_category->id}}">
            @foreach($m_category->getCategories as $category)
            <li><a href="{{route('frontend.post_list', [$m_category->slug, $category->slug])}}"><b>{{$category->$category_name}}</b>
              </a>
              @if(!$category->subCategories->isEmpty())
              <i class="fas fa-chevron-down mx-2"
                onclick="toggleDropdown('inner_dropdownContent_{{$category->id}}')"></i>
              @endif


              @if($m_category->page_type == '1')
              <ul class="sidenav__menu-dropdown" id="inner_dropdownContent_{{$category->id}}">
                @foreach($category->subCategories as $sub_category)
                <li><a
                    href="{{route('frontend.post_list', [$m_category->slug, $category->slug, $sub_category->slug])}}">{{$sub_category->$sub_category_name}}</a>
                </li>
                @endforeach
              </ul>
              @endif

            </li>
            @endforeach
          </ul>

        </li>
        @endforeach

      </ul>
      <hr>
      <ul class="top-menu-sidenav sidenav__menu">
        @foreach($pdf_page_list as $index => $pdf_page)
        <li class="">
        @if($index == 0)
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                @elseif($index == 1)
                <i class="fas fa-boxes"></i>
                @endif
          <a href="{{route('frontend.pdf_page.index', [$pdf_page->slug])}}" target="_blank"
            class="sidenav__menu-url">{{$pdf_page->$pdf_page_name}}</a>
        </li>
        @endforeach

        @php
        $top_menu = App\Models\backend\MainCategory::where('main_category_status', 1)->where('page_type',
        3)->get();
        @endphp
        @foreach($top_menu as $index => $menu)
        <li>
        @if($index == 0)
              <i class="fa-solid fa-bowl-food"></i>
                @elseif($index == 1)
              <i class="fas fa-book" aria-hidden="true"></i>
              @endif
        <a href="{{route('frontend.post_list', [$menu->slug])}}" target="_blank"
            class="sidenav__menu-url">{{$menu->$top_header_menu_page_name}}</a>
        </li>
        @endforeach

        <li><i class="fa fa-question-circle" aria-hidden="true"></i><a href="{{route('frontend.question.index')}}"
            target="_blank" class="sidenav__menu-url">{{$lang == 'en'?'Ques-Ans':'सवाल-जवाब'}}</a></li>
            <li><i class="fa fa-pen" aria-hidden="true"></i><a href="{{route('frontend.writers_corner_list')}}"
            target="_blank" class="sidenav__menu-url">{{$lang == 'en'?'Writer\'s Corner':'लेखक की क़लम से'}}</a></li>
        <!--
              <li><i class="fa fa-comments-o" aria-hidden="true"></i><a
                  href="{{route('writer.register.view', ['redirect' => url()->current()])}}"
                  class="sidenav__menu-url">{{$lang == 'hi'?'रजिस्टर':'Register'}}</a></li> -->
<!--
        @foreach($main_categories as $indexx => $m_category)
        @foreach($m_category->getCategories as $index => $category)
        @if($indexx == 7 && $index == 2)
        <li><i class="fa-solid fa-bowl-food"></i><a
            href="{{route('frontend.post_list', [$m_category->slug, $category->slug])}}"
            class="sidenav__menu-url">{{$lang == 'en'?'Traditional Dishes':'पारंपरिक व्यंजन'}}</a>
        </li>
        @endif
        @endforeach
        @endforeach -->




      </ul>
    </nav>

    <div class="socials sidenav__socials">
      @if($social_media->facebook_status == 1)
      <a class="social-sidenav social-facebook" href="{{$social_media->facebook}}" target="_blank"
        aria-label="facebook">
        <i class="ui-facebook"></i>
      </a>
      @endif

      @if($social_media->x_status == 1)
      <a class="social-sidenav social-twitter" href="{{$social_media->x}}" target="_blank" aria-label="twitter">
        <i class="fa-brands fa-x-twitter"></i>
      </a>
      @endif

      @if($social_media->linkedin_status == 1)
      <a class="social-sidenav social-linkedin" href="{{$social_media->linkedin}}" target="_blank"
        aria-label="linkedin">
        <i class="ui-linkedin"></i>
      </a>
      @endif


      @if($social_media->instagram_status == 1)
      <a class="social-sidenav social-instagram" href="{{$social_media->instagram}}" target="_blank"
        aria-label="instagram">
        <i class="ui-instagram"></i>
      </a>
      @endif

      @if($social_media->youtube_status == 1)
      <a class="social-sidenav social-youtube" href="{{$social_media->youtube}}" target="_blank" aria-label="youtube">
        <i class="ui-youtube"></i>
      </a>
      @endif

      @if($social_media->thread_status == 1)
      <a class=" social-sidenav social-threads" href="{{$social_media->thread}}" target="_blank" aria-label="thread">
        <i class="fa-brands fa-threads"></i>
      </a>
      @endif

      @if($social_media->whatsapp_status == 1)
      <a class="social-sidenav social-whatsapp " href="{{$social_media->whatsapp}}" target="_blank"
        aria-label="whatsapp">
        <i class="ui-whatsapp"></i>
      </a>
      @endif

      @if($social_media->telegram_status == 1)
      <a class="social-sidenav social-telegram " href="{{$social_media->telegram}}" target="_blank"
        aria-label="telegram">
        <i class="fab fa-telegram"></i>
      </a>
      @endif
    </div>
  </header> <!-- end sidenav -->

  <main class="main oh" id="main">

    <!-- Top Bar -->
    <div class="top-bar  ">
      <div class="container">
        <div class="row" id="main-respon">
          <div class="col-md-4 visiblity-resopnsive"></div>
          <!-- Socials -->
          <div class="col-md-5 "id="mobile-ries">
            <div class="socials nav__socials socials--nobase socials--white justify-content-end social-top-header">
              <button class="top-header-btn mx-3 px-3" data-toggle="modal"
                data-target="#subscribeModal">Subscribe</button>
              <li><a href="{{route('frontend.home.set_lang')}}">Language - <span style="color:#FF0000">
                    {{Session::get('lang') == 'en' ? 'Hin':'Eng'}}</span></a>|</li>


              @guest
              <li><a href="{{route('user.login.view')}}" class="sidenav__menu-url"><i
                    class="fa fa-user mx-2" aria-hidden="true"></i>{{$lang == 'hi'?'लॉगिन':'Login'}}</a>|</li>

              @else
              <li class="dropdown-trigger">
                <a href="#" class="sidenav__menu-url">
                  <i class="fa fa-user mx-2" aria-hidden="true"></i> {{Auth::user()->name}}<i
                    class="fa fa-caret-down mx-2" aria-hidden="true"></i>
                </a>
                <div class="dropdown-content">
                  @if($user_type != 3)
                  <a href="{{route('user.login.view')}}" target="_blank"><i class="fa fa-tachometer mx-2"
                      aria-hidden="true"></i>Dashboard</a>
                  @endif

                  <a href="
                  @if($user_type==1)
                  {{route('admin.account.status')}}
                  @elseif($user_type==2)
                  {{route('writer.account.status')}}
                 @else
                 {{route('user.account.status')}}
                 @endif " target="_blank"><i class="fa fa-user mx-2" aria-hidden="true"></i>My Profile</a>
                  <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary m-0 w-100"><i class="fa fa-sign-out mx-2"
                        aria-hidden="true"></i> Logout</button>
                  </form>
                </div>
              </li>
              @endguest


            </div>
          </div>
          <div class="col-md-3 social-div">
            @if($social_media->whatsapp_status == 1)
            <a class="social" href="{{$social_media->whatsapp}}" target="_blank" aria-label="whatsapp">
              <i class="ui-whatsapp"></i>
            </a>
            @endif

            @if($social_media->telegram_status == 1)
            <a class="social" href="{{$social_media->telegram}}" target="_blank" aria-label="telegram">
              <i class="fab fa-telegram"></i>
            </a>
            @endif

            @if($social_media->youtube_status == 1)
            <a class="social" href="{{$social_media->youtube}}" target="_blank" aria-label="youtube">
              <i class="ui-youtube"></i>
            </a>
            @endif

            @if($social_media->linkedin_status == 1)
            <a class="social" href="{{$social_media->linkedin}}" target="_blank" aria-label="linkedin">
              <i class="ui-linkedin"></i>
            </a>
            @endif

            @if($social_media->x_status == 1)
            <a class="social" href="{{$social_media->x}}" target="_blank" aria-label="x">
              <i class="fa-brands fa-x-twitter"></i></i>
            </a>
            @endif

            @if($social_media->facebook_status == 1)
            <a class="social" href="{{$social_media->facebook}}" target="_blank" aria-label="facebook">
              <i class="ui-facebook"></i>
            </a>
            @endif

            @if($social_media->instagram_status == 1)
            <a class="social" href="{{$social_media->instagram}}" target="_blank" aria-label="instagram">
              <i class="ui-instagram"></i>
            </a>
            @endif

            @if($social_media->thread_status == 1)
            <a class="social" href="{{$social_media->thread}}" target="_blank" aria-label="thread">
              <i class="fa-brands fa-threads"></i>
            </a>
            @endif
          </div>

        </div>
      </div>
    </div> <!-- end top bar -->

    <!-- Subscribe Modal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="subscribeModalLabel">Subscribe Us</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{route('frontend.subscribe_newsletter')}}">
              @csrf
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
              <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- Navigation -->
    <header class="header d-lg-block d-none " id="header-top-set">
      <div class="container head_width">
        <div class=" row">

          <!-- Logo -->
          <div class="col-md-3 d-flex">
            <div class="logo-img">
              <a href="/" class="logo">
                <img class="logo__img img-fluid" src="{{url('public/build/assets/frontend/img/logo.png')}}"
                  alt="Bhartiya Parmapara">
              </a>

            </div>
          </div>
          <!-- Menu -->
          <!-- Top menu -->
          <div class="col-md-9 d-flex justify-content-end align-items-center">
            <ul class="top-menu" >
              @foreach($pdf_page_list as $index => $pdf_page)
              <li class="{{Str::slug($pdf_page->slug)}}" onclick="activeFrontMenu('{{$pdf_page->slug}}')">
                @if($index == 0)
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                @elseif($index == 1)
                <i class="fas fa-boxes"></i>
                @endif
                <a href="{{route('frontend.pdf_page.index', [$pdf_page->slug])}}" target="_blank"
                  class="sidenav__menu-url">{{$pdf_page->$pdf_page_name}}</a>
              </li>
              @endforeach

              @php
              $top_menu = App\Models\backend\MainCategory::where('main_category_status', 1)->where('page_type',
              3)->get();
              @endphp
              @foreach($top_menu as $index => $menu)
              <li class="{{$menu->slug}}" onclick="activeFrontMenu('{{$menu->slug}}')">
              @if($index == 0)
              <i class="fa-solid fa-bowl-food"></i>
                @elseif($index == 1)
              <i class="fas fa-book" aria-hidden="true"></i>
              @endif

              <a href="{{route('frontend.post_list', [$menu->slug])}}" target="_blank"
                  class="sidenav__menu-url">{{$menu->$top_header_menu_page_name}}</a>
              </li>
              @endforeach

              <li class="{{route('frontend.question.index')}}" onclick="activeFrontMenu('{{route('frontend.question.index')}}')">
                <i class="fa fa-question-circle" aria-hidden="true"></i><a href="{{route('frontend.question.index')}}"
                  target="_blank" class="sidenav__menu-url">{{$lang == 'en'?'Did You Know?':'क्या आप जानते है?'}}</a></li>

              <li class="{{route('frontend.writers_corner_list')}}" onclick="activeFrontMenu('{{route('frontend.writers_corner_list')}}')">
                <i class="fa fa-pen" aria-hidden="true"></i><a href="{{route('frontend.writers_corner_list')}}"
                  target="_blank" class="sidenav__menu-url">{{$lang == 'en'?'Our Writer':'हमारे लेखक'}}</a></li>
              <!--
              <li><i class="fa fa-comments-o" aria-hidden="true"></i><a
                  href="{{route('writer.register.view', ['redirect' => url()->current()])}}"
                  class="sidenav__menu-url">{{$lang == 'hi'?'रजिस्टर':'Register'}}</a></li> -->

              <!-- @foreach($main_categories as $indexx => $m_category)
              @foreach($m_category->getCategories as $index => $category)
              @if($indexx == 7 && $index == 2)
              <li><i class="fa-solid fa-bowl-food"></i><a
                  href="{{route('frontend.post_list', [$m_category->slug, $category->slug])}}"
                  class="sidenav__menu-url">{{$lang == 'en'?'Traditional Dishes':'पारंपरिक व्यंजन'}}</a>
              </li>
              @endif
              @endforeach
              @endforeach -->

            </ul>
          </div>
          <!-- <div class="flex-child text-center" style="margin-left:250px;">
            Ad Banner 728
            <div class="text-center">
              <iframe src="" width="728" height="90" style="border:none;"></iframe>
            </div>
          </div> -->
        </div>
      </div> <!-- end container -->
    </header>
    <header class="nav">
      <div class="nav__holder nav--sticky">
        <div class="container relative head_width">
          <div class="flex-parent">

            <!-- Side Menu Button -->
            <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open side menu">
              <span class="nav-icon-toggle__box">
                <span class="nav-icon-toggle__inner"></span>
              </span>
            </button>
            <a href="/" class="logo-mob-front">
              <img class="logo__img-sidenav img-fluid" src="{{url('public/build/assets/frontend/img/logo.png')}}"
                alt="Bhartiya Parmapara">
            </a>
            <!-- Nav-wrap -->
            <nav class="flex-child nav__wrap d-none d-lg-block navbar-links">
              <ul class="nav__menu">

                <li class="{{Route::currentRouteName() == 'frontend.home.index'?'active':''}}"><a href="/">{{Session::get('lang') == 'en' ? 'Home':'होम'}}</a></li>

                @foreach($main_categories as $m_category)
                <li class="nav__dropdown {{!$m_category->getCategories->isEmpty() ? 'drop-icon':''}} {{$m_category->slug}}"  onclick="activeFrontMenu('{{$m_category->slug}}')">
                  <a href="
                 @if($m_category->page_type == '0' || $m_category->page_type == '1' || $m_category->page_type == '3' || $m_category->page_type == '4')
                 {{route('frontend.post_list', [$m_category->slug])}}
                 @else
                  {{route('frontend.view.page', [$m_category->slug])}}
                  @endif
                 ">{{$m_category->$main_category_name}}</a>

                  @if(!$m_category->getCategories->isEmpty())
                  <ul class="nav__dropdown-menu {{$m_category->page_type == '1' ? 'nav__megamenu':''}}">
                    @if($m_category->page_type == '1')
                    <li>
                      <div class="nav__megamenu-wrap">
                        <div class="row">
                          @foreach($m_category->getCategories as $category)
                          <div class="col nav__megamenu-item">
                            <article class="entry">
                              <div class="entry__img-holder chng">
                                <a
                                  href="{{route('frontend.post_list', [$m_category->slug, $category->slug])}}">{{$category->$category_name}}</a>
                              </div>

                              <div class="entry__body">
                                <h2 class="entry__title light">
                                  <a
                                    href=" {{route('frontend.post_list', [$m_category->slug, $category->slug])}}">
                                    @foreach($category->subCategories as $sub_category)
                    <li class="linee">
                      <a href="{{route('frontend.post_list', [$m_category->slug, $category->slug, $sub_category->slug])}}" class="set">{{$sub_category->$sub_category_name}}</a>
                    </li>
                    @endforeach
                    </a>
                    </h2>
          </div>
          </article>
        </div>
        @endforeach
      </div>
      </div>
      </li>

      @else
      @foreach($m_category->getCategories as $category)
      <li class="nav__dropdown {{!$category->subCategories->isEmpty() ? 'drop-icon':''}}"><a
          href="{{route('frontend.post_list', [$m_category->slug, $category->slug])}}">{{$category->$category_name}}</a>
        @if(!$category->subCategories->isEmpty())
        <ul class="nav__dropdown-menu">
          @foreach($category->subCategories as $sub_category)
          <li><a
              href="{{route('frontend.post_list', [$m_category->slug, $category->slug, $sub_category->slug])}}">{{$sub_category->sub_category_name_en}}</a>
          </li>
          @endforeach
        </ul>
        @endif
      </li>
      @endforeach

      @endif


      </ul>
      @endif
      </li>
      @endforeach
      </ul>
      </nav>

      <!-- Nav Right -->
      <div class="nav__right">

        <!-- Search -->
        <div class="nav__right-item nav__search">
          <a href="#" class="nav__search-trigger" id="nav__search-trigger">
            <i class="ui-search nav__search-trigger-icon"></i>
          </a>
          <div class="nav__search-box" id="nav__search-box">
            <input type="text" id="search-input" name="main_search" placeholder="Search...">
            <div id="search_ancher"></div>
          </div>
        </div>


      </div> <!-- end nav right -->

      </div> <!-- end flex-parent -->
      </div> <!-- end container -->

      </div>
    </header>





