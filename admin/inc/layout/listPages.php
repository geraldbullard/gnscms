<?php include('inc/head.php'); ?>

<?php include('inc/layout/header.php'); ?>

    <div class="row-fluid">
      <div class="box span12 tour">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Manage Site Pages</h2>
          <div class="box-icon">
            <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn btn-round p-btn-tour"><i class="icon32 icon-blue icon-help help-icon-fix"></i></a>
          </div>
        </div>
        <div class="box-content pTour1">
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
          <ul class="nav nav-tabs" id="myTab">
            <li class="active pTour2"><a href="#currentPages"><i class="icon icon-color icon-book-empty"></i> Current Pages</a></li>
            <li><a href="#newPage"><i class="icon icon-color icon-plus"></i> Add New Page</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentPages">
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <thead>
                  <tr>
                    <td class="hide-below-480 table-id-head">ID</td>
                    <td class="hide-below-480 table-id-head">Sort</td>
                    <td class="table-title-head pTour3">Title</td>
                    <td class="hide-below-480 pTour4" width="auto">Index</td>
                    <td class="hide-below-480 pTour5" width="auto">Status</td>
                    <td style="text-align:right;" width="20%" class="pTour6">Actions</td>
                  </tr>
                </thead>
                <tbody id="page-list">
                  <?php
                    foreach ( $results['pages'] as $page ) {
                  ?>
                  <tr id="listItem_<?php echo $page->id; ?>">
                    <td class="hide-below-480" title="Page ID" data-rel="tooltip">
                      <?php echo $page->id; ?>
                    </td>
                    <td style="width:5%; text-align:center; white-space: nowrap;" class="hide-below-480">
                      <img src="img/sortIcon.png" style="cursor:move; margin-bottom:3px;" class="pageSortHandle" title="Sort Page" data-rel="tooltip" />&nbsp;&nbsp;<span style="font-size:11px;"><?php echo $page->sort; ?></span>
                    </td>
                    <td><?php echo $page->title; ?></td>
                    <td class="hide-below-480">
                      <?php if ($page->siteIndex == 1) { ?>
                      <i class="icon32 icon-color icon-check" title="Page is set as Site Index" data-rel="tooltip"></i>
                      <?php } else { ?>
                      <form action="index.php?action=siteIndex" method="post" name="siteIndex_<?php echo $page->id; ?>" id="siteIndex_<?php echo $page->id; ?>">
                        <input type="hidden" name="siteIndex" value="1" />
                        <input type="hidden" name="id" value="<?php echo $page->id; ?>" />
                        <a onclick="$('#siteIndex_<?php echo $page->id; ?>').submit();" title="Set this page as the Site Index" data-rel="tooltip"><i class="icon32 icon-color icon-close" style="opacity:0.5;"></i></a>
                      </form>
                      <?php } ?> 
                    </td>
                    <td class="hide-below-480 noDecoration">
                      <?php if ($page->status == 1) { ?>
                      <div id="status_<?php echo $page->id; ?>"><a onclick="disablePage(<?php echo $page->id; ?>);" title="Disable this Page" data-rel="tooltip"><span class="label label-success">Enabled</span></a></div>
                      <?php } else { ?>
                      <div id="status_<?php echo $page->id; ?>"><a onclick="enablePage(<?php echo $page->id; ?>);" title="Enable this Page" data-rel="tooltip"><span class="label label-important">Disabled</span></a></div>
                      <?php } ?>
                    </td>
                    <td style="text-align:right; white-space:nowrap;">
                      <a id="view_<?php echo $page->id; ?>" href="../<?php echo gen_seo_friendly_titles($page->slug); ?>.html" title="View Page in New Window" data-rel="tooltip" target="_blank" class="btn btn-success"<?php if ($page->status != 1) echo ' style="display:none;"'; ?>>
                        <i class="icon-zoom-in icon-white"></i>
                        <span class="hide-below-768">View</span>
                      </a>
                      <a href="index.php?action=editPage&amp;pageId=<?php echo $page->id; ?>" title="Edit this Page" data-rel="tooltip" class="btn btn-info">
                        <i class="icon-edit icon-white"></i>
                        <span class="hide-below-768">Edit</span>
                      </a>
                      <a onclick="deletePage(<?php echo $page->id; ?>);" title="Delete this Page" data-rel="tooltip" class="btn btn-danger">
                        <i class="icon-trash icon-white"></i> 
                        <span class="hide-below-768">Delete</span>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <p><strong>( <?php echo $results['totalRows']?> )</strong> page<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> total</p>
            </div>
            <div class="tab-pane" id="newPage">
              <form action="index.php?action=newPage" method="post" name="newPage" id="newPage">
                <div class="row-fluid">
                  <div class="span4">
                    <label>Page Title</label>
                    <input class="span12" style="width:100%;" type="text" id="title" name="title" autofocus required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Page Slug (For Site URL)</label>
                    <input class="span12" style="width:100%;" type="text" id="slug" name="slug" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>URL Override</label>
                    <input class="span12" style="width:100%;" type="text" id="override" name="override" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Page Summary</label>
                    <input class="span12" style="width:100%;" type="text" id="summary" name="summary" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span8">
                    <label>Page Content</label>
                    <textarea class="span12 ckeditor" name="content" id="content"></textarea>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Meta Description</label>
                    <textarea class="span12" style="width:100%;" id="metaDescription" name="metaDescription"></textarea>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Meta Keywords</label>
                    <textarea class="span12" style="width:100%;" id="metaKeywords" name="metaKeywords"></textarea>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                      <label>Bot Actions</label>
                      <?php 
                        $botActions = explode(", ", $results['page']->botAction);
                      ?>
                      <input type="checkbox" name="botAction1" checked />Index this page<br>
                      <input type="checkbox" name="botAction2" checked />Follow links on this page
                  </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span6">
                      <label>Show in Menu</label>
                      <input type="checkbox" name="menu" checked />Show In Menu
                  </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span12">                           
                    <input type="hidden" name="sort" value="999" />
                    <input type="hidden" name="status" value="1" />
                    <input type="hidden" name="siteIndex" value="0" />
                    <button class="btn btn-primary" type="submit" name="saveChanges">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
    
    <!-- needed for page sorting -->
    <div id="info" style="display:none;"></div>
  
<?php include('inc/layout/footer.php'); ?>

<?php // add js array here ?>

<?php include('inc/bottom.php'); ?>