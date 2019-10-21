
<?php
	//error_reporting(E_ALL);
        //ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
	//ini_set("display_errors",true);
    ini_set('max_execution_time', 6000); // Seconds
    ini_set('set_time_limit',6000);
//    ini_set("memory_limit","128M");
    ini_set('short_open_tag', '1');
    ini_set('allow_url_fopen', '1');
    date_default_timezone_set('Asia/Jakarta');
    // Define path to application directory
    defined('APPLICATION_PATH')
        || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));
    
    // Define application environment
    defined('APPLICATION_ENV')
        || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));            

    // Ensure library/ is on include_path
    set_include_path("." . PATH_SEPARATOR .  "library"
    	. PATH_SEPARATOR . "modules" 
        . PATH_SEPARATOR . "hooks"
        . PATH_SEPARATOR . APPLICATION_PATH . "/system"
    	. PATH_SEPARATOR . APPLICATION_PATH  . get_include_path());
    //var_dump(get_include_path()); die();
    require_once 'Zend/Loader/Autoloader.php';
    $loader = Zend_Loader_Autoloader::getInstance();    
    
    /** Zend_Application */
    require_once 'Zend/Application.php';
    
    // Create application, bootstrap, and run
    $application = new Zend_Application(
        APPLICATION_ENV,
        'config/application.ini'
    );
    $application->bootstrap()
                ->run();
