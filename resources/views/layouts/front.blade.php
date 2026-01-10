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
	@if ($gs->title)
	<title> {{ $gs->title }}</title>
	@endif
    <meta name="description" content="{{ $seo->meta_description }}">
    <meta name="keywords" content="{{ $seo->meta_keys }}">
    <meta property="og:title" content="{{ $gs->title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:URL" content="{{route('frontend.index')}}" />
    <meta property="og:image" content="{{asset('assets/images/logo/'.$gs->og_images)}} />
    <meta property="og:description" content="{{ $seo->meta_description }}" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}" type="image/x-icon">

	@if ($default_font->font_value)
		<link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}&display=swap" rel="stylesheet">
	@else 
		<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	@endif
  <!--==== BASE CSS ====-->
  <link href="{{asset('assets/frontend/asset/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/asset/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/frontend/asset/css/menu.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/frontend/asset/css/owl.carousel.css')}}" rel="stylesheet">
  <!--==== CUSTOM CSS ====-->
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
<!--/========== START SCROLLUP ============-->
<div class="scrollup">
  <i aria-hidden="true" class="fa fa-chevron-up"></i>
</div><!--back-to-top-->
<!--/========== END SCROLLUP ============-->
<header>
<script src="https://bangla.plus/scripts/bangladatetoday.min.js"></script>
<script>dateToday('date-today', 'bangla');</script>
@php
    function bn_date($str)
        {
         $en = array(1,2,3,4,5,6,7,8,9,0);
        $bn = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $str = str_replace($en, $bn, $str);
        $en = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
        $en_short = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' );
        $bn = array( 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর' );
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
 
 
 
 
     <!-- Header Part-->
    @include('partial.front.header')
    <!-- Header Part End-->
 
 
 
 
 
 
 

     <!--Content of each page-->
    @yield('contents')
	<!--Content of each page end-->





	<!-- Footer Area Start -->
	@include('partial.front.footer')
	<!-- Footer Area End -->



<!--===== JAVASCRIPT FILES =====-->
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
<script>
  $(function () {
    $('.marquee-bottom').marquee({
        duration: 40000,  // Changed from 15000 to 40000 (Slower)
        gap: 50,
        delayBeforeStart: 0,
        direction: 'left',
        duplicated: true,
        pauseOnHover: true
    });
  });
</script>
</body>

</html>
