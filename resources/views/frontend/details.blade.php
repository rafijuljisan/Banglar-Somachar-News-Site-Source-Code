@php
  $seo=DB::table('seotools')->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$data->title}}</title>
  <meta property="og:url" content="{{Request::fullUrl()}}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="{{$data->title}}" />
  <meta property="og:image" content="{{asset('assets/images/post/'.$data->image_big)}}" />
    <link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}" type="image/x-icon">

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

  @if(DB::table('languages')->where('is_default','=',1)->first()->rtl == 1)
    <link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
  @endif
  <link rel="stylesheet" id="color" href="{{ asset('assets/front/css/color.php?base_color='.str_replace('#','', $gs->theme_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color)) }}">
  <link rel="stylesheet" id="color" href="{{ asset('assets/front/css/font.php?font_familly='.$default_font->font_family) }}">
    @stack('css')
    {!!$gs->adsense_code!!}
   {!!$gs->adsense_code!!}
  {!! $seo->google_analytics !!}
</head>
<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="../connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0"></script>
  <style>
.main-logo {padding: 22px 0 20px 0;}
@media only screen and (max-width: 767px) {
  .main-logo {padding: 10px 0 13px 0;text-align: center;}
}
</style>
<div class="scrollup">
  <i aria-hidden="true" class="fa fa-chevron-up"></i>
</div><header>
<script src="https://bangla.plus/scripts/bangladatetoday.min.js"></script>
<script>dateToday('date-today', 'bangla');</script>
@php
    // FIX: Check if function exists to prevent "Cannot redeclare" error
    if (!function_exists('bn_date')) {
        function bn_date($str)
        {
         $en = array(1,2,3,4,5,6,7,8,9,0);
        $bn = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $str = str_replace($en, $bn, $str);
        $en = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
        $en_short = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' );
        $bn = array( 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর' );
        $str = str_replace( $en, $bn, $str );
        $str = str_replace( $en_short, $bn, $str );
        $en = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
         $en_short = array('Sat','Sun','Mon','Tue','Wed','Thu','Fri');
         $bn_short = array('শনি', 'রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র');
         $bn = array('শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার');
         $str = str_replace( $en, $bn, $str );
         $str = str_replace( $en_short, $bn_short, $str );
         $en = array( 'am', 'pm' );
        $bn = array( 'পূর্বাহ্ন', 'অপরাহ্ন' );
        $str = str_replace( $en, $bn, $str );
         $str = str_replace( $en_short, $bn_short, $str );
         $en = array( '১২', '২৪' );
        $bn = array( '৬', '১২' );
        $str = str_replace( $en, $bn, $str );
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
        hoursOfDay-= 12;
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

   document.getElementById('Clock').innerHTML = time ;
   
    var chars = {'1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯','0':'০','A':'এ','P':'পি','M':'এম'};
    let str = document.getElementById("Clock").innerHTML; 
    let res = str.replace(/[1234567890AMP]/g, m => chars[m]);
    document.getElementById("Clock").innerHTML = res;

}
displayTime();

</script>
 
 
 
 
     @include('partial.front.header')
    <div class="container custom-container">
   <div class="row custom-row">
     <div class="left-content-area details-left-content-area">
       <div class="col-lg-12 custom-padding">

         <ol class="breadcrumb details-page-breadcrumb">
           <li><a href=""><i class="fa fa-home"></i></a></li>
           <li class="active"><a href="">{{$data->category->title}} </a></li>
         </ol><div class="details-content">
           <h3>{{$data->title}}</h3>
           <hr>
           <small class="small">


    <img style="width: 50px;
    height: 50px;
    border-radius: 21px;float: left;margin-right: 9px;" class="img-fluid writer-image" src="{{asset('assets/images/admin/'.$data->admin->photo)}}" alt="FavIcon">
 

  <div class="writer-name">
                {{$data->admin->name}} <br>
               নিউজ প্রকাশের তারিখ : {{$data->createdAt()}} ইং          </div>
           </small>
           <img class="img-fluid" src="{{asset('assets/images/post/'.$data->image_big)}}" alt="ছবির ক্যাপশন: {{$data->image_caption}}">
        {!!$gs->header3_728!!}
                                  @if ($data->post_type == 'audio')
  <p style="text-align: center;"><b>&nbsp;অডিও&nbsp; ফাইল</b></p>
<audio controls="" style="width:100%">
         <source src="{{asset('assets/audios/'.$data->audio)}}" type="audio/mp3">
        </audio>
        @endif
           <p style="text-align: justify;">{!! $data->description !!}</p>
       <p style="text-align: justify;">{!! $data->video_embed !!}</p>
       
       <div class="upg-print-button-wrapper" style="margin: 20px 0; border-top: 1px dashed #ddd; padding-top: 20px;">
           <button id="upg-print-trigger" 
                   data-postid="{{ $data->id }}" 
                   data-url="{{ route('post.tool.print', $data->id) }}"
                   style="padding: 8px 15px; background: #0e61d4; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
               <i class="fa fa-print"></i> সংবাদটি প্রিন্ট করুন
           </button>

           <button id="upg-photocard-trigger" 
                   data-postid="{{ $data->id }}" 
                   data-url="{{ route('post.tool.photocard', $data->id) }}"
                   style="padding: 8px 15px; background: #198754; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px; font-size: 16px;">
               <i class="fa fa-camera"></i> ফটোকার্ড ডাউনলোড
           </button>
       </div>
         </div><div class="facebook-comment-box">
           <h2 class="fb-h2" style="">আপনার মতামত লিখুন :</h2>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0&appId=1716117305495236" nonce="OKS9Fdbx"></script>
<div class="fb-comments" data-href="{{ URL::to('details/'.$data->id.'/'.$data->slug)}}" data-width="700" data-numposts="10"></div>
 
         </div></div></div><div class="right-content-area details-right-content-area">
       <div class="col-lg-12 custom-padding">

         <div class="details-page-side-banner">
           {!!$gs->sidebar_ads!!}
         </div><div class="details-right-news-heading">
            @php
        $favourite45=DB::table('posts')->inRandomOrder()->orderBy('id','DESC')->limit(6)->get();
        @endphp 
             <h2>আলোচিত শীর্ষ ১০ সংবাদ </h2>
           </div><div class="row custom-row">
                               
                 
          @foreach($favourite45 as $row)       
             <div class="col-lg-6 col-md-6 col-6">
                    <div class="details-news-single">
                      <a href="{{ route('frontend.details',[$row->id,$row->slug])}}">
                        <img src="{{asset('assets/images/post/'.$row->image_big)}}" class="img-fluid" alt="{{ $row->title}}" title="{{ $row->title}}" />                        <div class="details-news-single-text">
                          <span></span>
                          <h3>{{ $row->title}}</h3>
                        </div>
                      </a>
                    </div>
                  </div>
 @endforeach
                           </div></div><div class="details-tab-container">
          @php
        $latestpost=DB::table('posts')->inRandomOrder()->orderBy('id','DESC')->skip(10)->limit(20)->get();
        @endphp
           <ul class="nav nav-pills side-tab-main" id="pills-tab" role="tablist">
             <li class="nav-item">
               <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">সর্বশেষ</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">জনপ্রিয়</a>
             </li>
           </ul>

           <div class="tab-content alokitonews-tab-content" id="pills-tabContent">

             <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
               <div class="least-news">
                 <ul class="least-news-ul detail-least-news-ul">
  
  
  
  
  @foreach($latestpost as $row)
  <li><a href="{{ route('frontend.details',[$row->id,$row->slug])}}">
    <div class="least-news-left">
      <img src="{{asset('assets/images/post/'.$row->image_big)}}" class="img-fluid" alt="{{ $row->title}}" title="{{ $row->title}}" />
    </div>
    <div class="least-news-right">
      <h3>{{ $row->title}}</h3>
    </div>
  </a></li>
  @endforeach
  
  
 
 </ul></div></div><div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
               <div class="least-news">
                 <ul class="least-news-ul detail-least-news-ul">
    
            @php
        $favourite=DB::table('posts')->inRandomOrder()->orderBy('id','DESC')->skip(5)->limit(20)->get();
        @endphp 
  
  @foreach($favourite as $row)
  <li><a href="{{ route('frontend.details',[$row->id,$row->slug])}}">
    <div class="least-news-left">
      <img src="{{asset('assets/images/post/'.$row->image_big)}}" class="img-fluid" alt="{{ $row->title}}" title="{{ $row->title}}" />
    </div>
    <div class="least-news-right">
      <h3>{{ $row->title}}</h3>
    </div>
  </a></li>
    @endforeach




                 </ul></div></div></div></div></div></div></div></div>@include('partial.front.footer')
  <script src="{{asset('assets/frontend/asset/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/menu.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/jquery-stick.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/custom.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/jquery.marquee.min.js')}}"></script>
<script src="{{asset('assets/frontend/asset/js/jquery.pause.js')}}"></script>

<div id='fb-root'/>
<script type='text/javascript'>
//<![CDATA[
window.fbAsyncInit = function() {
FB.init({
appId : 'FB APP ID',
status : true, // check login status
cookie : true, // enable cookies 
xfbml : true // parse XFBML
});
};
(function() {
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
</body>

</html>