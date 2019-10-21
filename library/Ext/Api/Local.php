<?php
//ini_set('display_errors', '1');
class Ext_Api_Local {
    public      $format         = 'json';
    public      $decode_json     = true;
    
    public function __construct($appsId = null, $uName = null, $pass = null,$api_key=null){
        //die($uName);
        $this->appsId   = $appsId;   //use this if login as merchant
        $this->api_key  = $api_key; //use this if login as merchant
        $this->uName    = $uName; //use this if login as partner
        $this->pass     = $pass;  //use this if login as partner
       
    }             
    public function executeCurl($url,$postfields=array(),$request='GET'){
    	$postfields = json_encode($postfields);	
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	/* $request :
	    GET request to /api/client – List all client
	    GET request to /api/1/client – List info for client with ID of 1
	    POST request to /api/client – Create a new client
	    PUT request to /api/1/client – Update client with ID of 1
	    DELETE request to /api/1/client – Delete client with ID of 1
	     **/
        //die($this->uName);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
    	curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch,CURLOPT_USERPWD,$this->appsId .":". $this->api_key); //merchant
        curl_setopt($ch,CURLOPT_USERPWD,$this->uName .":". $this->api_key);  //partner
    	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,1);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($postfields))                                                                       
        );  
        
    	$data = curl_exec($ch);
        if(curl_errno($ch)) {
    		echo 'Curl error: ' . curl_error($ch);
    		die();
    	}
    	curl_close($ch);
    	return $data;
    }
    
    private function getApiUrl($endpoint){
        $config = Zend_Registry::get('config'); 
        //print_r($config);
        if(isset($config['api']['url']) AND !empty($config['api']['url'])){
            $apiUrl = $config['api']['url'];
        } else {
            if(!empty($config['frontController']['baseUrl']))
            {
                $apiUrl = Ext_Global_Function::siteURL() .$config['frontController']['baseUrl'];    
            } else {
                $apiUrl = Ext_Global_Function::siteURL();
            }
            
        }
    	$this->apiUrl = $apiUrl .'/api';
        return "{$this->apiUrl}{$endpoint}";
    }  
    public function get($endpoint, $data = array(), $debug=false) {
        return $this->sendRequestGet($endpoint,$data,$debug);
    }       
    public function sendRequestGet($endpoint, $data = array(), $debug=false) {
        $apiUrl = $this->getApiUrl($endpoint);
        //$parameters['config']["apps_uid"] = $this->appsId;
    	//$parameters['config']["username"] = $this->uName;
    	//$parameters['config']["password"] = $this->pass;
    	$parameters['data'] = $data;
        $response = $this->executeCurl($apiUrl, $parameters,"GET");
        if ($debug OR isset($_GET['debug'])){
        	$this->debug($apiUrl,$parameters,$response); //please comment this  function on production
        }
        
        if ($this->format === 'json' && $this->decode_json) {
          return json_decode($response,true);
        }
        return $response;
    }
    
    public function post($endpoint, $data = array(), $debug=false) {
        return $this->sendRequestPost($endpoint,$data,$debug);
    }
    public function sendRequestPost($endpoint, $data = array(), $debug=false) {
        $apiUrl = $this->getApiUrl($endpoint);
        //$parameters['config']["apps_uid"] = $this->appsId;
    	//$parameters['config']["username"] = $this->uName;
    	//$parameters['config']["password"] = $this->pass;
    	$parameters['data'] = $data;
        $response = $this->executeCurl($apiUrl, $parameters,"POST");
        ///echo $response;
        if ($debug OR isset($_GET['debug'])){
        	$this->debug($apiUrl,$parameters,$response); //please comment this  function on production
        }
        
        if ($this->format === 'json' && $this->decode_json) {
          return json_decode($response,true);
        }
        //return $response;
    }
    public function put($endpoint, $data = array(), $debug=false) {
        return $this->sendRequestPut($endpoint,$data,$debug);
    }
    public function sendRequestPut($endpoint, $data = array(), $debug=false) {
        $apiUrl = $this->getApiUrl($endpoint);
        //$parameters['config']["apps_uid"] = $this->appsId;
    	//$parameters['config']["username"] = $this->uName;
    	//$parameters['config']["password"] = $this->pass;
    	$parameters['data'] = $data;
        $response = $this->executeCurl($apiUrl, $parameters,"PUT");
        if ($debug OR isset($_GET['debug'])){
        	$this->debug($apiUrl,$parameters,$response); //please comment this  function on production
        }
        
        if ($this->format === 'json' && $this->decode_json) {
          return json_decode($response,true);
        }
        return $response;
    }
    public function delete($endpoint, $data = array(), $debug=false) {
        return $this->sendRequestDelete($endpoint,$data,$debug);
    }
    public function sendRequestDelete($endpoint, $data = array(), $debug=false) {
        $apiUrl = $this->getApiUrl($endpoint);
        //$parameters['config']["apps_uid"] = $this->appsId;
    	//$parameters['config']["username"] = $this->uName;
    	//$parameters['config']["password"] = $this->pass;
    	$parameters['data'] = $data;
        $response = $this->executeCurl($apiUrl, $parameters,"DELETE");
        if ($debug OR isset($_GET['debug'])){
        	$this->debug($apiUrl,$parameters,$response); //please comment this  function on production
        }
        
        if ($this->format === 'json' && $this->decode_json) {
          return json_decode($response,true);
        }
        return $response;
    }    
    public function debug($apiUrl,$params,$respon){
        	echo "<pre>";
		        echo "<h1>Request to server</h1>";
		              print_r($params);
                echo "Json : ". json_encode($params);
		        echo "<br />URL : " .$apiUrl; 
		        echo "<hr>";
		        
		        echo "<h1>Response by Server</h1>";
		              print_r($respon);
		        echo "<hr>";
	        echo "</pre>";
    }
}

?>