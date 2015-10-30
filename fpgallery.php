<!--
fpGallery v1.0 - 2013-06-08
(c) 2013 Harry Ghazanian - foliopages.com/php-jquery-ajax-photo-gallery-no-database
This content is released under the http://www.opensource.org/licenses/mit-license.php MIT License.
-->
<?php
  $mainFolder   = 'images/albums';            // main folder that holds subfolders - this folder resides on root directory of your domain
  $itemsPerPage = '15';                // number of images per page if not already specified   
  $thumb_width  = '150';               // width of thumbnails
  $no_thumb     = 'no_img.jpg';        // show this when no thumbnail exists    
  $sort_by      = 'date';              // 'date' will sort albums by upload date -  change 'date' to anything else to sort by album name 
  $extensions   = array(".jpg",".png",".gif",".JPG",".PNG",".GIF"); // allowed extensions in photo gallery 
  $numPerPage   = (!empty($_REQUEST['numperpage']) ? (int)$_REQUEST['numperpage'] : $itemsPerPage);
  $isFullAlbum  = (!empty($_REQUEST['fullalbum']) ? 1 : 0);

  // create thumbnails from images
  function make_thumb($folder,$src,$dest,$thumb_width) {
    $source_image = imagecreatefromjpeg($folder.'/'.$src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);  
    $thumb_height = floor($height*($thumb_width/$width));
    $virtual_image = imagecreatetruecolor($thumb_width,$thumb_height);
    imagecopyresampled($virtual_image,$source_image,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
    imagejpeg($virtual_image,$dest,100);
  } 
  // display pagination
  function paginateAlbum($numPages,$urlVars,$alb,$currentPage) {
    $html = '';
    if ($numPages > 1) {
      $html .= 'Page '.$currentPage.' of '.$numPages;
      $html .= '&nbsp;&nbsp;&nbsp;'; 
      if ($currentPage > 1) {
        $prevPage = $currentPage - 1;
        $html .= '<a class="pag" rel="'.$alb.'" rev="'.$prevPage.'" href="?'.$urlVars.'p='.$prevPage.'">&laquo;&laquo;</a> ';
      }  
      for( $i=0; $i < $numPages; $i++ ) {
        $p = $i + 1;
        if ($p == $currentPage) {      
          $class = 'current-paginate';
        } else {
          $class = 'paginate';
        }
        $html .= '<a rel="'.$alb.'" rev="'.$p.'" class="'.$class.' pag" href="?'.$urlVars.'p='.$p.'">'.$p.'</a>';    
      }
      if ($currentPage != $numPages) {
        $nextPage = $currentPage + 1;  
        $html .= ' <a class="pag" rel="'.$alb.'" rev="'.$nextPage.'" href="?'.$urlVars.'p='.$nextPage.'">&raquo;&raquo;</a>';
      }
    }
    return $html;
  }
?>
<div class="fp">
  <?php
    if (empty($_REQUEST['album'])) {
      $ignore  = array('.', '..', 'thumbs');
      $albums = array();
      $captions = array();
      $random_pics = array();
      // display list of albums using DirectoryIterator
      //$folders = new DirectoryIterator($mainFolder);
      if($sort_by == 'date') { 
        $folders = array_diff(scandir($mainFolder), array('..', '.'));
        $sort_folders = array();
        foreach ($folders as $key=>$folder) {
          $stat_folders = stat($mainFolder .'/'. $folder);
          $folder_time[$key] = $stat_folders['ctime'];
        }
        array_multisort($folder_time, SORT_DESC, $folders); 
      } else {
        $folders = scandir($mainFolder, 0);
      }
      foreach ($folders as $album) { 
        //$album = $album->getFilename(); // if DirectoryIterator  
        if(!in_array($album, $ignore)) {
          array_push($albums, $album);
          $caption = $album;
          //$caption = substr($album,0,20);
          array_push($captions, $caption);
          $rand_dirs = glob($mainFolder.'/'.$album.'/thumbs/*.*', GLOB_NOSORT);
          if (count($rand_dirs) > 0) {
            $rand_pic = $rand_dirs[array_rand($rand_dirs)];
          } else {
            $rand_pic = $no_thumb;
          }
          array_push($random_pics, $rand_pic);
        }
      } 
      if( count($albums) == 0 ) {
        echo 'There are currently no albums.';
      } else { 
        $numPages = ceil( count($albums) / $numPerPage ); 
        if(isset($_REQUEST['p'])) {
          $currentPage = (int)$_REQUEST['p'];
          if($currentPage > $numPages) {
            $currentPage = $numPages;
          } 
        } else {
          $currentPage=1;
        }
        $start = ($currentPage * $numPerPage) - $numPerPage;
      ?>
      <div class="titlebar">
        <div class="float-left"><span class="title">Photo Gallery</span> - <?php echo count($albums); ?> albums</div>
      </div>
      <div class="clear"></div>
      <?php        
        for( $i=$start; $i<$start + $numPerPage; $i++ ) {
          if( isset($albums[$i]) ) { 
          ?>
          <div class="thumb-album shadow">
            <div class="thumb-wrapper">
              <a class="showAlb" rel="<?php echo $albums[$i]; ?>" href="<?php $_SERVER['PHP_SELF']; ?>?album=<?php echo urlencode($albums[$i]); ?>">
                <img src="<?php echo $random_pics[$i]; ?>" width="<?php echo $thumb_width; ?>" alt="<?php echo $albums[$i]; ?>" /> 
              </a>  
            </div>
            <a class="showAlb" rel="<?php echo $albums[$i]; ?>" href="<?php $_SERVER['PHP_SELF']; ?>?album=<?php echo urlencode($albums[$i]); ?>">
              <?php echo $captions[$i]; ?>
            </a> 
          </div>
          <?php    
          }
        }
      ?>
      <div class="clear"></div>
      <div align="center" class="paginate-wrapper">
        <?php
          $urlVars = "";
          $alb = "";
          echo paginateAlbum($numPages,$urlVars,$alb,$currentPage);
        ?>
      </div>   
      <?php
      }
    } else {
      // display photos in album
      $src_folder = $mainFolder.'/'.$_REQUEST['album'];
      //$src_files = new DirectoryIterator($src_folder);
      $src_files  = scandir($src_folder);
      $files = array();
      foreach ($src_files as $file) { 
        //$file = $file->getFilename(); // if DirectoryIterator 
        $ext = strrchr($file, '.');
        if(in_array($ext, $extensions)) {
          array_push( $files, $file );
          if (!is_dir($src_folder.'/thumbs')) {
            mkdir($src_folder.'/thumbs');
            chmod($src_folder.'/thumbs', 0777);
            //chown($src_folder.'/thumbs', 'apache'); 
          }
          $thumb = $src_folder.'/thumbs/'.$file;
          if (!file_exists($thumb)) {
            make_thumb($src_folder,$file,$thumb,$thumb_width);
          }
        }
      }
      if ( count($files) == 0 ) {
        echo 'There are no photos in this album!';
      } else {
        $numPages = ceil( count($files) / $numPerPage );
        if(isset($_REQUEST['p'])) {
          $currentPage = (int)$_REQUEST['p'];
          if($currentPage > $numPages) {
            $currentPage = $numPages;
          }
        } else {
          $currentPage=1;
        }
        $start = ( $currentPage * $numPerPage ) - $numPerPage; 
      ?>
      <div class="titlebar">
        <div class="float-left"><span class="title"><?php echo $_REQUEST['album']; ?></span> - <?php echo count($files); ?> images</div>
        <?php if($isFullAlbum==1) { ?><div class="float-right"><a class="refresh">View All Albums</a></div><?php } ?>
      </div>  
      <div class="clear"></div>
      <?php
        for( $i=$start; $i<$start + $numPerPage; $i++ ) {
          if( isset($files[$i]) && is_file( $src_folder .'/'. $files[$i] ) ) {
            $ext = strrchr($files[$i], '.');
            $caption = substr($files[$i], 0, -strlen($ext));
            //$dat = date("YmdHis", filemtime($src_folder.'/'. $files[$i])); 
          ?>
          <div class="thumb shadow">
            <div class="thumb-wrapper">
              <a href="<?php echo $src_folder; ?>/<?php echo $files[$i]; ?>" title="<?php echo $caption; ?>" class="albumpix">
                <img src="<?php echo $src_folder; ?>/thumbs/<?php echo $files[$i]; ?>" width="<?php echo $thumb_width; ?>" alt="<?php echo $files[$i]; ?>" />
              </a>
            </div>  
          </div>
          <?php
          } else {
            if( isset($files[$i]) ) {
              echo $files[$i];
            }
          }
        }
      ?>
      <div class="clear"></div>
      <div align="center" class="paginate-wrapper">
        <?php   
          $urlVars = "album=".urlencode($_REQUEST['album'])."&amp;";
          $alb = $_REQUEST['album'];
          echo paginateAlbum($numPages,$urlVars,$alb,$currentPage);
        ?>
      </div>
      <?php   
      } // end else  
    }
  ?>
</div>