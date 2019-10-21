<?php
class Ext_Plugins_Auth  extends Zend_Controller_Action_Helper_Abstract {
//put your code here

/**
* Perform Basic HTTP authentication
*
* @return boolean authentication successful or not
*/
public function doBasicHTTPAuth() {

    $path = $_SERVER['DOCUMENT_ROOT'] .'/config/passwdBasic.txt';
    $resolver = new Zend_Auth_Adapter_Http_Resolver_File($path);
    $config = array(
    'accept_schemes' => 'basic',
    'realm' => 'Admin Area',
    'digest_domains' => '/index',
    'nonce_timeout' => 3600,
    );
    $adapter = new Zend_Auth_Adapter_Http($config);
    $adapter->setBasicResolver($resolver);
    
    $request = $this->getRequest();
    $response = $this->getResponse();
    $adapter->setRequest($request);
    $adapter->setResponse($response);
    
    $result = $adapter->authenticate();
    
    if (!$result->isValid()) {
    // Bad userame/password, or canceled password prompt
        return false;
    } else {
        return true;
    }
}

}
?>