<?php
class users_IndexController extends Ext_Controller_Action
{
	function init(){
       $this->run();       
	}

    public function indexAction()
    {    	
        //var_dump(get_include_path());
        Zend_Loader::loadClass("feusers");   
        $model = new feusers;
        echo "<pre>";
        print_r($model);
        die();
        if(isset($this->params['message'])){
   	        $this->view->message = $this->params['message'];
   	    }
    }
    public function editAction(){
        if(isset($this->session->user['uid'])){
            if(isset($this->params['update'])){
                $insertData                 = array();
                $insertData['email']        = $this->params['email'];
                $insertData['name']         = $this->params['name'];
                $insertData['birthday']     = $this->params['birthday'];
                $insertData['description']  = $this->params['description'];
                $insertData['gender']       = $this->params['gender'];
                $this->params['username']   = $this->params['email'];
                $insertData['phone']        = $this->params['telp'];
                $insertData['status_update'] = 1;
                
                $sendData = $this->apiLocal->put('/feusers/'.$this->session->user['uid'],$insertData);
                if($sendData['status']='success'){
                    $this->view->message = "Data succesfully updated";
                } else {
                    $this->view->message = "Data error";
                }
                
            }
           
           // Zend_Debug::dump($data);
        }else{
            $this->_redirect('/users/index/login');
        }
         $data = $this->apiLocal->get('/feusers/'.$this->session->user['uid']);
         $this->view->useredit = $data['data'];
        
    }
    
    public function registerAction(){
        if(!empty($this->params['email']) AND !empty($this->params['password'])){
            $insertData                 = array();
            $insertData['email']        = $this->params['email'];
            $insertData['password']     = md5($this->params['password']);
            $insertData['name']         = $this->params['name'];
            $insertData['birthday']     = $this->params['birthday'];
            $insertData['description']  = $this->params['description'];
            $insertData['gender']       = $this->params['gender'];
            $this->params['username']   = $this->params['email'];
            $insertData['phone']        = $this->params['telp'];
            $insertData['status_update']        = 1;
            
            $sendData = $this->apiLocal->post('/feusers',$insertData,true);
            
            if($sendData['results'] == 'success'){
                $data = $sendData['data'];
                $this->session->user    = array(
    				'uid'                => $sendData['newid'],
                    'crdate'            => time(),
    				'level'             => 0,
    				'name'              => $data['name'],
    				'birthday'          => $data['birthday'],
    				'email'             => $data['email'],
                    'phone'             => $data['telp'],
                    'provider'          => "",
                    'provider_id'       => "",
                    'profile_pic'       => '/templates/frontend/images/profil-default.jpg',
				);
                //EDITED BY AOH
                $this->_redirect('/index/index/register/1');
                //END EDITED BY AOH
            } else {
                $this->view->message = "Silahkan isi data dengan benar";
            }
        } else {
            $this->view->message = "Silahkan isi data dengan benar";
        }   
    }

 	public function loginAction()
    {
        if(isset($this->params['email'])){
            $userDb = $this->apiLocal->get("/feusers?filter[email]=".$this->params['email'] ."&filter[password]=".md5($this->params['password']),array(),true);
            if(count($userDb['data'])){
                $data = $userDb['data'][0];
				$this->session->user    = array(
    				'uid'                => $data['uid'],
    				'level'             => $data['level'],
    				'name'              => $data['name'],
    				'birthday'          => $data['birthday'],
    				'email'             => $data['email'],
                    'provider'          => "",
                    'provider_id'       => "",
                    'profile_pic'       => '/templates/frontend/images/profil-default.jpg',
				);
                $this->_redirect('/');               
            } else {
                $this->_redirect('/users/index/login?message=Username or Password incorrect');
            }
            exit();
        }
    }

    public function profileAction(){
        Zend_Debug::dump($this->session->user);
    }

    public function logoutAction(){
        Zend_Session::destroy(true);
        $this->_redirect("/");
        $this->_helper->viewRenderer('login');    
    }

    public function accountAction(){
        $timezones  = DateTimeZone::listAbbreviations();
        $cities     = array();

        foreach( $timezones as $key => $zones )
        {
            foreach( $zones as $id => $zone )
            {
                /**
                 * Only get timezones explicitely not part of "Others".
                 * @see http://www.php.net/manual/en/timezones.others.php
                 */
                if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'] ) 
                        && $zone['timezone_id']) {
                    $cities[$zone['timezone_id']][] = $key;
                }
            }
        }

        // For each city, have a comma separated list of all possible timezones for that city.
        foreach( $cities as $key => $value ) $cities[$key] = join( ', ', $value);

        // Only keep one city (the first and also most important) for each set of possibilities. 
        $cities = array_unique( $cities );

        // Sort by area/city name.
        ksort( $cities );

        if(isset($this->params['update'])){
            if(!empty($this->params['password'])){
                $this->params['f']['password'] = md5($this->params['password']);
            }

            $this->apiLocal->sendRequestPut("/feusers/".$this->sessionNamespace->user['uid'],$this->params['f']);
            $this->session->user['timezone'] = $this->params['f']['timezone'];
        }

        $userDb                 = $this->apiLocal->sendRequestGet("/feusers/".$this->sessionNamespace->user['uid']);
        $this->view->user       = $userDb['data'];
        $this->view->timezones  = $cities;
    }

    public function fbspeedAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);

        $time_start     = microtime();
        //require ('src/facebook.php');
        //require ('src/fbconfig.php');
        $config         = Zend_Registry::get('config');
        $facebook       = new Ext_Facebook_Wrapper(
                          array(
                          'appId'  => $config['facebook']['app_id'], // Hanya Untuk Testing
                          'secret' => $config['facebook']['app_secret'] // Hanya Untuk Testing
                          ));    

        $user_id        = $facebook->getUser();
        echo 'User id = ' .$user_id .'<br/>' ;

        if(!$user_id){
            $loginUrl   = $facebook->getLoginUrl(array(
                'scope' => 'publish_stream, user_likes'
            ));
            echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        }

        try {
            echo '<table><tr><th>GET</th><th>Time</th></tr>';
            $time_start2    = microtime(true);
            $user_profile   = $facebook->api('/me','GET');
            $time_end2      = microtime(true);
            $time_me_api    = $time_start2 - $time_end2;
            echo "<tr><td><p>facebook->api('/me') </td><td> $time_me_api seconds</td></tr>";

            $time_start3    = microtime(true);
            $access_token   = $facebook->getAccessToken();
            $likes          = $facebook->api('/me/likes/'.$config['facebook']['app_id'].'?access_token='.$access_token);
            $time_end3      = microtime(true);
            $time_like_api  = $time_start3 - $time_end3;
            echo "<tr><td>facebook->api('/me/likes/".$config['facebook']['app_id'].") </td><td> $time_me_api seconds</td></tr>";

            $time_start4    = microtime(true);
            echo '<tr><td><img src="https://graph.facebook.com/'.$user_id.'/picture" />';

            $time_end4      = microtime(true);
            $time_me_api    = $time_start4 - $time_end4;
            echo "get image  </td><td> $time_me_api seconds</td></tr>";
            echo '</table>';
        } catch (FacebookApiException $e) {
            echo "<p>Error occurs : ". $e;
            $user_id        = null;
        }

        $time_end           = microtime();
        $time_total         = $time_start - $time_end;
        echo "<p>Total page in $time_total seconds\n";
    }
   
    public function loginadminAction(){
        if(isset($this->params['username'])){
            $userDb = $this->apiLocal->get("/beusers?filter[username]=".$this->params['username'] ."&filter[password]=".md5($this->params['password']),array(),true);
            
            if(count($userDb['data'])){
                
                $data = $userDb['data'][0];
				$this->session->user = array(
    				'uid'            => $data['uid'],
    				'level'         => $data['level'],
    				'name'          => $data['name'],
    				'birthday'      => $data['birthday'],
    				'email'         => $data['email'],
                    'provider'      => "",
                    'provider_id'   => "",
                    'profile_pic'   => "",
				);
                if($data['level'] == 1){
                    $this->_redirect('/admin/index/');
                }else{
                    $this->_redirect('/');
                }             
            } else {
                $this->_redirect('/users/index/loginadmin?message=Username or Password incorrect');
            }
            exit();
        }
    }
    
    public function loginfbAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        if(!isset($_GET['error']))
    	{
    		$url              = 'http' . (( !(empty($_SERVER['HTTPS'])) ) ? 's' : '') . '://'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'].'?connect_with_fb';
    		// Create Facebook object with app id/secret
            $config           = Zend_Registry::get('config');
            $this->facebook   = new Ext_Facebook_Wrapper(
        				        array(
        						'appId'  => $config['facebook']['app_id'], // Hanya Untuk Testing
        						'secret' => $config['facebook']['app_secret'] // Hanya Untuk Testing
        				        ));    
				
    		if(!isset($_GET['state']))
    		{
    			$login_url = $this->facebook->getLoginUrl(array(
					//'scope' => 'publish_stream, offline_access, manage_pages',
					'scope' => $config['facebook']['scope'],
					'redirect_uri' => $url
 				));
                $this->_redirect($login_url); 
    		}
    
    		$user = $this->facebook->getUser();
               
            //die($user);
    		if ($user)
    		{
    			//die($user);
    			try {
					// Proceed knowing you have a logged in user who's authenticated.
					$user_profile          = $this->facebook->api('/me');
					$token                 = $this->facebook->getAccessToken();
					
					$data                  = array();
					$data['provider']      = 'facebook';
					$data['provider_id']   = $user_profile['id'];
					$data['username']      = $user_profile['username'];
					$data['token']         = $token;
					$data['name']          = $user_profile['name'];
					$data['email']         = $user_profile['email'];
                    $data['gender']        = $user_profile['gender'];
                    $data['crdate']        = time();
					$userDb = $this->apiLocal->sendRequestGet("/feusers?filter[provider_id]=".$user_profile['id']);
					
					if(count($userDb['data'])){ //jika user sudah terdaftar
						$userid   = $userDb['data'][0]['uid'];
                        //$userDb = $this->apiLocal->sendRequestPut("/users/".$userDb);
						//$userid = $user['data']['uid'];
						//$this->sessionNamespace->userDb = $userDb; 
                        $noUpdateAccount = $userDb['data'][0]['status_update'];                          
					} else {
						$result   = $this->apiLocal->sendRequestPost("/feusers", $data,true);
                        $noUpdateAccount = 0;
						$userid   = $result['newid'];
					}    					
    					
					$this->sessionNamespace->logged_in = true;
					$this->sessionNamespace->user = array(
						'uid'          => $userid,
						'provider'    => $data['provider'],
						'provider_id' => $data['provider_id'],
						'profile_pic' => 'https://graph.facebook.com/'.$data['provider_id'].'/picture',
						'name'        => $data['name'],
                        'email'       => $data['email'],
                        'level'       => 0,	
					);
                    
					if($userid){
					    if($noUpdateAccount == 0){
					        $this->_redirect('/users/index/edit');
					    }else{
					        $this->_redirect('/');    
					    }    					   
					} else {
                        print_r($user_profile);
                        die();
					}	
 				} catch (FacebookApiException $e) {
				    //error_log($e);
    				$user = null;
 				}
  			}	
   		}else{
  			die('FB Connections error...');
   		}
   }
   
   public function logintwAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        
        if(isset($this->params['close'])){                
            $user_profile                           = $this->twitter();            
            $user_profile['access_token']           = $this->sessionNamespace->oauth_access_token;
            $user_profile['access_token_secret']    = $this->sessionNamespace->oauth_access_token_secret;
             
            $data                        = array();
			$data['provider']            = 'twitter';
			$data['provider_id']         = $user_profile['id'];
			$data['username']            = $user_profile['screen_name'];
			$data['token']               = $user_profile['access_token'];
			$data['name']                = $user_profile['name'];
            $data['tw_token_secreet']     = $user_profile['access_token_secret'];
            $data['tw_screen_name']      = $user_profile['screen_name'];
            $data['url']                 = $user_profile['profile_image_url'];
            $data['crdate']              = time();
			$userDb          = $this->apiLocal->sendRequestGet("/feusers?filter[provider_id]=".$user_profile['id']);
			
			if(count($userDb['data'])){ //jika user sudah terdaftar
				$userid      = $userDb['data'][0]['uid'];
                //$userDb = $this->apiLocal->sendRequestPut("/users/".$userDb);
				//$userid = $user['data']['uid'];
				//$this->sessionNamespace->userDb = $userDb;
                $noUpdateAccount = $userDb['data'][0]['status_update']; 
                $email  = $userDb['data'][0]['email'];
			} else {
				$result      = $this->apiLocal->sendRequestPost("/feusers", $data,true);
                $register    = 1;
				$userid      = $result['newid'];
                $noUpdateAccount = 0;
                $email  = '';
			}    					
				
				
			$this->sessionNamespace->user = array(
				'uid'            => $userid,
				'provider'      => $data['provider'],
				'provider_id'   => $data['provider_id'],
				'profile_pic'   => $data['url'],
				'name'          => $data['name'],
               	'email'         => $email,
                'level'         => 0,
			);
            
			if($userid){
				if($noUpdateAccount==0){
				    $this->_redirect('/users/index/edit');
				}else{
				    $this->_redirect('/');
				}  
			} else {
                print_r($user_profile);
                die();
			}                           
        }else{
            $loginUrl = $this->twitterConnect($profileid,$providerid,$screenname,$addto);
            header("location:" . $loginUrl);    
        }   
    }
    private function twitterConnect($profileid,$providerid,$screenname,$addto="mysocial"){
        $config = Zend_Registry::get('config');    
        
        unset($this->sessionNamespace->oauth_access_token);
        unset($this->sessionNamespace->oauth_access_token_secret);
        unset($this->sessionNamespace->oauth_token);
        unset($this->sessionNamespace->oauth_token_secret);
        
        $to = new Ext_Twitter_Twitteroauth($config['twitter']['key'], $config['twitter']['secret']);
        if($profileid){            
            $url_callback = 'http://' . $_SERVER['HTTP_HOST'] . $config['frontController']['baseUrl'] . '/users/index/logintw/provider/twitter/' . 'screenname/' . $screenname . '/providerid/' . $providerid . '/profileid/' . $profileid . '/close/1';
        }else{
            $url_callback = 'http://' . $_SERVER['HTTP_HOST'] . $config['frontController']['baseUrl'] . '/users/index/logintw/provider/twitter/addto/' . $addto . '/close/1';
        }                                           
        $callback   = array('oauth_callback'=> $url_callback);
        $tok        = $to->getRequestToken($callback);            
        $this->sessionNamespace->oauth_token        = $tok['oauth_token'];
        $this->sessionNamespace->oauth_token_secret = $tok['oauth_token_secret'];
        return $request_link = $to->getAuthorizeURL($this->sessionNamespace->oauth_token) . "&force_login=true";        
    } 
    
    private function twitter(){
        $config = Zend_Registry::get('config');
        if (!isset($this->sessionNamespace->oauth_access_token) || $this->sessionNamespace->oauth_access_token=='') {
            $to = new Ext_Twitter_Twitteroauth(
                        $config['twitter']['key'], 
                        $config['twitter']['secret'], 
                        $this->sessionNamespace->oauth_token, 
                        $this->sessionNamespace->oauth_token_secret
                    );
            try{                
                if(isset($_REQUEST['oauth_verifier'])){
                    $tok = $to->getAccessToken($_REQUEST['oauth_verifier']);    
                }else{
                    $tok = $to->getAccessToken();
                }
                
            }catch (auoth $e) {die($e);}
            
            $this->sessionNamespace->oauth_access_token = $token = $tok['oauth_token'];
            $this->sessionNamespace->oauth_access_token_secret = $secret = $tok['oauth_token_secret'];
        }
        $to     = new Ext_Twitter_Twitteroauth(
                        $config['twitter']['key'], 
                        $config['twitter']['secret'],  
                        $this->sessionNamespace->oauth_access_token, 
                        $this->sessionNamespace->oauth_access_token_secret
                );        
        $user   = $to->get('account/verify_credentials');   
        return (array) $user;
    }
    
    //login mintalk
    public function loginmtAction(){
        $this->authorizeMindTalk();   
    }
    
    private function mtAPI(){
        $config = Zend_Registry::get('config');
        require_once('Ext/Mindtalk/Mindtalk.php');
        $config['client_id'] = $config['mindtalk']['client_id']; //or API Key, required
        $config['client_secret'] = $config['mindtalk']['client_secret']; //required
        $config['language'] = ''; //optional id_id or en_US, default id_id
        $this->mindtalk = new Mindtalk($config);
        if (isset($_GET['code'])) {
        	if (isset($_SESSION['digaku_sess_code'])) {
        		unset($_SESSION['digaku_sess_code']);
        		$_SESSION['digaku_sess_code'] = $_GET['code'];
        	} else {
        		$_SESSION['digaku_sess_code'] = $_GET['code'];
        	}
        }                        
        if (isset($_SESSION['digaku_sess_code'])) {
        	$this->mindtalk->setcode($_SESSION['digaku_sess_code']);
        }            
    }
    
    private function mindtalkLink(){
        $this->mtAPI();            
        $url_callback = 'http://'.$_SERVER['HTTP_HOST'].$this->_request->getBaseUrl().'/users/index/loginmt/';            
        $link = $this->_request->getBaseUrl() . "/users/index/loginmt/";
        if (!$this->mindtalk->checklogin()){
            $link = $this->mindtalk->authorize($url_callback)."&scopes=email,birth-date";
        }
        return $link;
    }
    
    private function authorizeMindTalk(){
        $this->mtAPI();            
        if ($this->mindtalk->checklogin()){
            $this->session->mt_access_token = $this->mindtalk->accesstoken()->access_token;
            $result = (array) $this->mindtalk->call('my/info');
            $this->session->mt_data = (array)$result['content']->result;
            if($this->session->mt_data['id']){
                if($this->session->mt_data['sex']==1){
                    $this->session->mt_data['gender'] = "male";
                }else{
                    $this->session->mt_data['gender'] = "female";
                }
                $data = array();
    			$data['provider'] = 'mindtalk';
    			$data['provider_id'] = $this->session->mt_data['id'];
    			$data['username'] = $this->session->mt_data['name'];
    			$data['token'] = $this->session->mt_access_token;
    			$data['name'] = $this->session->mt_data['full_name'];
                $data['url'] = $this->session->mt_data['photos'][0];
                $data['email'] = "";
                $data['crdate']        = time();
    			//print_r($data); die();
    
    			$userDb = $this->apiLocal->sendRequestGet("/feusers?filter[provider_id]=".$this->session->mt_data['id']);
    			
    			if(count($userDb['data'])){ //jika user sudah terdaftar
    				$userid = $userDb['data'][0]['id'];
                    $noUpdateAccount = $userid['data'][0]['status_update'];    
    			} else {
    				$result = $this->apiLocal->sendRequestPost("/feusers", $data,true);
    				$userid = $result['newid'];
                    $register = 1;
                    $noUpdateAccount = 0;
    			}    					
    			$this->sessionNamespace->user = array(
    					'id' => $userid,
    					'provider' => $data['provider'],
    					'provider_id' => $data['provider_id'],
    					'profile_pic' => $data['url'],
    					'name' => $data['name'],
                        'level'=>0,
                        'email'=>"",
    					
    			);
    			if($userid){
		           if($register==1){
		              $this->_redirect('/users/index/edit');
		           }else{
		              $this->_redirect('/');   
		           }
    			   
    			} else {
    			   //print_r($user_profile);
                   die();
    			}            
                    
            }else{
                $url_callback = 'http://'.$_SERVER['HTTP_HOST'].$this->_request->getBaseUrl().'/users/index/loginmt/';            
                $link = $this->_request->getBaseUrl() . "/users/index/loginmt/";
                $link = $this->mindtalk->authorize($url_callback)."&scopes=email,birth-date";
                echo "<script> top.location.href='" . $link . "'</script>";
                exit();
            }
        } else {
            $url_callback = 'http://'.$_SERVER['HTTP_HOST'].$this->_request->getBaseUrl().'/users/index/loginmt/';            
            $link = $this->_request->getBaseUrl() . "/users/index/loginmt/";
            $link = $this->mindtalk->authorize($url_callback)."&scopes=email,birth-date";
            echo "<script> top.location.href='" . $link . "'</script>";
            exit();
        }
    }
} //end of class