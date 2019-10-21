<?php 
class Ext_Plugins_Pages extends Zend_Controller_Plugin_Abstract {
	
    public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		//$session = new Zend_Session_Namespace();       
        
		$request = $this->getRequest();
		//$moduleName = strtolower($request->getModuleName());
		$moduleName = $request->getParam('module');
        $controllerName = strtolower($request->getControllerName());
		//$actionName = strtolower($request->getActionName());
	    //$admin_module = array('admin','users','livenu');
        //$module_dir = $request->getControllerDirectory();
        //die($moduleName);
        //die($controllerName);
        $config  = Zend_Registry::get('config');
        
            $localAPI = new Ext_Api_Local($appsId = null, $config['api']['username'], null ,$config['api']['password']);
            if($moduleName == 'pages'){
                //die("OK");
                $pages = $localAPI->get('/pages?filter[alias]='.$controllerName,array());
                //die();
                if(count($pages['data'])){
                    $request->setModuleName("pages");
                    $request->setControllerName("index");
                    $request->setActionName("index");
                    $request->setParams(array("id"=>$pages['data'][0]['uid']));   
                   
                }
            }
            
         

	}
	
}
?>