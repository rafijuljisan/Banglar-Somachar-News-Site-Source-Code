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
       MODERN BENGALI NEWSPAPER THEME
       Clean, Sharp, High-Contrast
       ========================================
    */
    /* Import Bengali Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Noto+Serif+Bengali:wght@400;700&display=swap');

    :root {
        --news-ink: #111111;         /* Deep Black */
        --news-white: #ffffff;       /* Pure White */
        --news-bg: #f5f7fa;          /* Very light cool gray for page background */
        --news-accent: #D72323;      /* "Breaking News" Red */
        --news-border: #e1e4e8;      /* Clean border */
        
        /* Fonts */
        --font-head: 'Noto Serif Bengali', serif;  /* For Headlines */
        --font-body: 'Hind Siliguri', sans-serif;  /* For Inputs/Text */
    }

    body#top {
        background-color: var(--news-bg);
        font-family: var(--font-body);
        color: var(--news-ink);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
    }

    /* Wrapper */
    .news-login-wrapper {
        width: 100%;
        max-width: 420px;
        padding: 15px;
    }

    /* The Main Card - Clean & Modern */
    .news-card {
        background: var(--news-white);
        border: 1px solid var(--news-border);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05); /* Subtle shadow, not brutalist */
        padding: 40px;
        position: relative;
        border-top: 4px solid var(--news-accent); /* Red accent bar on top */
    }

    /* Top Masthead */
    .news-masthead {
        text-align: center;
        margin-bottom: 30px;
    }

    .news-masthead .logo-container img {
        max-width: 180px;
        height: auto;
        margin-bottom: 20px;
    }

    /* Headlines */
    .news-headline {
        font-family: var(--font-head);
        font-weight: 700;
        font-size: 26px;
        margin: 0 0 5px 0;
        color: var(--news-ink);
    }

    .news-subhead {
        font-size: 14px;
        color: #666;
        font-weight: 500;
        display: block;
        margin-bottom: 15px;
    }

    /* Date Line Style (Common in BD Papers) */
    .news-date-line {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 8px 0;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #555;
        margin-bottom: 25px;
    }

    /* Inputs - Box Style (Cleaner) */
    .news-form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .news-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }

    .news-input {
        width: 100%;
        padding: 12px 15px;
        font-size: 16px;
        border: 1px solid var(--news-border);
        background-color: #fcfcfc;
        color: var(--news-ink);
        border-radius: 4px; 
        transition: all 0.3s ease;
        font-family: var(--font-body);
    }

    .news-input:focus {
        outline: none;
        border-color: var(--news-ink); /* Black border on focus */
        background-color: var(--news-white);
    }

    .news-input::placeholder {
        color: #bbb;
        font-size: 14px;
    }

    /* Checkbox & Links */
    .news-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 14px;
    }

    .news-check-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        color: #555;
        font-weight: 500;
    }

    .news-check-input {
        margin-right: 8px;
        accent-color: var(--news-accent);
        width: 16px;
        height: 16px;
    }

    .news-forgot-link {
        color: var(--news-accent); /* Red Link */
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .news-forgot-link:hover {
        color: var(--news-ink);
        text-decoration: underline;
    }

    /* Submit Button */
    .news-btn-submit {
        width: 100%;
        padding: 14px;
        background-color: var(--news-ink); /* Black Button */
        color: var(--news-white);
        border: none;
        font-family: var(--font-body);
        font-weight: 700;
        font-size: 16px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.3s;
        border-radius: 4px;
    }

    .news-btn-submit:hover {
        background-color: var(--news-accent); /* Turns Red on Hover */
    }

    /* Footer */
    .news-edition-line {
        margin-top: 25px;
        text-align: center;
        font-size: 12px;
        color: #999;
    }

    /* Alert Boxes */
    .alert {
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 4px;
        font-size: 14px;
        border: 1px solid transparent;
    }
    .alert-danger { background: #fee2e2; color: #991b1b; border-color: #fecaca; }
    .alert-success { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
    .alert-info { background: #e0f2fe; color: #075985; border-color: #bae6fd; }

    /* ============================
       EYE ICON (VIEW PASSWORD)
       ============================ */
    .password-toggle-icon {
        position: absolute;
        right: 15px;
        top: 43px; /* Precise alignment for label + input height */
        cursor: pointer;
        color: #aaa;
        font-size: 16px;
        z-index: 10;
        transition: color 0.3s;
    }

    .password-toggle-icon:hover {
        color: var(--news-ink);
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
                        <i class="fa fa-eye password-toggle-icon" id="togglePassword"></i>
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
        // Password View Toggle
        $('#togglePassword').on('click', function() {
            var passwordInput = $('#second_field');
            var icon = $(this);

            // Toggle the type attribute
            var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);

            // Toggle the eye / eye-slash icon
            icon.toggleClass('fa-eye fa-eye-slash');
        });
    </script>

</body>
</html>