<?php
class Lateph{
	/**
	 * Framework Kecil Cobak"
	 * @var Lateph 
	 */
	private static $_app;
	private $appFolder;
	private $sysFolder;
	/**
	 *
	 * @var LRouter
	 */
	private $router = array(
		 'class'=>'LRouter'
	);
	private $components = array();
	public function __construct($config) {
		$time = microtime(true); 
			
		self::$_app = $this;
		$this->sysFolder = dirname(__FILE__);
		
		foreach($config as $key=>$value){
			$this->$key = $value;
		}
		spl_autoload_register("Lateph::autoLoadSys");
		$router = new LRouter;
		echo "Time Elapsed: ".(microtime(true) - $time)."s";
		
	}
	public static function autoLoadSys($className){
		 $filename = Lateph::app()->sysFolder."/" . $className . ".php";
		 if (is_readable($filename)) {
			  require $filename;
		 }
	}
	
	public static function run($config){
		self::$_app = new Lateph($config);
	}
	/**
	 * Get Instanc App
	 * @return Lateph
	 */
	public static function app(){
		return self::$_app;
	}
}