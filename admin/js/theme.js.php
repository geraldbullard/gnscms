<script>
  $(document).ready(function(){
    // set the background of the theme gallery thumbnail image to match what is in the css
    var thumbWidth = $(".thumbnail img").width();
    $(".thumbnail a").css("background-size", "150px");
    //gallery colorbox
    $('.thumbnail a').colorbox({rel:'thumbnail a', transition:"elastic", maxWidth:"95%", maxHeight:"95%"});
    // tabs
    $('#currentThemeTab a:first').tab('show');
    $('#currentThemeTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });
</script>
