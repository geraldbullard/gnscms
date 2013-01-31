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
          <a class="brand" href="index.php"> <span>gnsCMS</span></a>
          
          <div class="top-nav nav-collapse">
            <ul class="nav">
              <li><a href="index.php?action=dashboard">Dashboard</a></li>
              <li><a href="index.php?action=listPage">Pages</a></li>
              <li><a href="index.php?action=theme">Themes</a></li>
              <li><a href="index.php?action=fileManager">File Manager</a></li>
              <li><a href="index.php?action=listSetting">Settings</a></li>
              <li class="hide-above-767"><a href="../">View Site</a></li>
              <li class="hide-above-767"><a href="login.php?action=logout">Logout</a></li>
              <li>
                <form class="navbar-search pull-left">
                  <input placeholder="Search" class="search-query span2" name="query" type="text">
                </form>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
          <div style="float:right; padding-top:3px;" class="hide-below-768">
            <a href="../" title="View Site" target="_blank"><i class="icon32 icon-white icon-extlink"></i></a> <a href="login.php?action=logout" title="Logout"><i class="icon32 icon-white icon-cross"></i></a> 
          </div>
        </div>
      </div>
    </div>
    <!-- topbar ends -->
