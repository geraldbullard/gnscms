    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Edit User : : <?php echo $results['user']->firstname . ' ' . $results['user']->lastname; ?></h2>
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
            <form action="index.php?action=editUser&editId=<?php echo $results['user']->id; ?>" name="editUser" method="post">
              <input type="hidden" name="id" value="<?php echo $results['user']->id; ?>"/> 
              <div class="row-fluid">
                <div class="span4">
                  <label>First Name</label>
                  <input class="text-input span12" type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars( $results['user']->firstname ); ?>" required autofocus />
                </div>
              </div>
              <div class="row-fluid">
                <div class="span4">
                  <label>Last Name</label>
                  <input class="text-input span12" type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars( $results['user']->lastname ); ?>" required />
                </div>
              </div>
              <div class="row-fluid">
                <div class="span4">
                  <label>Email</label>
                  <input class="text-input span12" type="text" id="email" name="email" value="<?php echo htmlspecialchars( $results['user']->email ); ?>" required />
                </div>
              </div>
              <div class="row-fluid">
                <div class="span4">
                  <label>Username</label>
                  <input class="text-input span12" type="text" id="username" name="username" value="<?php echo htmlspecialchars( $results['user']->username ); ?>" required />
                </div>
              </div>
              <input type="hidden" name="password" value="<?php echo $results['user']->password; ?>"/> 
              <div class="row-fluid">
                <div class="span4">
                  <label>New Password</label>
                  <input class="text-input span12" type="password" id="newPassword" name="newPassword" value="" autocomplete="off" />
                </div>
              </div>
              <div class="row-fluid">
                <div class="span4">
                  <label>Confirm New Password</label>
                  <input class="text-input span12" type="password" id="newPassConfirm" name="newPassConfirm" value="" autocomplete="off" />
                </div>
              </div>
              <div class="row-fluid">
                <div class="span4">
                  <label>User Group</label>
                  <div class="controls">
                    <select id="usergroup" name="usergroup">
                      <option>Select Group</option>
                      <?php
                        $groups = Group::getAll();
                        foreach ($groups['results'] as $group) {
                          echo '<option value="' . $group->id . '"' . (($group->id == $results['user']->usergroup) ? ' selected' : '') . '>' . $group->title . '</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row-fluid">
                <div class="span4">
                  <label>Gender</label>
                  <label class="radio">
                    <div class="radio" style="padding-left:10px;">
                      <span>
                        <input type="radio" name="gender" value="m"<?php echo ($results['user']->gender == 'm') ? ' checked' : ''; ?> />
                      </span>
                    </div>
                    Male
                  </label>
                  <div style="clear:both"></div>
                  <label class="radio">
                    <div class="radio" style="padding-left:10px;">
                      <span>
                        <input type="radio" name="gender" value="f"<?php echo ($results['user']->gender == 'f') ? ' checked' : ''; ?> />
                      </span>
                    </div>
                    Female
                  </label>
                </div>
              </div>
              <div class="row-fluid">&nbsp;</div>
              <div style="clear:both;"></div>            
              <input type="hidden" name="level" value="<?php echo $results['user']->level; ?>"/>
              <input type="hidden" name="status" value="<?php echo $results['user']->status; ?>"/>
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
