 jQuery(document).ready(function(){

   var transition_effect = ample_slider_value.transition_effect;
   var transition_delay = ample_slider_value.transition_delay;
   var transition_duration = ample_slider_value.transition_duration;
   var slider = jQuery('.big-slider').bxSlider({
      mode: transition_effect,
      speed: transition_duration,
      auto: true,
      pause: transition_delay,
      adaptiveHeight: true,
      nextText: '',
      prevText: '',
      nextSelector: '.slide-next',
      prevSelector: '.slide-prev',
      pager: false,
      autoHover: true
   });
   jQuery('.bx-next, .bx-prev').click(function(e){
      slider.stopAuto();
      setTimeout( function(){
            slider.startAuto();
         },1000
      );
   return false;
   });
 });