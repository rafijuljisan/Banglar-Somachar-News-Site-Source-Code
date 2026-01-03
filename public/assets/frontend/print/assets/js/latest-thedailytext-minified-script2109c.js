/*!
 * Name			: Minified Script 2
 * Author		: Md Maruf Adnan Sami
 * Author URL	: https://facebook.com/RealboyAdnan
 * Website		: https://softclever.com
 * Version		: 7.0.0
 * Copyright	: 2010 SoftClever Limited.
 
  _______ _          _____        _ _    _______        _   
 |__   __| |        |  __ \      (_) |  |__   __|      | |  
    | |  | |__   ___| |  | | __ _ _| |_   _| | _____  _| |_ 
    | |  | '_ \ / _ \ |  | |/ _` | | | | | | |/ _ \ \/ / __|
    | |  | | | |  __/ |__| | (_| | | | |_| | |  __/>  <| |_ 
    |_|  |_| |_|\___|_____/ \__,_|_|_|\__, |_|\___/_/\_\\__|
                                       __/ |                
                                      |___/                  
 
 */
 
$(function($){"use strict";$(window).on('load',function(){setTimeout(()=>{$('#dataloader').addClass('loaded');},1000);});$('.dataloader-cancel-btn').on('click',function(event){event.preventDefault();if(!$('#dataloader').hasClass('loaded')){$('#dataloader').addClass('loaded');}});$(window).on('scroll',function(){if($(window).scrollTop()>250){$('.ts-menu-sticky').addClass('sticky fade_down_effect');}else{$('.ts-menu-sticky').removeClass('sticky fade_down_effect');}});if($(".header-search").length>0){var todg=true;$(".header-search >a").on("click",function(e){e.preventDefault();if(todg){$(".header-search-form").fadeIn("slow");todg=false;}else{$(".header-search-form").fadeOut("slow");todg=true;}});$(document).on('mouseup',function(e){var container=$(".header-search");if(!container.is(e.target)&&container.has(e.target).length===0){$(".header-search-form").fadeOut("slow");todg=true;}});}
if($('.ts-main-menu').length>0){$(".ts-main-menu").navigation({effect:"fade",mobileBreakpoint:992,});}
if($('#breaking_slider').length>0){$('#breaking_slider').owlCarousel({items:1,loop:true,dots:false,nav:true,animateOut:'slideOutLeft',animateIn:'flipInX',autoplayTimeout:7000,autoplay:true,})}
if($('#featured-slider').length>0){$('#featured-slider').owlCarousel({loop:true,items:1,dots:false,nav:true,autoplayTimeout:7000,autoplay:true,animateOut:'slideOutLeft',navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],responsiveClass:true});}
if($('#featured-slider-2').length>0){$('#featured-slider-2').owlCarousel({loop:true,items:1,dots:true,nav:false,autoplayTimeout:10000,autoplay:true,responsiveClass:true,animateOut:'slideOutLeft',});}
if($('#featured-slider-3').length>0){$('#featured-slider-3').owlCarousel({items:1,dots:true,nav:true,autoplayTimeout:7000,autoplay:true,animateOut:'slideOutLeft',autoplay:true,responsiveClass:true,});}
if($('#featured-slider-4').length>0){$('#featured-slider-4').owlCarousel({items:1,dots:false,nav:true,autoplayTimeout:7000,autoplay:true,animateOut:'slideOutLeft',autoplay:true,responsiveClass:true,navText:["<i class='icon-arrow-left'></i>","<i class='icon-arrow-right'></i>"],});}
if($('#featured-slider-5').length>0){$('#featured-slider-5').owlCarousel({items:1,dots:true,nav:true,autoplayTimeout:7000,autoplay:true,animateOut:'slideOutLeft',autoplay:true,responsiveClass:true,});}
if($('#featured-slider-6').length>0){$('#featured-slider-6').owlCarousel({loop:true,items:1,dots:false,nav:false,autoplayTimeout:8000,autoplay:true,responsiveClass:true,animateOut:'slideOutLeft',});}
if($('.most-populers').length>0){$('.most-populers').owlCarousel({items:3,dots:false,loop:true,nav:true,margin:30,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],responsive:{0:{items:1,},480:{items:2,},768:{items:2,},1200:{items:3,}}});}
if($('#hot-topics-slider').length>0){$('#hot-topics-slider').owlCarousel({nav:false,items:4,margin:30,reponsiveClass:true,dots:true,responsive:{0:{items:1,},480:{items:2,},768:{items:2,},1200:{items:4,}}});}
if($('#more-news-slider').length>0){$('#more-news-slider').owlCarousel({nav:false,items:3,margin:30,reponsiveClass:true,dots:true,slideSpeed:600,responsive:{0:{items:1,},480:{items:2,},768:{items:2,},1200:{items:3,}}});}
if($("#hero-slider").length>0){$("#hero-slider").owlCarousel({margin:10,loop:true,dots:true,nav:true,autoplay:true,items:1,animateOut:'slideOutLeft',navText:["<i class='icon-arrow-left'></i>","<i class='icon-arrow-right'></i>"],});$('#hero-slider .owl-dots').wrap('<div class="container slider-dot-item"><div class="row"><div class="col-lg-9"></div></div></div>');$('#hero-slider .owl-nav').wrap('<div class="container slider-arrow-item"><div class="row"><div class="col-lg-9"></div></div></div>');}
$("#post-slider1").owlCarousel({margin:10,loop:true,dots:false,nav:true,autoplay:true,autoplaySpeed:3000,items:1,animateOut:'fadeOut',navText:["<i class='icon-arrow-left'></i>","<i class='icon-arrow-right'></i>"],});$(".blog-post-slider-item").owlCarousel({margin:10,dots:false,nav:true,items:1,animateOut:'fadeOut',navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],});if($('.slick.marquee').length>0){$('.slick.marquee').slick({speed:5000,autoplay:true,autoplaySpeed:0,centerMode:true,cssEase:'linear',slidesToShow:1,slidesToScroll:1,variableWidth:true,infinite:true,initialSlide:1,arrows:false,buttons:false});}
if($('#breaking_slider1').length>0){$('#breaking_slider1').slick({speed:5000,autoplay:true,autoplaySpeed:0,centerMode:true,cssEase:'linear',slidesToShow:1,slidesToScroll:1,variableWidth:true,infinite:true,initialSlide:1,arrows:false,buttons:false});}
if($('.gallery-popup').length>0){$('.gallery-popup').magnificPopup({type:'image',mainClass:'mfp-with-zoom',zoom:{enabled:true,duration:300,easing:'ease-in-out',opener:function(openerElement){return openerElement.is('img')?openerElement:openerElement.find('img');}}});}
if($('.ts-play-btn').length>0){$('.ts-play-btn').magnificPopup({type:'iframe',mainClass:'mfp-with-zoom',zoom:{enabled:true,duration:300,easing:'ease-in-out',opener:function(openerElement){return openerElement.is('img')?openerElement:openerElement.find('img');}}});}
if($('.ts-video-btn').length>0){$('.ts-video-btn').magnificPopup({type:'iframe',mainClass:'mfp-with-zoom',zoom:{enabled:true,duration:300,easing:'ease-in-out',opener:function(openerElement){return openerElement.is('img')?openerElement:openerElement.find('img');}}});}
if($('.ts-video-icon').length>0){$('.ts-video-icon').magnificPopup({type:'iframe',mainClass:'mfp-with-zoom',zoom:{enabled:true,duration:300,easing:'ease-in-out',opener:function(openerElement){return openerElement.is('img')?openerElement:openerElement.find('img');}}});}
$(document).ready(function(){var s=$('.video-slider'),sWrapper=s.find('.slider-wrapper'),sItem=s.find('.slide'),btn=s.find('.slider-link'),sWidth=sItem.width(),sCount=sItem.length,slide_date=s.find('.slide-date'),slide_title=s.find('.slide-title'),slide_text=s.find('.slide-text'),slide_more=s.find('.slide-more'),slide_image=s.find('.slide-image img'),sTotalWidth=sCount*sWidth;sWrapper.css('width',sTotalWidth);sWrapper.css('width',sTotalWidth);var clickCount=0;btn.on('click',function(e){e.preventDefault();if($(this).hasClass('next')){(clickCount<(sCount-1))?clickCount++:clickCount=0;}else if($(this).hasClass('prev')){(clickCount>0)?clickCount--:(clickCount=sCount-1);}
TweenMax.to(sWrapper,0.4,{x:'-'+(sWidth*clickCount)})
var fromProperties={autoAlpha:0,x:'-50',y:'-10'};var toProperties={autoAlpha:0.8,x:'0',y:'0'};TweenLite.fromTo(slide_image,1,{autoAlpha:0,y:'40'},{autoAlpha:1,y:'0'});TweenLite.fromTo(slide_date,0.4,fromProperties,toProperties);TweenLite.fromTo(slide_title,0.6,fromProperties,toProperties);TweenLite.fromTo(slide_text,0.8,fromProperties,toProperties);TweenLite.fromTo(slide_more,1,fromProperties,toProperties);});});if($("#video-tab-scrollbar").length>0){$("#video-tab-scrollbar").mCustomScrollbar({mouseWheel:true,scrollButtons:{enable:true}});}});