<?php
class welcome_IndexController extends Ext_Controller_Action
{
    function init(){
        $this->run();
    }
    
    public function indexAction()
    {
        //echo "tes";die();
    }
    
    public function loginAction()
    {
        if(isset($this->params['username'])){
            $userDb = $this->apiLocal->get("/feusers?filter[username]=".$this->params['username'] ."&filter[password]=".md5($this->params['password']),array(),true);
           //die();
            if(count($userDb['data'])){
                $data = $userDb['data'][0];
                $lembaga = $this->apiLocal->get('/lembagauser?filter[user_uid]='.$data['uid'],array(),true);
                //print_r($lembaga);
               // die();
                $this->session->user    = array(
    				'uid'               => $data['uid'],
    				'level'             => $data['level'],
    				'name'              => $data['name'],
    				'birthday'          => $data['birthday'],
    				'email'             => $data['email'],
                    'provider'          => "",
                    'provider_id'       => "",
                    'profile_pic'       => '/templates/frontend/images/profil-default.jpg',
                    'lembaga_uid'       => $lembaga['data'][0]['lembaga_uid'],
				);
                $this->_redirect('/');               
            } else {
                $this->_redirect('/welcome/index/login?message=Username or Password incorrect');
            }
            exit();
        }
    }
    public function loginmenuAction(){
        
    }
} //end class
?>