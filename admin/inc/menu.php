          <ul class="nav nav-tabs nav-stacked side-menu">
            <li class="nav-header">
              <?php
                $conArr = array('dashboard', 'listContent', 'listGallery');
              ?>
              <span id="side_content_trigger" onclick="sideContentToggle();">
                <i id="contentChevron" class="<?php echo (empty($_GET['action']) || in_array($_GET['action'], $conArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> Content
              </span>
              <ul id="side_content_menu" class="nav nav-inner-ul<?php echo (empty($_GET['action']) || in_array($_GET['action'], $conArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=dashboard"<?php echo (empty($_GET['action']) || $_GET['action'] == 'dashboard') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>Dashboard</a></li>
                <li><a href="index.php?action=listContent"<?php echo ($_GET['action'] == 'listContent') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>Content</a></li>
                <li><a href="index.php?action=listGallery"<?php echo ($_GET['action'] == 'listGallery') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>Gallery</a></li>
              </ul>
            </li>
            <li class="nav-header">
              <?php
                $appArr = array('theme');
              ?>
              <span id="side_appearance_trigger" onclick="sideAppearanceToggle();">
                <i id="appearanceChevron" class="<?php echo (in_array($_GET['action'], $appArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> Appearance
              </span>
              <ul id="side_appearance_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $appArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=theme"<?php echo ($_GET['action'] == 'theme') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>Themes</a></li>
              </ul>
            </li>
            <li class="nav-header">
              <?php
                $useArr = array('listUser');
              ?>
              <span id="side_users_trigger" onclick="sideUsersToggle();">
                <i id="usersChevron" class="<?php echo (in_array($_GET['action'], $useArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> Users
              </span>
              <ul id="side_users_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $useArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=listUser"<?php echo ($_GET['action'] == 'listUser') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>Users</a></li>
                <!--<li><a href="index.php?action=listUser"<?php echo ($_GET['action'] == '') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>Groups</a></li>-->
              </ul>
            </li>
            <li class="nav-header">
              <?php
                $tooArr = array('fileManager');
              ?>
              <span id="side_tools_trigger" onclick="sideToolsToggle();">
                <i id="toolsChevron" class="<?php echo (in_array($_GET['action'], $tooArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> Tools
              </span>
              <ul id="side_tools_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $tooArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=fileManager"<?php echo ($_GET['action'] == 'fileManager') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>File Manager</a></li>
              </ul>
            </li>
            <li class="nav-header">
              <?php
                $setArr = array('listSetting');
              ?>
              <span id="side_settings_trigger" onclick="sideSettingsToggle();">
                <i id="settingsChevron" class="<?php echo (in_array($_GET['action'], $setArr)) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> Settings
              </span>
              <ul id="side_settings_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $setArr)) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=listSetting"<?php echo ($_GET['action'] == 'listSetting') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;color:white;"' : ''; ?>>Settings</a></li>
              </ul>
            </li>
          </ul>