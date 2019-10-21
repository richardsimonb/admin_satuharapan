<?php
class banner_IndexController extends Ext_Controller_Action
{
    function init(){
        $this->run();
		Zend_Loader::loadClass('banners');
		$this->banner = new banners;
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
	
	public function indexAction()
	{
		//get list
	 $listPerPage=50; 
     $where = array();
     
	 if(isset($this->params['category']))
	 {
	 	//$where[] = 'newscatmm.uid_foreign='.$this->params['category'];
	 }
	 
     //Zend_Debug::dump($this->session->user);
     $join = array();
	 
     $orderByField = array("uid DESC");
	 
     $this->params['page']=isset($this->params['page']) ? $this->params['page'] : 0;
	 $offset = $this->params['page'];
	 
	 $this->view->rows = $this->banner->getList(
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
	 $numrows  = $this->banner->getNumRows();
	 //die($numrows);
	 $this->view->numrows = $numrows;
	 $this->smartyPagination($numrows,$this->params['page'],$listPerPage);     
	}
    

} //end class
?>