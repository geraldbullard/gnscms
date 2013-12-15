    <div class="row-fluid">
      <div id="leftNav" class="box span3" style="margin-bottom:15px;">
        <div class="box-header well">
          <h2><i class="icon-th"></i> <?php echo $lang['navigation']; ?></h2>
          <div class="box-icon">
            <i class="icon-chevron-left" onclick="toggleLeftNav();" style="margin:6px 20px 0px -35px; cursor:pointer;" title="<?php echo $lang['hide_navigation']; ?>"></i>
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <?php include('inc/menu.php'); ?>  
        </div>
      </div>
      <div id="rightContent" class="box span9">
        <div class="box-header well">
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="<?php echo $lang['show_navigation']; ?>"></i><i class="icon-th"></i> <?php echo $lang['dashboard']; ?></h2>
          <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <div class="pad-10">
            <h2><?php echo $lang['dashboard_welcome_to'] . ' ' . $lang['gnscms']; ?></h2>
            <div>
              <?php echo $lang['dashboard_welcome_text']; ?>
              <p></p>
              <span class="pull-right"><?php echo $lang['dashboard_welcome_signature']; ?></span>
              <p>&nbsp;</p>
            </div>
          </div>
          <div class="clear"></div>
          <ul class="nav nav-tabs" id="dashboardTab">
            <li class="active"><a href="#gettingStarted"><i class="icon-home"></i> <?php echo $lang['dashboard_getting_started']; ?></a></li>
            <li><a href="#gettingHelp"><i class="icon-question-sign"></i> <?php echo $lang['dashboard_getting_help']; ?></a></li>
          </ul>
          <div class="tab-content pad-10">
            <div class="tab-pane active" id="gettingStarted">
              <p><?php echo $lang['dashboard_highlights']; ?></p>
              <br />
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td><h3><a href="index.php?action=dashboard"><?php echo $lang['dashboard']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=listContent"><?php echo $lang['content']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_content_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=theme"><?php echo $lang['themes']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_themes_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=fileManager"><?php echo $lang['file_manager']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_file_manager_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=listSetting"><?php echo $lang['settings']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_settings_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="#"><?php echo $lang['search']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_search_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=listContent"><?php echo $lang['dashboard_draggable_sorting']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_draggable_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=listUser"><?php echo $lang['users'] . '/' . $lang['groups']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_users_groups_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=listContent"><?php echo $lang['dashboard_layout_templates']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_layout_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="index.php?action=dashboard"><?php echo $lang['dashboard_multi_language']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_multi_lang_description']; ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3><a href="../sitemap.xml" target="_blank"><?php echo $lang['dashboard_sitemap']; ?></a></h3></td>
                    <td>
                      <p><?php echo $lang['dashboard_sitemap_description']; ?></p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane" id="gettingHelp">
              <p>Coming soon...</p>
              <h3>Deserved Credits:</h3>
              <p class="pull-left">
                Copyright &copy; 2013 <a href="http://www.gnscms.com/" title="The Best in Web Development!" target="_blank">gnsCMS</a><br />
                Core Code Based on: <a href="http://www.elated.com/articles/cms-in-an-afternoon-php-mysql/" title="Core code based on &quot;Build a CMS in an Afternoon with PHP and MySQL&quot; by Matt Doyle" target="_blank">Afternoon CMS</a><br />
                Admin Powered by: <a href="http://www.usman.it/free-responsive-admin-template" title="Open Source, Mutiple Skin, Fully Responsive Admin Template" target="_blank">Charisma</a><br />
                File Manager by: <a href="http://www.elfinder.org/" title="File Manager for the Web" target="_blank">elFinder</a><br />
                Content Editor: <a href="http://ckeditor.com/" title="CKEditor is a free, Open Source HTML text editor designed to simplify website content creation." target="_blank">CKEditor</a>
              </p>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->