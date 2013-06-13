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
            <li class="active"><a href="#currentUsers"><i class="icon-cog"></i> Admin Users</a></li>
            <li><a href="#newUser"><i class="icon icon-color icon-plus"></i> New User</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentUsers">
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <tr>
                  <td class="hide-below-480 table-id-head">ID</td>
                  <td width="auto">Name</td>
                  <td class="hide-below-768" width="auto">Email</td>
                  <td class="hide-below-768" width="auto">Group</td>
                  <td class="hide-below-480" width="auto">Status</td>
                  <td style="text-align:right;" width="15%">Actions</td>
                </tr>
                <?php 
                  foreach ( $results['users'] as $user ) { 
                ?>
                <tr id="listUser_<?php echo $user->id; ?>">
                  <td class="hide-below-480">
                    <?php echo $user->id; ?>
                  </td>
                  <td>
                    <span title="<?php echo ($user->gender == 'm') ? 'Male' : 'Female'; ?>" data-rel="tooltip" class="icon icon-user<?php echo ($user->gender == 'm') ? ' icon-blue' : ' icon-red'; ?>"></span> <?php echo $user->firstname . ' ' . $user->lastname; ?>
                  </td>
                  <td class="hide-below-768">
                    <span class="icon icon-orange icon-envelope-closed"></span> <?php echo $user->email; ?>
                  </td>
                  <td class="hide-below-768">
                    <?php echo $user->group; ?>
                  </td>
                  <td class="hide-below-480 noDecoration">
                    <?php if ($user->title != '404') { ?>
                    <?php   if ($user->status == 1) { ?>
                    <div id="status_<?php echo $user->id; ?>"><a onclick="disableUser(<?php echo $user->id; ?>);"><span class="label label-success">Enabled</span></a></div>
                    <?php   } else { ?>
                    <div id="status_<?php echo $user->id; ?>"><a onclick="enableUser(<?php echo $user->id; ?>);"><span class="label label-important">Disabled</span></a></div>
                    <?php   } ?>
                    <?php } ?>
                  </td>
                  <td style="text-align:right; white-space:nowrap;">
                    <a href="index.php?action=editUser&amp;userId=<?php echo $user->id; ?>" title="Edit User Profile" class="btn btn-info" data-rel="tooltip">
                      <i class="icon-edit icon-white"></i>
                      <span class="hide-below-768">Edit</span>
                    </a>
                    <a onclick="deleteUser(<?php echo $user->id; ?>);" title="Delete User Profile" class="btn btn-danger">
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
    <!-- List User Groups -->
    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Manage Admin Access Levels</h2>
          <div class="box-icon">
            <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <!--<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
          </div>
        </div>
        <div class="box-content">
          <ul class="nav nav-tabs" id="listAccessTab">
            <li class="active"><a href="#currentAccess"><i class="icon-cog"></i> Admin Access Levels</a></li>
            <li><a href="#newAccess"><i class="icon icon-color icon-plus"></i> New Access Level</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentAccess">
              Current Access Levels
            </div>
            <div class="tab-pane" id="newAccess">
              <form action="index.php?action=newAccess" method="post" name="newAccess" id="newAccess">
                New Access Levels
              </form>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
