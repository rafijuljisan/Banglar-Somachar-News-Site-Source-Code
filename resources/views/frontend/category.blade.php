@extends('layouts.front')
@section('contents')

<style>
    /* === RESET & BASE === */
    .cat-page-wrapper * { 
        box-sizing: border-box !important;
    }
    
    /* Desktop Default Padding */
    .cat-page-wrapper {
        padding-left: 30px !important;
        padding-right: 5px !important;
    }

    /* Override reset for Bootstrap columns */
    .cat-page-wrapper .left-content-area,
    .cat-page-wrapper .right-content-area {
        margin: 0 !important;
    }
    
    .cat-page-wrapper .left-content-area > *,
    .cat-page-wrapper .right-content-area > *,
    .cat-page-wrapper .category-content > * {
        margin: 0 !important;
        padding: 0px 0px 15px 0px !important;
    }

    /* === FEATURED HERO POST === */
    .featured-hero-post {
        background: #ffffff !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        margin-bottom: 30px !important;
        transition: all 0.4s ease !important;
    }
    
    .featured-hero-post:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
        transform: translateY(-3px) !important;
    }

    .featured-hero-link {
        display: block !important;
        text-decoration: none !important;
        color: inherit !important;
    }

    .featured-hero-image-container {
        width: 100% !important;
        height: 400px !important;
        position: relative !important;
        overflow: hidden !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }

    .featured-hero-image-container img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        transition: transform 0.6s ease !important;
    }

    .featured-hero-post:hover .featured-hero-image-container img {
        transform: scale(1.08) !important;
    }

    .featured-hero-overlay {
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 60%, transparent 100%) !important;
        padding: 40px 30px 30px 30px !important;
    }

    .featured-hero-category-badge {
        display: inline-block !important;
        background: #ff0000 !important;
        color: #ffffff !important;
        padding: 6px 16px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin-bottom: 15px !important;
    }

    .featured-hero-title {
        font-size: 32px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        color: #ffffff !important;
        margin-bottom: 15px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3) !important;
    }

    .featured-hero-excerpt {
        font-size: 16px !important;
        line-height: 1.6 !important;
        color: #f0f0f0 !important;
        margin-bottom: 20px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    .featured-hero-read-more {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        background: rgba(255,255,255,0.15) !important;
        padding: 10px 20px !important;
        border-radius: 25px !important;
        backdrop-filter: blur(10px) !important;
        transition: all 0.3s ease !important;
    }

    /* === GRID POSTS === */
    .posts-grid-container {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 30px !important;
        margin-bottom: 40px !important;
    }

    .grid-post-card {
        background: #ffffff !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06) !important;
        transition: all 0.3s ease !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .grid-post-link {
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        text-decoration: none !important;
        color: inherit !important;
    }

    .grid-post-image-wrapper {
        width: 100% !important;
        height: 220px !important;
        position: relative !important;
        overflow: hidden !important;
        background: #f5f5f5 !important;
    }

    .grid-post-image-wrapper img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        transition: transform 0.5s ease !important;
    }

    .grid-post-card:hover .grid-post-image-wrapper img {
        transform: scale(1.12) !important;
    }

    .grid-post-content {
        padding: 20px !important;
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .grid-post-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        line-height: 1.4 !important;
        color: #1a1a1a !important;
        margin-bottom: 12px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        transition: color 0.3s ease !important;
    }

    .grid-post-description {
        font-size: 15px !important;
        line-height: 1.6 !important;
        color: #666666 !important;
        margin-bottom: 15px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 3 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        flex-grow: 1 !important;
    }

    .grid-post-meta {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        font-size: 13px !important;
        color: #999999 !important;
        padding-top: 12px !important;
        border-top: 1px solid #eeeeee !important;
    }

    /* === PAGINATION === */
    .category-pagination {
        text-align: center !important;
        margin-top: 40px !important;
        padding: 20px 0 !important;
    }

    /* === RESPONSIVE TABLET === */
    @media (max-width: 992px) {
        .featured-hero-title { font-size: 26px !important; }
    }

    /* === RESPONSIVE MOBILE FIXES (THE FIX IS HERE) === */
    @media (max-width: 768px) {
        /* 1. Force the Main Left Area to take 100% width and remove right padding */
        .cat-page-wrapper .left-content-area,
        .details-left-content-area {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding-right: 0px !important;
            margin-right: 0 !important;
        }

        /* 2. Main Wrapper Padding Adjustment */
        .cat-page-wrapper {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        /* 3. Featured Hero Height */
        .featured-hero-image-container {
            height: 220px !important;
        }
        .featured-hero-overlay {
            padding: 20px 15px !important;
        }
        .featured-hero-title {
            font-size: 20px !important;
            margin-bottom: 8px !important;
        }
        
        /* 4. Grid Posts - 2 Column Layout */
        .posts-grid-container {
            grid-template-columns: repeat(2, 1fr) !important; 
            gap: 12px !important; 
            margin-bottom: 30px !important;
        }

        /* 5. Adjust Card Style for Mobile */
        .grid-post-image-wrapper {
            height: 120px !important; /* Smaller height for mobile */
        }
        .grid-post-content {
            padding: 10px !important; 
        }
        .grid-post-title {
            font-size: 14px !important;
            line-height: 1.3 !important;
            margin-bottom: 5px !important;
            -webkit-line-clamp: 3 !important; 
        }
        /* Hide description on mobile to save space */
        .grid-post-description {
            display: none !important; 
        }
        .grid-post-meta {
            padding-top: 5px !important;
            font-size: 11px !important;
        }
        
        /* Sidebar Tabs Fix */
        .modern-sb-nav .nav-item {
            flex: 1;
            text-align: center;
        }
        .modern-sb-nav .nav-link {
            width: 100%;
        }
    }
</style>

<div class="container custom-container cat-page-wrapper">
    <div class="row custom-row">
        
        <div class="left-content-area details-left-content-area">
            <div class="col-lg-12 custom-padding">

                <ol class="breadcrumb details-page-breadcrumb">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                    <li class="active"><a href="#">{{$data->title}}</a></li>
                </ol>

                <div class="category-page">
                    <div class="category-content">

                        {{-- === FEATURED HERO POST === --}}
                        @if ($posts1->count() > 0)
                            @foreach ($posts1 as $post1)
                            <article class="featured-hero-post">
                                <a href="{{ route('frontend.details',[$post1->id,$post1->slug])}}" class="featured-hero-link">
                                    <div class="featured-hero-image-container">
                                        <img src="{{asset('assets/images/post/'.$post1->image_big)}}" alt="{{ $post1->title }}">
                                        <div class="featured-hero-overlay">
                                            <span class="featured-hero-category-badge">বিশেষ</span>
                                            <h1 class="featured-hero-title">{{ $post1->title }}</h1>
                                            <p class="featured-hero-excerpt">{{ Str::limit(strip_tags($post1->details ?? $post1->description), 150) }}</p>
                                            <div class="featured-hero-read-more">
                                                বিস্তারিত পড়ুন <i class="fa fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        @else
                            <div class="alert alert-warning">এই বিভাগে কোন সংবাদ পাওয়া যায়নি</div>
                        @endif

                        {{-- === GRID POSTS === --}}
                        @if ($posts->count() > 0)
                        <div class="posts-grid-container">
                            @foreach ($posts as $post)
                            <article class="grid-post-card">
                                <a href="{{ route('frontend.details',[$post->id,$post->slug])}}" class="grid-post-link">
                                    <div class="grid-post-image-wrapper">
                                        <img src="{{asset('assets/images/post/'.$post->image_big)}}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="grid-post-content">
                                        <h2 class="grid-post-title">{{ $post->title }}</h2>
                                        <p class="grid-post-description">{{ Str::limit(strip_tags($post->details ?? $post->description), 120) }}</p>
                                        <div class="grid-post-meta">
                                            <i class="fa fa-clock-o"></i>
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        </div>
                        @endif

                        {{-- === PAGINATION === --}}
                        <div class="row">
                            <div class="col-sm-12 category-pagination">
                                {{ $posts->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-12 right-content-area details-right-content-area">
          <div class="modern-sb-wrapper">
            <div class="col-lg-12 custom-padding">

              <div class="modern-sb-ads">
                {{-- DYNAMIC AD START --}}
                @php
                  $ad = App\Models\Advertisement::where('add_placement', 'single_sidebar_ads')->where('status', 1)->first();
                @endphp
                @if($ad)
                  <div class="ad-container" style="margin: 15px 0; text-align: center;">
                    @if($ad->banner_type == 'upload')
                      <a href="{{ $ad->link ?? '#' }}" target="_blank"><img
                          src="{{ asset('assets/images/addBanner/' . $ad->photo) }}" style="max-width:100%; height:auto;"></a>
                    @elseif($ad->banner_type == 'url')
                      <a href="{{ $ad->link ?? '#' }}" target="_blank"><img src="{{ $ad->photo_url }}"
                          style="max-width:100%; height:auto;"></a>
                    @elseif($ad->banner_type == 'code')
                      {!! $ad->banner_code !!}
                    @endif
                  </div>
                @endif
                {{-- DYNAMIC AD END --}}
              </div>

              <div class="modern-sb-header">
                @php
                  $topNews = DB::table('posts')->inRandomOrder()->orderBy('id', 'DESC')->limit(6)->get();
                @endphp
                <h2>আলোচিত শীর্ষ ১০ সংবাদ</h2>
              </div>

              <div class="row custom-row">
                @foreach($topNews as $row)
                  <div class="col-6 col-md-6 modern-sb-grid-item">
                    <a href="{{ route('frontend.details', [$row->id, $row->slug])}}" class="modern-sb-grid-link">
                      <div class="modern-sb-grid-thumb">
                        <img src="{{asset('assets/images/post/' . $row->image_big)}}" alt="{{ $row->title}}"
                          title="{{ $row->title}}">
                      </div>
                      <h3>{{ Str::limit($row->title, 45) }}</h3>
                    </a>
                  </div>
                @endforeach
              </div>

              <div class="modern-sb-tab-wrapper">

                <ul class="nav nav-pills modern-sb-nav" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                      aria-controls="pills-home" aria-selected="true">সর্বশেষ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                      aria-controls="pills-profile" aria-selected="false">জনপ্রিয়</a>
                  </li>
                </ul>

                <div class="tab-content modern-sb-tab-body" id="pills-tabContent">

                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <ul class="modern-sb-list">
                      @php
                        $latestpost = DB::table('posts')->inRandomOrder()->orderBy('id', 'DESC')->skip(10)->limit(20)->get();
                      @endphp

                      @foreach($latestpost as $row)
                        <li class="modern-sb-list-item">
                          <a href="{{ route('frontend.details', [$row->id, $row->slug])}}" class="modern-sb-list-link">
                            <div class="modern-sb-list-thumb">
                              <img src="{{asset('assets/images/post/' . $row->image_big)}}" alt="{{ $row->title}}">
                            </div>
                            <div class="modern-sb-list-info">
                              <h3>{{ $row->title}}</h3>
                            </div>
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>

                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="modern-sb-list">
                      @php
                        $favourite = DB::table('posts')->inRandomOrder()->orderBy('id', 'DESC')->skip(5)->limit(20)->get();
                      @endphp

                      @foreach($favourite as $row)
                        <li class="modern-sb-list-item">
                          <a href="{{ route('frontend.details', [$row->id, $row->slug])}}" class="modern-sb-list-link">
                            <div class="modern-sb-list-thumb">
                              <img src="{{asset('assets/images/post/' . $row->image_big)}}" alt="{{ $row->title}}">
                            </div>
                            <div class="modern-sb-list-info">
                              <h3>{{ $row->title}}</h3>
                            </div>
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>

@endsection