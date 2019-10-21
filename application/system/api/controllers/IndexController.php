<?php
class api_IndexController extends Ext_Api_Action
{             
    protected $_objectModelName;
	
    public function init(){
        //print_r($_SERVER);
        $this->params = $this->restParams();
        $config = Zend_Registry::get('config');
        if(isset($config['api']['feusers']) AND $config['api']['feusers']){
            //print_r($_SERVER);
            if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
            	if($_SERVER['PHP_AUTH_USER'] == $config['api']['username'] AND $_SERVER['PHP_AUTH_PW'] == $config['api']['password'])
                {
                    $this->getData();
                } else {
                    Zend_Loader::loadClass('feusers');
                    $user  = new feusers;
                    if($user->hasAccessApi($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'])){
                        $this->getData(); //jika sukses tampilkan data sesuai request client
                	}else{
                	   $this->HttpAuthUnauthorized();
                	}    
                }
                
            }else{
                $this->HttpAuthUnauthorized('Please provide username and api key.');
            }
        } else {
            $this->getData();
        }
    }
    
    public function HttpAuthUnauthorized($errMsg = "Invalid authentification.") {
        $realm = 'Authentication System';
        header('WWW-Authenticate: Basic realm="'.$realm.'"');
        header('HTTP/1.0 401 Unauthorized');
        
        $arrRes = array('status'=>'error' ,'message' => $errMsg,'data'=>array());
        die(json_encode($arrRes));
    }    
    
    public function getData(){
        $this->_objectModelName = $this->params['model'];
        unset($this->params['model']);
        $load = Zend_Loader::isReadable($this->_objectModelName .'.php'); 
        //Zend_Debug::dump($load);
        //echo $this->_objectModelName;
        if(!$load)
        {
            $results = array('status'=>'error','message'=>'Model not found'); 
            echo Zend_Json::encode($results);  
            exit();  
        }
        $this->run();
    }
            
}  