jQuery(document).ready(function(){

   if( ampleScriptParam.enable_sticky_menu == '1' ) {
      var headerheight = jQuery('.header').outerHeight();
      jQuery('#masthead').css('height', headerheight);
   }

   // For one page active menu item.
   jQuery(".main-navigation div ul li").click(function() {
     jQuery(".main-navigation div ul li").removeClass("current-one-page-menu-item");
     jQuery(this).addClass("current-one-page-menu-item");
   });

   //toggle menu when menu items clicked for one page
    jQuery("#menu-one-page li").click(function() {
     jQuery('#site-navigation').addClass('main-navigation').removeClass('main-small-navigation');
   });

   // For smooth scroll
   jQuery("a[href*='#']").mPageScroll2id();
   jQuery("a[rel='m_PageScroll2id']").mPageScroll2id({
     offset:"#masthead"
   });

   // For Search Icon Toggle effect added at the top
   jQuery(".search-top").click(function(){
      jQuery("#masthead .search-form-top").toggle();
   });

   // For Scroll to top button
   jQuery("#scroll-up").hide();
   jQuery(function () {
      jQuery(window).scroll(function () {
         if (jQuery(this).scrollTop() > 1000) {
            jQuery('#scroll-up').fadeIn();
         } else {
            jQuery('#scroll-up').fadeOut();
         }
      });
      jQuery('a#scroll-up').click(function () {
         jQuery('body,html').animate({
            scrollTop: 0
         }, 800);
         return false;
      });
   });

});