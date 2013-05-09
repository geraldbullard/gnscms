<?php 
/**
 * Class to handle content
 */
 
class Content {
  
  /**
  * @var int The content ID from the database
  */
  public $id = null;
 
  /**
  * @var string Title of the content
  */
  public $title = null;
 
  /**
  * @var string url Slug of the content
  */
  public $slug = null;
 
  /**
  * @var string Menu Title of the content
  */
  public $menuTitle = null;
 
  /**
  * @var string url Override of the content
  */
  public $override = null;

  /**
  * @var string A short summary of the page
  */
  public $summary = null;
 
  /**
  * @var string the content of the content
  */
  public $content = null;
 
  /**
  * @var string The meta description of the content
  */
  public $metaDescription = null;
  
  /**
  * @var string The meta keywords of the content
  */
  public $metaKeywords = null;
  
  /**
  * @var smallint The sort of the content
  */
  public $sort = null;
  
  /**
  * @var tinyint The status of the content
  */
  public $status = null;
  
  /**
  * @var int The siteIndex setting of the content
  */
  public $siteIndex = null;
  
  /**
  * @var string The botAction of the content
  */
  public $botAction = null;
  
  /**
  * @var tinyint The menu setting of the content
  */
  public $menu = null;

  /**
  * @var int The parent ID from the database
  */
  public $categoryId = null;
  
  /**
  * @var tinyint The content type of the item
  */
  public $type = null; 
  
  
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['slug'] ) ) $this->slug = $data['slug'];
    if ( isset( $data['menuTitle'] ) ) $this->menuTitle = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['menuTitle'] );
    if ( isset( $data['override'] ) ) $this->override = $data['override'];
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
    if ( isset( $data['metaDescription'] ) ) $this->metaDescription = $data['metaDescription'];
    if ( isset( $data['metaKeywords'] ) ) $this->metaKeywords = $data['metaKeywords'];
    if ( isset( $data['sort'] ) ) $this->sort = (int) $data['sort'];
    if ( isset( $data['status'] ) ) $this->status = (int) $data['status'];
    if ( isset( $data['siteIndex'] ) ) $this->siteIndex = (int) $data['siteIndex'];
    if ( isset( $data['botAction'] ) ) $this->botAction = $data['botAction'];
    if ( isset( $data['menu'] ) ) $this->menu = (int) $data['menu'];
    if ( isset( $data['categoryId'] ) ) $this->categoryId = (int) $data['categoryId'];
    if ( isset( $data['type'] ) ) $this->type = (int) $data['type'];
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
    
    // Store all the parameters
    $this->__construct( $params );
  }
 
 
  /**
  * Returns all Top Content objects in the DB with categoryId of 0
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the content (default="title ASC")
  * @return Array|false A two-element array : results => array, a list of Category objects; totalRows => Total number of items
  */
 
  public static function getTopList( $numRows = 1000000, $order = "sort ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "content WHERE categoryId = 0 ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $content = new Content( $row );
      $list[] = $content;
    }
 
    // Now get the total number of content objects that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Returns all Content objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the content (default="title ASC")
  * @return Array|false A two-element array : results => array, a list of Content objects; totalRows => Total number of content items
  */
 
  public static function getFullList( $numRows = 1000000, $order = "sort ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "content ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $content = new Content( $row );
      $list[] = $content;
    }
 
    // Now get the total number of content objects that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Returns Content objects in the DB based on categoryId
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the content (default="title ASC")
  * @return Array|false A two-element array : results => array, a list of Content objects; totalRows => Total number of content items
  */
 
  public static function getByCategoryList( $categoryId ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "content WHERE categoryId = :categoryId ORDER BY " . mysql_escape_string("sort ASC") . " LIMIT :numRows";
    
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", 1000000, PDO::PARAM_INT );
    $st->bindValue( ":categoryId", $categoryId, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $content = new Content( $row );
      $list[] = $content;
    }
 
    // Now get the total number of items that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Returns a Content object matching the given category ID
  *
  * @param int The category ID
  * @return Content|false The Content object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT * FROM " . DB_PREFIX . "content WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Content( $row );
  }


  /**
  * Returns a Content object matching the given page slug
  *
  * @param str The page slug
  * @return Content|false The Content object, or false if the record was not found or there was a problem
  */  
  public static function getBySlug( $slug ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT * FROM " . DB_PREFIX . "content WHERE slug = :slug LIMIT 1";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":slug", $slug, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Content( $row );
    
  } 


  /**
  * Returns a Content object matching the given page title
  *
  * @param str The page title
  * @return Content|false The Content object, or false if the record was not found or there was a problem
  */  
  public static function getByTitle( $title ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT * FROM " . DB_PREFIX . "content WHERE title = :title LIMIT 1";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":title", $title, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Content( $row );
    
  }


  /**
  * Returns true/fales if content is category and is parent
  * 
  */  
  public static function isParent( $id = 0 ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT id FROM " . DB_PREFIX . "content WHERE categoryId = :categoryId LIMIT 1";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":categoryId", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    
    if ( $row ) return true;
    
  }
 
 
  /**
  * Inserts the current Content object into the database, and sets its ID property.
  */
 
  public function insert() {
    
    // Does the Content object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Content::insert(): Attempt to insert a Content object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "INSERT INTO " . DB_PREFIX . "content ( title, slug, menuTitle, override, summary, content, metaDescription, metaKeywords, sort, status, siteIndex, botAction, menu, categoryId, type ) VALUES ( :title, :slug, :menuTitle, :override, :summary, :content, :metaDescription, :metaKeywords, :sort, :status, :siteIndex, :botAction, :menu, :categoryId, :type )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":slug", $this->slug, PDO::PARAM_STR );
    $st->bindValue( ":menuTitle", $this->menuTitle, PDO::PARAM_STR );
    $st->bindValue( ":override", $this->override, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":metaDescription", $this->metaDescription, PDO::PARAM_STR );
    $st->bindValue( ":metaKeywords", $this->metaKeywords, PDO::PARAM_STR );
    $st->bindValue( ":sort", $this->sort, PDO::PARAM_INT ); 
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT ); 
    $st->bindValue( ":siteIndex", $this->siteIndex, PDO::PARAM_INT ); 
    $st->bindValue( ":botAction", $this->botAction, PDO::PARAM_STR ); 
    $st->bindValue( ":menu", $this->menu, PDO::PARAM_INT ); 
    $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT ); 
    $st->bindValue( ":type", $this->type, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Content object in the database.
  */
 
  public function update() {
 
    // Does the Content object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Content::update(): Attempt to update a Content object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "content SET title = :title, slug = :slug, menuTitle = :menuTitle, override = :override, summary = :summary, content = :content, metaDescription = :metaDescription, metaKeywords = :metaKeywords, sort = :sort, status = :status, siteIndex = :siteIndex, botAction = :botAction, menu = :menu, categoryId = :categoryId, type = :type WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":slug", $this->slug, PDO::PARAM_STR );
    $st->bindValue( ":menuTitle", $this->menuTitle, PDO::PARAM_STR );
    $st->bindValue( ":override", $this->override, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":metaDescription", $this->metaDescription, PDO::PARAM_STR );
    $st->bindValue( ":metaKeywords", $this->metaKeywords, PDO::PARAM_STR );
    $st->bindValue( ":sort", $this->sort, PDO::PARAM_INT ); 
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT ); 
    $st->bindValue( ":siteIndex", $this->siteIndex, PDO::PARAM_INT ); 
    $st->bindValue( ":botAction", $this->botAction, PDO::PARAM_STR ); 
    $st->bindValue( ":menu", $this->menu, PDO::PARAM_INT ); 
    $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT ); 
    $st->bindValue( ":type", $this->type, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
  
  
  /**
  * Updates the current Content status in the database.
  */  
  public function updateStatus() {

    // Does the Content object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Content::updateStatus(): Attempt to update the status of a Content object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "content SET status = :status WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
    
  }
 
 
  /**
  * Deletes the current Content object from the database.
  */
 
  public function delete() {
 
    // Does the Content object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Content::delete(): Attempt to delete a Content object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "content WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }


  /**
  * Updates the current Content siteIndex in the database.
  */   
  public function siteIndex() {

    // Does the Content object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Content::update(): Attempt to update the siteIndex of a Content object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the siteIndex
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "content SET siteIndex = 0; UPDATE " . DB_PREFIX . "content SET siteIndex = 1 WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
    
  }


  /**
  * Makes a copy of the selected Content to the desired location.
  */   
  public function copyContent() {

    // Does the Content object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Content::copyContent(): Attempt to copy a Content object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "INSERT INTO " . DB_PREFIX . "content (title, slug, menuTitle, override, summary, content, metaDescription, metaKeywords, sort, status, siteIndex, botAction, menu, categoryId, type) SELECT title, slug, menuTitle, override, summary, content, metaDescription, metaKeywords, sort, status, siteIndex, botAction, menu, :categoryId, type FROM " . DB_PREFIX . "content WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT ); 
    $st->execute();
    $conn = null;
    
  }


  /**
  * Moves the selected Content to the desired location.
  */   
  public function moveContent() {

    // Does the Content object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Content::moveContent(): Attempt to move a Content object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "content SET categoryId = :categoryId WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT ); 
    $st->execute();
    $conn = null;
    
  }


  /**
  * Gets the higest sort value in the database for the current category.
  */   
  public function getSort( $id = 0 ) {
   
    // Get the highest sort value
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT sort FROM " . DB_PREFIX . "content WHERE categoryId = :categoryId ORDER BY sort DESC LIMIT 1";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":categoryId", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return $row['sort'];
    
  }
 
}
 
?>