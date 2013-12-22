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
        <div id="info" style="display:none;"></div>
        <div class="box-header well">
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Edit <?php echo ($results['content']->type == 0) ? 'Category' : 'Page'; ?> : : <?php echo $results['content']->title; ?></h2>
          <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <ul class="nav nav-tabs" id="editContentTab">
            <li class="active"><a href="#editContent"><i class="icon-pencil"></i> <?php echo $lang['content_tab_edit_content']; ?></a></li>
            <li><a href="#editBlocks"><i class="icon-th-large"></i> <?php echo $lang['content_tab_edit_blocks']; ?></a></li>
          </ul>
          <div class="tab-content pad-10">
            <div class="tab-pane active" id="editContent">
              <?php if ( isset( $results['errorMessage'] ) ) { ?>
              <div class="alert alert-error" id="errorMessage">
                <button class="close" data-dismiss="alert" type="button">x</button>
                <?php echo $results['errorMessage'] ?>
              </div>
              <?php } ?>           
              <div class="row-fluid span12" id="editBlock">
                <form action="index.php?action=editContent&editId=<?php echo $results['content']->id; ?>&categoryId=<?php echo (isset($_GET['categoryId']) && $_GET['categoryId'] != '') ? $_GET['categoryId'] : 0; ?>" name="editContent" method="post">
                  <input type="hidden" name="editId" value="<?php echo $results['content']->id; ?>"/>
                  <div class="row-fluid">
                    <label>Content Type</label>
                    <div class="controls" style="margin-left:10px;">
                      <label class="radio">
                        <div class="radio"><span class="<?php echo ($results['content']->type == 0) ? 'checked' : ''; ?>"><input type="radio" value="0" id="typeRadio1" name="type" style="opacity: 0;"<?php echo ($results['content']->type == 0) ? ' checked' : ''; ?>></span></div>
                        Category
                      </label>
                      <div style="clear:both"></div>
                      <label class="radio">
                        <div class="radio"><span class="<?php echo ($results['content']->type == 1) ? 'checked' : ''; ?>"><input type="radio" value="1" id="typeRadio2" name="type" style="opacity: 0;"<?php echo ($results['content']->type == 1) ? ' checked' : ''; ?>></span></div>
                        Page
                      </label>
                    </div>
                  </div>
                  <div style="height:5px;"></div>
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Title</label>
                      <input class="span12" type="text" id="contentTitle" name="title" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['content']->title ); ?>" autofocus required />
                    </div>
                  </div>              
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Slug (For Site URL)</label>
                      <input class="span12" type="text" id="contentSlug" name="slug" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['content']->slug ); ?>" />
                    </div>
                  </div>               
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Menu Title</label>
                      <input class="span12" type="text" id="menuTitle" name="menuTitle" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['content']->menuTitle ); ?>" />
                    </div>
                  </div>              
                  <div class="row-fluid">
                    <div class="span4">
                      <label>URL Override</label>
                      <input class="span12" type="text" id="override" name="override" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['content']->override ); ?>" />
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span6">
                      <label>Summary</label>
                      <textarea class="span12" type="text" id="summary" name="summary" style="width:100%;" maxlength="10000" value="<?php echo htmlspecialchars( $results['content']->summary ); ?>"></textarea>
                    </div>
                  </div>             
                  <div class="row-fluid" style="margin-bottom:10px;">
                    <div class="span8">
                      <label>Content</label>
                      <textarea class="span12 ckeditor" id="content" name="content" style="min-height:250px;" maxlength="100000"><?php echo htmlspecialchars( $results['content']->content ); ?></textarea>
                    </div>
                  </div>              
                  <div class="row-fluid">
                    <div class="span6">
                      <label>Meta Description</label>
                      <textarea class="span12" id="metaDescription" style="width:100%;" name="metaDescription"><?php echo htmlspecialchars( $results['content']->metaDescription ); ?></textarea>
                    </div>
                  </div>                
                  <div class="row-fluid">
                    <div class="span6">
                      <label>Meta Keywords</label>
                      <textarea class="span12" id="metaKeywords" style="width:100%;" name="metaKeywords"><?php echo htmlspecialchars( $results['content']->metaKeywords ); ?></textarea>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span6">
                      <label>Bot Actions</label>
                      <?php 
                        $botActions = explode(", ", $results['content']->botAction);
                      ?>
                      <input type="checkbox" id="botAction1" name="botAction1" <?php echo (($botActions[0] == 'index') ? 'checked' : ''); ?> />Index this category<br>
                      <input type="checkbox" id="botAction2" name="botAction2" <?php echo (($botActions[1] == 'follow') ? 'checked' : ''); ?> />Follow links on this category
                    </div>
                  </div>
                  <div class="row-fluid">&nbsp;</div>
                  <div class="row-fluid">
                    <div class="span6">
                      <label>Show in Menu</label>
                      <input type="checkbox" id="menu" name="menu" <?php echo (($results['content']->menu == 1) ? 'checked' : ''); ?> />Show In Menu
                    </div>
                  </div>
                  <br />
                  <div style="clear:both;"></div>             
                  <input type="hidden" name="sort" value="<?php echo $results['content']->sort; ?>"/>
                  <input type="hidden" name="status" value="<?php echo $results['content']->status; ?>"/>
                  <input type="hidden" name="siteIndex" value="<?php echo $results['content']->siteIndex; ?>"/>
                  <input type="hidden" name="publicationDate" value="<?php echo date('Y-m-d', $results['content']->publicationDate ); ?>"/>
                  <input type="hidden" name="categoryId" value="<?php echo $results['content']->categoryId; ?>"/>
                  <div class="row-fluid span12" style="margin:0 0 10px 0;">
                    <div style="float:left;">
                      <input class="btn btn-primary" type="submit" name="saveChanges" value="Save Changes" /> &nbsp; <input class="btn btn-primary" type="submit" formnovalidate name="cancel" value="Cancel" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane active" id="editBlocks"> 
              <?php
                $blocksDir = '../theme/' . siteTheme . '/block/';
                if (is_dir('../theme/' . siteTheme . '/block/')) {
                  $files = scandir($blocksDir);
              ?>
              <div class="row-fluid" id="edit_blocks">
                <?php
                  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
                  $sql = 'SELECT * FROM ' . DB_PREFIX . 'blocks';
                  $b = $conn->prepare( $sql );
                  $b->execute();
                  $b = $b->fetchAll();
                  foreach ($b as $block) {
                    $blocks[] = $block['filename'];
                  }   
                ?>
                <div class="span6">
                  <div id="left_block_selection">
                    <label>Select Left Blocks <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <select id="leftBlockSelect" style="text-transform:capitalize;">
                      <option value="">Select Left Block</option>
                      <?php
                        foreach ($files as $leftFile) {
                          $chkside = 'SELECT side FROM ' . DB_PREFIX . 'blocks where filename = "' . $leftFile . '" and contentId = "' . $_GET['editId'] . '"';
                          $chk = $conn->prepare( $chkside );
                          $chk->execute();
                          $chk = $chk->fetch();
                          if (empty($chk['side'])) {
                            if ($leftFile != "." && $leftFile != ".." && $leftFile != ".htaccess") {
                              $leftFileParts = explode(".", $leftFile);
                              $leftBlockName = str_replace(array("-", "_"), " ", $leftFileParts[0]);
                              if (strpos($leftBlockName, 'box') > -1) {
                                echo '  <option value="' . $leftFileParts[0] . '">' . $leftBlockName . '</option>' . "\n";
                              }
                            }
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div id="leftBlocks">
                    <ul id="leftBlockList" style="list-style:none;margin-left:5px;">
                      <?php
                        foreach ($b as $block) {
                          if ($block['contentId'] == $_GET['editId'] && $block['side'] == 'l') {
                            $lnparts = explode(".", $block['filename']);
                            $box = $lnparts[0];
                      ?>
                      <li id="<?php echo $box; ?>" value="" class="pad-5" style="white-space:nowrap;text-transform:capitalize;">
                        <i class="icon-move leftSortHandle" title="Drag to Sort"></i>
                        <i class="icon-trash" style="cursor:pointer;margin:0 10px 0 6px;" onclick="removeLeftBlock('<?php echo $box; ?>');" title="Remove Block"></i><?php echo ucfirst(str_replace("_", " ", $box)); ?>
                      </li>
                      <?php
                          }
                        }
                      ?>                    
                    </ul>
                  </div>
                  <div id="updateLeftSortChanges" style="display:none; margin-bottom:10px;">
                    <a onclick="location.reload();" title="Update Left Sort Changes" data-rel="tooltip" class="btn btn-success">
                      <i class="icon icon-arrowrefresh-e icon-white"></i> 
                      <span class="hide-below-768">Update Left Sort Changes</span>
                    </a>
                  </div>
                </div>
                <div class="span6">
                  <div id="right_block_selection">
                    <label>Select Right Blocks <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <select id="rightBlockSelect" style="text-transform:capitalize;">
                      <option value="">Select Right Block</option>
                      <?php
                        foreach ($files as $rightFile) {
                          $chkside = 'SELECT side FROM ' . DB_PREFIX . 'blocks where filename = "' . $rightFile . '" and contentId = "' . $_GET['editId'] . '"';
                          $chk = $conn->prepare( $chkside );
                          $chk->execute();
                          $chk = $chk->fetch();
                          if (empty($chk['side'])) {
                            if ($rightFile != "." && $rightFile != ".." && $rightFile != ".htaccess") {
                              $rightFileParts = explode(".", $rightFile);
                              $rightBlockName = str_replace(array("-", "_"), " ", $rightFileParts[0]);
                              if (strpos($rightBlockName, 'box') > -1) {
                                echo '  <option value="' . $rightFileParts[0] . '">' . $rightBlockName . '</option>' . "\n";
                              }
                            }
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div id="rightBlocks">
                    <ul id="rightBlockList" style="list-style:none;margin-left:5px;">
                      <?php
                        foreach ($b as $block) {
                          if ($block['contentId'] == $_GET['editId'] && $block['side'] == 'r') {
                            $lnparts = explode(".", $block['filename']);
                            $box = $lnparts[0];
                      ?>
                      <li id="<?php echo $box; ?>" value="" class="pad-5" style="white-space:nowrap;text-transform:capitalize;">
                        <i class="icon-move leftSortHandle" title="Drag to Sort"></i>
                        <i class="icon-trash" style="cursor:pointer;margin:0 10px 0 6px;" onclick="removeLeftBlock('<?php echo $box; ?>');" title="Remove Block"></i><?php echo ucfirst(str_replace("_", " ", $box)); ?>
                      </li>
                      <?php
                          }
                        }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
              <?php 
                  $conn = null;
                } 
              ?>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
