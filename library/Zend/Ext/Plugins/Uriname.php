<?php 
class Ext_Plugins_Uriname extends Zend_Controller_Plugin_Abstract {
	
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
        if($moduleName != 'api'){
            $forward = false;
            $localAPI = new Ext_Api_Local($appsId = null, $config['api']['username'], null ,$config['api']['password']);
            $users = $localAPI->get('/feusers?filter[nicename]='.$moduleName);
            if (count($users['data'])){
              $forward = true;
            } else {
                $users = $localAPI->get('/feusers?filter[nicename]='.$controllerName);
                if (count($users['data'])){
                    $forward = true;
                }
            }
            //cheking pages 
            $pages = false;
            if($moduleName == 'pages'){
                //die("OK");
                $pages = $localAPI->get('/pages?filter[alias]='.$controllerName,array());
                //die();
                if(count($pages['data'])){
                    $request->setModuleName("pages");
                    $request->setControllerName("index");
                    $request->setActionName("index");
                    $request->setParams(array("id"=>$pages['data'][0]['uid']));   
                    $pages = true; 
                }
            }
            
            if($forward){
                 $request->setModuleName("users");
                 $request->setControllerName("profile");
                 $request->setActionName("index");
                 $request->setParams(array("id"=>$users['data'][0]['uid']));
            }
        }
        

	}
	
}
?>