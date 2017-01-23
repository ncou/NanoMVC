<?php
/*
 * Autoload class
 *
 * Registers autoload clallback.
 *
 * @author Bryan Trudel https://github.com/thezombieguy
 * @package Pip
 */
class Autoload {
  private static $instance; 
  private $paths; 
  
  /*
   * initiates the autoload.
   */
  private function __construct(array $paths)
  {
    $this->paths = $paths;
    $this->register();
  }
  
  /*
   * Get singleton instance
   */
  public static function loadClasses(array $paths)
  {
    if(!self::$instance){
      self::$instance = new Autoload($paths);
    }
        
    return self::$instance;
  }
  
  /*
   * Registers the autoload function
   * 
   * @return array $this callback for autoload
   */
  private function register()
  {
    spl_autoload_register(array(__CLASS__, 'autoload'));
    return $this;
  }
  
  /*
   * load a class
   *
   * @param string  $class  the class you want to load
   * @return  void
   */
  private function autoload($class)
  {
    $paths = $this->paths; //$config['autoload_paths'];

    foreach($paths as $path){
      if(file_exists($path . strtolower($class) . '.php')) {
        require_once($path . strtolower($class) . '.php');
      }
    }
  }
  
}
?>