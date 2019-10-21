<?php
class Ext_Api_Action extends Zend_Rest_Controller {
     /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     * 
     */
     
	private $allow = 'GET, PUT, POST, DELETE, HEAD, OPTIONS';
	
    public function run(){
        
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        
        $objectClassName = $this->_objectModelName;
        Zend_Loader::loadClass($objectClassName);  
        $this->objectApi = new $objectClassName;
        $this->cols = $this->cols(); 
        $this->objectRel = $this->objectRel();
        $this->filter = $this->filter();
        //$this->params = $this->restParams();
        $this->orderBy = $this->orderby();
        $this->offset = $this->offset();;
        $this->limit = $this->limit();
        $this->numrows = 0;
        $this->page = $this->page();
        
        
    }
    
    
    
    public function indexAction(){
     
          $this->getAction();
    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    public function getAction() {
        
        $data['data'] = $this->executeRequest();
        $data['numrows'] = $this->setNumRows();
        //$data['offset'] = 0;
        $data['listperpage'] = $this->limit;
        echo Zend_Json::encode($data);
    }
    public function executeRequest(){
        $data = array();
        //print_r($this->cols);
    	$this->objectApi->deleteCache();
    	if(count($this->params) <= 4)
        {
            // only one rows
            if(isset($this->params['id']) && $this->params['id'] != null) 
            {
                //if numeric
                if(is_numeric($this->params['id'])){
                    //print_r($this->objectRel);
                    $data = $this->objectApi->getRow($this->cols, $this->objectRel, array($this->objectApi->getPrimaryKey() => $this->params['id']), $this->orderBy, $this->offset, $this->limit,$this->page);
                    $this->numrows = $this->objectApi->getNumRows(); 
                }else{
                    $name = $this->params['id'];
                    //var_dump($this->objectApi);
                    if(method_exists($this->objectApi, $name))
                    {
                        
                        $data = $this->objectApi->$name($this->cols, $this->objectRel, $this->filter, $this->orderBy, $this->offset, $this->limit,$this->page);
                        $this->numrows = $this->objectApi->getNumRows(); 
                    }else{
                        $data = array('error' => array('message' => 'Method not found.'));
                    }  
                              
                }
            } 
            else //get all rows
            {        
              $data = $this->objectApi->getList($this->cols, $this->objectRel, $this->filter(), $this->orderBy, $this->offset, $this->limit,$this->page,$this->joinsql());
              $this->numrows = $this->objectApi->getNumRows(); 
            }
            
        }
        else
        {
            $defArr = array('module', 'controller', 'action', 'id', 'getVar', 'objectRel');
            //print_r($this->params);
            foreach($this->params as $name => $val)
            {
                if(!in_array($name, $defArr))
                {   // jika object relation tidak punya uid (all)
                    if($val == null)
                    {   
                        //$data = $this->objectApi->getRow($cols, $this->objectRel, array($this->objectApi->getPrimaryKey() => $this->params['id']), $orderBy, $this->offset, $this->limit);
                        //print_r($this->params); die();
                        //die($name);
                        if(method_exists($this->objectApi,$name)){
                            //die('tes');
                            $data = $this->objectApi->$name($this->params['id']);
                            //$this->numrows = $this->objectApi->getNumRows();
                            //die("tes");
                        } else {
                            $relName = substr($name, 0, -1);
                            $classRelName = $relName;
                            Zend_Loader::loadClass($classRelName);
                            $classRelObj = new $classRelName;
                            $classRelReferenceMap = $classRelObj->getReferenceMap();
                            $data = $classRelObj->getList($this->cols, $this->objectRel, array($classRelReferenceMap[$this->_objectModelName]['columns'] => $this->params['id']), $this->orderBy, $this->offset, $this->limit,$this->page);    
                        }
                        
                        
                    }
                    else // jika object relation punya uid
                    {
                        $data = $classRelObj->getRow($this->cols, $this->objectRel, array($classRelObj->getPrimaryKey() => $val), $this->orderBy, $this->offset, $this->limit,$this->page);
                        
                    }   
                }
                else
                {
                    //print_r($this->params);
                }
            }            
        }      
        //print_r($this->params);
         if(isset($this->params['getVar']['sql'])){
           // die('tes');
            echo $this->objectApi->getSql();
         }
         return $data;   
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     */
     public function postAction(){
         // echo "TES";
        //die('Ini post');
        $results = array();
        $get_raw_body = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($get_raw_body);
       // print_r($this->params); die();
        
        if(count($this->params) == 3)
        {
          $insertId = $this->objectApi->insert($data['data']);
        
          if($insertId)
          {
                $results = array('results'=>'success','status'=>'success', 'newid'=>$insertId, 'data'=>$data['data']);
          } else {
                $results = array(
                    'results' => 'error',
                    'status' => 'error',  
                    'newid'=>0,
                    'data' => $data['data']
                );
          }  
        } else {
             $name = $this->params['id'];   
             $results = $this->objectApi->$name($data);
        }
        //
                
        echo Zend_Json::encode($results);
    }

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
     */
     public function putAction(){
        //echo "PUT";
        $get_raw_body = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($get_raw_body);
        
        if(isset($this->params['id']) && $this->params['id'] != null) // getRowDetail
        {
            //if numeric
            if(is_numeric($this->params['id'])){
                $act = $this->objectApi->update($data['data'],$this->objectApi->getPrimaryKey() ."=".$this->params['id']);
                if($act){
                    $data['status'] =  "success";
                    $data['message'] = "Data successfully updated"; 
                } else {
                    $data['status'] =  "error";
                    $data['message'] = "Data unsuccessfully updated";
                }
            }else{
                $name = $this->params['id'];
                $rows = $this->objectApi->$name();    
            }
        
        }
        
        if(count($this->filter))
        {
            $where = array();
            foreach($this->filter as $f=>$v)
            {
                $where[] = $f.'='.$v;
            }
            $act = $this->objectApi->update($data['data'],implode(" AND ",$where));
            if($act){
                $data['status'] =  "success";
                $data['message'] = "Data successfully updated"; 
            } else {
                $data['status'] =  "error";
                $data['message'] = "Data unsuccessfully updated";
            } 
        }
        echo Zend_Json::encode($data);
    }

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
     */
    public function deleteAction(){
       if(isset($this->params['id']) && $this->params['id'] != null) // getRowDetail
        {
            //if numeric
            if(is_numeric($this->params['id'])){
                $act = $this->objectApi->delete($this->objectApi->getPrimaryKey() ."=".$this->params['id']);
                if($act){
                    $data['status'] =  "success";
                    $data['message'] = "Data successfully deleted"; 
                } else {
                    $data['status'] =  "error";
                    $data['message'] = "Data unsuccessfully deleted";
                }
            }else{
                $name = $this->params['id'];
                $rows = $this->objectApi->$name();    
            }
        
        }
        if(count($this->filter))
        {
            $where = array();
            foreach($this->filter as $f=>$v)
            {
                $where[] = $f.'='.$v;
            }
            $act = $this->objectApi->delete(implode(" AND ",$where));
            if($act){
                $data['status'] =  "success";
                $data['message'] = "Data successfully deleted"; 
            } else {
                $data['status'] =  "error";
                $data['message'] = "Data unsuccessfully deleted";
            } 
        }
        echo Zend_Json::encode($data);
    }
    
    /**
     * addons functions 
     */
    
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
    
    public function filter(){
    	$params = $this->_request->getParams();
        if(isset($params['filter'])){
    		return $params['filter'];
    	} else {
    		return array();
    	}
    }
    public function orderby(){
    	$params = $this->_request->getParams();
        $orders = array();
        if(isset($params['order'])){
            if(count($params['order'])){
                foreach($params['order'] as $f=>$t){
                    $orders[] = $f." ".$t; 
                }
            }
    		return $orders;
    	} else {
    		return array();
    	}
    }
    
    public function objectRel(){
        $objectRel = array();
        $params = $this->_request->getParams(); 
    	//$params = $this->restParams();
        //print_r($params);
    	if(isset($params['objectRel'])){
    		$objectRel = explode(";", $params['objectRel']);
    	}
        
        return $objectRel;
    }
     public function joinsql(){
        $joinsql = array();
        $params = $this->_request->getParams(); 
    	//$params = $this->restParams();
        //print_r($params);
    	if(isset($params['join']))
        {
    		$joinsql = $params['join'];
    	} 
        
        
        return $joinsql;
    }
    public function cols(){
        $objectRel = array();
        $params = $this->_request->getParams(); 
    	//$params = $this->restParams();
        //print_r($params);
    	if(isset($params['field']) AND count($params['field'])){
    		return $params['field'];
    	} else {
    	   return array();
    	}
    }
    
    public function limit(){
        $params = $this->_request->getParams();     
    	if(isset($params['limit']) AND $params['limit']){
    		return $params['limit'];
    	} else {
    	   return 50;
    	}
    }
    public function offset(){
        $params = $this->_request->getParams();     
    	if(isset($params['offset']) AND $params['offset']){
    		return $params['offset'];
    	} else {
    	   return 0;
    	}
    }
    public function page(){
        $params = $this->_request->getParams();     
    	if(isset($params['page']) AND $params['page']){
    		return $params['page'];
    	} else {
    	   return 0;
    	}
    }
    public function setNumRows(){
        return $this->numrows;
    }
}
?>