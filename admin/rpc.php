<?php
/**  
 *  $Id: rpc.php v1.0 2013-01-01 maestro $
 *
 *  gnsCMS, A Truly Simple Yet Powerful Content Management System
 *  http://www.gnscms.com/
 *
 *  Copyright (c) 2013 gnsPLANET, LLC
 *
 *  @author     gnsCMS Team :: 3G Development
 *  @copyright  (c) 2013 gnsPLANET, LLC
 *  @license    http://www.gnscms.com/license.html
 */
  // include the core functionality
  require_once('inc/top.php');

  // set the action from the url
  $action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
  
  // set the page status to enabled
  if ($action == 'enablePage') {
    $page = new Page;
    $page->storeFormValues($_GET);
    $page->updateStatus(); 
  }
  
  // set the page status to disabled
  if ($action == 'disablePage') {
    $page = new Page;
    $page->storeFormValues($_GET);
    $page->updateStatus(); 
  }
  
  // delete the page
  if ($action == 'deletePage') {
    $page = new Page;
    $page->storeFormValues($_GET);
    $page->delete(); 
  }     
?>