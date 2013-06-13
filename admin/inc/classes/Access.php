<?php
/**
 * Class to handle profile Access
 */

class Access {

  /**
  * @var int The Access id from the database
  */    
  public $id = null;

  /**
  * @var string The Access name from the database
  */    
  public $name = null;

  /**
  * @var int The Access level from the database
  */    
  public $level = null;

  /**
  * @var int The Access status from the database
  */    
  public $status = null;
  
  
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data = array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['name'] ) ) $this->name = $data['name'];
    if ( isset( $data['level'] ) ) $this->level = (int) $data['level'];
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

  // insert a new Access
  public function insert() {
    
  }


  /**
  * Returns all Access objects in the database
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the results (default="id ASC")
  * @return Array|false A two-element array : results => array, a list of Access objects; totalRows => Total number of results
  */

  public static function getAll( $numRows=1000000, $order="id ASC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, id AS id FROM " . DB_PREFIX . "access ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $access = new Access( $row );
      $list[] = $access;
    }

    // Now get the total number of access levels that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }


  /**
  * Returns an Access object matching the given id
  *
  * @param int The Access id
  * @return Setting|false The Access object, or false if the record was not found or there was a problem
  */

  public static function getById( $id ) {
    
    /*$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT *, id AS id FROM " . DB_PREFIX . "users WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    
    if ( $row ) return new User( $row );*/
    
  }


  /**
  * Returns a User's Access Level information object matching the given ID
  *
  * @param int The user ID
  * @return Setting|false The user object, or false if the record was not found or there was a problem
  */

  public static function getByLevel( $level ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT *, id AS id FROM " . DB_PREFIX . "access WHERE level = :level";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":level", $level, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    
    if ( $row ) return new Access( $row );
    
  }


  /**
  * Updates the current Access object in the database.
  */

  public function update() {

    // Does the Access object have an id?
    //if ( is_null( $this->id ) ) trigger_error ( "Access::update(): Attempt to update an Access object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the User
    /*$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "users SET firstname = :firstname, lastname = :lastname, email = :email, username = :username, password = :password, gender = :gender, status = :status, group = :group WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":firstname", $this->firstname, PDO::PARAM_STR );
    $st->bindValue( ":lastname", $this->lastname, PDO::PARAM_STR );
    $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":password", $this->password, PDO::PARAM_INT );
    $st->bindValue( ":gender", $this->gender, PDO::PARAM_STR );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->bindValue( ":group", $this->group, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;*/
  }
  
  /**
  * Updates the current Access staus in the database.
  */
  
  public function status() {
    
    // Does the Access object have an ID?
    //if ( is_null( $this->id ) ) trigger_error ( "Access::status(): Attempt to update an Access object that does not have it\'s value property set.", E_USER_ERROR );
   
    // Update the User status
    /*$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "users SET status = :status WHERE id = :id;";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    $conn = null;*/
    
  }


  /**
  * Deletes the current Access object from the database.
  */

  public function delete() {

    // Does the Access object have an ID?
    //if ( is_null( $this->id ) ) trigger_error ( "Access::delete(): Attempt to delete an Access object that does not have it's ID property set.", E_USER_ERROR );

    // Delete the Access
    /*$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "users WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;*/
  }

} 

?>