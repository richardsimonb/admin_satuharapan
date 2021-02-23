<?php
class hooks_user extends Zend_Controller_Plugin_Abstract
{   
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $session = new Zend_Session_Namespace();
		$request = $this->getRequest();
		//$moduleName = strtolower($request->getModuleName());
		$moduleName = $request->getParam('module');
        //die($moduleName);
        $controllerName = strtolower($request->getControllerName());
		$actionName = strtolower($request->getActionName());
        
	    $admin_module = array('news','pages');
		if (in_array($moduleName,$admin_module) OR $controllerName == 'admin')
		{
			if(!$session->user){
				$request->setModuleName("staff");
                $request->setControllerName("index");
                $request->setActionName("index");
                //$request->setParams(array("id"=>$pages['data'][0]['uid']));   
			} 			
		}
    }
}
