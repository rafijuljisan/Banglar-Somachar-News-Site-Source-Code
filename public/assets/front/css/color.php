<?php
header("Content-type: text/css; charset: UTF-8");
    if(isset($_GET['base_color'])){
        $base_color = '#'.$_GET['base_color'];
    }else{
        $base_color = '#9C27B0';
    }
    if(isset($_GET['footer_color'])){
        $footer_color = '#'.$_GET['footer_color'];
    }else{
        $footer_color = '#101d29';
		}
    if(isset($_GET['copyright_color'])){
        $copyright_color = '#'.$_GET['copyright_color'];
    }else{
        $copyright_color = '#060f16';
    }
?>
.top-nav-sports {
  background: <?php echo $base_color ?>;
  z-index: 9;
  width: 100%;
}

.marquee-block h2 {
  font-size: 20px;
  margin: 0;
  line-height: 24px;
  position: absolute;
  background: <?php echo $base_color ?>;
  color: #fff;
  padding: 6px 10px;
}

.marquee-block h2:after {
  content: "";
  position: absolute;
  left: 84px;
  border-left: 20px solid <?php echo $base_color ?>;
  border-top: 36px solid transparent;
  clear: both;
  top: 0;
}
.marquee {
  width: 100%;
  overflow: hidden;
  background: #fff;
  list-style: none;
  display: inline-block;
  padding: 0;
  border: 1px solid <?php echo $base_color ?>;
  margin-bottom: 12px;
}
.top-nav-sports .navbar-nav .nav-item .nav-link:hover {
  background: <?php echo $base_color ?>;
}
.special-event-heading .title {
  position: relative;
  overflow: hidden;
  margin: 0 0 10px 0;
  font-size: 28px;
  border-left: 5px solid <?php echo $base_color ?>;
  line-height: 36px;
  padding-left: 10px;
}

.special-event-heading .title .liner:before {
  position: absolute;
  content: "";
  width: 100%;
  border-top: 5px dashed <?php echo $base_color ?>;
  top: 12px;
  display: inline-block;
  vertical-align: bottom;
}
.special-event-heading .title .liner:after {
  position: absolute;
  content: "";
  width: 100%;
  border-top: 5px dashed <?php echo $base_color ?>;
  top: 21px;
  display: inline-block;
  vertical-align: bottom;
}
.map-heading h2 {
  background: <?php echo $base_color ?>;
  color: #fff;
  font-size: 24px;
  line-height: 30px;
  padding: 5px;
}

.namaj-time-heading h2 {
  background: <?php echo $base_color ?>;
  color: #fff;
  font-size: 24px;
  line-height: 30px;
  padding: 5px;
  margin: 0;
}

.footer-new {
  /* background-color: #424242; */
  background-color: <?php echo $footer_color ?>;
  color: #fff;
  padding: 40px 0 25px 0px;
}










.menu-section {
	background: <?php echo $copyright_color ?>;
	-webkit-box-shadow: 0 0 6px rgba(0,0,0,0.3);
	box-shadow: 0 2px 3px rgba(0,0,0,0.3);
	margin-bottom: 15px;
	position: relative;
}
.footer-area {
	background: <?php echo $footer_color ?>;
	padding: 40px 0 20px;
	margin-top: 40px;
}
.mainmenu-area .navbar #main_menu .navbar-nav .nav-link.active, .mainmenu-area .navbar #main_menu .navbar-nav .nav-link:hover {
    color: <?php echo $base_color?>;
}

.top-header .content {
    border-bottom: 1px solid <?php echo $base_color?>;
}

.top-header .content .left-content .heading {
    background: <?php echo $base_color?>;
}

.top-header .content .right-content {
    background: <?php echo $base_color?>;
}

.home-front-area .aside-tab .nav li a.active {
    background: <?php echo $base_color?>;
}

.header-area .title {
    color: <?php echo $base_color?>;
}


.pignose-calender .pignose-calender-top {
    background-color:<?php echo $base_color?>!important;
}

.pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-active a {
    background: <?php echo $base_color?>;
    color: #fff !important;
}

.pignose-calender .pignose-calender-header .pignose-calender-week.pignose-calender-week-sun, 
.pignose-calender .pignose-calender-header .pignose-calender-week.pignose-calender-week-sat, 
 .pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-sat a,
 .pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-sun a
  {
    color: #000 !important;
}
.pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-active a{
    color: #fff!important;
}
.home-front-area .main-content.tab-view .nav .nav-link.active {
    color: <?php echo $base_color?>;
}

.aside-newsletter-widget .subscribe-form .submit {
    background: <?php echo $base_color?>;
}

.home-front-area .main-content.tab-view .nav .nav-link::before {
    background: <?php echo $base_color?>;
}

.home-front-area .main-content.tab-view .nav .nav-link::before {
    background: <?php echo $base_color?>;
}



.featured-news .owl-controls .owl-dots .owl-dot.active {
    background: <?php echo $base_color?>;
}

.mybtn1 {
    background: <?php echo $base_color?>;
}

.footer {
    background: <?php echo $copyright_color ?>;
}

.footer .copy-bg {
    background: <?php echo $copyright_color ?>;
}
.bottomtotop i {
    background: <?php echo $base_color?>;
}

.footer .footer-widget ul li a:hover {
  color: <?php echo $base_color?>;
}

.footer .fotter-social-links ul li a:hover {
  background: <?php echo $base_color?>;
}

.footer .tags-widget .tag-list li a:hover {
  background: <?php echo $base_color?>;
  border-color: <?php echo $base_color?>;
}

.footer .copy-bg .content .content p a {
    color: <?php echo $base_color?>;
}

.home-front-area .tags-widget .tag-list li a:hover {
  background: <?php echo $base_color?>;
}

.comment-log-reg-tabmenu .nav-tabs .nav-link.active {
    background:<?php echo $base_color?>;
}

.login-area .submit-btn {
    background:<?php echo $base_color?>;
}

.login-area .log-reg-header-area .title {
    color: <?php echo $base_color?>;
}

.login-area .form-input i {
    color: <?php echo $base_color?>;
}

.login-area .log-reg-social-area .title {
    color: <?php echo $base_color?>;
}

.single-news .content-wrapper .img .vid-aud {
    background: <?php echo $base_color?>;
}

.single-box.landScape-small-with-meta .img .vid-aud {
    background: <?php echo $base_color?>;
}

.more-news .single-news.land-scap-medium .img .vid-aud {
    background: <?php echo $base_color?>;
}
.mainmenu-area .navbar #main_menu .navbar-nav .nav-item.mega-menu .nav .nav-link:hover {
    border-left: 3px solid <?php echo $base_color?>;
}

.header-area .title::before {
  background: <?php echo $base_color?>;
}

.single-news.big .content-wrapper .vid-aud {
    background: <?php echo $base_color?>;
}


.single-news-menu .content-wrapper .vid-aud {
    background: <?php echo $base_color?>;
}

.widget-slider.owl-carousel .owl-controls .owl-nav .owl-prev, .widget-slider.owl-carousel .owl-controls .owl-nav .owl-next {
    border: 1px solid <?php echo $base_color?>;
    border-radius: 50%;
    color: <?php echo $base_color?>;
}

.sub-categori-author .left-area .select-option .header-area {
    background: <?php echo $base_color?>;
}

.sub-categori-author .left-area .filter-result-area .header-area {
    background: <?php echo $base_color?>;
}

.breadcrumb-area .pages li.active a {
    color: <?php echo $base_color?>;
}

.page-item.active .page-link{
    background-color: <?php echo $base_color?>;
    border-color: <?php echo $base_color?>;
}

.page-link {
    color: <?php echo $base_color?>;
}

.custom-control-input:checked~.custom-control-label::before {
    border-color: <?php echo $base_color?>;
    background-color: <?php echo $base_color?>;
}

.single-box.landScape-small-with-meta .content .post-meta li a:hover {
    color: <?php echo $base_color?>;
}

.breadcrumb-area .pages li a:hover {
    color: <?php echo $base_color?>;
}

.news-details-page .details-post .single-news .content .post-meta li a:hover {
    color: <?php echo $base_color?>;
}

.categori-widget-area .categori-list a:hover {
    color: <?php echo $base_color?>;
}