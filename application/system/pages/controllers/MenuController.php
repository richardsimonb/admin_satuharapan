<?php
class MenuController extends Ext_Controller_Action
{
    function init(){
       $this->run();        
	}
    
    public function indexAction(){
        $page = $this->apiLocal->get('/pages/',array());
        $this->view->menu = $page['data'];
    }
    public function applicationAction(){
        
        $page = $this->apiLocal->get('/pages/',array());
        $this->_helper->viewRenderer->setResponseSegment('menu');
        $this->view->menu = $page['data'];
    }
    
    
    public function anotherAction()
    {
        $this->_helper->viewRenderer->setResponseSegment('menu');
        $this->view->menu = array('a', 'b', 'b');
    }
}
?>