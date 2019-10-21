<?php
class Ext_Redwhite_Db extends Ext_Db_Abstract
{
    public function init()
    {
        $this->numrows = 0;    
        $frontendOptions = array(
           'lifetime' => 60, // cache lifetime of 2 hours
           'automatic_serialization' => true
        );
         
        $backendOptions = array(
            'cache_dir' => 'tmp/Zend_Cache' // Directory where to put the cache files
        );
        
        // getting a Zend_Cache_Core object
        $this->cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }
    
    public function getRow($selectField=array(), $objectRelation=array(), $filterData=array(), $join=array())
    {
    	$filter = array();
    
    	if(!is_array($selectField)) die("Colums/Fields must be array");
    	if(!count($selectField)){
    		//$sel->columns($selectField);
    		$selectField=array("*");
    		$filter[]=$selectField;
    	}
    	$sel = $this->select()->from(array($this->_alias => $this->_name), $selectField);
		if(count($join))
        {
            $this->_createJoinedSelect($sel,$join);
        }
    	//filter
    
    	//columns
    
    	//where
    	if(count($filterData)){
        	foreach ($filterData as $where) {
				$sel->where($where);	
			}
        }
    	
    
        $this->numrows =1;
    	//filter EOF
    	//echo $sel ."<br/>";
    	//die();
    	
		$rows = $this->fetchRow($sel);
        if($rows){
            $result = $rows->toArray();
        } else {
            $result = array();
        }
    	return $this->createObjectMapperRow($result, $this->_referenceMap, $objectRelation);
    }
    
    public function getList($selectField=array(), $objectRelation=array(), $filterData=array(), $orderByField = array(), $offset=0, $listPerPage=50, $page=0,$join=array())
    {
        $filter = array();
        
        if(!is_array($selectField)) die("Colums/Fields must be array");
        if(!count($selectField)){
           //$sel->columns($selectField);
           $selectField = array("*");
           $filter = $selectField;
           
        } 
        if (isset($this->_column))
        {
            $selectField = $this->_column;
            //print_r($this->_cols); die();
        }     
        $sel = $this->select();
        $sel->from(array($this->_alias => $this->_name), $selectField);
        if(count($join))
        {
            $this->_createJoinedSelect($sel,$join);
        }
        
        //filterdata / where
        $where = array(); 
        if(isset($this->_apicolumn)){
           // print_r($this->session->user);
            $where[] = $this->_apicolumn ."='1'";
        }
		/**
        if(count($filterData)){
            foreach($filterData as $fields=>$val){
                $where[] = $fields . $this->qualifier($val);
                
            }
            $filter = array_merge($filter,$where);
        }*/
        if(count($filterData)){
        	foreach ($filterData as $where) {
				$sel->where($where);	
			}
        }
        //end filterdata
        
        //order by
        if(count($orderByField)){
            $sel->order($orderByField);
            $filter = array_merge($filter,$orderByField);
        } 
        //limit
        //get numrows
     
        $sel2 = clone $sel;
        $sel2->reset(Zend_Db_Select::LIMIT_COUNT)
                   ->reset(Zend_Db_Select::LIMIT_OFFSET)
                   ->reset(Zend_Db_Select::ORDER)
                   ->reset(Zend_Db_Select::COLUMNS)
                   ->columns('COUNT(*)');
        $this->numrows = (int) $this->_db->fetchOne($sel2);
            
        if($page){
            $filterLimit = $page . "," . $listPerPage;
            $sel->limitPage($page,$listPerPage);
            array_push($filter,$filterLimit);
            //die("xx".$page);
        } else {
            $filterLimit =$offset . "," . $listPerPage ;
            $sel->limit($listPerPage,$offset);
            array_push($filter,$filterLimit);
        }
        
        
        $fileCacheArr=array();
        foreach($filter as $k=>$v){
            $fileCacheArr[] = $k.$v;
        }
        
        
        //echo $sel ."<br/>";die();
        
        
        if(isset($_GET['debugSql'])){  
            echo $sel ."<br/>";
            Zend_Debug::dump($fileCacheArr);
            die();
        }
        
        //print_r($filter);
        //die();
       
        $fileCache = md5(implode("_",$fileCacheArr));
        if(($result = $this->cache->load(__FUNCTION__ . '_' . $this->_name . $fileCache , array($this->_name))) === false )
        {
            
                
            $this->cache->save($result, __FUNCTION__ . '_' . $this->_name . $fileCache, array($this->_name));
        }
       
	   	$rows = $this->fetchAll($sel);
        if($rows){
            $result = $rows->toArray();
        } else {
            $result = array();
        }  
        //echo "<pre>";
        //print_r($result);
        //die();
        
        return $this->createObjectMapper($result, $this->_referenceMap, $objectRelation); 
    }
    
    public function mergerFilter($filter=array()){
        $string = "";
        if(count($filter)){
            foreach($filter as $key=>$val){
                if(is_array($val)){
                    
                } else {
                    
                }
            }
        }
        return $string;
    }
    
    public function createSelectObject(Zend_Db_Table_Select &$sel,$selectField="", $objectRelation=array(), $filterData=array(), $orderByField = '', $orderByType = '', $offset=0, $listPerPage=0)
    {
        $sel->setIntegrityCheck(false);
        //print_r($filterData);
        if(count($filterData)){
            $where = array();     
            foreach($filterData as $fields=>$val){
                $where[] = $fields ."= ".$val;
            }
            //print_r($where);
            $sel->where(implode(" AND ",$where));
        } 
        //die("tes");    
    }
    
    
    public function deleteCache()
    {
        $this->cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($this->_name));
    }

    private function _createJoinedSelect(Zend_Db_Table_Select &$sel,$arrayJoin) //Notice the & sign, indicating reference...
    {
        //print_r($arrayJoin); die();
        $sel->setIntegrityCheck(false); //I should set this to false, if I want to make joins (or to add values other than the current table's column names)
        foreach ($this->_referenceMap as $key => $rf) { //Loop for all the entries in the referenceMap
            //print_r($rf);die();
            
            if(isset($arrayJoin[$key]))
            {
                //die("tes");
                $colsToFetch = array();
                if(count($rf["refColumnsToFetch"]))
                {
                    foreach($rf["refColumnsToFetch"] as $cKey => $cVal) {
                        if (!is_numeric($cKey)) {
                            $colsToFetch[$cKey] = $cVal; //You might set a key
                        } else {
                            $colsToFetch[$key . "_" . $cVal] = $cVal; //To use the data in the view, you will use something like $this->prd->cats_name
                            //$colsToFetch[$key][$cVal] = $cVal;
                        }
                    }
                } else {
                    $colsToFetch = array($key.".*");
                }
                
                //print_r($arrayJoin[$key]); die();
                switch($arrayJoin[$key])
                {
                    case 'left':
                        if (isset($rf['joinFromClass'])) {
                            Zend_Loader::loadClass($rf['joinFromClass']);
							$objJoin = new $rf['joinFromClass'];
							$alias = $objJoin->getAlias();
						} else {
							$alias = $this->_alias; 
						}
                        $sel->joinLeft(array($key => $rf["refTableName"]),"{$key}.{$rf["refColumns"]} = ". $alias .".{$rf["columns"]}",$colsToFetch);
                        //$sel->joinLeft(array($key => $rf["refTableName"]),"{$key}.{$rf["refColumns"]} = ".$this->_alias .".{$rf["columns"]}",$colsToFetch);    
                    break;
                    case 'right':
                         if (isset($rf['joinFromClass'])) {
                            Zend_Loader::loadClass($rf['joinFromClass']);
							$objJoin = new $rf['joinFromClass'];
							$alias = $objJoin->getAlias();
						} else {
							$alias = $this->_alias; 
						}
                        $sel->joinRight(array($key => $rf["refTableName"]),"{$key}.{$rf["refColumns"]} = ".$alias .".{$rf["columns"]}",$colsToFetch);    
                    break;
                    default:
                         if (isset($rf['joinFromClass'])) {
                            Zend_Loader::loadClass($rf['joinFromClass']);
							$objJoin = new $rf['joinFromClass'];
							$alias = $objJoin->getAlias();
						} else {
							$alias = $this->_alias; 
						}
                        $sel->join(array($key => $rf["refTableName"]),"{$key}.{$rf["refColumns"]} = ".$alias .".{$rf["columns"]}",$colsToFetch);    
                    break;
                }
                
                    
            }
        }
        //die($sel);
    }
    
  
    
    public function createObjectMapper($objects, $referencyMap, $objectRel)
    {
       //$request = new Zend_Controller_Request_Http();
       //$params = $request->getParams();
       //print_r($params);
       //die();
       $data = array();
       //print_r($objects); 
       foreach($objects as $k=>$object){
            $data[$k]= $object;
            if(count($objectRel)){ //Jika ada permintaan object relation
                //$objectRel = explode(";",$objectRel);
                foreach ($referencyMap as $key => $rf){ //Loop for all the entries in the referenceMap
                    if(in_array($key, $objectRel)){
                        $colsToFetch = array();
                        Zend_Loader::loadClass($rf['refTableClass']);
                        $classObj = new $rf['refTableClass']; 
                        //print_r($object);
                        //print_r(array($rf['refColumns']=>$object[$rf['columns']])); die();
                        $data[$k][$key]= $classObj->getList($cols=array(), $referenceMap=array(), array($rf['refColumns'] => $object[$rf['columns']]));
                        //unset($data[$object[$rf['refColumns']]][$rf['columns']]);    
                    }
                }   
            } //end jika ada permintaan object relation
       }
       return $data;
    }
    
    public function createObjectMapperRow($objects, $referencyMap, $objectRel)
    {
       //$request = new Zend_Controller_Request_Http();
       //$params = $request->getParams();
       //print_r($params);
       //die();
       $data = array();
       //print_r($objects); die();
       //foreach($objects as $k=>$object){
            $data = $objects;
            if(count($objectRel)){ //Jika ada permintaan object relation
                //$objectRel = explode(";",$objectRel);
                //print_r($referencyMap); die();
                foreach ($referencyMap as $key => $rf){ //Loop for all the entries in the referenceMap
                    if(in_array($key, $objectRel)){
                        Zend_Loader::loadClass($rf['refTableClass']);
                        $classObj = new $rf['refTableClass']; 
                        //print_r($object);
                        //print_r(array($rf['refColumns']=>$object[$rf['columns']])); die();
                        //print_r($data); die();
                        $data[$key]= $classObj->getList($cols=array(), $referenceMap=array(), array($rf['refColumns'] => $objects[$rf['columns']]));
                        //unset($data[$rf['columns']]);    
                    }
                }   
            } //end jika ada permintaan object relation
       //}
       
       return $data;
    }
    
    public function getPrimaryKey(){
        return $this->_primary;
    }
    
    public function getReferenceMap(){
        return $this->_referenceMap;
    }
    
    public function getAlias(){
        return $this->_alias;
    } 
    
    public function getName(){
        return $this->_name;
    }
    public function getOffset(){
        return $this->offset;
    }
    public function getNumRows(){
        return $this->numrows;
    }
    
    function __call($funct,$arg) {
        return array("status"=>"error","message"=>"Method " . $funct." not found");
    } 
    
    public function getApiList() {
        $className = $this->_className;
        $class = new ReflectionClass($className);
        $cmethods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        //print_r($class);
        $exclude = array('getApiList');
        $methods = array();
        $i=0;
        foreach($cmethods as $value)
        {
            if($cmethods[$i]->class == $className)
            {
                if(!in_array($cmethods[$i]->name, $exclude))
                {
                    $methods[$i+1] = $cmethods[$i]->name;
                }
            }
            $i++;
        }
        
                
        //        //$t = new posts_models_postprofile;
        //        $cmethods = get_class_methods(__CLASS__);
        //        $exclude = array('generateAuth', 'authenticateRequest', 'getApiList');
        //        $methods = array();
        //        foreach($cmethods as $value){
        //            if(!in_array($value, $exclude)) {
        //                $methods[] = $value;
        //            }
        //        }

        //print_r($methods);
        //$methods['data'] = array('test1', 'test2');
        
        return $methods;
       
    }        
     public function getMethods() {
        $className = $this->_className;
        $class = new ReflectionClass($className);
        $cmethods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        //print_r($class);
        $exclude = array('getApiList');
        $methods = array();
        $i=0;
        foreach($cmethods as $value)
        {
            if($cmethods[$i]->class == $className)
            {
                if(!in_array($cmethods[$i]->name, $exclude))
                {
                    $methods[$i+1] = $cmethods[$i]->name;
                }
            }
            $i++;
        }
        
                
        //        //$t = new posts_models_postprofile;
        //        $cmethods = get_class_methods(__CLASS__);
        //        $exclude = array('generateAuth', 'authenticateRequest', 'getApiList');
        //        $methods = array();
        //        foreach($cmethods as $value){
        //            if(!in_array($value, $exclude)) {
        //                $methods[] = $value;
        //            }
        //        }

        //print_r($methods);
        //$methods['data'] = array('test1', 'test2');
        
        return $methods;
       
    }      
    public  function convert_utc_to_timezone($datetime, $timezone, $format = 'd M Y \a\t G:i')
	{
		$local_dt = new DateTime($datetime,new DateTimeZone('UTC'));
		$local_dt->setTimezone(new DateTimeZone($timezone));
		return (string) $local_dt->format($format);
	}   
    
    public function qualifier($val){
        $divider = explode(";",$val);
        $value = $divider[0];
        if (isset($divider[1])){
            $alternate = $divider[1];
        } else {
            $alternate = 'eq';
        }
        
        switch($alternate){
            case 'eq':
                $sql = " = '".$value ."'";
                break;
            case 'ne':
                $sql = " != '".$value ."'";
                break;
            case 'gt':
                $sql = " > '".$value ."'";
                break;
            case 'lt':
                $sql = " < '".$value ."'";
                break;
            case 'gte':
                $sql = " >= '".$value ."'";
                break;
            case 'lte':
                $sql = " <= '".$value ."'";
                break;
            case 'lk':
                $sql = " LIKE '%".$value ."%'";
                break;
            case 'in':
                $sql = " IN (".$value .")";
                break;          
            case 'bw':
                $betweenValue= explode(":",$value);
                $sql = " BETWEEN '".$betweenValue[0] ."' AND '". $betweenValue[1]."'";
                //die($sql);
                break;                             
            
        }
        return $sql;
    }
    
    function getSql(){
        $profiler = $this->db->getProfiler();
        $profiler->setEnabled(true);
        $query = $profiler->getLastQueryProfile();
        return  $query->getQuery();
    }
}
?>