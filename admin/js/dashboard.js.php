<script>
  $(document).ready(function(){
    // tabs
    $('#dashboardTab a:first').tab('show');
    $('#dashboardTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
    
    var allowedAccessValues = {
      0: true,
      1: true,
      2: true,
      3: true,
      4: true,
      5: true
    };
    
    $(".accessSlider").slider({
      range: true,
      values: [0],
      max: 5,
      slide: function(event, ui) {
        if (!allowedAccessValues[ui.value]) return false;
      },
      change: function(event, ui){
        $("#accessSliderValue").val(ui.value);
        alert('Value is: ' + ui.value);
      }
    });
    
    $(".accessSlider a:first").remove();
  });
</script>
