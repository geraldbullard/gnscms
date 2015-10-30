jQuery( function($) {
  $(document).ready(function(){
    
    $(".nav-menu").not(":first").removeClass("nav-menu");  
    $(".current-menu-item").parents('li').addClass("current-menu-item");
    
    // Scroll back to top  
    function wpexBackTopScroll() {
      
      $( 'a[href=#top]' ).on('click', function() {
        $( 'html, body' ).animate({scrollTop:0}, 'normal');
        return false;
      } );
    
    }
    
    // Scroll to comments  
    function wpexCommentScroll() {
      
      $( '.comment-scroll a' ).click( function(event) {    
        event.preventDefault();
        $( 'html,body' ).animate( {
          scrollTop: $( this.hash ).offset().top
          }, 'normal' );
      } );
      
    }
    
    // Responsive navbar
    function wpexResponsiveNav() {
      var nav = $( '#site-navigation' ), button, menu;
      $( '.nav-toggle' ).on( 'click', function() {  
        $( '.nav-menu' ).toggleClass( 'toggled-on' );
        $( '.nav-toggle' ).find('.toggle-icon').toggleClass('icon-arrow-down icon-arrow-up');
      } );
    }
    
    // Fire functions
    wpexBackTopScroll();
    wpexCommentScroll();
    wpexResponsiveNav();
  
  });
});