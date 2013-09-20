          <ul class="nav nav-tabs nav-stacked side-menu">
            <li class="nav-header" id="side_content_trigger" onclick="sideContentToggle();">
              <?php
                $conArr = array('dashboard', 'listContent', 'listGallery');
              ?>
              <i id="contentChevron" class="<?php echo (in_array($_GET['action'], $conArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
              <i class="icon-th-list"></i> Content
              <ul id="side_content_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $conArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=dashboard"<?php echo ($_GET['action'] == 'dashboard') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>Dashboard</a></li>
                <li><a href="index.php?action=listContent"<?php echo ($_GET['action'] == 'listContent') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>Content</a></li>
                <li><a href="index.php?action=listGallery"<?php echo ($_GET['action'] == 'listGallery') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>Gallery</a></li>
              </ul>
            </li>
            <li class="nav-header" id="side_appearance_trigger" onclick="sideAppearanceToggle();">
              <?php
                $appArr = array('theme');
              ?>
              <i id="appearanceChevron" class="<?php echo (in_array($_GET['action'], $appArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
              <i class="icon-th-list"></i> Appearance
              <ul id="side_appearance_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $appArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=theme"<?php echo ($_GET['action'] == 'theme') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>Themes</a></li>
              </ul>
            </li>
            <li class="nav-header" id="side_users_trigger" onclick="sideUsersToggle();">
              <?php
                $useArr = array('listUser');
              ?>
              <i id="usersChevron" class="<?php echo (in_array($_GET['action'], $useArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
              <i class="icon-th-list"></i> Users
              <ul id="side_users_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $useArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=listUser"<?php echo ($_GET['action'] == 'listUser') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>Users</a></li>
                <!--<li><a href="index.php?action=listUser"<?php echo ($_GET['action'] == '') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>Groups</a></li>-->
              </ul>
            </li>
            <li class="nav-header" id="side_tools_trigger" onclick="sideToolsToggle();">
              <?php
                $tooArr = array('fileManager');
              ?>
              <i id="toolsChevron" class="<?php echo (in_array($_GET['action'], $tooArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
              <i class="icon-th-list"></i> Tools
              <ul id="side_tools_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $tooArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=fileManager"<?php echo ($_GET['action'] == 'fileManager') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>File Manager</a></li>
              </ul>
            </li>
            <li class="nav-header" id="side_settings_trigger" onclick="sideSettingsToggle();">
              <?php
                $setArr = array('listSetting');
              ?>
              <i id="settingsChevron" class="<?php echo (in_array($_GET['action'], $setArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
              <i class="icon-th-list"></i> Settings
              <ul id="side_settings_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $setArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=listSetting"<?php echo ($_GET['action'] == 'listSetting') ? ' style="background-color:#222;border:1px solid #222;"' : ''; ?>>Settings</a></li>
              </ul>
            </li>
          </ul>
