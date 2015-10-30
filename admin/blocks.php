<?php
  require_once('inc/config.php');
  $pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $st = $pdo->prepare("SELECT value FROM " . DB_PREFIX . "settings WHERE define = 'siteTheme'");
  $st->execute();
  $theme = $st->fetch();
  if (isset($_GET['leftadd'])) {
    include('../theme/' . $theme['value'] . '/block/' . $_GET['leftadd'] . '.php');
    $bl = $pdo->prepare("INSERT INTO " . DB_PREFIX . "blocks (title, filename, summary, contentId, side, sort, status) VALUES ('" . blockTitle . "', '" . $_GET['leftadd'] . ".php', '" . blockSummary . "', '" . $_GET['cId'] . "', 'l', 99, 1)");
    $bl->execute();
  }
  if (isset($_GET['rightadd'])) {
    include('../theme/' . $theme['value'] . '/block/' . $_GET['rightadd'] . '.php');
    $bl = $pdo->prepare("INSERT INTO " . DB_PREFIX . "blocks (title, filename, summary, contentId, side, sort, status) VALUES ('" . blockTitle . "', '" . $_GET['rightadd'] . ".php', '" . blockSummary . "', '" . $_GET['cId'] . "', 'r', 99, 1)");
    $bl->execute();
  }
  $st->closeCursor();
  if (isset($_GET['sort'])) {
    foreach ($_GET['box'] as $newsort => $box) {
      $box = 'box_' . $box . '.php';
      $st = $pdo->prepare("UPDATE " . DB_PREFIX . "blocks SET sort = " . $newsort . " WHERE filename = '" . $box . "'");
      $st->execute(); 
    }
  }
  if (isset($_GET['remove'])) {
    $bl = $pdo->prepare("DELETE FROM " . DB_PREFIX . "blocks WHERE filename = '" . $_GET['remove'] . ".php'");
    $bl->execute();
  }
  $conn = null;
?>