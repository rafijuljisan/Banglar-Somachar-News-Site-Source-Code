/*=========================================

Template Name: alokitonews24.com
Author: Jonayed Islam
Version: 1.0
Design and Developed by: Bongosoft Ltd.
Url: http://bongosoftbd.com

=========================================*/

(function($) {
    "use strict";

    var $window = $(window),
        $body = $('body');
        /*==========================
            Back To Top
        ============================*/
        $(".scrollup").hide();
          $(window).scroll(function () {
            if ($(this).scrollTop() > 400) {
              $('.scrollup').fadeIn();
            } else {
              $('.scrollup').fadeOut();
            }
          });
          $('.scrollup').on('click', function () {
            $('body,html').animate({
              scrollTop: 0
            }, 800);
            return false;
          });
          /*==========================
              Toggle Search
          ============================*/
          $(".attr-nav").each(function(){
            $("li.search > a", this).on("click", function(e){
              e.preventDefault();
              $(".top-search").slideToggle();
              });
          });
          $(".input-group-addon.close-search").on("click", function(){
              $(".top-search").slideUp();
          });

          /*=================================
              NAVBAR STICKY
          ==================================*/
          $('.top-nav-main').sticky({
          topSpacing: 0
          });

          /*-------------------------------------
        Fetuered Videos jQuery activation code
        -------------------------------------*/
        $("#featured-videos-section").owlCarousel({
          // Navigation
          nav: true,
          loop: true,
          navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
          dots: false,
          autoplay: true,
          smartSpeed: 600,
          autoplayHoverPause: true,
          responsive:{
        		 0:{
        		   items:1 // In this configuration 1 is enabled from 0px up to 479px screen size
        		 },
        		 480:{
        		   items:1, // from 480 to 677
        		   center:false // only within 678 and next - 959
        		 },
        		 678:{
        		   items:2, // from this breakpoint 678 to 959
        		   center:false // only within 678 and next - 959
        		 },
        		 768:{
        		   items:2, // from this breakpoint 960 to 1199
        		   margin:20, // and so on...
        		   center:false
        		 },
        		 1200:{
        		   items:4,
        		   margin: 24
        		 }
           }
         });
         /*-------------------------------------
         PHOTO GALAERY ACTIVATION CODE
     -------------------------------------*/
       $("#gallery-images-section").owlCarousel({
           // Most important owl features
           items : 1,
           nav: true,
           navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
           loop: true,
           autoplay: true,
           smartSpeed: 800,
           autoplayHoverPause: true,
           // dots: false,
           // Responsive options
       })


  })(jQuery);
