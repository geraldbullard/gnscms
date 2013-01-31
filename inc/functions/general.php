<?php
  function handleException($exception) {
    echo 'Sorry, a problem occurred. Please try later.';
    error_log($exception->getMessage());
  }
  function gen_seo_friendly_titles($_title) {
    $replace_what = array('  ', ' - ', ' ', ', ', ',');
    $replace_with = array(' ', '-', '-', ',', '-');
    $title = strtolower($_title);
    $title = str_replace($replace_what, $replace_with, $title);
    return $title;
  }
?>