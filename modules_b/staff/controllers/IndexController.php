<?
class staff_IndexController extends Ext_Controller_Action 
{
  function init()
  {
    $this->run();
    Zend_Loader::loadClass('fegroups');
    Zend_Loader::loadClass('feusers');
    Zend_Loader::loadClass('vfeusers');
    Zend_Loader::loadClass('news');
    $this->feusers = new feusers;
    $this->vfeusers = new vfeusers;
    $this->fegroups = new fegroups;
    $this->news = new news;
  } 
   
  public function indexAction()
  {
    $this->disableLayout();
    if($this->getRequest()->isPost())
    {
    
        $user = $this->feusers->fetchRow("username='". $this->params['username'] ."' AND password='".$this->params['password']."' AND disable=0");
		//die();
        if($user){
            $this->session->user = $user->toArray();
            $this->_redirect('/news');
        } else {
            $this->view->message = "Username atau Password salah";
        }
    }
	//print_r($this->session->staff);
  }
  
  public function homeAction()
  {
    
  }
  
  public function listAction()
  {
    //delete user 
 	if(isset($this->params['act']))
	{
		switch ($this->params['act']) {
			case 'delete':
				$this->feusers->update(array("deleted"=>1,"disable"=>1),"uid IN(".implode(",",$this->params['uid']) .")");
			break;
		}
		exit();
	}
	 $listPerPage=50; 
     $where = array();
	 if(isset($this->params['category']))
	 {
	 	$where[] = 'newscatmm.uid_foreign='.$this->params['category'];
	 }
	 if(isset($this->params['name']))
	 {
	 	$where[] = "name LIKE '%".trim($this->params['name']) ."%'";
	 }
     if($this->session->user['usergroup']==2)
	 {
	 	$where[] = "usergroup != 3";
	 }
     $where[] = "feuser.deleted=0";
     $where[] = "feuser.uid !=".$this->session->user['uid'];
     $join = array('group'=>'left');
	 
     $orderByField = array("uid DESC");
	 
     $this->params['page']=isset($this->params['page']) ? $this->params['page'] : 0;
	 $offset = $this->params['page'];
	 
	 $rows  = $this->vfeusers->getList(
												 $selectField=array(), 
												 $objectRelation=array(), 
												 $where, 
												 $orderByField, 
												 $offset, 
												 $listPerPage, 
												 $page=0,
												 $join
											 );
                                             
    
     foreach($rows as $k=>$row)
     {
        $where = array();
        $where[] = "cruser_id=".$row['uid'];
        if(isset($this->params['awal']) AND !empty($this->params['awal']))
    	{
    	   $date =  DateTime::createFromFormat('d-m-Y', $this->params['awal'])->format('Y-m-d');
    	   $where[] = "crdate >= " . strtotime($date);
    	}
        if(isset($this->params['akhir']) AND !empty($this->params['akhir']))
    	{
    	   $date =  DateTime::createFromFormat('d-m-Y', $this->params['akhir'])->format('Y-m-d');
    	   $where[] = "crdate  <= " . strtotime($date);
    	}
        
        $posting = $this->news->totalPosting($where);        
        $rows[$k]['jumlah_berita'] = $posting['jumlah'];
        
        $posting = $this->news->totalPosting(array_merge($where,array("hidden=0"))); 
        $rows[$k]['publish'] = $posting['jumlah'];
        
        $posting = $this->news->totalPosting(array_merge($where,array("hidden=1"))); 
        $rows[$k]['unpublish'] = $posting['jumlah'];
     }                                             
     //Zend_Debug::dump($rows);                                         
     $this->view->rows = $rows;
     $this->view->nextnumber = $listPerPage * ($this->params['page'] - 1);
     //echo $this->news->getSql();
	 
     $this->view->limit = $listPerPage;
	 $numrows  = $this->vfeusers->getNumRows();
	 //die($numrows);
	 $this->view->numrows = $numrows;
     $this->view->totalpage  = ceil($numrows/$listPerPage);
	 $this->smartyPagination($numrows,$this->params['page'],$listPerPage);         
     //end list
  }
  
  public function editAction()
  {
    if(!isset($this->params['uid']))
    {
        $this->params['uid'] = $this->session->user['uid'];
    } 
    if($this->getRequest()->isPost())
     {
        $reply = array();
        if(!isset($_POST['f']['disable']))
        {
            $_POST['f']['disable']  = 0;
        }
        //$_POST['f']['name'] = $_POST['f']['first_name']." ".$_POST['f']['middle_name']." ".$_POST['f']['last_name'];
        $update = $this->feusers->update($_POST['f'],"uid=".$this->params['uid']);
        if($update)
        {
            $reply['status'] = "success";
            $reply['message'] = "Data berhasil di update";
        } else {
            $reply['status'] = "error";
            $reply['message'] = "tidak ada perubahan data";
        }
        $this->view->reply	 = $reply;   
     }
    
    $user = $this->feusers->fetchRow("uid=". $this->params['uid']);
    $this->view->detail = $user->toArray();
    $groups = $this->fegroups->fetchAll();
    $this->view->groups  = $groups->toArray();
    $this->view->params = $this->params;
    //Zend_Debug::dump($this->view->detail);
  }
  
  public function newAction()
  {
    if($this->getRequest()->isPost())
     {
        $reply = array();
        if(!isset($_POST['f']['disable']))
        {
            $_POST['f']['disable']  = 0;
            
        }
        $_POST['f']['pid']  = 110;
        //jika redaktur langsung create usergroup 1 (wartawan)
        if($this->session->user['usergroup'] == 2)
        {
            $_POST['f']['usergroup'] = 1;
        }
        //$_POST['f']['name'] = $_POST['f']['first_name']." ".$_POST['f']['middle_name']." ".$_POST['f']['last_name'];
        $exist = $this->feusers->fetchRow("username ='". trim($_POST['f']['username'])."'");
        if ($exist)
        {
            $reply['status'] = "error";
            $reply['message'] = "Username sudah ada";
        } else {
           $update = $this->feusers->insert($_POST['f']);
            if($update)
            {
                $reply['status'] = "success";
                $reply['message'] = "Data berhasil dimasukan";
            } else {
                $reply['status'] = "error";
                $reply['message'] = "tidak ada perubahan data";
            } 
        }
        
        $this->view->reply	 = $reply;   
     }
    
    $groups = $this->fegroups->fetchAll();
    $this->view->groups  = $groups->toArray();
    if(!isset($this->params['uid']))
    {
        $this->params['uid'] = $this->session->user['uid'];
    } 
    $this->view->params = $this->params;
    //Zend_Debug::dump($this->view->detail);
  }
  public function clearcacheAction(){
  	//$this->_helper->layout()->disableLayout();
  	  	
    $this->_helper->viewRenderer->setNoRender(true);
	//$this->_redirect('/news');
  }
} //end class

?>