<?php
class admin_IndexController extends Ext_Controller_Action
{
    function init(){
       $this->run();
	}
    
    public function indexAction()
    {    	
       //$js1 = "alert('OK')";
       //$js2 = "alert('OK 2')";
       //$this->view->headScript()->appendScript($js1)->appendScript($js2);
       //echo $this->getModuleDirectory();
      // $this->addJs('static/js/menupages.js');
      // $this->addCss('static/css/menupages.css');
    }
    
    public function leftmenuAction(){
      
       
       //$this->addPhp('lib/sample.php');
       $layout = Zend_Layout::getMvcInstance();
       
       $module_dir = $this->getFrontController()->getControllerDirectory();
       unset($module_dir['models']);
       unset($module_dir['modules']);
       unset($module_dir['admin']);
       $this->view->module = array_keys($module_dir);
    } 
}