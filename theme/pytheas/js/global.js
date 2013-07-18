jQuery( function($) {
  $(document).ready(function(){
    
    $('ul').removeClass("nav-menu");
    $('ul:first').addClass("nav-menu");
    
    // Responsive navbar
    function wpexResponsiveNav() {
      var nav = $( '#site-navigation' ), button, menu;
      $( '.nav-toggle' ).on( 'click', function() {
        $( '.nav-menu' ).toggleClass( 'toggled-on' );
        $( '.nav-toggle' ).find('.toggle-icon').toggleClass('icon-arrow-down icon-arrow-up');
      } );
    }
    
    // Fire functions
    wpexResponsiveNav();
  
  });
});