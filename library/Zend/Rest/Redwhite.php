<?php
class Zend_Rest_Redwhite extends Zend_Rest_Controller {
     /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     * 
     */
    
    public function indexAction(){
          $this->getAction();
    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    public function getAction() {
       
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     */
    public function postAction(){
        
    }

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
     */
    public function putAction(){
        
    }

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
     */
    public function deleteAction(){
        
    }
    
    public function restParams($var=null){
        $request = new Zend_Controller_Request_Http();
        $request = $request->getParams();
        $params = $this->_request->getParams();                        
        foreach($request as $k=>$v){
            unset($params[$k]);
        }
        
        if(isset($params[$var])){
            return $params[$var];
        }else{
            return $params;    
        }        
    }
}
?>