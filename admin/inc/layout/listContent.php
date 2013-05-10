    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Manage Site Content</h2>
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
          <ul class="nav nav-tabs" id="listContentTab">
            <li class="active"><a href="#currentContent"><i class="icon icon-color icon-book-empty"></i> Current Content</a></li>
            <li><a href="#newContent"><i class="icon icon-color icon-plus"></i> Add New Content</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentContent">
              <h4>Content >> <a href="index.php?action=listContent">Top</a> <?php echo (isset($_GET['categoryId']) ? ' > ' : '') . createPath($_GET['categoryId']); ?></h4><br />
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <thead>
                  <tr>
                    <td class="hide-below-480 table-id-head" style="width:2.5%;">ID</td>
                    <td class="hide-below-480 table-id-head" style="width:2.5%;">Sort</td>
                    <td class="table-title-head">Title</td>
                    <td class="hide-below-480 table-title-head" style="width:10%;">Index</td>
                    <td class="hide-below-480 table-title-head" style="width:10%;">Status</td>
                    <td class="table-title-head" style="text-align:right;" style="width:20%;">Actions</td>
                  </tr>
                </thead>
                <tbody id="content-list">
                  <?php
                    foreach ( $results['content'] as $content ) {
                  ?>
                  <tr id="listItem_<?php echo $content->id; ?>">
                    <td class="hide-below-480" title="Content ID" data-rel="tooltip">
                      <?php echo $content->id; ?>
                    </td>
                    <td style="text-align:center; white-space:nowrap;" class="hide-below-480">
                      <?php if ($content->title != '404') { ?>
                      <img src="img/sortIcon.png" style="cursor:move; margin-bottom:3px;" class="sortHandle" title="Sort Content" data-rel="tooltip" />&nbsp;&nbsp;<span style="font-size:11px;"><?php echo $content->sort; ?></span>
                      <?php } ?>
                    </td>
                    <?php if ($content->type == 0) { ?>
                    <td><a href="index.php?action=listContent&amp;categoryId=<?php echo $content->id; ?>" title="Enter This Category" data-rel="tooltip" style="text-decoration:none;" /><i class="icon icon-orange icon-folder-open"></i> <?php echo $content->title; ?></a></td>
                    <?php } else { ?>
                    <td><i class="icon icon-orange icon-document"></i> <?php echo $content->title; ?></td>
                    <?php } ?>
                    <td class="hide-below-480">
                      <?php if ($content->title != '404') { ?>
                      <?php   if ($content->siteIndex == 1) { ?>
                      <i class="icon32 icon-color icon-check" title="This <?php echo ($content->type == 0) ? 'Category' : 'Page'; ?> is set as the Site Index" data-rel="tooltip"></i>
                      <?php   } else { ?>
                      <form action="index.php?action=siteIndex&categoryId=<?php echo $_GET['categoryId']; ?>" method="post" id="siteIndex_<?php echo $content->id; ?>" name="siteIndex_<?php echo $content->id; ?>">
                        <input type="hidden" name="siteIndex" value="1" />
                        <input type="hidden" name="id" value="<?php echo $content->id; ?>" />
                        <a onclick="$('#siteIndex_<?php echo $content->id; ?>').submit();" title="Set this <?php echo ($content->type == 0) ? 'Category' : 'Page'; ?> as the Site Index" data-rel="tooltip"><i class="icon32 icon-color icon-close" style="opacity:0.5;cursor:pointer;"></i></a>
                      </form>
                      <?php   } ?>
                      <?php } ?>
                    </td>
                    <td class="hide-below-480 noDecoration">
                      <?php if ($content->title != '404') { ?>
                      <?php   if ($content->status == 1) { ?>
                      <div id="status_<?php echo $content->id; ?>"><a onclick="disableContent(<?php echo $content->id; ?>);"><span class="label label-success">Enabled</span></a></div>
                      <?php   } else { ?>
                      <div id="status_<?php echo $content->id; ?>"><a onclick="enableContent(<?php echo $content->id; ?>);"><span class="label label-important">Disabled</span></a></div>
                      <?php   } ?>
                      <?php } ?>
                    </td>
                    <td style="text-align:right; white-space:nowrap;">
                      <a id="view_<?php echo $content->id; ?>" href="../<?php echo gen_seo_friendly_titles($content->slug); ?>.html" title="View this <?php echo ($content->type == 0) ? 'Category' : 'Page'; ?> in New Window" data-rel="tooltip" target="_blank" class="btn btn-success"<?php if ($content->status != 1) echo ' style="display:none;"'; ?>>
                        <i class="icon-zoom-in icon-white"></i>
                      </a>
                      <a href="index.php?action=editContent&amp;editId=<?php echo $content->id; ?>&categoryId=<?php echo (isset($_GET['categoryId']) && $_GET['categoryId'] != '') ? $_GET['categoryId'] : 0; ?>" title="Edit this <?php echo ($content->type == 0) ? 'Category' : 'Page'; ?>" data-rel="tooltip" class="btn btn-info">
                        <i class="icon-edit icon-white"></i>
                        <span class="hide-below-768">Edit</span>
                      </a>
                      <?php if ($content->title != '404') { ?>
                      <a title="Copy this <?php echo ($content->type == 0) ? 'Category' : 'Page'; ?>" data-rel="tooltip" class="btn btn-primary btn-copy" id="btn_copy_<?php echo $content->id; ?>">
                        <i class="icon-asterisk icon-white"></i>
                      </a>
                      <a title="Move this <?php echo ($content->type == 0) ? 'Category' : 'Page'; ?>" data-rel="tooltip" class="btn btn-warning btn-move" id="btn_move_<?php echo $content->id; ?>">
                        <i class="icon-share-alt icon-white"></i>
                      </a>
                      <a onclick="deleteContent(<?php echo $content->id; ?>);" title="Delete this <?php echo ($content->type == 0) ? 'Category' : 'Page'; ?>" data-rel="tooltip" class="btn btn-danger">
                        <i class="icon-trash icon-white"></i>
                      </a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php 
                    }
                  ?>
                </tbody>
              </table>
              <div id="updateSortChanges" style="display:none; margin-bottom:10px;">
                <a onclick="location.reload();" title="Update Sort Changes" data-rel="tooltip" class="btn btn-success">
                  <i class="icon icon-arrowrefresh-e icon-white"></i> 
                  <span class="hide-below-768">Update Sort Changes</span>
                </a>
              </div>
              <p><strong>( <?php echo $results['totalCats']; ?> )</strong> categor<?php echo ( $results['totalCats'] != 1 ) ? 'ies' : 'y' ?> and <strong>( <?php echo $results['totalPages']?> )</strong> page<?php echo ( $results['totalPages'] != 1 ) ? 's' : '' ?> total</p>
            </div>
            <div class="tab-pane" id="newContent">
              <form action="index.php?action=newContent&categoryId=<?php echo (isset($_GET['categoryId']) && $_GET['categoryId'] != '') ? $_GET['categoryId'] : 0; ?>" method="post" name="newContent" id="newContent">
                <div class="row-fluid">
                  <label>Content Type</label>
                  <div class="controls" style="margin-left:10px;">
                    <label class="radio">
                      <div class="radio"><span class=""><input type="radio" value="0" id="typeRadio0" name="type" style="opacity: 0;"></span></div>
                      Category
                    </label>
                    <div style="clear:both"></div>
                    <label class="radio">
                      <div class="radio"><span class=""><input type="radio" value="1" id="typeRadio1" name="type" style="opacity: 0;"></span></div>
                      Page
                    </label>
                  </div>
                </div>
                <div style="height:10px;"></div>
                <?php
                  $layoutDir = '../theme/' . siteTheme . '/layout/';
                  if (is_dir('../theme/' . siteTheme . '/layout/')) {
                    $files = scandir($layoutDir);
                ?>
                <div class="row-fluid" id="layout_template" style="display:none;">
                  <div class="span8">
                    <div>
                      <label>Layout Template</label>
                      <select id="layout" name="layout" onchange="getLayout(this.value);" style="min-width:275px;">
                        <option value="custom">Select a Layout</option>
                        <?php
                          // added for stock layouts provided by theme designer if present
                          foreach ($files as $file) {
                            if ($file != "." && $file != ".." && $file != ".htaccess") {
                              $file_parts = explode(".", $file);
                              if ($file_parts[1] == 'tpl') {
                                $layout_name = str_replace("-", " ", $file_parts[0]);
                                echo '  <option value="' . $file_parts[0] . '">' . ucwords($layout_name) . '</option>' . "\n";
                              }
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div style="display:none; margin-top:10px;" id="layout_preview">
                      <p>Layout Preview</p>
                      <img src="" style="border:1px solid #ccc; padding:10px; width:255px;" />
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div style="height:10px;"></div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Title</label>
                    <input class="span12" style="width:100%;" type="text" id="contentTitle" name="title" autofocus required />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Slug (For Site URL)</label>
                    <input class="span12" style="width:100%;" type="text" id="contentSlug" name="slug" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Menu Title</label>
                    <input class="span12" style="width:100%;" type="text" id="menuTitle" name="menuTitle" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>URL Override</label>
                    <input class="span12" style="width:100%;" type="text" id="override" name="override" />
                  </div>
                </div>
                <div class="row-fluid" id="summaryDiv" style="display:none;">
                  <div class="span6">
                    <label>Summary</label>
                    <textarea class="span12" type="text" id="summary" name="summary" style="width:100%;" maxlength="10000"></textarea>
                  </div>
                </div>
                <div class="row-fluid" id="contentDiv" style="margin-bottom:10px; display:none;">
                  <div class="span8">
                    <label>Content</label>
                    <textarea class="span12 ckeditor" id="content" name="content"></textarea>
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
                      <input type="checkbox" id="botAction1" name="botAction1" checked />Index this page<br>
                      <input type="checkbox" id="botAction2" name="botAction2" checked />Follow links on this page
                  </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span6">
                      <label>Show in Menu</label>
                      <input type="checkbox" id="menu" name="menu" checked />Show In Menu
                  </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span12">                           
                    <input type="hidden" name="sort" value="<?php echo (Content::getSort(isset($_GET['categoryId']) ? $_GET['categoryId'] : 0) + 1); ?>" />
                    <input type="hidden" name="status" value="1" />
                    <input type="hidden" name="siteIndex" value="0" />
                    <input type="hidden" name="categoryId" value="<?php echo (isset($_GET['categoryId']) && $_GET['categoryId'] != '') ? $_GET['categoryId'] : 0; ?>" />
                    <button class="btn btn-primary" type="submit" name="saveChanges">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Copy Modal -->
        <div class="modal hide fade" id="copyModal">
          <form action="index.php?action=copyContent&categoryId=<?php echo $_GET['categoryId']; ?>" method="post" id="copyContent" name="copyContent">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">X</button>
              <h3>Copy Content</h3>
            </div>
            <div class="modal-body" id="copy_modal_body">
              <p>Select the location where you wish to move the content from the dropdwon below... </p>
              <select id="copyId" name="copyId">
                <option value="0">Top</option>
                <?php echo listCategories(0, 1); ?>
              </select>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <button class="btn btn-primary" type="submit" name="saveChanges">Save Changes</button>
            </div>
          </form>
        </div>
        <!-- Move Modal -->
        <div class="modal hide" id="moveModal">
          <form action="index.php?action=moveContent&categoryId=<?php echo $_GET['categoryId']; ?>" method="post" id="moveContent" name="moveContent">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">X</button>
              <h3>Move Content</h3>
            </div>
            <div class="modal-body" id="move_modal_body">
              <p>Select the location where you wish to move the content from the dropdwon below... </p>
              <select id="moveId" name="moveId">
                <option value="0">Top</option>
                <?php echo listCategories(0, 1); ?>
              </select>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <button class="btn btn-primary" type="submit" name="saveChanges">Save Changes</button>
            </div>
          </form>
        </div>
      </div><!--/span-->
    </div><!--/row-->
    <!-- needed for page sorting -->
    <div id="info"></div>
