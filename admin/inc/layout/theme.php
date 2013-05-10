    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Theme Management</h2>
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
          <?php if ( isset( $results['successMessage'] ) && !isset( $results['errorMessage'] ) ) { ?>
          <div class="alert alert-success" id="successMessage">
            <button class="close" data-dismiss="alert" type="button">x</button>
            <?php echo $results['successMessage'] ?>
          </div>
          <?php } ?>
          <?php 
            $ext = array('.jpg', '.jpeg', '.gif', '.png');
            for ($i = 0; count($ext) > $i; $i++) { 
              if (file_exists('../theme/' . siteTheme . '/preview' . $ext[$i])) {
                $curThemeImg = 'preview' . $ext[$i];
              }
            }
          ?>
          <h3>Current Theme Preview: "<?php echo siteTheme; ?>"</h3>
          <div class="pad-10" align="center">
            <img src="../theme/<?php echo siteTheme . '/' . $curThemeImg; ?>" border="0" />
          </div>          
          <ul class="nav nav-tabs" id="currentThemeTab">
            <li class="active"><a href="#themeInfo"><i class="icon-picture"></i> Theme Details</a></li>
            <li><a href="#shortCodes"><i class="icon-cog"></i> Short Codes</a></li>
          </ul> 
          <?php
            if (file_exists('../theme/' . siteTheme . '/' . siteTheme . '.xml')) {
              $z = new XMLReader;
              $z->open('../theme/' . siteTheme . '/' . siteTheme . '.xml');

              while ($z->read() && $z->name !== 'theme');
              while ($z->name === 'theme') {
                $node = new SimpleXMLElement($z->readOuterXML());
          ?>
          <div class="tab-content pad-10">
            <div class="tab-pane active" id="themeInfo">
              <h3>Description:</h3>
              <?php echo $node->summary; ?>
              <div class="spacer">&nbsp;</div>
              <div class="themeInfo"><h4>Author:</h4> <span class="themeXMLinfo"><?php echo $node->author; ?></span></div>
              <div class="themeInfo"><h4>Website:</h4> <span class="themeXMLinfo"><a href="<?php echo $node->url; ?>" target="_blank"><?php echo substr($node->url, 7, 100); ?></a></span></div>
              <div class="themeInfo"><h4>License:</h4> <span class="themeXMLinfo"><?php echo $node->license; ?></span></div>
              <div class="themeInfo"><h4>Version:</h4> <span class="themeXMLinfo"><?php echo $node->version; ?></span></div>
            </div>
            <div class="tab-pane" id="shortCodes">
              <?php echo $node->shortcodes; ?>
            </div>
          </div>
          <?php
                $z->next('theme');
              }
            }
          ?>
        </div>
      </div><!--/span-->
    </div><!--/row-->    
    <div style="clear:both;">&nbsp;</div>    
    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Available Themes</h2>
          <div class="box-icon">
            <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <!--<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
          </div>
        </div>
        <div class="box-content">
          <ul class="thumbnails gallery">
          <?php
            $themeDir = opendir('../theme/'); 
            while(false !== ($entryName = readdir($themeDir))) {
              if (substr($entryName, 0, 1) != '.') {
                $themeNames[] = $entryName;
              }
            }
            closedir($themeDir);
            sort($themeNames);            
            foreach ($themeNames as $theme) {              
              $directory = '../theme/' . $theme . '/';
              $wtlf = 'preview';              
              for ($i = 0; count($ext) > $i; $i++) {
                if (file_exists($directory . $wtlf . $ext[$i])) {
                  $name = $wtlf . $ext[$i];
                }
              }              
              echo '<li id="theme-' . $theme . '" class="thumbnail theme-listing">' . "\n" . 
                   '  <div title="Preview This Theme">' . "\n" . 
                   '    <a class="cboxElement" style="background:url(' . $directory . $name . ') no-repeat;" href="' . $directory . $name . '">' . "\n" . 
                   '      <img style="display: block;" src="' . $directory . $name . '">' . "\n" . 
                   '    </a>' . "\n" . 
                   '  </div>' . "\n" . 
                   '  <div class="theme-controls">' . "\n" .
                   '    <div ' . ($theme != siteTheme ? 'onclick="window.location=\'index.php?action=activateTheme&amp;value=' . $theme . '\';" style="cursor:pointer!important;"' : ' style="cursor:default!important;"') . ' title="' . ($theme == siteTheme ? 'Current Theme' : 'Activate This Theme') . '">' . "\n" . 
                   '      ' . ($theme == siteTheme ? '<button class="btn btn-mini btn-success" disabled><i class="icon-off"></i> Current</button>' : '<button class="btn btn-mini btn-primary"><i class="icon-off"></i> Activate</button>') . "\n" . 
                   '    </div>' . "\n" . 
                   '  </div>' . "\n" . 
                   '</li>';               
            }
          ?>
          </ul>
        </div>
      </div><!--/span-->
    </div><!--/row-->
