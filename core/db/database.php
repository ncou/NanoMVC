<?php


  // TODO : regarder cette classe pour se baser dessus : ????? 
  //https://github.com/Briscoooe/MVC-Rest-API/blob/master/app/DB/pdoDbManager.php
  //https://github.com/mturjak/rest-db/blob/master/application/libs/Database.php     <== regarder la méthode statis getinstance() qui semble interessante.
//https://github.com/FaaPz/Slim-PDO/blob/master/src/PDO/Database.php


// Singleton to connect db.
class Database extends \PDO{
  // Hold the class instance.
  private static $instance = null;
  private $database;
   
  // The db connection is established in the private constructor.
  public function __construct()
  {

    if (!$this->database) {
      
      global $config;

      try {
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
        $dsn = 'mysql:host=' . $config['db_host'] .
               ';dbname='    . $config['db_name'] .
               ';port='    . $config['db_port'] .
               ';connect_timeout=15';

        $this->database = parent::__construct($dsn, $config['db_user'], $config['db_pass'], $options);
      } catch (PDOException $e) {
        die('Connection database failed: ' . $e->getMessage());
      }
    }

    return $this->database;
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