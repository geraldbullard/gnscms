<?php
  require_once('inc/top.php');
  
  $search = filter_var(htmlspecialchars(strip_tags(mysql_real_escape_string($_GET['search']))), FILTER_SANITIZE_STRING);

  if (!$_GET['submit']) {
    echo "you didn't submit a keyword";
  } else {
    if (strlen($search) <= 2) {
      echo "Search term too short";
    } else {
      $keywords = explode(" ", $search);

      foreach ($keywords as $keyword) {
        $i++;
        if ($i == 1) {
          $where .= " (title LIKE '%$keyword%' OR summary LIKE '%$keyword%' OR content LIKE '%$keyword%')";
        } else {
          $where .= " AND (title LIKE '%$keyword%' OR summary LIKE '%$keyword%' OR content LIKE '%$keyword%')";
        }
      }
      
      $where .= " ORDER BY sort";

      $query = mysql_query("SELECT title, slug FROM " . DB_PREFIX . "content WHERE status = 1 AND$where");
      $results = mysql_num_rows($query);
      
      if ($results == 0) {
        echo "Sorry, there are no matching result for <b>$search</b>.";
      } else {
        echo "$results results found!";
        while ($result = mysql_fetch_assoc($query)) {
          $title = $result['title'];
          $slug = $result['slug'] . '.html';

          echo "<p><a href='$slug'><b>$title</b></a></p>";
        }
      }
    }
  }
?>