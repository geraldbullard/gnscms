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
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Manage Site Settings</h2>
          <div class="box-icon">
            <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <!--<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
          </div>
        </div>
        <div class="box-content">
          <?php if (isset($results['errorMessage']) || isset($results['successMessage'])) { ?>
          <div>
            <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="alert alert-error" id="errorMessage">
              <button class="close" data-dismiss="alert" type="button">x</button>
              <?php echo $results['errorMessage'] ?>
            </div>
            <?php } ?>
            <?php if ( isset( $results['successMessage'] ) ) { ?>
            <div class="alert alert-success" id="successMessage">
              <button class="close" data-dismiss="alert" type="button">x</button>
              <?php echo $results['successMessage'] ?>
            </div>
            <?php } ?>
            <?php if ( isset( $results['attentionMessage'] ) ) { ?>
            <div class="alert alert-block" id="attentionMessage">
              <button class="close" data-dismiss="alert" type="button">x</button>
              <?php echo $results['attentionMessage'] ?>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
          <ul class="nav nav-tabs" id="listSettingsTab">
            <li class="active"><a href="#currentSettingsTab"><i class="icon-cog"></i> Site Settings</a></li>
            <li><a href="#newSettingTab"><i class="icon icon-color icon-plus"></i> New Setting</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentSettingsTab">
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <tr>
                  <td class="hide-below-480 table-id-head">ID</td>
                  <td width="auto">Title</td>
                  <td class="hide-below-768" width="auto">Define</td>
                  <td class="hide-below-768" width="auto">Summary</td>
                  <td class="hide-below-480" width="auto">Value</td>
                  <td style="text-align:right;" width="15%">Actions</td>
                </tr>
                <?php 
                  foreach ( $results['settings'] as $setting ) { 
                ?>
                <tr>
                  <td class="hide-below-480">
                    <?php echo $setting->id; ?>
                  </td>
                  <td>
                    <?php echo $setting->title; ?>
                  </td>
                  <td class="hide-below-768">
                    <?php echo $setting->define; ?>
                  </td>
                  <td class="hide-below-768">
                    <?php echo $setting->summary; ?>
                  </td>
                  <td class="hide-below-480">
                    <?php echo $setting->value; ?>
                  </td>
                  <td style="text-align:right; white-space:nowrap;">
                    <?php if ($setting->edit == 1) { ?>
                      <a href="index.php?action=editSetting&amp;settingId=<?php echo $setting->id; ?>" title="Edit" class="btn btn-info" data-rel="tooltip">
                        <i class="icon-edit icon-white"></i>
                        <span class="hide-below-768">Edit</span>
                      </a>
                      <a href="index.php?action=deleteSetting&amp;settingId=<?php echo $setting->id; ?>" onclick="return confirm('Are You Sure?')" title="Delete" class="btn btn-danger">
                        <i class="icon-trash icon-white"></i> 
                        <span class="hide-below-768">Delete</span>
                      </a>
                    <?php } else { ?>
                      <a href="index.php?action=editSetting&amp;settingId=<?php echo $setting->id; ?>" title="Edit" class="btn btn-info">
                        <i class="icon-edit icon-white"></i>
                        <span class="hide-below-768">Edit</span>
                      </a>
                      <a href="#" title="This setting was locked upon creation and can not be deleted!" class="btn btn-danger disabled">
                        <i class="icon icon-locked icon-white"></i>
                        <span class="hide-below-768">Delete</span>
                      </a>
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>
              </table>
              <p><strong>( <?php echo $results['totalRows']?> )</strong> setting<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> total</p>
            </div>
            <div class="tab-pane" id="newSettingTab">
              <form action="index.php?action=newSetting" method="post" name="newSetting" id="newSetting">
                <div class="row-fluid">
                  <div class="span6">
                    <label>Setting Title</label>
                    <input class="text-input span12" type="text" id="title" name="title" required autofocus />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Setting Define</label>
                    <input class="text-input span12" type="text" id="define" name="define" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span8">
                    <label>Setting Summary</label>
                    <input class="text-input span12" type="text" id="summary" name="summary" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span8">
                    <label>Setting Value</label>
                    <input class="text-input span12" type="text" id="value" name="value" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Setting Define Edit Mode</label>
                    <label class="radio">
                      <div class="radio" style="padding-left:10px;">
                        <span>
                          <input type="radio" value="1" name="edit">
                        </span>
                      </div>
                      Yes make it editable
                    </label>
                    <div style="clear:both"></div>
                    <label class="radio">
                      <div class="radio" style="padding-left:10px;">
                        <span>
                          <input type="radio" value="0" name="edit">
                        </span>
                      </div>
                      No make it permanent
                    </label>
                  </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span6">                           
                    <input type="hidden" name="system" value="0" />
                    <button class="btn btn-primary" type="submit" name="saveChanges">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
