          <?php 
            global $gns_admin_RCI; 
            $_SESSION['conArr'] = array('dashboard', 'listContent');
            $_SESSION['appArr'] = array('theme');
            $_SESSION['useArr'] = array('listUser', 'editUser', 'editGroup');
            $_SESSION['tooArr'] = array('fileManager');
            $_SESSION['setArr'] = array('listSetting', 'editSetting');
            echo $gns_admin_RCI->get('menuarrays', 'add');
          ?>
          <ul class="nav nav-tabs nav-stacked side-menu">
            <li class="nav-header">
              <span id="side_content_trigger" onclick="sideContentToggle();">
                <i id="contentChevron" class="<?php echo (empty($_GET['action']) || in_array($_GET['action'], $_SESSION['conArr'])) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> <?php echo $lang['content']; ?>
              </span>
              <ul id="side_content_menu" class="nav nav-inner-ul<?php echo (empty($_GET['action']) || in_array($_GET['action'], $_SESSION['conArr'])) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=dashboard"<?php echo (empty($_GET['action']) || $_GET['action'] == 'dashboard') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;"' : ''; ?>><?php echo $lang['dashboard']; ?></a></li>
                <li><a href="index.php?action=listContent"<?php echo ($_GET['action'] == 'listContent') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;"' : ''; ?>><?php echo $lang['content']; ?></a></li>
                <?php echo $gns_admin_RCI->get('contentmenu', 'add'); ?>
              </ul>
            </li>
            <li class="nav-header">
              <span id="side_appearance_trigger" onclick="sideAppearanceToggle();">
                <i id="appearanceChevron" class="<?php echo (in_array($_GET['action'], $_SESSION['appArr'])) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> <?php echo $lang['appearance']; ?>
              </span>
              <ul id="side_appearance_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $_SESSION['appArr'])) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=theme"<?php echo ($_GET['action'] == 'theme') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;"' : ''; ?>><?php echo $lang['themes']; ?></a></li>
                <?php echo $gns_admin_RCI->get('appearancemenu', 'add'); ?>
              </ul>
            </li>
            <li class="nav-header">
              <span id="side_users_trigger" onclick="sideUsersToggle();">
                <i id="usersChevron" class="<?php echo (in_array($_GET['action'], $_SESSION['useArr'])) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> <?php echo $lang['users']; ?>
              </span>
              <ul id="side_users_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $_SESSION['useArr'])) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=listUser"<?php echo (in_array($_GET['action'], $_SESSION['useArr'])) ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;"' : ''; ?>><?php echo $lang['users']; ?></a></li>
                <?php echo $gns_admin_RCI->get('usersmenu', 'add'); ?>
              </ul>
            </li>
            <li class="nav-header">
              <span id="side_tools_trigger" onclick="sideToolsToggle();">
                <i id="toolsChevron" class="<?php echo (in_array($_GET['action'], $_SESSION['tooArr'])) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> <?php echo $lang['tools']; ?>
              </span>
              <ul id="side_tools_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $_SESSION['tooArr'])) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=fileManager"<?php echo ($_GET['action'] == 'fileManager') ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;"' : ''; ?>><?php echo $lang['file_manager']; ?></a></li>
                <?php echo $gns_admin_RCI->get('toolsmenu', 'add'); ?>
              </ul>
            </li>
            <li class="nav-header">
              <span id="side_settings_trigger" onclick="sideSettingsToggle();">
                <i id="settingsChevron" class="<?php echo (in_array($_GET['action'], $_SESSION['setArr'])) ? 'icon-chevron-up ' : 'icon-chevron-down '; ?>pull-right pointer small-margin-top"></i> 
                <i class="icon-th-list"></i> <?php echo $lang['settings']; ?>
              </span>
              <ul id="side_settings_menu" class="nav nav-inner-ul<?php echo (in_array($_GET['action'], $_SESSION['setArr'])) ? '' : ' hide'; ?>">
                <li><a href="index.php?action=listSetting"<?php echo (in_array($_GET['action'], $_SESSION['setArr'])) ? ' style="background-color:#43A1DA;color:white;border:1px solid #43A1DA;"' : ''; ?>><?php echo $lang['settings']; ?></a></li>
                <?php echo $gns_admin_RCI->get('settingsmenu', 'add'); ?>
              </ul>
            </li>
            <?php echo $gns_admin_RCI->get('menubottom', 'add'); ?>
          </ul>
