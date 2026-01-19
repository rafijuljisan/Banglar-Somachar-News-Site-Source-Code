@php
  $seo = DB::table('seotools')->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$data->title}}</title>

  {{-- Facebook / Open Graph --}}
  <meta property="og:url" content="{{Request::fullUrl()}}" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="{{$data->title}}" />
  <meta property="og:description" content="{{ mb_substr(strip_tags($data->description), 0, 200) }}..." />
  <meta property="fb:app_id" content="966242223397117" />

  {{-- Dynamic Social Image --}}
  <meta property="og:image" content="{{ route('social.share.image', $data->id) }}" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />

  {{-- Twitter --}}
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{$data->title}}" />
  <meta name="twitter:description" content="{{ mb_substr(strip_tags($data->description), 0, 200) }}..." />
  <meta name="twitter:image" content="{{ route('social.share.image', $data->id) }}" />

  <link rel="shortcut icon" href="{{asset('assets/images/' . $gs->favicon)}}" type="image/x-icon">

  @if ($default_font->font_value)
    <link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}&display=swap" rel="stylesheet">
  @else
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  @endif

  <link href="{{asset('assets/frontend/asset/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/asset/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/frontend/asset/css/menu.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/frontend/asset/css/owl.carousel.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/asset/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/asset/css/responsive.css')}}" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/eror/css/style.css')}}" />

  @if(DB::table('languages')->where('is_default', '=', 1)->first()->rtl == 1)
    <link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
  @endif

  <link rel="stylesheet" id="color"
    href="{{ asset('assets/front/css/color.php?base_color=' . str_replace('#', '', $gs->theme_color) . '&' . 'footer_color=' . str_replace('#', '', $gs->footer_color) . '&' . 'copyright_color=' . str_replace('#', '', $gs->copyright_color)) }}">
  <link rel="stylesheet" id="color"
    href="{{ asset('assets/front/css/font.php?font_familly=' . $default_font->font_family) }}">

  @stack('css')

  {{-- Scripts & Analytics --}}
  {!! $gs->adsense_code !!}
  {!! $seo->google_analytics !!}
</head>

<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="../connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0"></script>
  <style>
    .main-logo {
      padding: 22px 0 20px 0;
    }

    @media only screen and (max-width: 767px) {
      .main-logo {
        padding: 10px 0 13px 0;
        text-align: center;
      }
    }
  </style>
  <div class="scrollup">
    <i aria-hidden="true" class="fa fa-chevron-up"></i>
  </div>
  <header>
    <script src="https://bangla.plus/scripts/bangladatetoday.min.js"></script>
    <script>dateToday('date-today', 'bangla');</script>
    @php
      // FIX: Check if function exists to prevent "Cannot redeclare" error
      if (!function_exists('bn_date')) {
        function bn_date($str)
        {
          $en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
          $bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
          $str = str_replace($en, $bn, $str);
          $en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
          $en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
          $bn = array('জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
          $str = str_replace($en, $bn, $str);
          $str = str_replace($en_short, $bn, $str);
          $en = array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
          $en_short = array('Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri');
          $bn_short = array('শনি', 'রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহঃ', 'শুক্র');
          $bn = array('শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার');
          $str = str_replace($en, $bn, $str);
          $str = str_replace($en_short, $bn_short, $str);
          $en = array('am', 'pm');
          $bn = array('পূর্বাহ্ন', 'অপরাহ্ন');
          $str = str_replace($en, $bn, $str);
          $str = str_replace($en_short, $bn_short, $str);
          $en = array('১২', '২৪');
          $bn = array('৬', '১২');
          $str = str_replace($en, $bn, $str);
          return $str;
        }
      }
    @endphp
    <script>
      setInterval(displayTime, 1000);

      function displayTime() {

        const timeNow = new Date();

        let hoursOfDay = timeNow.getHours();
        let minutes = timeNow.getMinutes();
        let seconds = timeNow.getSeconds();
        let weekDay = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
        let today = weekDay[timeNow.getDay()];
        let months = timeNow.toLocaleString("default", {
          month: "long"
        });
        let year = timeNow.getFullYear();
        let period = "AM";

        if (hoursOfDay > 12) {
          hoursOfDay -= 12;
          period = "PM";
        }

        if (hoursOfDay === 0) {
          hoursOfDay = 12;
          period = "AM";
        }

        hoursOfDay = hoursOfDay < 10 ? "0" + hoursOfDay : hoursOfDay;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        let time = hoursOfDay + ":" + minutes + ":" + seconds + " " + period;

        document.getElementById('Clock').innerHTML = time;

        var chars = { '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯', '0': '০', 'A': 'এ', 'P': 'পি', 'M': 'এম' };
        let str = document.getElementById("Clock").innerHTML;
        let res = str.replace(/[1234567890AMP]/g, m => chars[m]);
        document.getElementById("Clock").innerHTML = res;

      }
      displayTime();

    </script>




    @include('partial.front.header')
    <div class="container custom-container">
      <div class="row custom-row">
        <div class="col-lg-8 col-md-8 col-12 left-content-area details-left-content-area">
          <div class="col-lg-12 custom-padding">

            <ol class="breadcrumb details-page-breadcrumb">
              <li><a href=""><i class="fa fa-home"></i></a></li>
              <li class="active"><a href="">{{$data->category->title}} </a></li>
            </ol>
            <div class="details-content">
              <h3 class="details-title">{{$data->title}}</h3>
              <hr>

              <img class="img-fluid mb-3" src="{{asset('assets/images/post/' . $data->image_big)}}"
                alt="ছবির ক্যাপশন: {{$data->image_caption}}">


              <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-md-center my-3 py-2 border-top border-bottom">

                <div class="d-flex align-items-center mb-3 mb-md-0">
                  <img style="width: 45px; height: 45px; border-radius: 50%; margin-right: 10px; object-fit: cover;"
                    class="img-fluid" src="{{asset('assets/images/admin/' . $data->admin->photo)}}"
                    alt="{{$data->admin->name}}">

                  <div style="line-height: 1.3;">
                    <strong style="font-size: 15px;">{{$data->admin->name}}</strong> <br>
                    <small style="color: #666; font-size: 12px;">প্রকাশ: {{$data->createdAt()}} ইং</small>
                  </div>
                </div>

                <div class="tool-bar-area m-0 p-0 d-flex align-items-center">
                  <button class="tool-btn text-size" id="btn-increase" title="Increase Font Size">
                    <i class="fa fa-plus"></i>
                  </button>
                  <button class="tool-btn text-size" id="btn-decrease" title="Decrease Font Size">
                    <i class="fa fa-minus"></i>
                  </button>

                  <div
                    style="width: 1px; background: #ddd; height: 20px; display: inline-block; vertical-align: middle; margin: 0 8px;">
                  </div>

                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                    target="_blank" class="tool-btn fb-share" title="Share on Facebook">
                    <i class="fa fa-facebook"></i>
                  </a>

                  <button class="tool-btn link-copy" id="btn-copy-link" title="Copy Link">
                    <i class="fa fa-link"></i>
                  </button>

                  <button class="tool-btn" id="btn-native-share" title="Share">
                    <i class="fa fa-share-alt"></i>
                  </button>
                </div>
              </div>
              @if ($data->post_type == 'audio')
                <p style="text-align: center;"><b>&nbsp;অডিও&nbsp; ফাইল</b></p>
                <audio controls="" style="width:100%">
                  <source src="{{asset('assets/audios/' . $data->audio)}}" type="audio/mp3">
                </audio>
              @endif

              {{-- Body Content --}}
              <div id="article-body-content" style="text-align: justify; font-size: 18px;" class="mt-4">
                {!! $data->description !!}
              </div>
              {{-- DYNAMIC AD START --}}
              @php
                $ad = App\Models\Advertisement::where('add_placement', 'single_page_sponsor')->where('status', 1)->first();
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
              <p style="text-align: justify;">{!! $data->video_embed !!}</p>

              <div class="upg-print-button-wrapper"
                style="margin: 20px 0; border-top: 1px dashed #ddd; padding-top: 20px;">
                <button id="upg-print-trigger" data-postid="{{ $data->id }}"
                  data-url="{{ route('post.tool.print', $data->id) }}"
                  style="padding: 8px 15px; background: #0e61d4; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                  <i class="fa fa-print"></i> সংবাদটি প্রিন্ট করুন
                </button>

                <button id="upg-photocard-trigger" data-postid="{{ $data->id }}"
                  data-url="{{ route('post.tool.photocard', $data->id) }}"
                  style="padding: 8px 15px; background: #198754; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px; font-size: 16px;">
                  <i class="fa fa-camera"></i> ফটোকার্ড ডাউনলোড
                </button>
              </div>
              {{-- 1. TAGS SECTION --}}
              @if($data->tags)
                <div class="tags-area">
                  <span class="tags-label">Tags:</span>
                  @php
                    $tags = explode(',', $data->tags);
                  @endphp
                  @foreach($tags as $tag)
                    <a href="{{ route('front.news_search') }}?search={{ trim($tag) }}" class="tag-item">
                      {{ trim($tag) }}
                    </a>
                  @endforeach
                </div>
              @endif


              {{-- 2. RELATED NEWS SECTION --}}
              @php
                // Fetch 4 related posts from the same category, excluding the current one
                $related_posts = DB::table('posts')
                  ->where('category_id', $data->category_id)
                  ->where('id', '!=', $data->id)
                  ->inRandomOrder() // Or use orderBy('id','desc') for latest
                  ->limit(4)
                  ->get();
              @endphp

              @if(count($related_posts) > 0)
                <div class="related-news-wrapper">
                  <h3 class="related-title">সম্পর্কিত খবর :</h3>

                  <div class="row">
                    @foreach($related_posts as $related)
                      <div class="col-lg-3 col-md-6 col-6">
                        <div class="related-post-item">
                          <a href="{{ route('frontend.details', [$related->id, $related->slug]) }}">
                            <img src="{{asset('assets/images/post/' . $related->image_big)}}" class="related-post-img"
                              alt="{{ $related->title }}">
                            <span class="related-post-title">{{ $related->title }}</span>
                          </a>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
              <div class="facebook-comment-box">
                <h2 class="fb-h2">আপনার মতামত লিখুন :</h2>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous"
                  src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0&appId=1716117305495236"
                  nonce="OKS9Fdbx"></script>
                <div class="fb-comments" data-href="{{ URL::to('details/' . $data->id . '/' . $data->slug)}}" data-width="700"
                  data-numposts="10"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- RIGHT SIDEBAR STARTS HERE -->
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
      <!-- RIGHT SIDEBAR ENDS HERE -->

    </div> <!-- End of row -->
    </div> <!-- End of container -->

    @include('partial.front.footer')
    <script src="{{asset('assets/frontend/asset/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/menu.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/jquery-stick.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/custom.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/jquery.marquee.min.js')}}"></script>
    <script src="{{asset('assets/frontend/asset/js/jquery.pause.js')}}"></script>

    <div id='fb-root' />
    <script type='text/javascript'>
      //<![CDATA[
      window.fbAsyncInit = function () {
        FB.init({
          appId: 'FB APP ID',
          status: true, // check login status
          cookie: true, // enable cookies 
          xfbml: true // parse XFBML
        });
      };
      (function () {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
      //]]>
    </script>


    <script>
      //get getSubCatList Bangla
      $(function () {
        /*-------------------------------------
        jQuery Marquee
        -------------------------------------*/
        $('.marquee').marquee({
          pauseOnHover: true,
          duration: 20000
        });

        $('.marquee-breaking').marquee({
          pauseOnHover: true,
          duration: 25000
        });

      });
      //to move active class
      $('#home').addClass('active')
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/front/css/print-tool.css') }}">
    <script src="{{ asset('assets/front/js/print-tool.js') }}"></script>
    <script>
      $(document).ready(function () {

        // 1. Text Resizing Logic
        // Target the ID because that is what your CSS uses
        var $articleWrapper = $('#article-body-content');
        var currentFontSize = 20; // Match your CSS default

        $('#btn-increase').click(function () {
          if (currentFontSize < 34) {
            currentFontSize += 2;
            updateSize();
          }
        });

        $('#btn-decrease').click(function () {
          if (currentFontSize > 14) {
            currentFontSize -= 2;
            updateSize();
          }
        });
        function updateSize() {
          var newLineHeight = currentFontSize * 1.6;

          // Apply size to the Main Wrapper
          $articleWrapper.css({
            'font-size': currentFontSize + 'px',
            'line-height': newLineHeight + 'px'
          });
        }

        function updateArticleStyle(size) {
          // FIXED: Used '.' instead of '#' to select by class
          $('.article-body-content').css('font-size', size + 'px');
          $('.article-body-content p').css('font-size', size + 'px'); // Explicitly target p tags

          var newLineHeight = size * 1.6;
          $('.article-body-content').css('line-height', newLineHeight + 'px');
          $('.article-body-content p').css('line-height', newLineHeight + 'px');
        }

        // 2. Copy Link Logic
        $('#btn-copy-link').click(function () {
          var dummy = document.createElement('input'),
            text = window.location.href;
          document.body.appendChild(dummy);
          dummy.value = text;
          dummy.select();
          document.execCommand('copy');
          document.body.removeChild(dummy);

          var originalIcon = $(this).html();
          $(this).html('<i class="fa fa-check" style="color:green"></i>');
          setTimeout(() => {
            $(this).html(originalIcon);
          }, 2000);
        });

        // 3. Native Share Logic
        $('#btn-native-share').click(function () {
          if (navigator.share) {
            navigator.share({
              // Ensure $data or $post is correct for your blade file
              title: '{{ $data->title ?? $post->title ?? "News" }}',
              url: window.location.href
            }).then(() => {
              console.log('Thanks for sharing!');
            })
              .catch(console.error);
          } else {
            alert('URL copied to clipboard!');
            $('#btn-copy-link').click();
          }
        });
      });
    </script>
</body>

</html>