    <div class="row-fluid">
      <div id="leftNav" class="box span3" style="margin-bottom:15px;">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Navigation</h2>
          <div class="box-icon">
            <i class="icon-chevron-left" onclick="toggleLeftNav();" style="margin:6px 20px 0px -35px; cursor:pointer;" title="Hide Navigation"></i>
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <?php include('inc/menu.php'); ?>  
        </div>
      </div>
      <div id="rightContent" class="box span9">
        <div class="box-header well">
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Edit Group : : <?php echo $results['group']->title; ?></h2>
          <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <?php if ( isset( $results['errorMessage'] ) ) { ?>
          <div class="alert alert-error" id="errorMessage">
            <button class="close" data-dismiss="alert" type="button">x</button>
            <?php echo $results['errorMessage'] ?>
          </div>
          <?php } ?>           
          <div class="row-fluid span12" id="editBlock">
            <form action="index.php?action=editGroup&editId=<?php echo $results['group']->id; ?>" name="editGroup" method="post">
              <input type="hidden" name="id" value="<?php echo $results['group']->id; ?>"/> 
              <div class="row-fluid">
                <div class="span4">
                  <label>Group Name</label>
                  <input class="text-input span12" type="text" id="title" name="title" value="<?php echo htmlspecialchars( $results['group']->title ); ?>" required autofocus />
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div class="row-fluid">
                <div class="span6">
                  <label>Content Access</label>
                  <div class="access-slider">
                    <div style="height:25px;">
                      <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                      <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                    </div>
                    <div id="accessSliderContent" style="clear:both;"></div>
                  </div>
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div class="row-fluid">
                <div class="span6">
                  <label>Themes Access</label>
                  <div class="access-slider">
                    <div style="height:25px;">
                      <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                      <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                    </div>
                    <div id="accessSliderThemes" style="clear:both;"></div>
                  </div>
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div class="row-fluid">
                <div class="span6">
                  <label>Gallery Access</label>
                  <div class="access-slider">
                    <div style="height:25px;">
                      <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                      <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                    </div>
                    <div id="accessSliderGallery" style="clear:both;"></div>
                  </div>
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div class="row-fluid">
                <div class="span6">
                  <label>File Manager Access</label>
                  <div class="access-slider">
                    <div style="height:25px;">
                      <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                      <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                    </div>
                    <div id="accessSliderFileManager" style="clear:both;"></div>
                  </div>
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div class="row-fluid">
                <div class="span6">
                  <label>Settings Access</label>
                  <div class="access-slider">
                    <div style="height:25px;">
                      <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                      <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                    </div>
                    <div id="accessSliderSettings" style="clear:both;"></div>
                  </div>
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div class="row-fluid">
                <div class="span6">
                  <label>Users Access</label>
                  <div class="access-slider">
                    <div style="height:25px;">
                      <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                      <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                    </div>
                    <div id="accessSliderUsers" style="clear:both;"></div>
                  </div>
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div style="clear:both;"></div>
              <input type="hidden" value="<?php echo $results['group']->dashboard; ?>" name="dashboard" id="dashboard" />
              <input type="hidden" value="<?php echo $results['group']->content; ?>" name="content" id="content" />
              <input type="hidden" value="<?php echo $results['group']->themes; ?>" name="themes" id="themes" />
              <input type="hidden" value="<?php echo $results['group']->gallery; ?>" name="gallery" id="gallery" />
              <input type="hidden" value="<?php echo $results['group']->files; ?>" name="files" id="files" />
              <input type="hidden" value="<?php echo $results['group']->settings; ?>" name="settings" id="settings" />
              <input type="hidden" value="<?php echo $results['group']->users; ?>" name="users" id="users" />
              <input type="hidden" name="status" value="<?php echo $results['group']->status; ?>"/>
              <div class="row-fluid span12" style="margin:0 0 10px 0;">
                <div style="float:left;">
                  <input class="btn btn-primary" type="submit" name="saveChanges" value="Save Changes" /> &nbsp; <input class="btn btn-primary" type="submit" formnovalidate name="cancel" value="Cancel" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
    <?php
      if ($results['group']->content == 4) {
        $contentSlider = '100';
      } else if ($results['group']->content == 3) {
        $contentSlider = '75';
      } else if ($results['group']->content == 2) {
        $contentSlider = '50';
      } else if ($results['group']->content == 1) {
        $contentSlider = '25';
      } else if ($results['group']->content == 0) {
        $contentSlider = '0';
      }
      if ($results['group']->themes == 4) {
        $themesSlider = '100';
      } else if ($results['group']->themes == 3) {
        $themesSlider = '75';
      } else if ($results['group']->themes == 2) {
        $themesSlider = '50';
      } else if ($results['group']->themes == 1) {
        $themesSlider = '25';
      } else if ($results['group']->themes == 0) {
        $themesSlider = '0';
      }
      if ($results['group']->gallery == 4) {
        $gallerySlider = '100';
      } else if ($results['group']->gallery == 3) {
        $gallerySlider = '75';
      } else if ($results['group']->gallery == 2) {
        $gallerySlider = '50';
      } else if ($results['group']->gallery == 1) {
        $gallerySlider = '25';
      } else if ($results['group']->gallery == 0) {
        $gallerySlider = '0';
      }
      if ($results['group']->files == 4) {
        $filesSlider = '100';
      } else if ($results['group']->files == 3) {
        $filesSlider = '75';
      } else if ($results['group']->files == 2) {
        $filesSlider = '50';
      } else if ($results['group']->files == 1) {
        $filesSlider = '25';
      } else if ($results['group']->files == 0) {
        $filesSlider = '0';
      }
      if ($results['group']->settings == 4) {
        $settingsSlider = '100';
      } else if ($results['group']->settings == 3) {
        $settingsSlider = '75';
      } else if ($results['group']->settings == 2) {
        $settingsSlider = '50';
      } else if ($results['group']->settings == 1) {
        $settingsSlider = '25';
      } else if ($results['group']->settings == 0) {
        $settingsSlider = '0';
      }
      if ($results['group']->users == 4) {
        $usersSlider = '100';
      } else if ($results['group']->users == 3) {
        $usersSlider = '75';
      } else if ($results['group']->users == 2) {
        $usersSlider = '50';
      } else if ($results['group']->users == 1) {
        $usersSlider = '25';
      } else if ($results['group']->users == 0) {
        $usersSlider = '0';
      }
    ?>
    <script>   
      $(document).ready(function(){
        // access sliders
        var allowedAccessValues = {
          0: true,
          1: true,
          2: true,
          3: true,
          4: true
        };
        $("#accessSliderContent").slider({
          range: true,
          max: 4,
          slide: function(event, ui) {
            if (!allowedAccessValues[ui.value]) return false;
          },
          change: function(event, ui){
            $("#content").val(ui.value);
          }
        });    
        $("#accessSliderContent a:first").remove();
        $("#accessSliderContent .ui-slider-range").css("left", "0%").css("width", "<?php echo $contentSlider; ?>%");        
        $("#accessSliderContent .ui-slider-handle").css("left", "<?php echo $contentSlider; ?>%");        
        $("#accessSliderThemes").slider({
          range: true,
          max: 4,
          slide: function(event, ui) {
            if (!allowedAccessValues[ui.value]) return false;
          },
          change: function(event, ui){
            $("#themes").val(ui.value);
          }
        });    
        $("#accessSliderThemes a:first").remove();
        $("#accessSliderThemes .ui-slider-range").css("left", "0%").css("width", "<?php echo $themesSlider; ?>%");        
        $("#accessSliderThemes .ui-slider-handle").css("left", "<?php echo $themesSlider; ?>%");        
        $("#accessSliderGallery").slider({
          range: true,
          max: 4,
          slide: function(event, ui) {
            if (!allowedAccessValues[ui.value]) return false;
          },
          change: function(event, ui){
            $("#gallery").val(ui.value);
          }
        });    
        $("#accessSliderGallery a:first").remove();
        $("#accessSliderGallery .ui-slider-range").css("left", "0%").css("width", "<?php echo $gallerySlider; ?>%");        
        $("#accessSliderGallery .ui-slider-handle").css("left", "<?php echo $gallerySlider; ?>%");        
        $("#accessSliderFileManager").slider({
          range: true,
          max: 4,
          slide: function(event, ui) {
            if (!allowedAccessValues[ui.value]) return false;
          },
          change: function(event, ui){
            $("#files").val(ui.value);
          }
        });    
        $("#accessSliderFileManager a:first").remove();
        $("#accessSliderFileManager .ui-slider-range").css("left", "0%").css("width", "<?php echo $filesSlider; ?>%");        
        $("#accessSliderFileManager .ui-slider-handle").css("left", "<?php echo $filesSlider; ?>%");        
        $("#accessSliderSettings").slider({
          range: true,
          max: 4,
          slide: function(event, ui) {
            if (!allowedAccessValues[ui.value]) return false;
          },
          change: function(event, ui){
            $("#settings").val(ui.value);
          }
        });    
        $("#accessSliderSettings a:first").remove();
        $("#accessSliderSettings .ui-slider-range").css("left", "0%").css("width", "<?php echo $settingsSlider; ?>%");        
        $("#accessSliderSettings .ui-slider-handle").css("left", "<?php echo $settingsSlider; ?>%");        
        $("#accessSliderUsers").slider({
          range: true,
          max: 4,
          slide: function(event, ui) {
            if (!allowedAccessValues[ui.value]) return false;
          },
          change: function(event, ui){
            $("#users").val(ui.value);
          }
        });    
        $("#accessSliderUsers a:first").remove();
        $("#accessSliderUsers .ui-slider-range").css("left", "0%").css("width", "<?php echo $usersSlider; ?>%");        
        $("#accessSliderUsers .ui-slider-handle").css("left", "<?php echo $usersSlider; ?>%");
      });
    </script>
