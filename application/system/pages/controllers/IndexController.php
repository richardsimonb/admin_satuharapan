<?php
class IndexController extends Ext_Controller_Action
{        
    function init(){
       $this->run();
       //$this->_helper->actionStack('application', 'menu');
	}
    public function indexAction()
    {
        if(!isset($this->params['id'])){
            $this->params['id'] = 1;
        }
        $page = $this->apiLocal->get('/pages/'.$this->params['id'] .'&filter[hidden]=0',array());
        $module = $this->apiLocal->get('/modules/?filter[pid]='.$this->params['id'] .'&order[sorting]=asc',array());
        $this->view->arr = array('id'=>1);
        $this->view->modules =$module['data'];
        //Zend_Debug::dump($module);
        
        
    }
   
}

