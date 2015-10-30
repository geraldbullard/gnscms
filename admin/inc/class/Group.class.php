<?php
/**
 * Class to handle Admin Groups
 */ 
class Group {

  /**
  * @var int The Group id
  */    
  public $id = null;
  

  /**
  * @var string The Group title
  */    
  public $title = null;
   

  /**
  * @var int The Group Dashboard access level
  */    
  public $dashboard = null;
   

  /**
  * @var int The Group Content access level
  */    
  public $content = null;
   

  /**
  * @var int The Group Themes access level
  */    
  public $themes = null;
   

  /**
  * @var int The Group File Manager access level
  */    
  public $files = null;
  

  /**
  * @var int The Group Settings access level
  */    
  public $settings = null;
   

  /**
  * @var int The Group Users access level
  */    
  public $users = null;
   

  /**
  * @var int The Group status
  */    
  public $status = null;
    
  
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
  public function __construct( $data = array() ) {
    
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['title'] ) ) $this->title = $data['title'];
    if ( isset( $data['dashboard'] ) ) $this->dashboard = (int) $data['dashboard'];
    if ( isset( $data['content'] ) ) $this->content = (int) $data['content'];
    if ( isset( $data['themes'] ) ) $this->themes = (int) $data['themes'];
    if ( isset( $data['files'] ) ) $this->files = (int) $data['files'];
    if ( isset( $data['settings'] ) ) $this->settings = (int) $data['settings'];
    if ( isset( $data['users'] ) ) $this->users = (int) $data['users'];
    if ( isset( $data['status'] ) ) $this->status = (int) $data['status'];
    
  }
  

  /**
  * Sets the object's properties using the form post values in the supplied array
  *
  * @param assoc The form post values
  */
  public function storeFormValues( $params ) {
    
    // store the parameters
    $this->__construct( $params );
     
  }

  /**
  * Insert a new group from the stored form values
  * 
  * @param assoc The stored form values
  */
  public function insert() {
    // Does the Group object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Group::insert(): Attempt to insert a Group object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Group
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "INSERT INTO " . DB_PREFIX . "groups ( title, dashboard, content, themes, files, settings, users, status ) VALUES ( :title, :dashboard, :content, :themes, :files, :settings, :users, :status )";

    $st = $conn->prepare( $sql );
    $st->bindValue( "title", $this->title, PDO::PARAM_STR );
    $st->bindValue( "dashboard", $this->dashboard, PDO::PARAM_INT );
    $st->bindValue( "content", $this->content, PDO::PARAM_INT );
    $st->bindValue( "themes", $this->themes, PDO::PARAM_INT );
    $st->bindValue( "files", $this->files, PDO::PARAM_INT );
    $st->bindValue( "settings", $this->settings, PDO::PARAM_INT );
    $st->bindValue( "users", $this->users, PDO::PARAM_INT );
    $st->bindValue( "status", $this->status, PDO::PARAM_INT );
    $st->execute();
    
    $this->id = $conn->lastInsertId();
    
    $conn = null;
    
  }


  /**
  * Returns all Group objects in the database
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the results (default="id ASC")
  * @return Array|false A two-element array : results => array, a list of Group objects; totalRows => Total number of results
  */ 
  public static function getAll( $numRows=1000000, $order="id ASC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, id AS id FROM " . DB_PREFIX . "groups ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $group = new Group( $row );
      $list[] = $group;
    }

    // Now get the total number of groups that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }


  /**
  * Returns Group information object matching the given ID
  *
  * @param int The Group ID
  * @return Array of information from the groups table
  */
  public static function getById( $id ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT *, id AS id FROM " . DB_PREFIX . "groups WHERE id = :id";
      
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    
    $row = $st->fetch();
    
    $conn = null;
    
    if ( $row ) return new Group( $row );
    
  }


  /**
  * Updates the current Group object in the database.
  */ 
  public function update() {

    // Does the Group object have an id?
    if ( is_null( $this->id ) ) trigger_error ( "Group::update(): Attempt to update a Group object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Group
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "groups SET title = :title, dashboard = :dashboard, content = :content, themes = :themes, files = :files, settings = :settings, users = :users, status = :status WHERE id = :id";
    
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":dashboard", $this->dashboard, PDO::PARAM_INT );
    $st->bindValue( ":content", $this->content, PDO::PARAM_INT );
    $st->bindValue( ":themes", $this->themes, PDO::PARAM_INT );
    $st->bindValue( ":files", $this->files, PDO::PARAM_INT );
    $st->bindValue( ":settings", $this->settings, PDO::PARAM_INT );
    $st->bindValue( ":users", $this->users, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
    
  }
  
  /**
  * Updates the current Group staus in the database.
  */   
  public function status() {
    
    // Does the Group object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Group::status(): Attempt to update a Group object that does not have it\'s value property set.", E_USER_ERROR );
   
    // Update the Group status
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "groups SET status = :status WHERE id = :id;";
    
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
    
  }


  /**
  * Deletes the current Group object from the database.
  */
  public function delete() {

    // Does the Group object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Group::delete(): Attempt to delete a Group object that does not have it's ID property set.", E_USER_ERROR );

    // Delete the Group
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "groups WHERE id = :id LIMIT 1" );
    
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
  }
}
?>