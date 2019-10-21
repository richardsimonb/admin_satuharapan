<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{                
    /**
     * Bootstrap get module name from URI
    */
    public static $frontController = null;
    public static $root = '';
    
    protected function getModule(){
        $router = new Zend_Controller_Router_Rewrite(); 
        $request =  new Zend_Controller_Request_Http();        
        $router->route($request);       
        $module = $request->getModuleName();
        
        return $module;
    }
    public function _initRequest()
    {
        $this->bootstrap('frontController');
        $front = $this->getResource('frontController');
        $front->setRequest(new Zend_Controller_Request_Http());
        $request = $front->getRequest();    
    }
    
    protected function _initAutoload(){
        $front = Zend_Controller_Front::getInstance();
        $cd = $front->getControllerDirectory();
        $moduleNames = array_keys($cd);

        foreach($moduleNames as $data){
            set_include_path("." . PATH_SEPARATOR .  "modules/" . $data . "/models/"  
            . PATH_SEPARATOR . APPLICATION_PATH . "/system/" . $data . "/models/" . get_include_path());
        }        
    }    
    protected function _initService()
    {
        $config = $this->getOption('general');
        $resources = $this->getOption('resources');
        $smarty  = $this->getOption('smarty');
        $config = array_merge($config, $resources);   
        $config = array_merge($config,array("smarty"=>$smarty));             
        Zend_Registry::set('config', $config);        
        return $config;
    }
    /**
     * Bootstrap Smarty view
     */    
     function getFilesFromDir($dir) {
      $files = array();
      if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if(is_dir($dir.'/'.$file)) {
                    $dir2 = $dir.'/'.$file;
                    $files[] = getFilesFromDir($dir2);
                }
                else {
                  $files[] = str_replace(".php","",basename($file));
                }
            }
        }
        closedir($handle);
      }
    
      return $files;
    } 
    protected function _initPlugins() {
    	$module = $this->getModule();
        $front = Zend_Controller_Front::getInstance();  
        #print($_SERVER['DOCUMENT_ROOT'].'/hooks');
        $resources = $this->getOption('resources');
        #print_r($resources);
        if(!empty($resources['frontController']['baseUrl']))
        {
            $hooks = $this->getFilesFromDir($_SERVER['DOCUMENT_ROOT'].$resources['frontController']['baseUrl'].'/hooks');
        } else {
            $hooks = $this->getFilesFromDir($_SERVER['DOCUMENT_ROOT'].'/hooks');    
        }
        
        #print_r($front->registerPlugin(new Ext_Plugins_Layout()));
	#$abc = count($hooks);
	#print_r($this->getFilesFromDir($_SERVER['DOCUMENT_ROOT'].$resources['frontController']['baseUrl'].'/hooks'));
        #die(); 
    	if ($module != 'api'){    
			/*Zend_Loader::loadClass('Ext_Plugins_Layout',
				array(
					'/mnt/data/public_html/_admin_/library/Ext/Plugins'
				)
			);*/
    	     $front->registerPlugin(new Ext_Plugins_Checkaccess());
             $front->registerPlugin(new Ext_Plugins_Layout());
             $front->registerPlugin(new Ext_Plugins_Pages());
             if(count($hooks))
            {
                foreach ($hooks as $hook)
                {
                    $className = 'hooks_'.$hook;
                    $front->registerPlugin(new $className());
                }
            }
            
    	}else{    	   
    	   $front->registerPlugin(new Ext_Plugins_Apimodule());           
    	}        
    }
    
	protected function _initView()
    {   
        // initialize smarty view
        $view = new Ext_View_Smarty($this->getOption('smarty'));
       
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setViewSuffix('html');
        $viewRenderer->setView($view);   
        //$smarty = $view->getEngine();
		//var_dump($this->smarty); die();
		//$sample = new Ext_Global_Function;
		//$smarty->registerObject('sample', $sample);
                        
        //return $view;
    }
    /**
     * Bootstrap init routes
    
    */
     //adding this function in Bootstrap class to initilize Zend_Rest_Route.
      protected function _initRestRoute() {        
      //getting an instance of zend front controller.
      $frontController = Zend_Controller_Front::getInstance ();
      //initializing a Zend_Rest_Route
      $restRoute = new Zend_Rest_Route($frontController, array(), array('api'));
      //let all actions to use Zend_Rest_Route.
      $frontController->getRouter()->addRoute( 'rest', $restRoute );      
     }
     
    /*
    protected function _initRouter()
      {
        $front = $this->getContainer()->frontcontroller;
        $router = $front->getRouter();
        $route = new Zend_Controller_Router_Route(
            ':alias',
            array(
                'module' => 'pages',
                'controller' => 'index',
                //'action'     => 'index'
            )
        );
        $router->addRoute('pages', $route);
        return $router;
    } */ 
}
