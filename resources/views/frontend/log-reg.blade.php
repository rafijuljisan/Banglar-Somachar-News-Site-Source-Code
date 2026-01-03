<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/fonts/flaticon/font/flaticon.css')}}">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/login/assets/css/style.css')}}">

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
                        <a href="{{route('frontend.index')}}">
                            <img src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="logo">
                        </a>
                    </div>
                    <h3>Sign Into Your Account</h3>
                    <div class="login-inner-form">
                        <form class="mloginform" action="{{ route('front.login') }}" method="POST">
						  @include('includes.validation.form_validation')
                          @csrf
                            <div class="form-group clearfix">
                                <div class="form-box">
                                    <input name="email" type="email" class="form-control" id="first_field" placeholder="{{__('Type Email Address')}}" aria-label="Email Address">
                                    <i class="flaticon-mail-2"></i>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="form-box">
                                    <input name="password" type="password" class="form-control" autocomplete="off" id="second_field" placeholder="{{__('Type Password')}}" aria-label="Password">
                                    <i class="flaticon-password"></i>
                                </div>
                            </div>
                            <div class="checkbox form-group clearfix">
                                <div class="form-check float-start">
                                    <input class="form-check-input" type="checkbox" id="remember" id="mrp">
                                    <label class="form-check-label" for="mrp">
                                       {{__('Remember Password')}}
                                    </label>
                                </div>
                                <a href="" class="link-light float-end forgot-password">Forgot your password?</a>
                            </div>
                            <div class="form-group clearfix">
							     {{-- <input type="hidden" name="modal" value="1"> --}}
                                    <input class="mauthdata" type="hidden" value="Authenticating...">
                                <button type="submit" class="btn btn-primary btn-lg btn-theme">{{__('Login')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 7 end -->

<!-- External JS libraries -->
<script src="{{asset('assets/frontend/login/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/frontend/login/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/login/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/frontend/login/assets/js/app.js')}}"></script>
<script src="{{asset('assets/front/js/login.js')}}"></script>
<!-- Custom JS Script -->
</body>

</html>
