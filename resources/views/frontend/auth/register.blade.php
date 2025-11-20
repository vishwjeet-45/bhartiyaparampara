@php

@endphp
<!DOCTYPE html>
<html lang="en">


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bhartiya Parampara: Country of Festivals, Identity of Culture and Tradition</title>
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
      background-image: url('../public/build/assets/auth/images/login-new.jpg');
      background-repeat: no-repeat;
     background-size: cover; 
    }
   @media only screen and (max-width: 1025px) {
    .back-image{ 
      background: beige; 
    } 
    .login-left{
      display:none;
    }
    .login-right{
      width:100% !important;
    }
   }
  </style>

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
    <div class="container-fluid ">
      <div class="row">
        <div class="login-left" style="width: 50%;"></div>
        <div class="login-right" style="width: 50%;">
          <div class="login-card">
            <form class="theme-form login-form" action="{{route('writer.store.user')}}" method="POST">
              @csrf
              <div class="login-header text-center">
                <h4 class="m-b-10" style="font-size: 25px; font-weight: bold;">Create your account</h4>

                <h6 style="font-size: 13px;">Enter your personal details to create account</h6>
              </div>
              <div class="login-social-title">
                <h5>Sign up with Email</h5>
              </div>
              <div class="form-group">
                <label style="font-size:12px;">Your Name<span class="mx-1" style="color: red;">*</span></label>
                <div class="small-group">
                  <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                    <input class="form-control" type="text" name="username" placeholder="Enter your name"
                      value="{{old('username')}}">
                  </div>
                </div>
                @error('username')
                <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                @enderror
              </div>
              <div class="row ">
                <div class="form-group col-md-6">
                  <label style="font-size:12px;"> Your Email<span class="mx-1" style="color: red;">*</span></label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input class="form-control" type="email" name="email" placeholder="Enter your email"
                      value="{{old('email')}}">
                  </div>
                  @error('email')
                  <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label style="font-size:12px;"> Your Contact<span class="mx-1" style="color: red;">*</span></label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-book"
                        style="color:red"></i></span>
                    <input class="form-control" type="number" id="phone_number" name="phone_number"
                      placeholder="Enter your phone number" value="{{ old('phone_number') }}" min="10"
                      pattern="\d{10}">
                  </div>
                  @error('phone_number')
                  <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-group col-md-6">
                  <label style="font-size:12px;"> Your City<span class="mx-1" style="color: red;">*</span></label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-home"
                        style="color:red"></i></span>
                    <input class="form-control" type="text" name="city" placeholder="Enter your city"
                      value="{{old('city')}}">
                  </div>
                  @error('city')
                  <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label for="gender" style="font-size:12px;">Your Gender<span class="mx-1"
                      style="color: red;">*</span></label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="">Select Gender</option>
                    <option value="Male" {{(old('gender')=="Male" ?"selected":"")}}>Male</option>
                    <option value="Female" {{(old('gender')=="Female" ?"selected":"")}}>Female</option>
                    <option value="Other" {{(old('gender')=="Other" ?"selected":"")}}>Other</option>
                  </select>
                  @error('gender')
                  <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label style="font-size:12px;">Password<span class="mx-1" style="color: red;">*</span></label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" name="password" id="password"
                      placeholder="Enter password">
                  </div>
                  @error('password')
                  <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                  @enderror
                </div>


                <div class="form-group col-md-6">
                  <label style="font-size:12px;">Confirm Password<span class="mx-1" style="color: red;">*</span></label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" name="confirm_password" type="password" name="confirm_password"
                      id="confirm_password" placeholder="Confirm password">
                    <span class="show-hide" id="show_hide_password"><i class="icon-eye"></i></span>
                  </div>
                  @error('confirm_password')
                  <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-group col-md-12">
                  <label style="font-size:12px;">Please check user type checkbox<span class="mx-1"
                      style="color: red;">*</span></label>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <div class="radio radio-danger">
                        <input id="user_type_user" type="radio" name="user_type" value="3">
                        <label for="user_type_user" style="font-size:12px;">I am a user</label>
                      </div>
                      @error('user_type')
                      <span class="error" style="color:red;font-size: 12px;">{{$message}}</span>
                      @enderror
                    </div>

                    <div class="form-group col-md-6">
                      <div class="radio radio-danger">
                        <input id="user_type_writer" type="radio" name="user_type" value="2">
                        <label for="user_type_writer" style="font-size:12px;">I am a writer</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="tacxbox" style="font-size:12px;">
                    <input id="checkebox" type="checkbox" name="term_and_condition" />
                    <label for="checkbox"> I acknowledge and agree to the <a href="pages/terms-and-condition" target="_blank">Terms and
                        Conditions</a></label>
                  </div>
                  @error('term_and_condition')
                  <span class="error" style="color:red;font-size: 12px;">Please check this box if you want to
                    proceed.</span>
                  @enderror
                </div>

                <div class="row ">
                <div class="form-group col-md-6">
                  <label style="font-size:12px;"> Captcha:<span class="mx-1" style="color: red;">*</span></label>
                  <div class="captcha d-flex">
                    <span>{!! captcha_img('flat') !!} </span>
                      <button type="button" class="btn btn-danger m-0 " class="reload" id="reload">
                          &#x21bb;
                      </button> 
              </div>
                 
                </div>
                <div class="form-group col-md-6"> 
                <label style="font-size:12px;"> Enter Captcha:<span class="mx-1" style="color: red;">*</span></label>
                  <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                @error('captcha')
            @if($message == 'validation.captcha') 
            <p style="color:red;">Invalid Captcha</p>
            @else
                <p style="color:red;">{{$message}}</p>
                @endif
                @enderror
                 
                </div>



                <div class="form-group col-md-6">
                  <div class="checkbox">
                    <p style="font-size:12px;">Already have an account?<a class="ms-2"
                        href="{{route('user.login.view', ['redirect' => session('redirect_after_login', '/')])}}">Sign
                        in</a></p>
                  </div>
                </div>


                <div class="form-group col-md-6">
                  <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                </div>
            </form>
          </div>
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
  <script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: "{{route('reload_captcha')}}",
            success: function (data) {
              console.log(data);
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
</body>


</html>