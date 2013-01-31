<?php include('inc/head.php'); ?>

<?php include('inc/layout/header.php'); ?>

    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Manage Site Pages</h2>
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
          </div>
          <?php } ?>
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#currentPages"><i class="icon icon-color icon-book-empty"></i> Current Pages</a></li>
            <li><a href="#newPage"><i class="icon icon-color icon-plus"></i> Add New Page</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentPages">
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <tr>
                  <td class="hide-below-480 table-id-head">ID</td>
                  <td class="table-title-head">Title</td>
                  <td class="hide-below-480" width="auto">Index</td>
                  <td class="hide-below-480" width="auto">Status</td>
                  <td style="text-align:right;" width="20%">Actions</td>
                </tr>
                <?php 
                  asort($results['pages']); 
                  foreach ( $results['pages'] as $page ) { 
                ?>
                <tr>
                  <td class="hide-below-480">
                    <?php echo $page->id; ?>
                  </td>
                  <td>
                    <?php echo $page->title; ?>
                  </td>
                  <td class="hide-below-480">
                    <?php if ($page->siteIndex == 1) { ?>
                    <i class="icon32 icon-color icon-check" title="Page is set as Site Index"></i>
                    <?php } else { ?>
                    <form action="index.php?action=siteIndex" method="post" name="siteIndex_<?php echo $page->id; ?>" id="siteIndex_<?php echo $page->id; ?>">
                      <input type="hidden" name="siteIndex" value="1" />
                      <input type="hidden" name="id" value="<?php echo $page->id; ?>" />
                      <a onclick="$('#siteIndex_<?php echo $page->id; ?>').submit();" title="Set this page as the Site Index"><i class="icon32 icon-color icon-close" style="opacity:0.5;"></i></a>
                    </form>
                    <?php } ?> 
                  </td>
                  <td class="hide-below-480 noDecoration">
                    <?php if ($page->status == 1) { ?>
                    <form action="index.php?action=disablePage" method="post" name="disablePage_<?php echo $page->id; ?>" id="disablePage_<?php echo $page->id; ?>">
                      <input type="hidden" name="status" value="0" />
                      <input type="hidden" name="id" value="<?php echo $page->id; ?>" />
                      <a onclick="$('#disablePage_<?php echo $page->id; ?>').submit();" title="Disable this page"><span class="label label-success">Enabled</span></a>
                    </form>
                    <?php } else { ?>
                    <form action="index.php?action=enablePage" method="post" name="enablePage_<?php echo $page->id; ?>" id="enablePage_<?php echo $page->id; ?>">
                      <input type="hidden" name="status" value="1" />
                      <input type="hidden" name="id" value="<?php echo $page->id; ?>" />
                      <a onclick="$('#enablePage_<?php echo $page->id; ?>').submit();" title="Enable this page"><span class="label label-important">Disabled</span></a>
                    </form>
                    <?php } ?>
                  </td>
                  <td style="text-align:right; white-space:nowrap;">
                    <?php if ($page->status == 1) { ?>
                    <a href="../<?php echo gen_seo_friendly_titles($page->slug); ?>.html" title="View Page" target="_blank" class="btn btn-success">
                      <i class="icon-zoom-in icon-white"></i>
                      <span class="hide-below-768">View</span>
                    </a>
                    <?php } ?>
                    <a href="index.php?action=editPage&amp;pageId=<?php echo $page->id; ?>" title="Edit" class="btn btn-info">
                      <i class="icon-edit icon-white"></i>
                      <span class="hide-below-768">Edit</span>
                    </a>
                    <a href="index.php?action=deletePage&amp;pageId=<?php echo $page->id; ?>" onclick="return confirm('Are You Sure?')" title="Delete"class="btn btn-danger">
                      <i class="icon-trash icon-white"></i> 
                      <span class="hide-below-768">Delete</span>
                    </a>
                  </td>
                </tr>
                <?php } ?>
              </table>
              <p><strong>( <?php echo $results['totalRows']?> )</strong> page<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> total</p>
            </div>
            <div class="tab-pane" id="newPage">
              <form action="index.php?action=newPage" method="post" name="newPage" id="newPage">
                <div class="row-fluid">
                  <div class="span6">
                    <label>Page Title</label>
                    <input class="span12" style="width:100%;" type="text" id="title" name="title" autofocus required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Page Slug (For Site URL)</label>
                    <input class="span12" style="width:100%;" type="text" id="slug" name="slug" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Page Summary</label>
                    <input class="span12" style="width:100%;" type="text" id="summary" name="summary" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span6">
                    <label>Page Content</label>
                    <textarea class="span12" style="width:100%;" name="content" id="content"></textarea>
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
                      <label>Parent Page</label>              
                      <select name="parent" class="small-input">
                        <option value="0">No Parent</option>
                        <?php foreach ( $results['pages'] as $page ) { ?>
                          <option value="<?php echo $page->id; ?>"><?php echo $page->title; ?></option>
                          <?php } ?>
                      </select>
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
  
<?php include('inc/layout/footer.php'); ?>

<?php // add js array here ?>

<?php include('inc/bottom.php'); ?>