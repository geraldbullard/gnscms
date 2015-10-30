<?php
  require('inc/top.php');
  header("Content-Type: text/xml;charset=iso-8859-1");
  echo 
'<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
  $query = mysql_query("SELECT * FROM " . DB_PREFIX . "content WHERE title != '404' ORDER BY categoryId, sort");
  while($row = mysql_fetch_assoc($query)) {
echo 
'
  <url>
    <loc>' . $row['slug'] . '.html</loc>
    <lastmod>' . $row['publicationDate'] . '</lastmod>
    <changefreq>' . sitemapChangeFrequency . '</changefreq>
    <priority>' . sitemapPriority . '</priority>
  </url>';
  }
  echo '
</urlset>';
?>