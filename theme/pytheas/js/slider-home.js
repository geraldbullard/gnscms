jQuery(function($){
  $(window).load(function() {
    $('#home-slider-loader').hide();
    if(flexLocalize.slideshow == "true") flexLocalize.slideshow = true; else flexLocalize.slideshow = false;
    if(flexLocalize.randomize == "true") flexLocalize.randomize = true; else flexLocalize.randomize = false;    
    $('#home-slider.flexslider').flexslider({
      slideshow : flexLocalize.slideshow,
      randomize : flexLocalize.randomize,
      animation : flexLocalize.animation,
      direction : flexLocalize.direction,
      slideshowSpeed : flexLocalize.slideshowSpeed,
      animationSpeed : flexLocalize.animationSpeed,
      smoothHeight : true,
      controlNav : true,
      prevText : '<span class=" icon-angle-left"></span>',
      nextText : '<span class="icon-angle-right"></span>'
    });    
  });
});