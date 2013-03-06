<?php include('inc/head.php'); ?>

<?php include('inc/layout/header.php'); ?>

    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Edit Page</h2>
          <div class="box-icon">
            <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <!--<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
          </div>
        </div>
        <div class="box-content">
          <?php if ( isset( $results['errorMessage'] ) ) { ?>
          <div class="alert alert-error" id="errorMessage">
            <button class="close" data-dismiss="alert" type="button">x</button>
            <?php echo $results['errorMessage'] ?>
          </div>
          <?php } ?>           
          <div class="row-fluid span12" id="editPageBlock">
            <form action="index.php?action=editPage" name="editPage" method="post">
            <input type="hidden" name="pageId" value="<?php echo $results['page']->id; ?>"/>
            <div class="row-fluid">
              <div class="span8">
                <label>Page Title</label>
                <input class="span12" type="text" id="title" name="title" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['page']->title ); ?>" autofocus required />
              </div>
            </div>              
            <div class="row-fluid">
              <div class="span8">
                <label>Page Slug (For Site URL)</label>
                <input class="span12" type="text" id="slug" name="slug" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['page']->slug ); ?>" />
              </div>
            </div>               
            <div class="row-fluid">
              <div class="span8">
                <label>URL Override</label>
                <input class="span12" type="text" id="override" name="override" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['page']->override ); ?>" />
              </div>
            </div>              
            <div class="row-fluid">
              <div class="span8">
                <label>Page Summary</label>
                <textarea class="span12" id="summary" name="summary" style="width:100%;" maxlength="1000"><?php echo htmlspecialchars( $results['page']->summary ); ?></textarea>
              </div>
            </div>              
            <div class="row-fluid">
              <div class="span8">
                <label>Page Content</label>
                <textarea class="span12 ckeditor" name="content" style="min-height:250px;" maxlength="100000"><?php echo htmlspecialchars( $results['page']->content ); ?></textarea>
              </div>
            </div>              
            <div class="row-fluid">
              <div class="span8">
                <label>Meta Description</label>
                <textarea class="span12" id="metaDescription" style="width:100%;" name="metaDescription"><?php echo htmlspecialchars( $results['page']->metaDescription ); ?></textarea>
              </div>
            </div>                
            <div class="row-fluid">
              <div class="span8">
                <label>Meta Keywords</label>
                <textarea class="span12" id="metaKeywords" style="width:100%;" name="metaKeywords"><?php echo htmlspecialchars( $results['page']->metaKeywords ); ?></textarea>
              </div>
            </div>                
            <div class="row-fluid">
              <div class="span8">    
                <label>Parent Page</label>              
                <select name="parent" class="span12">
                  <option value="0">No Parent</option>
                  <?php 
                    foreach ( $results['pages'] as $page ) {
                      if ($results['page']->id != $page->id) { 
                  ?>
                    <option value="<?php echo $page->id; ?>" <?php echo ($results['page']->parent == $page->id) ? 'selected' : ''; ?>><?php echo $page->title; ?></option>
                  <?php
                      } 
                    } 
                  ?>
                </select> 
              </div>
            </div>
            <div class="row-fluid">
              <div class="span8">
                <label>Bot Actions</label>
                <?php 
                  $botActions = explode(", ", $results['page']->botAction);
                ?>
                <input type="checkbox" name="botAction1" <?php echo (($botActions[0] == 'index') ? 'checked' : ''); ?> />Index this page<br>
                <input type="checkbox" name="botAction2" <?php echo (($botActions[1] == 'follow') ? 'checked' : ''); ?> />Follow links on this page
              </div>
            </div>
            <div class="row-fluid">&nbsp;</div>
            <div class="row-fluid">
              <div class="span6">
                  <label>Show in Menu</label>
                  <input type="checkbox" name="menu" <?php echo (($results['page']->menu == 1) ? 'checked' : ''); ?> />Show In Menu
              </div>
            </div>
            <br />
            <div style="clear:both;"></div>             
            <input type="hidden" name="sort" value="<?php echo $results['page']->sort; ?>"/>
            <input type="hidden" name="status" value="<?php echo $results['page']->status; ?>"/>
            <input type="hidden" name="siteIndex" value="<?php echo $results['page']->siteIndex; ?>"/>
            <div class="row-fluid span8" style="margin:0 0 10px 0;">
              <div style="float:left;">
                <input class="btn btn-primary" type="submit" name="saveChanges" value="Save Changes" /> &nbsp; <input class="btn btn-primary" type="submit" formnovalidate name="cancel" value="Cancel" /></form>
              </div>
              <div style="float:right; text-align:right;">
                <form action="index.php?action=deletePage&amp;pageId=<?php echo $results['page']->id ?>" method="post">
                  <input class="btn btn-primary" type="submit" name="deleteSetting" value="Delete" onclick="return confirm('Are You Sure?')" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
  
<?php include('inc/layout/footer.php'); ?>

<?php // add js array here ?>

<?php include('inc/bottom.php'); ?>