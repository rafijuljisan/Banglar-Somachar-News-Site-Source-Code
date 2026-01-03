<!doctype html>
<html lang="en" dir="ltr">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="author" content="EliteDesign">
    <!-- Title -->

		<title>Login Admin Panel | {{ $gs->title }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}" type="image/x-icon">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/fonts/flaticon/font/flaticon.css')}}">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/css/style.css')}}">
	    <!-- Bootstrap -->
    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.css')}}">
    <!-- icofont -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/icofont.min.css')}}">
    <!-- Sidemenu Css -->
    <link href="{{asset('assets/admin/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/admin/css/plugin.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" />   
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-coloroicker.css') }}">
    <!-- Main Css -->
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet" />
@yield('styles')
</head>
<body id="top">
<div class="page_loader"></div>

<!-- Login 7 start -->
<div class="login-7">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-section">
                    <div class="logo">
                        <a href="login-7.html">
                            <img src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="logo">
                        </a>
                    </div>
                    <h3>আপনাকে {{ $gs->title }} এর এডমিন প্যানেলে স্বাগতম!</h3>
                    <div class="login-inner-form">
					 @include('includes.admin.form-login')
              <form id="loginform" action="{{ route('admin.login') }}" method="POST">
                  {{ csrf_field() }}
                            <div class="form-group clearfix">
                                <div class="form-box">
                                    <input name="email" type="email" class="form-control" id="first_field" placeholder="{{ __('Type Email Address') }}" aria-label="Email Address">
                                    <i class="flaticon-mail-2"></i>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="form-box">
                                    <input name="password" type="password" class="form-control" autocomplete="off" id="second_field" placeholder="{{ __('Type Password') }}" aria-label="Password">
                                    <i class="flaticon-password"></i>
                                </div>
                            </div>
                            <div class="checkbox form-group clearfix">
                                <div class="form-check float-start">
                                   <input type="checkbox" name="remember"  id="rp" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rp">
                                        {{ __('Remember Password') }}
                                    </label>
                                </div>
                                <a href="{{route('admin.forgot')}}" class="link-light float-end forgot-password">{{ __('Forgot Password?') }}?</a>
                            </div>
                            <div class="form-group clearfix">
							<input id="authdata" type="hidden"  value="{{ __('Authenticating...') }}">
                                <button class="btn btn-primary btn-lg btn-theme">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 7 end -->

    <!-- Dashboard Core -->
    <script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
    <!-- Fullside-menu Js-->
    <script src="{{asset('assets/admin/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/fullside-menu/waves.min.js')}}"></script>

    <script src="{{asset('assets/admin/js/plugin.js')}}"></script>
    <script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
    <script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{asset('assets/admin/js/load.js')}}"></script>
    <!-- Custom Js-->
    <script src="{{asset('assets/admin/js/custom.js')}}"></script>
    <!-- AJAX Js-->
    <script src="{{asset('assets/admin/js/myscript.js')}}"></script>

<!-- External JS libraries -->
<script src="{{asset('assets/frontend/login/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/frontend/login/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/login/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/frontend/login/assets/js/app.js')}}"></script>
<!-- Custom JS Script -->
</body>

</html>
