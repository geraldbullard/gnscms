
<script>
  // access sliders
  var allowedAccessValues = {
    0: true,
    1: true,
    2: true,
    3: true,
    4: true
  };
</script>
<?php
  $results['group'] = Group::getById( (int)$_GET['groupId'] );
  foreach ($results['group'] as $group => $val) {
    if ($group != 'id' && $group != 'title' && $group != 'status') {        
      if ($results['group']->$group == 4) {
        $slider = '100';
      } else if ($results['group']->$group == 3) {
        $slider = '75';
      } else if ($results['group']->$group == 2) {
        $slider = '50';
      } else if ($results['group']->$group == 1) {
        $slider = '25';
      } else if ($results['group']->$group == 0) {
        $slider = '0';
      }
?>
<script>   
  $(document).ready(function(){
    $("#accessSlider<?php echo ucfirst($group); ?>").slider({
      range: true,
      max: 4,
      slide: function(event, ui) {
        if (!allowedAccessValues[ui.value]) return false;
      },
      change: function(event, ui){
        $("#<?php echo $group; ?>").val(ui.value);
      }
    });    
    $("#accessSlider<?php echo ucfirst($group); ?> a:first").remove();
    $("#accessSlider<?php echo ucfirst($group); ?> .ui-slider-range").css("left", "0%").css("width", "<?php echo $slider; ?>%");        
    $("#accessSlider<?php echo ucfirst($group); ?> .ui-slider-handle").css("left", "<?php echo $slider; ?>%");
  });
</script>
<?php
    }        
  }
?>