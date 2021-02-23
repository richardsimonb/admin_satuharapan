<?php 
class Ext_Plugins_Layout extends Zend_Controller_Plugin_Abstract {
	
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $config = Zend_Registry::get('config');
        
        $moduleName = $request->getParam('module');
        $controllerName = strtolower($request->getControllerName());
		$actionName = strtolower($request->getActionName());
        
        if ('admin' == $request->getModuleName() OR 'admin' == $request->getControllerName()) {
            // If not in this module, return early
            $tmplPath = $config['layout']['pathAdmin'];
            $htmlFile = $config['layout']['pathAdminFile'];
    	}else if ($moduleName=='users' AND $actionName=='loginadmin'){
    	    $tmplPath = $config['layout']['pathAdmin'];
            $htmlFile = $config['layout']['pathAdminFileLogin'];
    	}else{
    		$tmplPath = $config['layout']['pathFrontend'];
            $htmlFile = $config['layout']['pathFrontendFile'];
    	}
        $globalvar = array();
        
        $view = new Ext_View_Smarty($config['smarty']);
        $view->assign("baseUrl",$config['frontController']['baseUrl']); 
        //$view->register_object('gfunction',Ext_Global_Function);
        if(!empty($config['frontController']['baseUrl']))
        {
            $basehttp = Ext_Global_Function::siteURL() .$config['frontController']['baseUrl'];    
			$view->assign("tplpath",$basehttp."/".$tmplPath ."/"); 
			$globalvar['tplpath'] = $basehttp."/".$tmplPath ."/";
			$globalvar['baseUrl'] = $basehttp;
			$view->assign("baseUrl",$basehttp);
        } else {
            $basehttp = Ext_Global_Function::siteURL();
			$view->assign("tplpath",$config['frontController']['baseUrl']."/".$tmplPath ."/"); 
			$globalvar['tplpath'] = $config['frontController']['baseUrl']."/".$tmplPath ."/";
			$globalvar['baseUrl'] = $config['frontController']['baseUrl'];
        
        }
        $view->assign("basehttp",$basehttp); 
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view);
        
        $globalvar['basehttp'] = $basehttp;        
        Zend_Registry::set('GLOBAL_VAR', $globalvar);
        // Change layout
        //Zend_Layout::getMvcInstance()->setLayout('foomodule');
        $layout = Zend_Layout::getMvcInstance();
        $layout->setViewSuffix('html');
        $layout->setLayout($htmlFile)->setLayoutPath($tmplPath);        
        Zend_Controller_Action_HelperBroker::addPath( $_SERVER['DOCUMENT_ROOT'].$config['frontController']['baseUrl'] .'/application/system/pages/views/helpers', 'Helper');
    }
	
}
?>
