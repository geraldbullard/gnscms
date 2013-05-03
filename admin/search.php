<?php  
  require('inc/top.php');

  $terms = strip_tags(substr($_POST['searchit'], 0, 100));
  $term = mysql_escape_string($terms); // Attack Prevention
  if ($term != "") {
    $query = mysql_query("SELECT id, title, categoryId, type FROM " . DB_PREFIX . "content WHERE title LIKE '%" . $term . "%' ORDER BY title ASC");
    $string = '';
    if (mysql_num_rows($query)) {
      $string .= "<ul>";
      while ($row = mysql_fetch_assoc($query)) {
        $string .= '<li>' . (($row['type'] == 0) ? '<i class="icon icon-orange icon-folder-open"></i>' : '<i class="icon icon-orange icon-document"></i>') . ' <a href="index.php?action=listContent&categoryId=' . (($row['type'] == 0) ? $row['id'] : $row['categoryId']) . '">' . $row['title'] . '</a></li>' . "\n";
      }
      $string .= "</ul>"; 
    } else {
      $string = '<p>No matches found!</p>';
    }
    echo $string;
  }
?>