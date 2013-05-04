<?php include('inc/head.php'); ?>

<?php include('inc/layout/header.php'); ?>

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
          <ul class="nav nav-tabs" id="myTab">
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
                  <td class="hide-below-768" width="auto">Level</td>
                  <td class="hide-below-480" width="auto">Status</td>
                  <td style="text-align:right;" width="15%">Actions</td>
                </tr>
                <?php 
                  foreach ( $results['users'] as $user ) { 
                ?>
                <tr>
                  <td class="hide-below-480">
                    <?php echo $user->id; ?>
                  </td>
                  <td>
                    <span class="icon icon-user<?php echo ($user->gender == 'm') ? ' icon-blue' : ' icon-red'; ?>"></span> <?php echo $user->firstname . ' ' . $user->lastname; ?>
                  </td>
                  <td class="hide-below-768">
                    <span class="icon icon-orange icon-envelope-closed"></span> <?php echo $user->email; ?>
                  </td>
                  <td class="hide-below-768">
                    <?php echo $user->level; ?>
                  </td>
                  <td class="hide-below-480">
                    <?php echo $user->status; ?>
                  </td>
                  <td style="text-align:right; white-space:nowrap;">
                    <a href="index.php?action=editUser&amp;userId=<?php echo $user->id; ?>" title="Edit User Profile" class="btn btn-info" data-rel="tooltip">
                      <i class="icon-edit icon-white"></i>
                      <span class="hide-below-768">Edit</span>
                    </a>
                    <a href="index.php?action=deleteUser&amp;userId=<?php echo $user->id; ?>" onclick="return confirm('Are You Sure?')" title="Delete User Profile" class="btn btn-danger">
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
  
<?php include('inc/layout/footer.php'); ?>

<?php // add js array here ?>

<?php include('inc/bottom.php'); ?>