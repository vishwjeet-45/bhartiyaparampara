{{--<x-guest-layout>
  <div class="mb-4 text-sm text-gray-600">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset
    link that will allow you to choose a new one.') }}
  </div>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />
  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autofocus />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div class="flex items-center justify-end mt-4">
      <x-primary-button>
        {{ __('Email Password Reset Link') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
--}}


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from admin.pixelstrap.com/wingo/theme/sign-up-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 05:13:39 GMT -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bhartiya Parampara: Country of Festivals, Identity of Culture and Tradition</title>
  <meta name="description" content="Explore the rich tapestry of Indian culture with Bhartiya Parampara, offering comprehensive information on traditions,
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
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
    rel="stylesheet">
  <!-- Font Awesome-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/vendors/font-awesome.css')}}">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/vendors/icofont.css')}}">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/vendors/themify.css')}}">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/vendors/flag-icon.css')}}">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/vendors/feather-icon.css')}}">
  <!-- Plugins css start-->
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/vendors/bootstrap.css')}}">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/style.css')}}">
  <link id="color" rel="stylesheet" href="{{url('public/build/assets/auth/css/color-1.css')}}" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{url('public/build/assets/auth/css/responsive.css')}}">

  <style>
     .back-image {
      background-image: url('public/build/assets/auth/images/login-new.jpg');
      background-repeat: no-repeat;
     background-size: cover; 
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
  <!-- page-wrapper Start-->
  <section class="back-image">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <div class="login-card">
            <form class="theme-form login-form" action="{{ route('password.email') }}" method="POST"
              style="width:430px !important">
              @csrf

              <div class="login-header text-center">
                <h4 class="m-b-10" style="font-size:25px;">Forgot Password</h4>
                <h6>Enter your email </h6>
              </div>
              <div class="form-group">
              </div>
              <!-- <div class="login-social-title">                
                              <h5>Sign up with Email</h5>
                            </div> -->
              <hr>

              <div class="row ">
                <div class="mb-4 text-sm text-gray-600" style="font-size:13px;">
                  {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a
                  password
                  reset link that will allow you to choose a new one.') }}
                </div>
                <div class="form-group col-md-12">
                  <x-auth-session-status class="mb-4" :status="session('status')" />
                  <label style="font-size:12px;"> Your Email<span class="mx-1" style="color: red;">*</span></label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input class="form-control" type="email" name="email" placeholder="Enter your email"
                      value="{{old('email')}}">
                  </div>
                  @error('email')
                  <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                  @enderror
                </div>


                <!-- <div class="form-group col-md-12">
                              <label>Password</label>
                              <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" id="password" placeholder="*********">
                              </div>
                              @error('password')
                              <span class="error" style="color:red;">{{$message}}</span>
                         @enderror
                            </div> -->
                <div class="form-group col-md-12">
                  <div class="form-group col-md-12">
                    <div class="checkbox">
                      <p style="font-size:12px;">I dont have an account?<a class="ms-2"
                          href="{{route('writer.register.view', ['redirect' => session('redirect_after_login', '/')])}}">Sign
                          up</a></p>
                    </div>
                  </div>
                </div>
                <div class=""></div>
                <div class="form-group col-md-12">
                  <button class="btn btn-primary btn-block" type="submit">Send Link</button>
                </div>
            </form>
          </div>
        </div>
      </div>
  </section>
  <!-- page-wrapper end   -->
  <!-- latest jquery-->
  <script src="{{url('public/build/assets/auth/js/jquery-3.5.1.min.js')}}"></script>
  <!-- feather icon js-->
  <script src="{{url('public/build/assets/auth/js/icons/feather-icon/feather.min.js')}}"></script>
  <script src="{{url('public/build/assets/auth/js/icons/feather-icon/feather-icon.js')}}"></script>
  <!-- Sidebar jquery-->
  <script src="{{url('public/build/assets/auth/js/sidebar-menu.js')}}"></script>
  <script src="{{url('public/build/assets/auth/js/config.js')}}">   </script>
  <!-- Bootstrap js-->
  <script src="{{url('public/build/assets/auth/js/bootstrap/popper.min.js')}}"></script>
  <script src="{{url('public/build/assets/auth/js/bootstrap/bootstrap.min.js')}}"></script>
  <!-- Plugins JS start-->
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="{{url('public/build/assets/auth/js/script.js')}}"></script>
  <script src="{{url('public/build/assets/auth/js/custom-javascript.js')}}"></script>
  <!-- login js-->
  <!-- Plugin used-->

</body>

<!-- Mirrored from admin.pixelstrap.com/wingo/theme/sign-up-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 05:13:39 GMT -->

</html>