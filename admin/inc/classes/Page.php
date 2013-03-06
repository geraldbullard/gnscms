<?php
/**
 * Class to handle pages
 */
 
class Page {
  
  // Properties

  /**
  * @var int The page ID from the database
  */
  public $id = null;

  /**
  * @var string Full title of the page
  */
  public $title = null;

  /**
  * @var string URL slug of the page
  */
  public $slug = null;

  /**
  * @var string A short summary of the page
  */
  public $summary = null;

  /**
  * @var string The HTML content of the page
  */
  public $content = null;
  
  /**
  * @var string The meta description of the page
  */
  public $metaDescription = null;
  
  /**
  * @var string The meta keywords of the page
  */
  public $metaKeywords = null;
  
  /**
  * @var smallint The sort of the page
  */
  public $sort = null;
  
  /**
  * @var tinyint The status of the page
  */
  public $status = null;
  
  /**
  * @var smallint The parent id of the page
  */
  public $parent = null;
  
  /**
  * @var tinyint The siteIndex setting of the page
  */
  public $siteIndex = null;
  
  /**
  * @var tinyint The siteIndex setting of the page
  */
  public $botAction = null;
  
  /**
  * @var tinyint The menu setting of the page
  */
  public $menu = null;

  /**
  * @var string URL slug of the page
  */
  public $override = null;
  
  
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */  
  public function __construct( $data=array() ) {
    
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['slug'] ) ) $this->slug = $data['slug'];
    if ( isset( $data['override'] ) ) $this->override = $data['override'];
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
    if ( isset( $data['metaDescription'] ) ) $this->metaDescription = $data['metaDescription'];
    if ( isset( $data['metaKeywords'] ) ) $this->metaKeywords = $data['metaKeywords'];
    if ( isset( $data['sort'] ) ) $this->sort = (int) $data['sort'];
    if ( isset( $data['status'] ) ) $this->status = (int) $data['status'];
    if ( isset( $data['parent'] ) ) $this->parent = (int) $data['parent'];
    if ( isset( $data['siteIndex'] ) ) $this->siteIndex = (int) $data['siteIndex'];
    if ( isset( $data['botAction'] ) ) $this->botAction = $data['botAction'];
    if ( isset( $data['menu'] ) ) $this->menu = (int) $data['menu'];
    
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
  * Returns a Page object matching the given page ID
  *
  * @param int The page ID
  * @return Page|false The page object, or false if the record was not found or there was a problem
  */  
  public static function getByPageId( $id ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM " . DB_PREFIX . "pages WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Page( $row );
    
  }


  /**
  * Returns a Page object matching the given page name
  *
  * @param str The page Name
  * @return Page|false The page object, or false if the record was not found or there was a problem
  */  
  public static function getByPageSlug( $slug ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM " . DB_PREFIX . "pages WHERE slug = :slug";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":slug", $slug, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Page( $row );
    
  }


  /**
  * Returns all (or a range of) Page objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the pages (default="id ASC")
  * @return Array|false A two-element array : results => array, a list of Page objects; totalRows => Total number of pages
  */    
  public static function getPageList( $numRows=1000000, $order="sort ASC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "pages ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $page = new Page( $row );
      $list[] = $page;
    }
    
    // Now get the total number of pages that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    
  }


  /**
  * Returns all (or a range of) Page objects in the DB that have no parent page
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the pages (default="id ASC")
  * @return Array|false A two-element array : results => array, a list of Page objects; totalRows => Total number of pages
  */   
  public static function getParentList( $numRows=1000000, $order="sort ASC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "pages WHERE parent = 0 ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $page = new Page( $row );
      $list[] = $page;
    }
    
    // Now get the total number of pages that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "parentResults" => $list, "parentTotalRows" => $totalRows[0] ) );
    
  }


  /**
  * Returns all (or a range of) Page objects in the DB that do have a parent page
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the pages (default="id ASC")
  * @return Array|false A two-element array : results => array, a list of Page objects; totalRows => Total number of pages
  */    
  public static function getChildList( $numRows=1000000, $order="sort ASC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "pages WHERE parent != 0 ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $page = new Page( $row );
      $list[] = $page;
    }

    // Now get the total number of pages that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "childResults" => $list, "childTotalRows" => $totalRows[0] ) );
    
  }


  /**
  * Inserts the current Page object into the database, and sets it's ID property.
  */  
  public function insert() {
    
    // Does the Page object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Page::insert(): Attempt to insert a Page object that already has it\'s ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO " . DB_PREFIX . "pages ( title, slug, override, summary, content, metaDescription, metaKeywords, sort, status, parent, siteIndex, botAction, menu ) VALUES ( :title, :slug, :override, :summary, :content, :metaDescription, :metaKeywords, :sort, :status, :parent, :siteIndex, :botAction, :menu )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":slug", $this->slug, PDO::PARAM_STR );
    $st->bindValue( ":override", $this->override, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":metaDescription", $this->metaDescription, PDO::PARAM_STR );
    $st->bindValue( ":metaKeywords", $this->metaKeywords, PDO::PARAM_STR );
    $st->bindValue( ":sort", $this->sort, PDO::PARAM_INT ); 
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT ); 
    $st->bindValue( ":parent", $this->parent, PDO::PARAM_INT ); 
    $st->bindValue( ":siteIndex", $this->siteIndex, PDO::PARAM_INT );
    $st->bindValue( ":botAction", $this->botAction, PDO::PARAM_STR ); 
    $st->bindValue( ":menu", $this->menu, PDO::PARAM_INT ); 
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
    
  }


  /**
  * Updates the current Page object in the database.
  */  
  public function update() {

    // Does the Page object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Page::update(): Attempt to update a Page object that does not have it\'s ID property set.", E_USER_ERROR );
   
    // Update the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE " . DB_PREFIX . "pages SET title = :title, slug = :slug, override = :override, summary = :summary, content = :content, metaDescription = :metaDescription, metaKeywords = :metaKeywords, sort = :sort, status = :status, parent = :parent, siteIndex = :siteIndex, botAction = :botAction, menu = :menu WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":slug", $this->slug, PDO::PARAM_STR );
    $st->bindValue( ":override", $this->override, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":metaDescription", $this->metaDescription, PDO::PARAM_STR );
    $st->bindValue( ":metaKeywords", $this->metaKeywords, PDO::PARAM_STR );
    $st->bindValue( ":sort", $this->sort, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->bindValue( ":parent", $this->parent, PDO::PARAM_INT );
    $st->bindValue( ":siteIndex", $this->siteIndex, PDO::PARAM_INT );
    $st->bindValue( ":botAction", $this->botAction, PDO::PARAM_STR );
    $st->bindValue( ":menu", $this->menu, PDO::PARAM_INT );
    
    $st->execute();
    $conn = null;
    
  }
  
  
  /**
  * Updates the current Page status in the database.
  */  
  public function updateStatus() {

    // Does the Page object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Page::update(): Attempt to update a Page object that does not have it\'s ID property set.", E_USER_ERROR );
   
    // Update the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE " . DB_PREFIX . "pages SET status = :status WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
    
  }


  /**
  * Updates the current Page siteIndex in the database.
  */   
  public function siteIndex() {

    // Does the Page object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Page::update(): Attempt to update a Page object that does not have it\'s ID property set.", E_USER_ERROR );
   
    // Update the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE " . DB_PREFIX . "pages SET siteIndex = 0; UPDATE " . DB_PREFIX . "pages SET siteIndex = :siteIndex WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":siteIndex", $this->siteIndex, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
    
  }


  /**
  * Deletes the current Page object from the database.
  */
  public function delete() {

    // Does the Page object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Page::delete(): Attempt to delete a Page object that does not have it\'s ID property set.", E_USER_ERROR );

    // Delete the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "pages WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>