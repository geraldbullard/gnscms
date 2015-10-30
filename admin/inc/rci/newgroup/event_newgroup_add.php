
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
                <input type="hidden" value="" name="events" id="events" />
                <script>
                  $(document).ready(function(){
                    var allowedAccessValues = {
                      0: true,
                      1: true,
                      2: true,
                      3: true,
                      4: true
                    };
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
                  });
                </script>