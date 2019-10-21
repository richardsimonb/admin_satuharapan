<?php 
class Ext_Plugins_Checkaccess extends Zend_Controller_Plugin_Abstract {
	
    public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		//$sessionNamespace  = new Zend_Session_Namespace();
		$session = new Zend_Session_Namespace();
		$request = $this->getRequest();
		//$moduleName = strtolower($request->getModuleName());
		$moduleName = $request->getParam('module');
        $controllerName = strtolower($request->getControllerName());
		$actionName = strtolower($request->getActionName());
        
	    $admin_module = array('admin');
		if (in_array($moduleName,$admin_module) OR $controllerName == 'admin')
		{
			if(!$session->user){
				$this->_response->setRedirect($this->getRequest()->getBaseUrl().'/users/index/loginadmin');
			} else {
			  if ($session->user['level'] != 1){
			     $this->_response->setRedirect($this->getRequest()->getBaseUrl().'/');
			  }
			}				
		}

	}
	
}
	
?>