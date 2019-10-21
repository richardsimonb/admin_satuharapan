<?php 
class Ext_Plugins_Apimodule extends Zend_Controller_Plugin_Abstract {
	
    public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
    	 $controllerName = strtolower($request->getControllerName());
         if($controllerName != 'error'){
            $actionName = strtolower($request->getActionName());
            //print_r($_SERVER);
            //echo $actionName;
        	$request->setModuleName("api");
            $request->setControllerName("index");
            $request->setActionName($actionName);
            $request->setParams(array("model"=>$controllerName));   
         }
    	 
    }
	
}
?>