<?php 
/**
 * Class to handle events
 */ 
class Event {
  
 /**
  * @var int The event ID from the database
  */
  public $id = null;
  
 /**
  * @var string The event title from the database
  */
  public $title = null;
  
 /**
  * @var string The event description from the database
  */
  public $description = null;
  
 /**
  * @var date The event date from the database
  */
  public $eventDate = null;
  
 /**
  * @var string The event start time from the database
  */
  public $startTime = null;
  
 /**
  * @var string The event end time from the database
  */
  public $endTime = null;
  
 /**
  * @var string The event location from the database
  */
  public $location = null;
  
 /**
  * @var string The event map url from the database
  */
  public $map = null;
  
 /**
  * @var int The event status from the database
  */
  public $status = null;
  
 
 /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */ 
  public function __construct( $data=array() ) {
    
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['title'] ) ) $this->title = $data['title'];
    if ( isset( $data['description'] ) ) $this->description = $data['description'];
    if ( isset( $data['eventDate'] ) ) $this->eventDate = $data['eventDate'];
    if ( isset( $data['startTime'] ) ) $this->startTime = $data['startTime'];
    if ( isset( $data['endTime'] ) ) $this->endTime = $data['endTime'];
    if ( isset( $data['location'] ) ) $this->location = $data['location'];
    if ( isset( $data['map'] ) ) $this->map = $data['map'];
    if ( isset( $data['status'] ) ) $this->status = (int) $data['status'];
    
  }
 
 
 /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */  
  public function storeFormValues ( $params ) {
    
    // Store all the parameters
    $this->__construct( $params );

    // Parse and store the event date
    if ( isset($params['eventDate']) ) {
      $lastModified = explode ( '/', $params['eventDate'] );
      if ( count($lastModified) == 3 ) {
        $this->eventDate = $lastModified[2] . '-' . $lastModified[0] . '-' . $lastModified[1];
      }
    }
    
  }
 
 /**
  * Returns all Event objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the content (default="eventDate DESC")
  * @return Array|false A two-element array : results => array, a list of Event objects; totalRows => Total number of Event items
  */  
  public static function getAll( $numRows = 1000000, $order = "eventDate ASC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, eventDate AS eventDate, lastModified AS lastModified FROM " . DB_PREFIX . "events ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $event = new Event( $row );
      $list[] = $event;
    }
 
    // Now get the total number of event objects that matched the criteria
    foreach ($list as $item) {
      $events[] = $item->id;
    }
    
    $conn = null;
    
    return ( array ( "results" => $list, "totalRows" => count($events) ) );
  }
 
 
  /**
  * Returns an Event object matching the given event ID
  *
  * @param int The event ID
  * @return Event|false The Event object, or false if the record was not found or there was a problem
  */ 
  public static function getById( $id ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT *, eventDate AS eventDate, lastModified AS lastModified FROM " . DB_PREFIX . "events WHERE id = :id";
    
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    
    $row = $st->fetch();
    
    $conn = null;
    
    if ( $row ) return new Event( $row );
  }
 
 
  /**
  * Inserts the current Event object into the database, and sets its ID property.
  * 
  */ 
  public function insert() {
    
    // Does the Event object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Event::insert(): Attempt to insert an Event object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Event
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "INSERT INTO " . DB_PREFIX . "events ( title, description, eventDate, startTime, endTime, location, map, status, lastModified ) VALUES ( :title, :description, :eventDate, :startTime, :endTime, :location, :map, :status, now() )";
    
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":description", $this->description, PDO::PARAM_STR );
    $st->bindValue( ":eventDate", $this->eventDate, PDO::PARAM_STR );
    $st->bindValue( ":startTime", $this->startTime, PDO::PARAM_STR ); 
    $st->bindValue( ":endTime", $this->endTime, PDO::PARAM_STR ); 
    $st->bindValue( ":location", $this->location, PDO::PARAM_STR ); 
    $st->bindValue( ":map", $this->map, PDO::PARAM_STR ); 
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute(); 
    
    $this->id = $conn->lastInsertId();
    
    $conn = null;
    
  }
 
 
  /**
  * Updates the current Content object in the database.
  * 
  */  
  public function update() {
    
    // Does the Event object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Event::update(): Attempt to update an Event object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Content
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "events SET title = :title, description = :description, eventDate = :eventDate, startTime = :startTime, endTime = :endTime, location = :location, map = :map, status = :status, lastModified = now() WHERE id = :id";
    
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR ); 
    $st->bindValue( ":description", $this->description, PDO::PARAM_STR ); 
    $st->bindValue( ":eventDate", $this->eventDate, PDO::PARAM_STR );
    $st->bindValue( ":startTime", $this->startTime, PDO::PARAM_STR );
    $st->bindValue( ":endTime", $this->endTime, PDO::PARAM_STR );
    $st->bindValue( ":location", $this->location, PDO::PARAM_STR );
    $st->bindValue( ":map", $this->map, PDO::PARAM_STR );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
    
  }
 
 
  /**
  * Deletes the current Event object from the database.
  * 
  */  
  public function delete() {
 
    // Does the Event object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Event::delete(): Attempt to delete a Event object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Event
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $st = $conn->prepare ( "DELETE FROM " . DB_PREFIX . "events WHERE id = :id LIMIT 1" );
    
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
    
  }
  
  
  /**
  * Updates the current Event status in the database.
  * 
  */  
  public function updateStatus() {
    
    // Does the Event object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Event::updateStatus(): Attempt to update the status of a Event object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Event
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "UPDATE " . DB_PREFIX . "events SET status = :status WHERE id = :id";
    
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->execute();
    
    $conn = null;
    
  } 
} 
?>