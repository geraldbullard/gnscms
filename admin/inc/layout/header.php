<body>

  <div class="container-fluid">
  
    <!-- topbar starts -->
    <div class="navbar">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div>
            <a class="brand" href="index.php"><img src="img/logo-85.png" /></a>
          </div>
          <div style="float:left;" class="hide-below-480">
            <form class="navbar-search pull-left" id="searchform" method="post">
              <input name="search_query" id="search_query" placeholder="Seacrh Content" spellcheck="false" autocomplete="off" class="search-query span2" type="text">
            </form>
            <div id="display_results" style="display:none;"></div>
          </div>
          
          <div class="top-nav nav-collapse">
            <ul class="nav">
              <li><a href="index.php?action=dashboard" title="Welcome to gnsCMS">Dashboard</a></li>
              <li><a href="index.php?action=listContent" title="Manage Site Pages">Content</a></li>
              <li><a href="index.php?action=theme" title="Manage Site Themes">Themes</a></li>
              <li><a href="index.php?action=fileManager" title="Manage Files">File Manager</a></li>
              <li><a href="index.php?action=listSetting" title="Manage Site Settings">Settings</a></li>
              <li><a href="index.php?action=listUser" title="Manage Site Users">Users</a></li>
              <li class="hide-above-767"><a href="../" title="View Site in New Window">View Site</a></li>
              <li class="hide-above-767"><a href="login.php?action=logout" title="Logout">Logout</a></li>
              <li class="show-below-480" style="display:none;">
                <form class="navbar-search pull-left" id="searchform320" method="post">
                  <input name="search_query_320" id="search_query_320" placeholder="Seacrh Content" spellcheck="false" autocomplete="off" class="search-query span2" type="text">
                </form>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
          <div style="float:right; padding-top:3px;" class="hide-below-768 navbar-actions">
            <a href="../" title="View Site in New Window" target="_blank"><i class="icon32 icon-white icon-extlink"></i></a> <a href="login.php?action=logout" title="Logout"><i class="icon32 icon-white icon-cross"></i></a> 
          </div>
        </div>
      </div>
    </div>
    <!-- topbar ends -->
    
    <div id="display_results_320" style="display:none;"></div>
