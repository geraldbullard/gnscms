jQuery(function($){
  $(document).ready(function(){    
    $(".prettyphoto-link").prettyPhoto({
      animation_speed: 'fast',
      theme: lightboxLocalize.theme,
      show_title: false,
      social_tools: false,
      slideshow: false,
      autoplay_slideshow: false,
      wmode: 'opaque'
    });
    $("a[rel^='prettyPhoto']").prettyPhoto({
      animation_speed: 'fast',
      theme: lightboxLocalize.theme,
      show_title: false,
      social_tools: false,
      autoplay_slideshow: false,
      overlay_gallery: true,
      wmode: 'opaque'  
    });    
  });
});