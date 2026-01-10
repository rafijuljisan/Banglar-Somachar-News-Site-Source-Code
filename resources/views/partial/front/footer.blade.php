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
          <p class="developer-text">কারিগরি সহযোগিতায়: <a href="https://jisan.technomenia.com/" target="_blank">Md Jisan</a></p>
        </div>
    </div>
  </div>
</div>