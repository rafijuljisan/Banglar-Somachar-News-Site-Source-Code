jQuery(document).ready(function(){

    // --- YOUR EXISTING CODE STARTS HERE ---
    jQuery('#mega-canvas-close-link').on('click' ,function(e){
        jQuery('#sidebar').removeClass('active');
    });

    jQuery(window).scroll(function(){
        var windowScroll = jQuery(window).scrollTop();
        if (windowScroll >= 60) {
            jQuery('.demo-7').addClass('sticky');
        }
        else{
            jQuery('.demo-7').removeClass('sticky');
        }
    });

    //mega-canvas-link
    jQuery('#mega-canvas-link').on('click', function(e) {
        jQuery(this).toggleClass('active');
        jQuery('#sidebar').toggleClass('active');
        jQuery('.main-panel-container').toggleClass('show');
    });

    jQuery('.dropdown-menu .dropdown-toggle').on('click', function(e) {
        if (!jQuery(this).next().hasClass('show')) {
            jQuery(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        jQuery(this).next(".dropdown-menu").toggleClass('show');
        return false;
    });

    //for product mega menu
    jQuery('.product-heading').click(function(){
        if (!jQuery(this).next().hasClass('active')) {
            jQuery('.product-dropdown-list').removeClass('active');
            jQuery(this).next().addClass('active');
        }
        else if (jQuery(this).next().hasClass('active')) {
            jQuery(this).next().removeClass('active');
        }
        return false;
    });

    //for shop mega menu
    jQuery('.shop-heading').on('click' , function(){
        if (!jQuery(this).parent().parent().next().hasClass('active')) {
            jQuery('.shop-dropdown-list').removeClass('active');
            jQuery(this).parent().parent().next().addClass('active');
        }
        else if (jQuery(this).parent().parent().next().hasClass('active')) {
            jQuery(this).parent().parent().next().removeClass('active');
        }
        return false;
    });
    // --- YOUR EXISTING CODE ENDS HERE ---


    // --- NEW SIDEBAR CODE STARTS HERE ---
    
    // 1. Open Sidebar
    // This triggers when you click the menu icon (hamburger)
    jQuery('.sidebar-trigger').on('click', function() {
        jQuery('body').addClass('sidebar-is-open');
    });

    // 2. Close Sidebar
    // This triggers when you click the "X" button OR the dark background overlay
    jQuery('.close-sidebar-btn, .sidebar-overlay').on('click', function() {
        jQuery('body').removeClass('sidebar-is-open');
    });

	jQuery(document).ready(function($) {

		// 1. SIDEBAR TOGGLE
		// Open Sidebar
		$('.sidebar-trigger').on('click', function(e) {
			e.preventDefault(); // Stop any default link behavior
			$('#sidebarMenu').addClass('active');
			$('.sidebar-backdrop').addClass('active');
			$('body').css('overflow', 'hidden'); // Prevent background scrolling
		});

		// Close Sidebar (Clicking X or Backdrop)
		$('.sidebar-close-trigger').on('click', function(e) {
			e.preventDefault();
			$('#sidebarMenu').removeClass('active');
			$('.sidebar-backdrop').removeClass('active');
			$('body').css('overflow', 'auto'); // Restore scrolling
		});

		// 2. SEARCH POPUP TOGGLE
		// Open/Close Search Overlay
		$('.search-toggle').on('click', function(e) {
			e.preventDefault();
			var overlay = $('#search-overlay');
			
			if (overlay.hasClass('open')) {
				overlay.removeClass('open');
				setTimeout(function(){ overlay.hide(); }, 300); // Wait for fade out
			} else {
				overlay.show();
				// Small delay to allow CSS transition to catch the 'display:block'
				setTimeout(function(){ overlay.addClass('open'); }, 10);
				// Focus on input
				setTimeout(function(){ overlay.find('input').focus(); }, 100);
			}
		});

		// Close search on ESC key
		$(document).keyup(function(e) {
			if (e.key === "Escape") {
				$('#search-overlay').removeClass('open');
				setTimeout(function(){ $('#search-overlay').hide(); }, 300);
				
				// Also close sidebar
				$('#sidebarMenu').removeClass('active');
				$('.sidebar-backdrop').removeClass('active');
				$('body').css('overflow', 'auto');
			}
		});
		
		// 3. HORIZONTAL NAV JUSTIFICATION (Mobile Fix)
		// Ensure dropdowns don't overflow on mobile
		if ($(window).width() < 768) {
			$('.navbar-nav .dropdown-menu').css('width', '100%');
		}

	});
    // --- NEW SIDEBAR CODE ENDS HERE ---

});