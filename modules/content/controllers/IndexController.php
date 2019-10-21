<?php
class content_IndexController extends Ext_Controller_Action
{
    function init(){
        $this->run();
		Zend_Loader::loadClass('content');
		Zend_Loader::loadClass('kontak');
		$this->content = new content;
		$this->kontak = new kontak;
    }
    
    public function indexAction()
    {
        //echo "tes";die();
    }
	
	public function editAction()
	{
		//http://stackoverflow.com/questions/7851925/saving-html-content-in-mysql-database
		if($this->getRequest()->isPost())
		{
			$respon = array();
			$this->params['f']['bodytext'] = stripslashes($this->params['f']['bodytext'] );
			$update = $this->content->update($this->params['f'],"uid=".$this->params['uid']);
			if($update)
			{
				$respon['status']  = 'success';
				$respon['message'] = "Data successfully updated";
			} else {
				$respon['status']  = 'error';
				$respon['message'] = "Data unsuccesfully updated";
			}
			$this->view->respon = $respon;
			//Zend_Debug::dump($this->params);
		}
		$row = $this->content->fetchRow("uid=".$this->params['uid']); 
		$this->view->detail = $row->toArray();
	}
	
	public function pagesAction()
	{
		//get list
	 $listPerPage=50; 
     $where = array();
     $where[] = "pid=6";
	 if(isset($this->params['category']))
	 {
	 	$where[] = 'newscatmm.uid_foreign='.$this->params['category'];
	 }
	 
     //Zend_Debug::dump($this->session->user);
     $join = array();
	 
     $orderByField = array("uid DESC");
	 
     $this->params['page']=isset($this->params['page']) ? $this->params['page'] : 0;
	 $offset = $this->params['page'];
	 
	 $this->view->rows = $this->content->getList(
												 $selectField=array(), 
												 $objectRelation=array(), 
												 $where, 
												 $orderByField, 
												 $offset, 
												 $listPerPage, 
												 $page=0,
												 $join
											 ); 
     $this->view->nextnumber = $listPerPage * ($this->params['page'] - 1);
     //echo $this->news->getSql();
	 
     $this->view->limit = $listPerPage;
	 $numrows  = $this->content->getNumRows();
	 //die($numrows);
	 $this->view->numrows = $numrows;
	 $this->smartyPagination($numrows,$this->params['page'],$listPerPage);     
	}
	
	public function kontakAction()
	{
	   if(isset($this->params['act']))
    	{
    		switch ($this->params['act']) {
    			case 'delete':
    				$this->kontak->update(array("deleted"=>1),"uid IN(".implode(",",$this->params['uid']) .")");
    				break;
    		}
    		exit();
    	}  
	 //get list
	 $listPerPage=50; 
     $where = array();
     $where[] = "deleted=0";
	
	 
     //Zend_Debug::dump($this->session->user);
     $join = array();
	 
     $orderByField = array("uid DESC");
	 
     $this->params['page']=isset($this->params['page']) ? $this->params['page'] : 0;
	 $offset = $this->params['page'];
	 
	 $this->view->rows = $this->kontak->getList(
												 $selectField=array(), 
												 $objectRelation=array(), 
												 $where, 
												 $orderByField, 
												 $offset, 
												 $listPerPage, 
												 $page=0,
												 $join
											 ); 
     $this->view->nextnumber = $listPerPage * ($this->params['page'] - 1);
     //echo $this->news->getSql();
	 
     $this->view->limit = $listPerPage;
	 $numrows  = $this->kontak->getNumRows();
	 //die($numrows);
	 $this->view->numrows = $numrows;
     $this->view->totalpage  = ceil($numrows/$listPerPage);
	 $this->smartyPagination($numrows,$this->params['page'],$listPerPage);     
	}
    
    
    

} //end class
?>