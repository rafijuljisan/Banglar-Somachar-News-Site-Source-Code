@extends('layouts.admin')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Noto+Serif+Bengali:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --page-bg: #ffffff;
        --card-bg: #ffffff;
        --text-dark: #1e1e1e;
        --text-meta: #6c757d;
        
        /* Vibrant Bengali Palette for accents */
        --accent-news: #00695c;     /* Deep Teal */
        --accent-pending: #d35400;  /* Burnt Orange */
        --accent-draft: #2c3e50;    /* Ink Blue */
        --accent-schedule: #8e44ad; /* Royal Purple */
        --accent-rss: #c0392b;      /* Alta Red */
        --accent-polls: #2980b9;    /* River Blue */

        --font-head: 'Noto Serif Bengali', serif;
        --font-num: 'Hind Siliguri', sans-serif;
    }

    body {
        background-color: var(--page-bg) !important;
    }

    .content-area {
        background-color: var(--page-bg);
        padding: 40px 20px;
        font-family: var(--font-num);
    }

    /* Modern Minimalist Card */
    .modern-card {
        background: var(--card-bg);
        /* Asymmetrical corners for unique artistic look */
        border-radius: 16px 4px 16px 4px; 
        border: 1px solid #f0f0f0;
        padding: 25px;
        margin-bottom: 30px;
        position: relative;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        overflow: hidden;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        border-color: transparent;
    }

    /* Accent Line on Left */
    .modern-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 15%;
        bottom: 15%;
        width: 4px;
        border-radius: 0 4px 4px 0;
        background-color: #ddd; /* Default fallback */
        transition: height 0.3s;
    }

    /* Color Specific Accents */
    .type-news::before { background-color: var(--accent-news); }
    .type-pending::before { background-color: var(--accent-pending); }
    .type-draft::before { background-color: var(--accent-draft); }
    .type-schedule::before { background-color: var(--accent-schedule); }
    .type-rss::before { background-color: var(--accent-rss); }
    .type-polls::before { background-color: var(--accent-polls); }

    /* Card Content */
    .card-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .card-title {
        font-family: var(--font-head);
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        line-height: 1.4;
    }

    /* Icon Circle */
    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    /* Icon Colors (Soft Backgrounds) */
    .type-news .icon-circle { background: rgba(0, 105, 92, 0.1); color: var(--accent-news); }
    .type-pending .icon-circle { background: rgba(211, 84, 0, 0.1); color: var(--accent-pending); }
    .type-draft .icon-circle { background: rgba(44, 62, 80, 0.1); color: var(--accent-draft); }
    .type-schedule .icon-circle { background: rgba(142, 68, 173, 0.1); color: var(--accent-schedule); }
    .type-rss .icon-circle { background: rgba(192, 57, 43, 0.1); color: var(--accent-rss); }
    .type-polls .icon-circle { background: rgba(41, 128, 185, 0.1); color: var(--accent-polls); }

    /* The Big Number */
    .stat-number {
        font-family: var(--font-num);
        font-size: 48px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1;
        margin-bottom: 5px;
        letter-spacing: -1px;
    }

    /* Link Area */
    .card-footer-link {
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px dashed #eee;
        color: var(--text-meta);
        transition: color 0.2s;
    }

    .card-footer-link i {
        font-size: 10px;
        margin-left: 6px;
        transition: transform 0.2s;
    }

    .modern-card:hover .card-footer-link i {
        transform: translateX(3px);
    }

    /* Hover Text Colors */
    .type-news:hover .card-footer-link { color: var(--accent-news); }
    .type-pending:hover .card-footer-link { color: var(--accent-pending); }
    .type-draft:hover .card-footer-link { color: var(--accent-draft); }
    .type-schedule:hover .card-footer-link { color: var(--accent-schedule); }
    .type-rss:hover .card-footer-link { color: var(--accent-rss); }
    .type-polls:hover .card-footer-link { color: var(--accent-polls); }

</style>
@endsection

@section('content')
<div class="content-area">

    <div class="row mb-4">
        <div class="col-12">
            <h3 style="font-family: 'Noto Serif Bengali', serif; font-weight: 700; color: #1e1e1e; margin-bottom: 5px;">ড্যাশবোর্ড</h3>
            <p style="color: #888; font-size: 14px;">Welcome to your admin control center</p>
        </div>
    </div>

    <div class="row row-cards-one">
        @php
            $user = Auth::guard('admin')->user()->role;
        @endphp

        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="modern-card type-news">
                <div class="card-head">
                    <h5 class="card-title">{{ __('All News') }}</h5>
                    <div class="icon-circle">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
                <div>
                    @if ($user->name != 'admin' && $user->name != 'moderator')
                        <span class="stat-number">{{ $author_post }}</span>
                    @else 
                        <span class="stat-number">{{ $total_post }}</span>
                    @endif
                </div>
                <a href="{{ route('post.index') }}" class="card-footer-link">
                    {{ __('View Details') }} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="modern-card type-pending">
                <div class="card-head">
                    <h5 class="card-title">{{ __('Pending') }}</h5>
                    <div class="icon-circle">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
                <div>
                    @if ($user->name != 'admin' && $user->name != 'moderator')
                        <span class="stat-number">{{ $author_pending }}</span>
                    @else 
                        <span class="stat-number">{{ $pending_posts }}</span>
                    @endif
                </div>
                <a href="{{ route('pending.index') }}" class="card-footer-link">
                    {{ __('Review Items') }} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="modern-card type-draft">
                <div class="card-head">
                    <h5 class="card-title">{{ __('Drafts') }}</h5>
                    <div class="icon-circle">
                        <i class="fas fa-pen-nib"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-number">{{ $drafts }}</span>
                </div>
                <a href="{{ route('draft.index') }}" class="card-footer-link">
                    {{ __('Continue Editing') }} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="modern-card type-schedule">
                <div class="card-head">
                    <h5 class="card-title">{{ __('Scheduled') }}</h5>
                    <div class="icon-circle">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-number">{{ $schedules }}</span>
                </div>
                <a href="{{ route('schedule.index') }}" class="card-footer-link">
                    {{ __('View Timeline') }} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="modern-card type-rss">
                <div class="card-head">
                    <h5 class="card-title">{{ __('RSS Feeds') }}</h5>
                    <div class="icon-circle">
                        <i class="fas fa-rss"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-number">{{ $rss }}</span>
                </div>
                <a href="{{ route('rss.index') }}" class="card-footer-link">
                    {{ __('Manage Feeds') }} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="modern-card type-polls">
                <div class="card-head">
                    <h5 class="card-title">{{ __('Polls') }}</h5>
                    <div class="icon-circle">
                        <i class="fas fa-poll-h"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-number">{{ $polls }}</span>
                </div>
                <a href="{{ route('addPolls.index') }}" class="card-footer-link">
                    {{ __('View Results') }} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection