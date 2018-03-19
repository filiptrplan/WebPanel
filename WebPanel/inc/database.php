<?php
require_once 'inc.php';

class DB
{
  private static $m_pInstance;
  private static $conn;
  private static $success;

  /*
  Connects to the database and stores the connection in $conn
  It parses and ini file called db.ini
  If you move it please change this path
  */
  public static function connect()
  {
    try {
      $config = parse_ini_file("db.ini");
      self::$conn = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'], $config['username'], $config['password']);
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      self::$success = true;
    } catch (PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
      self::$success = false;
    }
  }

  /*
  Selects query with params
  EXAMPLE Usage:
  select('SELECT * FROM myTable WHERE name = :name'), array(':name' => $name));
  */
  public static function select($query, $params)
  {
    try {
      $rows = array();
      $stmt = self::$conn->prepare($query);
      $result = $stmt->execute($params);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($rows, $row);
      }
      return $rows;
    } catch (PDOException $e) {
      return 'ERROR: ' . $e->getMessage();
    }
  }

  /*
  Executes query with params
  EXAMPLE Usage:
  query('DELETE FROM myTable WHERE name = :name'), array(':name' => $name));
  */
  public static function query($query, $params)
  {
    try {
      $stmt = self::$conn->prepare($query);
      $result = $stmt->execute($params);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      return 'ERROR: ' . $e->getMessage();
    }
  }
}
