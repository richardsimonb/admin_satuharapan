<?php
class users_AdminController extends Ext_Controller_Action
{
    function init(){
       $this->run();
	}
    
    public function indexAction()
    {    	
        $filter = array();
        $this->limit = 20;
        
        if(isset($this->params['subaction'])){
            $alert = array();
            switch($this->params['subaction']){
                case 'delete' :
                    
                    //Zend_Debug::dump($alert);
                break;
            }
            $this->view->alert = $alert;
        }
        if(!isset($this->params['page'])){
            $this->params['page'] = 0;
        } 
        $filter[] = 'offset='.$this->params['page'];
        $filter[] = 'limit='. $this->limit;
        
        $users = $this->apiLocal->get('/feusers?'. implode("&",$filter));
        $this->view->users = $users['data'];        
        //$this->paginations($users); 
        $this->smartyPagination($users['numrows'],$this->params['page'],$this->limit);               
    }
    public function feusersdelAction()
    {
        $this->disableLayout();
        $this->noRender();
        if(count($this->params['uid'])){
            foreach($this->params['uid'] as $uid){
                $this->apiLocal->delete('/feusers/'.$uid);
            }
        }
        
    }
    
    public function feusereditAction()
    {
        //Zend_Debug::dump($this->params);
        if(isset($this->params['update'])){
            $insertData                 = array();
            $insertData['username']     = $this->params['username'];
            $insertData['nicename']     = $this->params['nicename'];
            $insertData['name']         = $this->params['name'];
            $insertData['email']        = $this->params['email'];
            $insertData['birthday']     = $this->params['birthday'];
            $insertData['gender']       = $this->params['gender'];
            $insertData['phone']        = $this->params['phone'];
            $insertData['url']          = $this->params['url'];
            $insertData['phone']        = $this->params['phone'];
            //$insertData['registered']   = $this->params['registered'];
            $insertData['provider']     = $this->params['provider'];
            $insertData['provider_id']  = $this->params['provider_id'];
            $insertData['token']        = $this->params['token'];
            $insertData['tw_screen_name'] = $this->params['tw_screen_name'];
            $insertData['description']  = $this->params['description'];
            $insertData['status_update'] = 1;
            
            $sendData = $this->apiLocal->put('/feusers/'.$this->params['user_uid'],$insertData);
            $this->view->alert = $sendData;
        }
            
        $this->addJs('res/js/uservalidate.js');    
        $data = $this->apiLocal->get('/feusers/'.$this->params['user_uid']);
        $this->view->user = $data['data'];
    }
    
    public function feusernewAction()
    {
        if(isset($this->params['newdata'])){
            $insertData                 = array();
            $insertData['username']     = $this->params['username'];
            $insertData['nicename']     = $this->params['nicename'];
            $insertData['name']         = $this->params['name'];
            $insertData['email']        = $this->params['email'];
            $insertData['birthday']     = $this->params['birthday'];
            $insertData['gender']       = $this->params['gender'];
            $insertData['phone']        = $this->params['phone'];
            $insertData['url']          = $this->params['url'];
            $insertData['phone']        = $this->params['phone'];
            //$insertData['registered']   = $this->params['registered'];
            $insertData['provider']     = $this->params['provider'];
            $insertData['provider_id']  = $this->params['provider_id'];
            $insertData['token']        = $this->params['token'];
            $insertData['tw_screen_name'] = $this->params['tw_screen_name'];
            $insertData['description']  = $this->params['description'];
            $insertData['status_update'] = 1;
            $insertData['password']     = md5($this->params['password']);
            $insertData['api_key']     = md5($this->params['username'] . $this->params['password']);
            
            $sendData = $this->apiLocal->post('/feusers',$insertData);
            $this->view->alert = $sendData;
        }
        $this->addJs('res/js/uservalidate.js'); 
    }
    
      
    
}

