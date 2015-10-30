<?php

/**
 * Class to handle settings
 */
class Setting {
  // Properties

  /**
  * @var int The setting ID from the database
  */
  public $id = null;
  

  /**
  * @var string Full title of the setting
  */
  public $title = null;
  

  /**
  * @var string the define of the setting
  */
  public $define = null;
  

  /**
  * @var string A short summary of the setting
  */
  public $summary = null;
  

  /**
  * @var string The value of the setting
  */
  public $value = null;
  

  /**
  * @var int edit mode of the setting
  */
  public $edit = null;
  

  /**
  * @var int stsyem mode of the setting
  */
  public $system = null;


  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
  public function __construct( $data=array() ) {
    
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['define'] ) ) $this->define = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['define'] );
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );
    if ( isset( $data['value'] ) ) $this->value = $data['value'];
    if ( isset( $data['edit'] ) ) $this->edit = (int) $data['edit'];
    if ( isset( $data['system'] ) ) $this->system = (int) $data['system'];
    
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
  * Returns a Setting object matching the given setting ID
  *
  * @param int The setting ID
  * @return Setting|false The setting object, or false if the record was not found or there was a problem
  */
  public static function getById( $id ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $sql = "SELECT *, id AS id FROM " . DB_PREFIX . "settings WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    
    $row = $st->fetch();
    
    $conn = null;
    
    if ( $row ) return new Setting( $row );
    
  }


  /**
  * Returns all (or a range of) Setting objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the setting (default="id ASC")
  * @return Array|false A two-element array : results => array, a list of Setting objects; totalRows => Total number of settings
  */
  public static function getSetting( $numRows=1000000, $order="id ASC" ) {
    
    $pdo = new PDO( "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD ); 
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $st = $pdo->prepare( "SELECT SQL_CALC_FOUND_ROWS *, id AS id FROM " . DB_PREFIX . "settings ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows" );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $setting = new Setting( $row );
      $list[] = $setting;
    }

    $pdo = null;
    
    return ( array ( "results" => $list, "totalRows" => count($list) ) );
    
  }


  /**
  * Inserts the current Setting object into the database, and sets its ID property.
  */
  public function insert() {

    // Does the Setting object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Setting::insert(): Attempt to insert a Setting object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Setting
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $sql = "INSERT INTO " . DB_PREFIX . "settings ( title, define, summary, value, edit, system ) VALUES ( :title, :define, :summary, :value, :edit, :system )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":define", $this->define, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":value", $this->value, PDO::PARAM_STR );
    $st->bindValue( ":edit", $this->edit, PDO::PARAM_INT );
    $st->bindValue( ":system", $this->system, PDO::PARAM_INT );
    $st->execute();
    
    $this->id = $conn->lastInsertId();
    
    $conn = null;
    
  }


  /**
  * Updates the current Setting object in the database.
  */
  public function update() {

    // Does the Setting object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Setting::update(): Attempt to update a Setting object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Setting
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );  
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $sql = "UPDATE " . DB_PREFIX . "settings SET title = :title, define = :define, summary = :summary, value = :value, edit = :edit, system = :system WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":define", $this->define, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":value", $this->value, PDO::PARAM_STR );
    $st->bindValue( ":edit", $this->edit, PDO::PARAM_INT );
    $st->bindValue( ":system", $this->system, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
    
  }
  
  
  /**
  * Updates the current Page siteIndex in the database.
  */  
  public function activateTheme() {
    
    // Does the Page object have an ID?
    if ( is_null( $this->value ) ) trigger_error ( "Setting::update(): Attempt to update a Setting object that does not have it\'s value property set.", E_USER_ERROR );
   
    // Update the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $sql = "UPDATE " . DB_PREFIX . "settings SET value = :value WHERE define = 'siteTheme';";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":value", $this->value, PDO::PARAM_STR );
    $st->execute();
    
    $conn = null;
        
  }


  /**
  * Deletes the current Setting object from the database.
  */
  public function delete() {

    // Does the Setting object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Setting::delete(): Attempt to delete a Setting object that does not have it's ID property set.", E_USER_ERROR );

    // Delete the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "settings WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
    
  }

}
?>