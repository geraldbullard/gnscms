    <!-- List Users -->
    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Manage Admin Users</h2>
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
          <ul class="nav nav-tabs" id="listUsersTab">
            <li class="active"><a href="#currentUsers"><i class="icon-cog"></i> Users</a></li>
            <li><a href="#newUser"><i class="icon icon-color icon-plus"></i> New User</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentUsers">
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <tr>
                  <td class="hide-below-480 table-id-head">ID</td>
                  <td width="auto">Name</td>
                  <td class="hide-below-768" width="auto">Email</td>
                  <td class="hide-below-480" width="auto">Status</td>
                  <td style="text-align:right;" width="15%">Actions</td>
                </tr>
                <?php 
                  foreach ( $results['users'] as $user ) {
                    $gInfo = Group::getById($user->group);
                ?>
                <tr id="listUser_<?php echo $user->id; ?>">
                  <td class="hide-below-480">
                    <?php echo $user->id; ?>
                  </td>
                  <td>
                    <span title="<?php echo ($user->gender == 'm') ? 'Male' : 'Female'; ?>" data-rel="tooltip" class="icon icon-user<?php echo ($user->gender == 'm') ? ' icon-blue' : ' icon-red'; ?>"></span> <?php echo $user->firstname . ' ' . $user->lastname; ?><br /><small class="level"><?php echo $gInfo->name; ?></small>
                  </td>
                  <td class="hide-below-768">
                    <span class="icon icon-orange icon-envelope-closed"></span> <?php echo $user->email; ?>
                  </td>
                  <td class="hide-below-480 noDecoration">
                    <?php if ($user->status == 1) { ?>
                    <div id="statusUser_<?php echo $user->id; ?>"><a onclick="disableUser(<?php echo $user->id; ?>);"><span class="label label-success">Enabled</span></a></div>
                    <?php } else { ?>
                    <div id="statusUser_<?php echo $user->id; ?>"><a onclick="enableUser(<?php echo $user->id; ?>);"><span class="label label-important">Disabled</span></a></div>
                    <?php } ?>
                  </td>
                  <td style="text-align:right; white-space:nowrap;">
                    <a href="index.php?action=editUser&amp;userId=<?php echo $user->id; ?>" title="Edit User Profile" class="btn btn-info" data-rel="tooltip">
                      <i class="icon-edit icon-white"></i>
                      <span class="hide-below-768">Edit</span>
                    </a>
                    <a<?php echo (($user->group != 1) ? ' onclick="deleteUser(' . $user->id . ');"' : ''); ?> title="<?php echo (($user->group == 1) ? 'This Profile can not be deleted!' : 'Delete User Profile'); ?>" class="btn btn-danger<?php echo (($user->group == 1) ? ' disabled' : ''); ?>" data-rel="tooltip">
                      <i class="icon-trash icon-white"></i>
                    </a>
                  </td>
                </tr>
                <?php } ?>
              </table>
              <p><strong>( <?php echo $results['totalRows']?> )</strong> user<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> total</p>
            </div>
            <div class="tab-pane" id="newUser">
              <form action="index.php?action=newUser" method="post" name="newUser" id="newUser">
                <div class="row-fluid">
                  <div class="span4">
                    <label>First Name</label>
                    <input class="text-input span12" type="text" id="firstname" name="firstname" required autofocus />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Last Name</label>
                    <input class="text-input span12" type="text" id="lastname" name="lastname" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Email</label>
                    <input class="text-input span12" type="text" id="email" name="email" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Username</label>
                    <input class="text-input span12" type="text" id="username" name="username" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Password</label>
                    <input class="text-input span12" type="password" id="password" name="password" autocomplete="off" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Confirm Password</label>
                    <input class="text-input span12" type="password" id="passconfirm" name="passconfirm" autocomplete="off" required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Gender</label>
                    <label class="radio">
                      <div class="radio" style="padding-left:10px;">
                        <span>
                          <input type="radio" name="gender" value="m">
                        </span>
                      </div>
                      Male
                    </label>
                    <div style="clear:both"></div>
                    <label class="radio">
                      <div class="radio" style="padding-left:10px;">
                        <span>
                          <input type="radio" name="gender" value="f">
                        </span>
                      </div>
                      Female
                    </label>
                  </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span4">                           
                    <input type="hidden" id="level" name="level" value="99" />
                    <input type="hidden" id="status" name="status" value="1" />
                    <button class="btn btn-primary" type="submit" name="saveChanges">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
    <div><br /></div>
    <!-- List Groups -->
    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Manage Admin Groups</h2>
          <div class="box-icon">
            <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <!--<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
          </div>
        </div>
        <div class="box-content">
          <ul class="nav nav-tabs" id="listGroupsTab">
            <li class="active"><a href="#currentGroups"><i class="icon-cog"></i> Groups</a></li>
            <li><a href="#newGroup"><i class="icon icon-color icon-plus"></i> New Group</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentGroups">
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <tr>
                  <td class="hide-below-480 table-id-head">ID</td>
                  <td width="auto">Name</td>
                  <td class="hide-below-480" width="auto">Status</td>
                  <td style="text-align:right;" width="15%">Actions</td>
                </tr>
                <?php 
                  foreach ( $gResults['groups'] as $group ) {                     
                ?>
                <tr id="listGroup_<?php echo $group->id; ?>">
                  <td class="hide-below-480">
                    <?php echo $group->id; ?>
                  </td>
                  <td>
                    <?php echo $group->name; ?>
                  </td>
                  <td class="hide-below-480 noDecoration">
                    <?php if ($group->status == 1) { ?>
                    <div id="statusGroup_<?php echo $group->id; ?>">
                      <?php if ($group->id != 1) { ?>
                      <a onclick="disableGroup(<?php echo $group->id; ?>);"><span class="label label-success">Enabled</span></a>
                      <?php } else { ?>
                      <span class="label label-success" title="This Group can not be disabled!" data-rel="tooltip">Enabled</span>
                      <?php } ?>
                    </div>
                    <?php } else { ?>
                    <div id="statusGroup_<?php echo $group->id; ?>"><a onclick="enableGroup(<?php echo $group->id; ?>);"><span class="label label-important">Disabled</span></a></div>
                    <?php } ?>
                  </td>
                  <td style="text-align:right; white-space:nowrap;">
                    <a href="index.php?action=editGroup&amp;groupId=<?php echo $group->id; ?>" title="Edit Admin Group" class="btn btn-info" data-rel="tooltip">
                      <i class="icon-edit icon-white"></i>
                      <span class="hide-below-768">Edit</span>
                    </a>
                    <a<?php echo (($group->id != 1) ? ' onclick="deleteGroup(' . $group->id . ');"' : ''); ?> title="<?php echo (($group->id == 1) ? 'This Group can not be deleted!' : 'Delete Admin Group'); ?>" class="btn btn-danger<?php echo (($group->id == 1) ? ' disabled' : ''); ?>" data-rel="tooltip">
                      <i class="icon-trash icon-white"></i>
                    </a>
                  </td>
                </tr>
                <?php } ?>
              </table>
              <p><strong>( <?php echo $gResults['totalRows']?> )</strong> group<?php echo ( $gResults['totalRows'] != 1 ) ? 's' : '' ?> total</p>
            </div>
            <div class="tab-pane" id="newGroup">
              <form action="index.php?action=newGroup" method="post" name="newGroup" id="newGroup">
                <div class="row-fluid">
                  <div class="span4">
                    <label>Group Name</label>
                    <input class="text-input span12" type="text" id="name" name="name" required autofocus />
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
                <div class="row-fluid">
                  <div class="span4">
                    <input type="hidden" value="1" name="dashboard" id="dashboard" />
                    <input type="hidden" value="" name="content" id="content" />
                    <input type="hidden" value="" name="themes" id="themes" />
                    <input type="hidden" value="" name="files" id="files" />
                    <input type="hidden" value="" name="settings" id="settings" />
                    <input type="hidden" value="" name="users" id="users" />                           
                    <input type="hidden" id="status" name="status" value="1" />
                    <button class="btn btn-primary" type="submit" name="saveChanges">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
