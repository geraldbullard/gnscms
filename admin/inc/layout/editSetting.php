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
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Edit Setting</h2>
          <div class="box-icon">
            <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <!--<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
          </div>
        </div>
        <div class="box-content">
          <?php if ( isset( $results['errorMessage'] ) ) { ?>
          <div class="alert alert-error" id="errorMessage">
            <button class="close" data-dismiss="alert" type="button">x</button>
            <?php echo $results['errorMessage'] ?>
          </div>
          <?php } ?>        
          <form action="index.php?action=editSetting" method="post" name="editSetting" id="editSetting">
            <input type="hidden" name="settingId" value="<?php echo $results['setting']->id ?>"/>
            <div class="row-fluid">
              <div class="span6">
                <label>Setting Title</label>
                <input class="text-input span6" type="text" id="title" name="title" value="<?php echo htmlspecialchars( $results['setting']->title )?>" required autofocus <?php echo ($results['setting']->edit == 0) ? 'disabled' : ''; ?> />
              </div>
            </div>
            <div class="row-fluid">
              <div class="span6">
                <label>Setting Define</label>
                <input class="text-input span6" type="text" id="define" name="define" value="<?php echo htmlspecialchars( $results['setting']->define )?>" required <?php echo ($results['setting']->edit == 0) ? 'disabled' : ''; ?> />
              </div>
            </div>
            <div class="row-fluid">
              <div class="span8">
                <label>Setting Summary</label>
                <input class="text-input span8" type="text" id="summary" name="summary" value="<?php echo htmlspecialchars( $results['setting']->summary )?>" required />
              </div>
            </div>
            <div class="row-fluid">
              <div class="span8">
                <label>Setting Value</label>
                <input class="text-input span8" type="text" id="value" name="value" value="<?php echo htmlspecialchars( $results['setting']->value )?>" required />
              </div>
            </div>
            <?php if ($results['setting']->edit == 1) { ?>
            <div class="row-fluid">
              <div class="span6">
                <label>Setting Define Edit Mode</label>
                <label class="radio">
                  <div class="radio" style="padding-left:10px;">
                    <span>
                      <input type="radio" value="1" name="edit"<?php echo ($results['setting']->edit == 1) ? ' checked' : ''; ?> />
                    </span>
                  </div>
                  Yes make it editable
                </label>
                <div style="clear:both"></div>
                <label class="radio">
                  <div class="radio" style="padding-left:10px;">
                    <span>
                      <input type="radio" value="0" name="edit"<?php echo ($results['setting']->edit == 0) ? ' checked' : ''; ?> />
                    </span>
                  </div>
                  No make it permanent
                </label>
              </div>
            </div>
            <?php } else { ?>
            <input type="hidden" name="edit" value="0" />
            <?php } ?>              
            <?php if ($results['setting']->system == 1) { ?>
            <input type="hidden" name="system" value="1"/>
            <?php } else { ?>
            <input type="hidden" name="system" value="0"/>
            <?php } ?>            
            <div class="row-fluid">&nbsp;</div>
            <div class="row-fluid">
              <div class="span6">
                <button class="btn btn-primary" type="submit" name="saveChanges">Save Changes</button> &nbsp; <input class="btn btn-primary" type="submit" formnovalidate name="cancel" value="Cancel" />
              </div>
            </div>
          </form>
        </div>
      </div><!--/span-->
    </div><!--/row-->
