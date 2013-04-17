<?php include('inc/head.php'); ?>

<?php include('inc/layout/header.php'); ?>

    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Edit Category</h2>
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
          <div class="row-fluid span12" id="editCategoryBlock">
            <form action="index.php?action=editCategory&editId=<?php echo $results['category']->id; ?>&categoryId=<?php echo (isset($_GET['categoryId']) && $_GET['categoryId'] != '') ? $_GET['categoryId'] : 0; ?>" name="editCategory" method="post">
            <input type="hidden" name="editId" value="<?php echo $results['category']->id; ?>"/>
            <div class="row-fluid">
              <div class="span8">
                <label>Category Title</label>
                <input class="span12" type="text" id="catTitle" name="title" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['category']->title ); ?>" autofocus required />
              </div>
            </div>              
            <div class="row-fluid">
              <div class="span8">
                <label>Category Slug (For Site URL)</label>
                <input class="span12" type="text" id="catSlug" name="slug" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['category']->slug ); ?>" />
              </div>
            </div>               
            <div class="row-fluid">
              <div class="span8">
                <label>Category Menu Title</label>
                <input class="span12" type="text" id="menuTitle" name="menuTitle" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['category']->menuTitle ); ?>" />
              </div>
            </div>              
            <div class="row-fluid">
              <div class="span8">
                <label>URL Override</label>
                <input class="span12" type="text" id="override" name="override" style="width:100%;" maxlength="255" value="<?php echo htmlspecialchars( $results['category']->override ); ?>" />
              </div>
            </div>             
            <div class="row-fluid">
              <div class="span8">
                <label>Category Content</label>
                <textarea class="span12 ckeditor" name="content" style="min-height:250px;" maxlength="100000"><?php echo htmlspecialchars( $results['category']->content ); ?></textarea>
              </div>
            </div>              
            <div class="row-fluid">
              <div class="span8">
                <label>Meta Description</label>
                <textarea class="span12" id="metaDescription" style="width:100%;" name="metaDescription"><?php echo htmlspecialchars( $results['category']->metaDescription ); ?></textarea>
              </div>
            </div>                
            <div class="row-fluid">
              <div class="span8">
                <label>Meta Keywords</label>
                <textarea class="span12" id="metaKeywords" style="width:100%;" name="metaKeywords"><?php echo htmlspecialchars( $results['category']->metaKeywords ); ?></textarea>
              </div>
            </div>                
            <!--<div class="row-fluid">
              <div class="span8">    
                <label>Category</label>              
                <select name="parent" class="span12">
                  <option value="0">Top</option>
                  <?php 
                    //foreach ( $results['pages'] as $page ) {
                      //if ($results['page']->id != $page->id) { 
                  ?>
                    <option value="<?php echo $category->id; ?>" <?php echo ($results['category']->parent == $category->id) ? 'selected' : ''; ?>><?php echo $category->title; ?></option>
                  <?php
                      //} 
                    //} 
                  ?>
                </select> 
              </div>
            </div>-->
            <div class="row-fluid">
              <div class="span8">
                <label>Bot Actions</label>
                <?php 
                  $botActions = explode(", ", $results['category']->botAction);
                ?>
                <input type="checkbox" name="botAction1" <?php echo (($botActions[0] == 'index') ? 'checked' : ''); ?> />Index this category<br>
                <input type="checkbox" name="botAction2" <?php echo (($botActions[1] == 'follow') ? 'checked' : ''); ?> />Follow links on this category
              </div>
            </div>
            <div class="row-fluid">&nbsp;</div>
            <div class="row-fluid">
              <div class="span6">
                  <label>Show in Menu</label>
                  <input type="checkbox" name="menu" <?php echo (($results['category']->menu == 1) ? 'checked' : ''); ?> />Show In Menu
              </div>
            </div>
            <br />
            <div style="clear:both;"></div>             
            <input type="hidden" name="sort" value="<?php echo $results['category']->sort; ?>"/>
            <input type="hidden" name="status" value="<?php echo $results['category']->status; ?>"/>
            <input type="hidden" name="siteIndex" value="<?php echo $results['category']->siteIndex; ?>"/>
            <div class="row-fluid span8" style="margin:0 0 10px 0;">
              <div style="float:left;">
                <input class="btn btn-primary" type="submit" name="saveChanges" value="Save Changes" /> &nbsp; <input class="btn btn-primary" type="submit" formnovalidate name="cancel" value="Cancel" /></form>
              </div>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
  
<?php include('inc/layout/footer.php'); ?>

<?php // add js array here ?>

<?php include('inc/bottom.php'); ?>