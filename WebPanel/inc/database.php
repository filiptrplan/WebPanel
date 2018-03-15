<?php
require_once 'inc.php';

class DB {
  protected $conn;
  private $success;
  public function __construct(){
    try {
      $config = parse_ini_file("db.ini");
      $this->conn = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'], $config['username'], $config['password']);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->success = true;
    } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
      $this->success = false;
    }
  }

  /*
  Checks if the DB is connected
  */
  public function isConnected(){
    return $this->success;
  }
  
  /*
  Selects query with params
  EXAMPLE Usage:
  select('SELECT * FROM myTable WHERE name = :name'), array(':name' => $name));
  */
  public function select($query, $params){
    try {
      $rows = array();
      $stmt = $conn->prepare($query);
      $result = $stmt->execute($params);
      while($row = $stmt->fetch()) {
        array_push($rows, $row);
      }
      return $rows;
    } catch(PDOException $e) {
      return 'ERROR: ' . $e->getMessage();
    }
  }
}
?>