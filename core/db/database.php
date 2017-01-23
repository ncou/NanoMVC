<?php

// Singleton to connect db.
class Database{
  // Hold the class instance.
  private static $instance = null;
  public $db;
   
  // The db connection is established in the private constructor.
  private function __construct()
  {

      $options = array(
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_EMULATE_PREPARES => false,
        //PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        // mySQL strict mode
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION sql_mode='ONLY_FULL_GROUP_BY,STRICT_ALL_TABLES,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'"
      );

      // building data source name from config
      $dsn = 'mysql:host=' . DB_HOST .
             ';dbname='    . DB_NAME .
             ';port='    . DB_PORT .
             ';connect_timeout=15';

      $this->db = new PDO($dsn, DB_USER, DB_PASS, $options);
  }
  
  public static function getInstance()
  {
    if(!isset(self::$instance))
    {
      $object = __CLASS__;
      self::$instance = new $object;
    }

    return self::$instance;
  }

}

?>