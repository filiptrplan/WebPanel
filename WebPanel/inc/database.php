<?php
require 'inc.php';
$config = parse_ini_file("db.ini");
class DB {
  static protected $conn;

  public function __construct(){
    try {
      $this->conn = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'], $config['username'], $config['password']);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return 'done';
    } catch(PDOException $e) {
      return 'ERROR: ' . $e->getMessage();
    }
  }

  /*
  EXAMPLE Usage:
  $stmt = $conn->prepare('SELECT * FROM myTable WHERE name = :name');
  $stmt->execute(array('name' => $name));
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