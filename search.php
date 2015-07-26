<?php
  require_once('inc/top.php');
  
  $search = filter_var(htmlspecialchars(strip_tags(mysql_real_escape_string($_GET['search']))), FILTER_SANITIZE_STRING);

  if (!$_GET['submit']) {
    header("Location: search.html");
  } else {
    if (strlen($search) <= 2) {
      header("Location: search.html?minterms");
    } else {
      $keywords = explode(" ", $search);

      foreach ($keywords as $keyword) {
        $i++;
        if ($i == 1) {
          $where .= "(title LIKE '%$keyword%' OR summary LIKE '%$keyword%' OR content LIKE '%$keyword%')";
        } else {
          $where .= "AND (title LIKE '%$keyword%' OR summary LIKE '%$keyword%' OR content LIKE '%$keyword%')";
        }
      }
      
      $where .= " ORDER BY sort";

      $query = mysql_query("SELECT title, slug FROM " . DB_PREFIX . "content WHERE status = 1 AND $where");
      $results = mysql_num_rows($query);
      
      if ($results == 0) {
        header("Location: search.html?noresults");
      } else {
        $cnt = 1;
        while ($result = mysql_fetch_assoc($query)) {
          $title = $result['title'];
          $slug = $result['slug'] . '.html';
          $data .= '&title' . $cnt . '=' . str_replace(" ", "_", $title) . '&slug' . $cnt . '=' . $slug;
          $cnt++;
        }
        header("Location: search.html?results=" . urlencode($search) . $data);
      }
    }
  }
?>