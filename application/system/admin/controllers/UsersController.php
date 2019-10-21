<?php
class admin_UsersController extends Ext_Controller_Action
{
    function init(){
       $this->run();
	}
    
    public function indexAction()
    {    	
        $filter = array();
        $this->limit = 20;
        if(!isset($this->params['page'])){
            $this->params['page'] = 1;
        } 
        $filter[] = 'offset='.$this->params['page'];
        $filter[] = 'limit='. $this->limit;
        
        $users = $this->apiLocal->get('/users?'. implode("&",$filter));
        $this->view->users = $users['data'];        
        //$this->paginations($users); 
        $this->smartyPagination($users['numrows'],$this->params['page'],$this->limit);               
    }
    
      
    
}

