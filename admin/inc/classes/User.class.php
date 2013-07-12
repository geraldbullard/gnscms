<?php
/**
 * Class to handle profiles
 */

class User {

  /**
  * @var int The users id from the database
  */    
  public $id = null;

  /**
  * @var string The users first name from the database
  */    
  public $firstname = null;

  /**
  * @var string The users last name from the database
  */    
  public $lastname = null;

  /**
  * @var string The users email from the database
  */    
  public $email = null;

  /**
  * @var string The users username from the database
  */    
  public $username = null;

  /**
  * @var string The users password from the database
  */
  public $password = null;

  /**
  * @var int The users usergroup from the database
  */    
  public $usergroup = null;

  /**
  * @var string The users gender from the database
  */    
  public $gender = null;

  /**
  * @var int The users status from the database
  */    
  public $status = null;
  
  
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data = array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['firstname'] ) ) $this->firstname = $data['firstname'];
    if ( isset( $data['lastname'] ) ) $this->lastname = $data['lastname'];
    if ( isset( $data['email'] ) ) $this->email = preg_replace ( "/[^\.\@ a-zA-Z0-9()]/", "", $data['email'] );
    if ( isset( $data['username'] ) ) $this->username = $data['username'];
    if ( isset( $data['password'] ) ) $this->password = $data['password'];
    if ( isset( $data['usergroup'] ) ) $this->usergroup = (int) $data['usergroup'];
    if ( isset( $data['gender'] ) ) $this->gender = $data['gender'];
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

  // insert a new user
  public function insert() {
      
    // Does the User object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "User::insert(): Attempt to insert a User object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "INSERT INTO " . DB_PREFIX . "users ( firstname, lastname, email, username, password, usergroup, gender, status ) VALUES ( :firstname, :lastname, :email, :username, :password, :usergroup, :gender, :status )";

    $st = $conn->prepare( $sql );
    $st->bindValue( "firstname", $this->firstname, PDO::PARAM_STR );
    $st->bindValue( "lastname", $this->lastname, PDO::PARAM_STR );
    $st->bindValue( "email", $this->email, PDO::PARAM_STR );
    $st->bindValue( "username", $this->username, PDO::PARAM_STR );
    $st->bindValue( "password", md5( $this->password ), PDO::PARAM_STR );
    $st->bindValue( "usergroup", $this->usergroup, PDO::PARAM_INT );
    $st->bindValue( "gender", $this->gender, PDO::PARAM_STR );
    $st->bindValue( "status", $this->status, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
      
  }


  /**
  * Returns all User objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the user (default="id ASC")
  * @return Array|false A two-element array : results => array, a list of User objects; totalRows => Total number of users
  */

  public static function getAll( $numRows=1000000, $order="id ASC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, id AS id FROM " . DB_PREFIX . "users ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $user = new User( $row );
      $list[] = $user;
    }

    // Now get the total number of settings that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }


  /**
  * Returns a User object matching the given ID
  *
  * @param int The user ID
  * @return Setting|false The user object, or false if the record was not found or there was a problem
  */

  public static function getById( $id ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT *, id AS id FROM " . DB_PREFIX . "users WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    
    if ( $row ) return new User( $row );
    
  }


  /**
  * Updates the current User object in the database.
  */

  public function update() {

    // Does the Setting object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "User::update(): Attempt to update a User object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "users SET firstname = :firstname, lastname = :lastname, email = :email, username = :username, password = :password, usergroup = :usergroup, gender = :gender, status = :status WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":firstname", $this->firstname, PDO::PARAM_STR );
    $st->bindValue( ":lastname", $this->lastname, PDO::PARAM_STR );
    $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":password", $this->password, PDO::PARAM_INT );
    $st->bindValue( ":usergroup", $this->usergroup, PDO::PARAM_INT );
    $st->bindValue( ":gender", $this->gender, PDO::PARAM_STR );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
  
  /**
  * Updates the current User staus in the database.
  */
  
  public function status() {
    
    // Does the User object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "User::status(): Attempt to update a User object that does not have it\'s value property set.", E_USER_ERROR );
   
    // Update the User status
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "users SET status = :status WHERE id = :id;";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
    
  }


  /**
  * Deletes the current User object from the database.
  */

  public function delete() {

    // Does the User object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "User::delete(): Attempt to delete a User object that does not have it's ID property set.", E_USER_ERROR );

    // Delete the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "users WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }


  /**
  * Returns a Users usergroup id matching the given username
  *
  * @param string The users username
  * @return Setting|false The user object, or false if the record was not found or there was a problem
  */

  public static function getGroupID( $username ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT usergroup FROM " . DB_PREFIX . "users WHERE username = :username";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":username", $username, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    
    if ( $row ) return $row['usergroup'];
    
  }

}
?>