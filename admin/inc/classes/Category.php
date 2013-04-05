<?php 
/**
 * Class to handle article categories
 */
 
class Category {
  
  // Properties
 
  /**
  * @var int The category ID from the database
  */
  public $id = null;
 
  /**
  * @var string Title of the category
  */
  public $title = null;
 
  /**
  * @var string url Slug of the category
  */
  public $slug = null;
 
  /**
  * @var string url Override of the category
  */
  public $override = null;
 
  /**
  * @var string the content of the category
  */
  public $content = null;
 
  /**
  * @var string The meta description of the category
  */
  public $metaDescription = null;
  
  /**
  * @var string The meta keywords of the category
  */
  public $metaKeywords = null;
  
  /**
  * @var smallint The sort of the category
  */
  public $sort = null;
  
  /**
  * @var tinyint The status of the category
  */
  public $status = null;
  
  /**
  * @var int The siteIndex setting of the category
  */
  public $siteIndex = null;
  
  /**
  * @var string The botAction of the category
  */
  public $botAction = null;
  
  /**
  * @var tinyint The menu setting of the category
  */
  public $menu = null;

  /**
  * @var int The parent ID from the database
  */
  public $parent = null;
 
  
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
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
    if ( isset( $data['metaDescription'] ) ) $this->metaDescription = $data['metaDescription'];
    if ( isset( $data['metaKeywords'] ) ) $this->metaKeywords = $data['metaKeywords'];
    if ( isset( $data['sort'] ) ) $this->sort = (int) $data['sort'];
    if ( isset( $data['status'] ) ) $this->status = (int) $data['status'];
    if ( isset( $data['siteIndex'] ) ) $this->siteIndex = (int) $data['siteIndex'];
    if ( isset( $data['botAction'] ) ) $this->botAction = $data['botAction'];
    if ( isset( $data['menu'] ) ) $this->menu = (int) $data['menu'];
    if ( isset( $data['parent'] ) ) $this->parent = (int) $data['parent'];
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
  * Returns a Category object matching the given category ID
  *
  * @param int The category ID
  * @return Category|false The category object, or false if the record was not found or there was a problem
  */
 
  public static function getByCategoryId( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM " . DB_PREFIX . "categories WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Category( $row );
  }


  /**
  * Returns a Category object matching the given page slug
  *
  * @param str The page slug
  * @return Page|false The page object, or false if the record was not found or there was a problem
  */  
  public static function getByCategorySlug( $slug ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM " . DB_PREFIX . "categories WHERE slug = :slug LIMIT 1";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":slug", $slug, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Category( $row );
    
  }
 
 
  /**
  * Returns all Top Category objects in the DB with no parent
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the categories (default="title ASC")
  * @return Array|false A two-element array : results => array, a list of Category objects; totalRows => Total number of categories
  */
 
  public static function getCategoryList( $numRows=1000000, $order="sort ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "categories WHERE parent = 0 
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $category = new Category( $row );
      $list[] = $category;
    }
 
    // Now get the total number of categories that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Returns Category objects in the DB based on parent
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the categories (default="title ASC")
  * @return Array|false A two-element array : results => array, a list of Category objects; totalRows => Total number of categories
  */
 
  public static function getByCategoryList( $categoryId ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . DB_PREFIX . "categories WHERE parent = :parent  
            ORDER BY " . mysql_escape_string("sort ASC") . " LIMIT :numRows";
    
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", 1000000, PDO::PARAM_INT );
    $st->bindValue( ":parent", $categoryId, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $category = new Category( $row );
      $list[] = $category;
    }
 
    // Now get the total number of categories that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Category object into the database, and sets its ID property.
  */
 
  public function insert() {
    
    // Does the Category object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Category::insert(): Attempt to insert a Category object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Category
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO " . DB_PREFIX . "categories ( title, slug, override, content, metaDescription, metaKeywords, sort, status, siteIndex, botAction, menu, parent ) VALUES ( :title, :slug, :override, :content, :metaDescription, :metaKeywords, :sort, :status, :siteIndex, :botAction, :menu, :parent )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":slug", $this->slug, PDO::PARAM_STR );
    $st->bindValue( ":override", $this->override, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":metaDescription", $this->metaDescription, PDO::PARAM_STR );
    $st->bindValue( ":metaKeywords", $this->metaKeywords, PDO::PARAM_STR );
    $st->bindValue( ":sort", $this->sort, PDO::PARAM_INT ); 
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT ); 
    $st->bindValue( ":siteIndex", $this->siteIndex, PDO::PARAM_INT ); 
    $st->bindValue( ":botAction", $this->botAction, PDO::PARAM_STR ); 
    $st->bindValue( ":menu", $this->menu, PDO::PARAM_INT ); 
    $st->bindValue( ":parent", $this->parent, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Category object in the database.
  */
 
  public function update() {
 
    // Does the Category object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Category::update(): Attempt to update a Category object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Category
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE " . DB_PREFIX . "categories SET title = :title, slug = :slug, override = :override, content = :content, metaDescription = :metaDescription, metaKeywords = :metaKeywords, sort = :sort, status = :status, siteIndex = :siteIndex, botAction = :botAction, menu = :menu, parent = :parent WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":slug", $this->slug, PDO::PARAM_STR );
    $st->bindValue( ":override", $this->override, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":metaDescription", $this->metaDescription, PDO::PARAM_STR );
    $st->bindValue( ":metaKeywords", $this->metaKeywords, PDO::PARAM_STR );
    $st->bindValue( ":sort", $this->sort, PDO::PARAM_INT ); 
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT ); 
    $st->bindValue( ":siteIndex", $this->siteIndex, PDO::PARAM_INT ); 
    $st->bindValue( ":botAction", $this->botAction, PDO::PARAM_STR ); 
    $st->bindValue( ":menu", $this->menu, PDO::PARAM_INT ); 
    $st->bindValue( ":parent", $this->parent, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
  
  
  /**
  * Updates the current Category status in the database.
  */  
  public function updateStatus() {

    // Does the Category object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Category::update(): Attempt to update a Category object that does not have it\'s ID property set.", E_USER_ERROR );
   
    // Update the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE " . DB_PREFIX . "categories SET status = :status WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
    
  }
 
 
  /**
  * Deletes the current Category object from the database.
  */
 
  public function delete() {
 
    // Does the Category object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Category::delete(): Attempt to delete a Category object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Category
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "categories WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
 
?>