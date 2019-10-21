<?php
class welcome_LoginController extends Ext_Controller_Action
{
    function init()
    {
        $this->run();
    }
    
    public function indexAction()
    {
        $this->disableLayout();
        if(isset($this->params['username'])){
            $userDb = $this->apiLocal->get("/feusers?filter[username]=".$this->params['username'] ."&filter[password]=".md5($this->params['password']),array());
            if(count($userDb['data'])){
                $data = $userDb['data'][0];
				$this->session->user    = array(
    				'uid'               => $data['uid'],
    				'level'             => 1,
    				'name'              => $data['name'],
    				'birthday'          => $data['birthday'],
    				'email'             => $data['email'],
                    'provider'          => "",
                    'provider_id'       => "",
                    'profile_pic'       => '/templates/frontend/images/profil-default.jpg',
				);
                $this->_redirect('/');               
            } else {
                $this->view->message = "Username or Password incorrect";
            }
        } else {
            $this->view->message = '';
        }
    }
} //end of class
?>