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
                  <label>File Manager Access</label>
                  <div class="access-slider">
                    <div style="height:25px;">
                      <div style="width:25%;float:right;text-align:right;margin-right:-21px;">Delete</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:3px;">Insert</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:5px;">Edit</div>
                      <div style="width:25%;float:right;text-align:right;margin-right:-3px;">View</div>
                      <div style="width:0;float:right;position:relative;left:-28px;">None</div>
                    </div>
                    <div id="accessSliderFiles" style="clear:both;"></div>
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
              <?php echo $gns_admin_RCI->get('editgroup', 'add'); ?>
              <div class="row-fluid">&nbsp;</div>
              <div style="clear:both;"></div>
              <input type="hidden" value="<?php echo $results['group']->dashboard; ?>" name="dashboard" id="dashboard" />
              <input type="hidden" value="<?php echo $results['group']->content; ?>" name="content" id="content" />
              <input type="hidden" value="<?php echo $results['group']->themes; ?>" name="themes" id="themes" />
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
