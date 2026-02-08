@php
    $bottom_breaking_news = DB::table('posts')->orderBy('id', 'DESC')->limit(10)->get();
@endphp

<style>
/* Sticky Bottom News Bar CSS */
.bottom-breaking-wrapper {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #fff;
    border-top: 3px solid #D80000;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    z-index: 9999;
    height: 40px;
    font-family: 'SolaimanLipiNormal', sans-serif;
}
.bottom-breaking-inner {
    display: flex;
    align-items: center;
    height: 37px;
    overflow: hidden;
}
.breaking-label {
    background: #D80000;
    color: #fff;
    padding: 0 15px;
    font-weight: bold;
    height: 100%;
    display: flex;
    align-items: center;
    position: relative;
    font-size: 16px;
    z-index: 2;
    white-space: nowrap;
}
.breaking-label .arrow-right {
    position: absolute;
    right: -10px;
    top: 0;
    width: 0; 
    height: 0; 
    border-top: 37px solid transparent;
    border-left: 10px solid #D80000;
    border-bottom: 0 solid transparent;
}
.marquee-bottom {
    flex-grow: 1;
    overflow: hidden;
    line-height: 37px;
    padding-left: 20px;
}
.breaking-link {
    color: #333;
    margin-right: 30px;
    font-weight: 600;
    font-size: 18px;
    text-decoration: none;
    display: inline-block;
}
.breaking-link:hover { color: #D80000; }
.breaking-link i { color: #D80000; margin-right: 5px; font-size: 12px; }
.breaking-close-btn {
    background: #333;
    border: none;
    color: #fff;
    width: 30px;
    height: 100%;
    cursor: pointer;
    z-index: 3;
}
/* --- Fix for Bottom Bar Alignment --- */

/* 1. Force the container to take full width and remove left/right gap */
.bottom-breaking-wrapper .container,
.bottom-breaking-wrapper .custom-container {
    padding-left: 0 !important;
    padding-right: 0 !important;
    max-width: 100% !important;
    margin: 0 !important;
}

/* 2. (Optional) If you want the Close button to not touch the very right edge, add this: */
.bottom-breaking-wrapper .breaking-close-btn {
    margin-right: 10px; /* Adds a small breathing room on the right */
}

/* 3. Mobile Specific Tweak (Ensures perfect fit on phones) */
@media (max-width: 767px) {
    .bottom-breaking-wrapper .custom-container {
        width: 100% !important;
    }
    
    /* Adjust label font size if it's too big for small phones */
    .breaking-label {
        font-size: 14px; 
        padding: 0 10px;
    }
}
</style>
<link href="{{asset('assets/front/css/style.css')}}" rel="stylesheet">
<footer class="footer-new">
  <div class="container jagaran-container">
    <div class="row custom-row">
      
      <div class="col-lg-3 col-md-6 custom-padding">
        <div class="footer-widget about-widget">
          <h3 class="widget-title"> <span> আমাদের পরিচিতি </span> </h3>
          
          <div class="editor-list">
            @if($gs->sompadok)
            <div class="editor-item">
                <span class="role">সম্পাদক ও প্রকাশক</span>
                <span class="name">{{$gs->sompadok}}</span>
            </div>
            @endif

            @if($gs->nirbahi_sompadok)
            <div class="editor-item">
                <span class="role">নির্বাহী সম্পাদক</span>
                <span class="name">{{$gs->nirbahi_sompadok}}</span>
            </div>
            @endif

            @if($gs->barta_sompadok)
            <div class="editor-item">
                <span class="role">বার্তা সম্পাদক</span>
                <span class="name">{{$gs->barta_sompadok}}</span>
            </div>
            @endif
          </div>

          <div class="social-area">
             <p class="follow-text">সোশ্যাল মিডিয়া :</p>
             <ul class="social-icon footer-social">
                @foreach ($social_links as $social_link) 
                  <li>
                      <a target="_blank" href="{{ $social_link->link}}" class="{{$social_link->name}}">
                          <i class="{{$social_link->icon}}"></i>
                      </a>
                  </li>
                 @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 custom-padding">
        <div class="footer-widget contact-widget">
          <h3 class="widget-title"> <span> রেজিস্টার্ড অফিস </span> </h3>
          <ul class="address-list">
            <li>
              <div class="icon-box"><i class="fa fa-map-marker"></i></div>
              <div class="text-box">{{$gs->address}}</div>
            </li>
            <li>
              <div class="icon-box"><i class="fa fa-phone"></i></div>
              <div class="text-box">{{$gs->mobile}}</div>
            </li>
            <li>
              <div class="icon-box"><i class="fa fa-envelope"></i></div>
              <div class="text-box">{{$gs->email_address}}</div>
            </li>
            <li>
              <div class="icon-box"><i class="fa fa-globe"></i></div>
              <div class="text-box">{{ route('frontend.index')}}</div>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 custom-padding">
        <div class="footer-widget contact-widget">
          <h3 class="widget-title"> <span> কর্পোরেট অফিস </span> </h3>
          <ul class="address-list">
             <li>
              <div class="icon-box"><i class="fa fa-building"></i></div>
              <div class="text-box">{{$gs->address}}</div>
            </li>
            <li>
              <div class="icon-box"><i class="fa fa-phone"></i></div>
              <div class="text-box">{{$gs->mobile}}</div>
            </li>
            <li>
              <div class="icon-box"><i class="fa fa-envelope"></i></div>
              <div class="text-box">{{$gs->email_address}}</div>
            </li>
             <li>
              <div class="icon-box"><i class="fa fa-globe"></i></div>
              <div class="text-box">{{ route('frontend.index')}}</div>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 custom-padding">
        <div class="footer-widget map-widget">
          <h3 class="widget-title"> <span> মানচিত্রে আমরা </span> </h3>
          <div class="google-map-wrapper">
             {!! $gs->google_map !!}
          </div>
        </div>
      </div>

    </div></div></footer>

<div class="footer-bottom">
  <div class="container custom-container">
    <div class="row align-items-center">
        <div class="col-md-6">
          <p class="copyright-text">{{$gs->copyright_text}}</p>
        </div>
        <div class="col-md-6 text-right">
          <p class="developer-text">কারিগরি সহযোগিতায়: <a href="https://jisan.openwindowbd.com/" target="_blank">Md Jisan</a></p>
        </div>
    </div>
  </div>
</div>
<div class="bottom-breaking-wrapper">
    <div class="container custom-container">
        <div class="bottom-breaking-inner">
            <div class="breaking-label">
                সদ্য সংবাদ
                <div class="arrow-right"></div>
            </div>
            <div class="marquee-bottom">
                @foreach($bottom_breaking_news as $news)
                    <a href="{{ route('frontend.details',[$news->id, $news->slug])}}" class="breaking-link">
                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{ $news->title }}
                    </a>
                @endforeach
            </div>
            <button class="breaking-close-btn" onclick="jQuery('.bottom-breaking-wrapper').fadeOut();">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>