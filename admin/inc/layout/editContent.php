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
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Edit <?php echo ($results['content']->type == 0) ? 'Category' : 'Page'; ?> : : <?php echo $results['content']->title; ?></h2>
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
      </div><!--/span-->
    </div><!--/row-->
