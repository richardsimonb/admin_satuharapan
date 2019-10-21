<?php
class AdminController extends Ext_Controller_Action
{        
    function init(){
       $this->run();        
	}
    public function indexAction()
    {
        
    }
    public function menuAction(){
        $this->addCss('res/treemenu/jquery.treeview.css');
        $this->addJs('res/treemenu/jquery.treeview.js');
        $this->addJs('res/treemenu/jquery.cookie.js');
        $page = $this->apiLocal->get('/pages/',array());
        $this->view->menu = $page['data'];
    }
    public function menueditAction()
    {
        if($this->getRequest()->isPost() AND $this->params['uid']){
            $alert = array();    
            if(!isset($this->params['f']['hidden'])){
                $this->params['f']['hidden'] = 0;
            }
            $update = $this->apiLocal->put('/pages/'.$this->params['uid'],$this->params['f']);
            $this->view->alert = $update;
        }
        $page = $this->apiLocal->get('/pages/'.$this->params['uid']);
        //Zend_Debug::dump($page);
        $this->view->row = $page['data'];
    }
    public function menudelAction(){
        $this->disableLayout();
        $this->noRender();
        $this->apiLocal->delete('/pages/'.$this->params['uid']);
    }
    public function moduleAction(){
        if($this->getRequest()->isPost() AND $this->params['f']['pid']){
            $alert = array();    
            if(!isset($this->params['f']['hidden'])){
                $this->params['f']['hidden'] = 0;
            }
            $update = $this->apiLocal->post('/modules',$this->params['f']);
            $this->view->alert = $update;
        }
        
        $module = $this->apiLocal->get('/modules/?filter[pid]='.$this->params['page_id'],array());
        //Zend_Debug::dump($module);
        $this->view->modules =$module['data'];
                
        $page = $this->apiLocal->get('/pages/'.$this->params['page_id']);
        $this->view->page = $page['data'];
        $this->view->module = array("pid"=>$this->params['page_id']);
    }
    public function moduledelAction()
    {
        $this->disableLayout();
        $this->noRender();
        if(count($this->params['uid'])){
            foreach($this->params['uid'] as $uid){
                $this->apiLocal->delete('/modules/'.$uid);
            }
        }
        
    }
    public function moduleeditAction(){
        
        if($this->getRequest()->isPost() AND $this->params['f']['pid']){
            $alert = array();    
            if(!isset($this->params['f']['hidden'])){
                $this->params['f']['hidden'] = 0;
            }
            $update = $this->apiLocal->put('/modules/'.$this->params['mm_module_id'],$this->params['f']);
            $alert['status'] = $update['status'];
            $alert['message'] = $update['message'];
            $this->view->alert = $alert;
        }
        $module = $this->apiLocal->get('/modules/'.$this->params['mm_module_id']);
        //Zend_Debug::dump($module);
        $this->view->module = $module['data'];
    }
    public function selectpageAction(){
        $page = $this->apiLocal->get('/pages/',array());
        $this->view->page = $page['data'];
    }
}

