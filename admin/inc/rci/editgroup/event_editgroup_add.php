
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Events Access</label>
                    <div class="access-slider">
                      <div style="height:25px;">
                        <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                        <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                        <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                        <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                        <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                      </div>
                      <div id="accessSliderEvents" style="clear:both;"></div>
                    </div>
                  </div>
                </div>
                <input type="hidden" value="<?php echo $_SESSION['editaccess']; ?>" name="events" id="events" />
                <?php
                  if ($_SESSION['editaccess'] == 4) {
                    $eventSlider = '100';
                  } else if ($_SESSION['editaccess'] == 3) {
                    $eventSlider = '75';
                  } else if ($_SESSION['editaccess'] == 2) {
                    $eventSlider = '50';
                  } else if ($_SESSION['editaccess'] == 1) {
                    $eventSlider = '25';
                  } else if ($_SESSION['editaccess'] == 0) {
                    $eventSlider = '0';
                  }
                ?>
                <script>   
                  $(document).ready(function(){
                    $("#accessSliderEvents").slider({
                      range: true,
                      max: 4,
                      slide: function(event, ui) {
                        if (!allowedAccessValues[ui.value]) return false;
                      },
                      change: function(event, ui){
                        $("#events").val(ui.value);
                      }
                    });    
                    $("#accessSliderEvents a:first").remove();
                    $("#accessSliderEvents .ui-slider-range").css("left", "0%").css("width", "<?php echo $eventSlider; ?>%");        
                    $("#accessSliderEvents .ui-slider-handle").css("left", "<?php echo $eventSlider; ?>%");
                  });
                </script>
