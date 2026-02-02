<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="EliteDesign">
    <title>Login Admin Panel | {{ $gs->title }}</title>

    <link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700;900&display=swap" rel="stylesheet">

    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/icofont.min.css')}}">

    <style>
        /* ========================================
        NEWSPAPER THEME LOGIN STYLES 
        ========================================
        */
        :root {
            --news-black: #1a1a1a;
            --news-paper: #f4f1ea; /* Warm off-white paper color */
            --news-white: #ffffff;
            --news-gray: #666666;
            --news-accent: #2c2c2c;
            --news-border: #dcdcdc;
            --font-headline: 'Playfair Display', serif;
            --font-body: 'Inter', sans-serif;
        }

        body#top {
            background-color: var(--news-paper);
            font-family: var(--font-body);
            color: var(--news-black);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: radial-gradient(#e0ddd5 1px, transparent 1px);
            background-size: 20px 20px; /* Subtle texture */
        }

        /* Wrapper to isolate new design */
        .news-login-wrapper {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .news-card {
            background: var(--news-white);
            border: 1px solid var(--news-black);
            box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.8); /* Brutalist/Retro shadow */
            padding: 40px;
            position: relative;
        }

        /* The "Masthead" - Newspaper Header Style */
        .news-masthead {
            text-align: center;
            border-bottom: 3px double var(--news-black);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .news-masthead .logo-container img {
            max-width: 180px;
            height: auto;
            margin-bottom: 15px;
            filter: grayscale(100%); /* Optional: makes logo fit newspaper vibe */
            transition: filter 0.3s;
        }
        
        .news-masthead .logo-container img:hover {
            filter: grayscale(0%);
        }

        .news-headline {
            font-family: var(--font-headline);
            font-weight: 700;
            font-size: 28px;
            line-height: 1.2;
            margin: 10px 0 5px 0;
            color: var(--news-black);
        }

        .news-subhead {
            font-family: var(--font-headline);
            font-style: italic;
            font-size: 16px;
            color: var(--news-gray);
            position: relative;
            display: inline-block;
        }

        /* Form Styling */
        .news-form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .news-label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--news-black);
        }

        .news-input {
            width: 100%;
            padding: 12px 0;
            font-family: var(--font-body);
            font-size: 16px;
            color: var(--news-black);
            background: transparent;
            border: none;
            border-bottom: 2px solid var(--news-border);
            border-radius: 0;
            transition: border-color 0.3s;
        }

        .news-input:focus {
            outline: none;
            border-bottom-color: var(--news-black);
        }

        .news-input::placeholder {
            color: #aaa;
            font-style: italic;
        }

        /* Checkbox & Link Row */
        .news-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .news-check-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: var(--news-gray);
        }

        .news-check-input {
            margin-right: 8px;
            width: 16px;
            height: 16px;
            accent-color: var(--news-black);
            cursor: pointer;
        }

        .news-forgot-link {
            color: var(--news-black);
            text-decoration: none;
            font-weight: 600;
            position: relative;
        }

        .news-forgot-link::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--news-black);
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }

        .news-forgot-link:hover::after {
            visibility: visible;
            transform: scaleX(1);
        }

        /* Submit Button */
        .news-btn-submit {
            width: 100%;
            padding: 15px;
            background-color: var(--news-black);
            color: var(--news-white);
            border: none;
            font-family: var(--font-headline);
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .news-btn-submit:hover {
            background-color: #333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Decorative "Edition" Line */
        .news-edition-line {
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid var(--news-border);
            padding-top: 15px;
            font-size: 12px;
            color: var(--news-gray);
            font-family: var(--font-body);
        }

        /* Alert styling for the include */
        .alert {
            border-radius: 0;
            font-family: var(--font-body);
            border: 1px solid var(--news-black);
        }
        .alert-danger {
            background-color: #ffe6e6;
            color: #990000;
        }
        .alert-success {
            background-color: #e6ffe6;
            color: #006600;
        }

    </style>
</head>

<body id="top">

    <div class="news-login-wrapper">
        <div class="news-card">
            
            <div class="news-masthead">
                <div class="logo-container">
                    <a href="#">
                        <img src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="logo">
                    </a>
                </div>
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 2px; border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 4px 0; margin: 15px 0;">
                    Admin Panel &bullet; Secure Access &bullet; {{ date('l, F j, Y') }}
                </div>
                <h3 class="news-headline">Welcome Back</h3>
                <span class="news-subhead">{{ $gs->title }} Administration</span>
            </div>

            <div class="news-form-body">
                
                @include('includes.admin.form-login')

                <form id="loginform" action="{{ route('admin.login') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="news-form-group">
                        <label class="news-label">{{ __('Email Address') }}</label>
                        <input name="email" type="email" class="news-input" id="first_field" placeholder="editor@dailynews.com" required>
                    </div>

                    <div class="news-form-group">
                        <label class="news-label">{{ __('Password') }}</label>
                        <input name="password" type="password" class="news-input" id="second_field" placeholder="••••••••" required autocomplete="off">
                    </div>

                    <div class="news-actions">
                        <label class="news-check-label" for="rp">
                            <input type="checkbox" name="remember" id="rp" class="news-check-input" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('Remember Me') }}
                        </label>
                        
                        <a href="{{route('admin.forgot')}}" class="news-forgot-link">
                            {{ __('Forgot Password?') }}
                        </a>
                    </div>

                    <div class="news-form-group">
                        <input id="authdata" type="hidden" value="{{ __('Authenticating...') }}">
                        <button class="news-btn-submit">{{ __('Login to Dashboard') }}</button>
                    </div>

                </form>
            </div>

            <div class="news-edition-line">
                &copy; {{ date('Y') }} {{ $gs->title }}. All Rights Reserved.
            </div>

        </div>
    </div>


    <script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugin.js')}}"></script>
    <script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
    <script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{asset('assets/admin/js/load.js')}}"></script>
    <script src="{{asset('assets/admin/js/custom.js')}}"></script>
    <script src="{{asset('assets/admin/js/myscript.js')}}"></script>

    <script src="{{asset('assets/frontend/login/assets/js/jquery.validate.min.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            // Optional: Add simple visual feedback on focus
            $('.news-input').on('focus', function() {
                $(this).parent().addClass('focused');
            }).on('blur', function() {
                $(this).parent().removeClass('focused');
            });
        });
    </script>

</body>
</html>