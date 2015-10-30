<?php
  class gns_RCI {
    var $_folders = array();

    function gns_RCI() {
      if (!isset($_SESSION['gns_RCI_data'])) {
        $_SESSION['gns_RCI_data'] = array('folders' => array() );
      }
      $this->_folders = $_SESSION['gns_RCI_data']['folders'];
    }

    function get($pageName, $function, $display = true) {
      $pageName = strtolower($pageName);
      $function = strtolower($function);
      $rci_holder = '';
      
      if (!array_key_exists($pageName, $this->_folders)) {
        $this->_build_folder($pageName);
      }

      if (array_key_exists($function, $this->_folders[$pageName])) {
        foreach ($this->_folders[$pageName][$function] as $fileName) {
          if (!file_exists('inc/rci/' . $pageName . '/' . $fileName)) {
            $this->_folders = array();
            continue;
          }
          $rci = '';
          if ($pageName == 'stylesheet') {
            $rci = '<link rel="stylesheet" href="' . 'inc/rci/' . $pageName . '/' . $fileName . '">';
          } else {
            include('inc/rci/' . $pageName . '/' . $fileName);
          }
          $rci_holder .= $rci;
        }
      }
      return $rci_holder;
    }

    function _build_folder($pageName) {
      $this->_folders[$pageName] = array();    
      if (is_dir('inc/rci/' . $pageName)) {
        $filesFound = array();
        if ($pageName == 'stylesheet') {
          $pattern = '/(\w*)_*(\w+)_(\w+)_(\w+)\.css$/';
        } else {
          $pattern = '/(\w*)_*(\w+)_(\w+)_(\w+)\.php$/';
        } 
        $dir = opendir('inc/rci/' . $pageName);
        while ($file = readdir($dir)) {
          if ($file == '.' || $file == '..') continue;
          $match = array();
          if (preg_match($pattern, $file, $match) > 0) {
            if ($match[3] == $pageName) {
              $filesFound[$match[0]] = $match[4];
            }
          }
        }
        if (count($filesFound) > 0) {
          ksort($filesFound);
          foreach ($filesFound as $file => $function) {
            $this->_folders[$pageName][$function][] = $file;
          }
        }
      }
    }
  }
?>