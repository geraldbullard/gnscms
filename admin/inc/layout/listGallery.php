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
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Manage Albums</h2>
          <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
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
          </div>
          <?php } ?>
          <ul class="nav nav-tabs" id="listGalleryTab">
            <li class="active"><a href="#currentGalleryTab"><i class="icon icon-color icon-book-empty"></i> Current Albums</a></li>
            <li><a href="#newGalleryTab"><i class="icon icon-color icon-plus"></i> Add New Album</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentGalleryTab">
            </div>
            <div class="tab-pane" id="newGalleryTab">
              <form action="index.php?action=newAlbum" method="post" name="newAlbum" id="newAlbum">
              </form>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
    <!-- needed for page sorting -->
    <div id="info"></div>
