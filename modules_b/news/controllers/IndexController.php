<?php
class news_IndexController extends Ext_Controller_Action 
{
  function init()
  {
    $this->run();
    Zend_Loader::loadClass('news');
	Zend_Loader::loadClass('category');
	Zend_Loader::loadClass('newscatmm');
    Zend_Loader::loadClass('feusers');
    Zend_Loader::loadClass('newsrelatedmm');
    
	
    $this->category = new category;
    $this->news = new news;
	$this->newscatmm = new newscatmm;
    $this->feusers = new feusers;
    $this->newsrelated = new newsrelatedmm;
  } 
   
  public function indexAction()
  {
  	//action
  	if(isset($this->params['act']))
	{
		switch ($this->params['act']) {
			case 'delete':
				$this->news->update(array("deleted"=>1),"uid IN(".implode(",",$this->params['uid']) .")");
				break;
		}
		exit();
	}
    //get list
	 $listPerPage=12; 
     $where = array();
	 if(isset($this->params['category']))
	 {
	 	$where[] = 'newscatmm.uid_foreign='.$this->params['category'];
        $getCat = $this->category->fetchRow("uid=".$this->params['category']);
        $this->view->category = $getCat->toArray();
	 }
	 if(isset($this->params['keyword']))
	 {
	 	$searchFieldList=array("short","bodytext","author","keywords","links","imagecaption","title");
	 	//$keyword = trim($this->params['keyword']);
		$search = array();
		foreach($searchFieldList as $field)
		{
			$search[] = $field ." LIKE '%". trim($this->params['keyword']) ."%'";
		}
	 	$where[] = implode(" OR ", $search);
	 }
     
     if(isset($this->params['title']) AND !empty($this->params['title']))
	 {
	   $where[] = "title LIKE '%".trim($this->params['title']) ."%'";
     } 
     
     if(isset($this->params['author']) AND !empty($this->params['author']))
	 {
	   $where[] = "author LIKE '%".trim($this->params['author']) ."%'";
     } 
     
     if(isset($this->params['cr_first']) AND !empty($this->params['cr_first']))
	 {
	   $date =  DateTime::createFromFormat('d-m-Y', $this->params['cr_first'])->format('Y-m-d');
       $where[] = "datetime >= " . strtotime($date);
     } 
     
     if(isset($this->params['cr_last']) AND !empty($this->params['cr_last']))
	 {
	   $date =  DateTime::createFromFormat('d-m-Y', $this->params['cr_last'])->format('Y-m-d');
       $where[] = "datetime <= " . strtotime($date);
     } 
     
     if(isset($this->params['status']) AND $this->params['status'] != '')
	 {
	   $where[] = "hidden =".$this->params['status'];
     }
     if(isset($this->params['edited']) AND $this->params['edited'] != '')
	 {
	   if ($this->params['edited'])
       {
        $where[] = "redaktur_uid != 0";
       } else {
        $where[] = "redaktur_uid = 0";
       }
	   
     }
     
     $where[] = "deleted=0";
     
     if($this->session->user['usergroup'] == 1)
     {
        $where[] = "cruser_id=".$this->session->user['uid']; 
     }
     //Zend_Debug::dump($this->session->user);
     $join = array('newscatmm'=>'left');
	 
     $orderByField = array("uid DESC");
	 
     $this->params['page']=isset($this->params['page']) ? $this->params['page'] : 0;
	 $offset = $this->params['page'];
	 
	 $this->view->rows = $this->news->getList(
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
	 $numrows  = $this->news->getNumRows();
	 //die($numrows);
	 $this->view->numrows = $numrows;
	 $this->smartyPagination($numrows,$this->params['page'],$listPerPage);         
     //end list
    
  }
  
  public function leftmenuAction()
  {
    Zend_Loader::loadClass('category');
    $category = new category;
    $this->view->categories  = $category->categoryArr(0);
  }
  	
  public function newAction()
  {
    
    //$mail = new Zend_Mail();
                            
    // render view
    //$bodyText = 'Sample';    
    
    //$mail->addTo("saepulloh@gmail.com","saepulloh");
    //$mail->setSubject('New News');
    //$mail->setFrom('info@kabarpembaruan.com','Kabar Pembaruan');
    //$mail->setBodyHtml($bodyText);
    //$mail->send();
    $select = $this->news->select();
    $select->order("uid DESC");
    //$select->limit(0,10);
    $select->where("deleted=0 AND hidden=0");
    $this->view->news = $this->news->fetchAll($select)->toArray();
    $this->view->newsrel = array();	
			
		
    
    
    if($this->getRequest()->isPost())
	{
		$respon = array();	
		if(!empty($_POST['f']['datetime'])){
			$_POST['f']['datetime']      = strtotime($_POST['f']['datetime']);	
		} else {
			$_POST['f']['datetime']      = strtotime(date("Y-m-d H:i"));
		}
		if(!empty($_POST['f']['starttime']))
        {
          $_POST['f']['starttime']     = strtotime($_POST['f']['starttime']);  
        }
	    if(!empty($_POST['f']['endtime']))
        {
          $_POST['f']['endtime']       = strtotime($_POST['f']['endtime']);
        }
	    
		//echo date("Y-m-d H:i:s",$_POST['f']['datetime']);
		$_POST['f']['archivedate']   = strtotime(date("Y-m-d",$_POST['f']['datetime']));
        //addons
        $_POST['f']['pid']           = 5;
        $_POST['f']['tstamp']        = time();
        $_POST['f']['crdate']        = time();
        $_POST['f']['cruser_id']     = $this->session->user['uid'];
        $_POST['f']['author']        = $this->session->user['name'];
        $_POST['f']['author_email']  = $this->session->user['email'];
        $_POST['f']['category']      = 1;
        
        //image
        $destination = $_SERVER['DOCUMENT_ROOT'] .'/uploads/pics/';
		$file_one = array($_FILES['image'],$destination,"news_".$this->session->user['uid']."_".time());
		if($file = Ext_Global_Function::uploadFiles($file_one)) {
		    $_POST['filename'][] = $file;
            require_once('Ext/PHPImageWorkshop/ImageWorkshop.php');
            
            $layer = new ImageWorkshop(array(
        			'imageFromPath' => $destination.$file,
        	));
            $dirPath = $destination;
            $filename = $file;
            $createFolders = true;
            $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
            $imageQuality = 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)
            if($_POST['category']['uid_foreign'] == 37)
            {
               $layer->resizeInPixel(620, 400, true);     
            } else {
                $layer->resizeInPixel(440, 240, true);
            }
            $layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);
		}
        if(isset($_POST['filename']))
        {
            $_POST['f']['image']   = implode(",",$_POST['filename']);
        }
		//jika pimred bisa publish.unpublish berita
		if($this->session->user['usergroup']==3)
        {
            if(!isset($_POST['f']['hidden']))
            {
                $_POST['f']['hidden']  = 0;
            }
        } else {
            $_POST['f']['hidden']  = 1;
        }
        //jika redaktur proses berita sebagai edited
        if($this->session->user['usergroup']==2)
        {
            $_POST['f']['redaktur_uid'] = $this->session->user['uid'];
        }
		$updateRow = $this->news->insert($_POST['f']);
		if($updateRow)
		{
			$respon['status']  = 'success';
			$respon['message'] = "Data successfully updated";
            
            $_POST['category']['uid_local'] = $updateRow;
		    $this->newscatmm->insert($_POST['category']);
            	//send email
                $rows = $this->feusers->fetchAll("usergroup != 1 AND email != '' AND disable=0 AND deleted = 0");
                $users = $rows->toArray();
               
				//new send mail
				$message = "";
		        $message .= "<table>";
		        $message .= "<tr>";
		        $message .= "<td>Author</td><td>:</td><td>".$this->session->user['name']."</td>";
		        $message .= "</tr>";
		        $message .= "<tr>";
		        $message .= "<td>Title</td><td>:</td><td>".$_POST['f']['title']."</td>";
		        $message .= "</tr>";
		        $message .= "<tr>";
		        $message .= "<td>Create date</td><td>:</td><td>".date("d-m-Y H:i",$_POST['f']['datetime'])."</td>";
		        $message .= "</tr>";
		        $message .= "<table>";
		    	$random_hash = md5(date('r', time()));	
				$headers = "from: info@kabarpembaruan.com" ;
				$headers .= "\r\nContent-Type: text/html; boundary=\"PHP-alt-".$random_hash."\""; 
				$to = "saepulloh@gmail.com";
				$subject = "New content news";
				
				if(count($users))
                {
                    foreach($users as $user)
                    {
                        @mail($user['email'],$subject, $message,$headers);
                    }
                }
				
			    if(isset($_POST['related']) AND count($_POST['related']))
                {
                    $sorting = 1;   
                    foreach($_POST['related'] as $rel){
                        $where = "uid_local = ".$updateRow ." AND uid_foreign=".$rel;
                        $cek = $this->newsrelated->fetchRow($where);
                        if(!$cek){
                            $arr = array();
                            $arr['uid_local']   = $updateRow;
                            $arr['uid_foreign'] = $rel;
                            $arr['tablenames']  = "tt_news";
                            $arr['sorting']     = $sorting;
                            $this->newsrelated->insert($arr);
                            $sorting++;
                        }
                        
                        
                    }
                }
             $this->_redirect('/news/index/edit/uid/'.$updateRow.'/preview/'.$this->params['preview']);   	   
        
		} else {
			$respon['status']  = 'error';
			$respon['message'] = "No changed";
		}
		
		$this->view->respon = $respon;
	    //Zend_Debug::dump($updateRow);	
	}
    //Zend_Debug::dump($this->session->user);
  	$this->view->categories  = $this->category->categoryArr(0);
    
    //http://harvesthq.github.com/chosen/
    //http://ivaynberg.github.com/select2/
    $this->view->params = $this->params;
  }
  
  public function editAction()
  {
    //http://www.mixedwaves.com/2010/02/integrating-fckeditor-filemanager-in-ckeditor/
    //http://stackoverflow.com/questions/1498628/how-can-you-integrate-a-custom-file-browser-uploader-with-ckeditor
    //http://stackoverflow.com/questions/2115302/ckeditor-image-upload-filebrowseruploadurl
    //magic_quotes_gpc = Off
    if($this->getRequest()->isPost())
	{
	   $update = false;
		$respon = array();	
		$_POST['f']['datetime']    = strtotime($_POST['f']['datetime']);
        
	    if(!empty($_POST['f']['starttime']))
        {
          $_POST['f']['starttime']     = strtotime($_POST['f']['starttime']);  
        }
	    if(!empty($_POST['f']['endtime']))
        {
          $_POST['f']['endtime']       = strtotime($_POST['f']['endtime']);
        }
        //jika PIMRED  bisa publish/unpublish berita
        if($this->session->user['usergroup']==3)
        {
            if(!isset($_POST['f']['hidden']))
            {
                $_POST['f']['hidden']  = 0;
            }
            $_POST['f']['redaktur_uid'] = $this->session->user['uid'];
            if(!$_POST['redaktur_uid'])
            {
                $_POST['f']['bodytext'] .= '<p>Editor : ' .$this->session->user['name'] ."</p>";    
            }
            
        } else {
            $_POST['f']['hidden']  = 1;
        }
        //jika redaktur proses berita sebagai edited
        if($this->session->user['usergroup']==2)
        {
            $_POST['f']['redaktur_uid'] = $this->session->user['uid'];
            if(!$_POST['redaktur_uid'])
            {
                $_POST['f']['bodytext'] .= '<p>Editor : ' .$this->session->user['name'] ."</p>";    
            }
            
        }
		
		$_POST['f']['archivedate'] = strtotime(date("Y-m-d",$_POST['f']['datetime']));
        
        $destination = $_SERVER['DOCUMENT_ROOT'] .'/uploads/pics/';
		$file_one = array($_FILES['image'],$destination,"news_".$this->params['uid']."_".time());
		if($file = Ext_Global_Function::uploadFiles($file_one)) {	    
            $_POST['filename'][] = $file; //for database
            
            require_once('Ext/PHPImageWorkshop/ImageWorkshop.php');
            
            $layer = new ImageWorkshop(array(
        			'imageFromPath' => $destination.$file,
        	));
            $dirPath = $destination;
            $filename = $file;
            $createFolders = true;
            $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
            $imageQuality = 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)
            if($_POST['category']['uid_foreign'] == 37)
            {
               $layer->resizeInPixel(620, 400, true);     
            } else {
                $layer->resizeInPixel(440, 240, true);
            }
            $update = true;
            $layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);
		}
		$_POST['f']['image']       = implode(",",$_POST['filename']);
        $_POST['f']['bodytext']    = stripslashes($_POST['f']['bodytext']); 
		
		$updateRow = $this->news->update($_POST['f'],"uid=".$this->params['uid']);
        if($updateRow)
        {
            $update = true;
        }
		
        //image 
        
        //$this->newscatmm->delete("uid_local=".$this->params['uid']);
		$this->newscatmm->update($_POST['category'],"uid_local=".$this->params['uid']);
        $this->newsrelated->delete("uid_local = ".$this->params['uid']);
        if(isset($_POST['related']) AND count($_POST['related']))
        {
           
            $sorting = 1;   
            foreach($_POST['related'] as $rel){
                //$where = "uid_local = ".$this->params['uid'] ." AND uid_foreign=".$rel;
                //$cek = $this->newsrelated->fetchRow($where);
               // if(!$cek){
                    $arr = array();
                    $arr['uid_local']   = $this->params['uid'];
                    $arr['uid_foreign'] = $rel;
                    $arr['tablenames']  = "tt_news";
                    $arr['sorting']     = $sorting;
                    $insert = $this->newsrelated->insert($arr);
                    if($insert)
                    {
                        $update = true;
                    }
                    $sorting++;
               // }               
                
            }
        }
		
	    //Zend_Debug::dump($_POST);	
        if($update)
		{
			$respon['status']  = 'success';
			$respon['message'] = "Data successfully updated";
            
		} else {
			$respon['status']  = 'error';
			$respon['message'] = "No changed";
		}
        $this->view->respon = $respon;
	}
    
    
    $this->view->categories  = $this->category->categoryArr(0);
	$filterData = array('uid='.$this->params['uid']);
	$join = array('newscatmm'=>'left');
    $detailNews = $this->news->getRow($selectField=array(), $objectRelation=array(), $filterData, $join);
    //Zend_Debug::dump($detailNews);
    $detailNews['bodytext'] = stripslashes($detailNews['bodytext']);
    //echo  date("M d Y H:i:s", $detailNews['datetime']);
    //get Image
    $this->view->images = explode(",",$detailNews['image']);
    $this->view->detail = $detailNews;
    //
    $select = $this->news->select();
    $select->order("uid DESC ");
    //$select->limit(0,10);
    $select->where("deleted=0 AND hidden=0");
    $this->view->news = $this->news->fetchAll($select)->toArray();
    
    $getRelated = $this->newsrelated->select();
    $getRelated->from(array("tt_news_related_mm"),"uid_foreign");
    $getRelated->where("uid_local=".$this->params['uid']);
    $rowsrel = $this->newsrelated->fetchAll($getRelated)->toArray();
    $uid_foreign = array();
    foreach($rowsrel as $reluid)
    {
      $uid_foreign[] = $reluid['uid_foreign'];  
    }
    $this->view->newsrel = $uid_foreign;
    //Zend_Debug::dump($this->session->user);
    $this->view->params = $this->params;
    
  }
  
     function imageAction(){
    	$this->noRender();
    	$this->disableLayout();
    	require_once('Ext/PHPImageWorkshop/ImageWorkshop.php');
    	$filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/pics/'.$this->params['filename'];
    	$layer = new ImageWorkshop(array(
    			'imageFromPath' => $filePath,
    	));
    	if(isset($this->params['width']) And !empty($this->params['width'])){
    		$width = $this->params['width'];
    	} else {
    		$width = null;
    	}
    	if(isset($this->params['height']) And !empty($this->params['height'])){
    		$height = $this->params['height'];
    	} else {
    		$height = null;
    	}
    	$layer->resizeInPixel($width, $height, true);
    	$image = $layer->getResult();
    
    	$ext = substr($filePath, -3, 3);
    
    	if ($ext == 'jpg' || $ext == 'JPG')
    	{
    		header('Content-type: image/jpeg');
    		header('Content-Disposition: filename="butterfly.jpg"');
    	} elseif ($ext == 'gif' || $ext == 'GIF'){
    		header('Content-type: image/gif');
    		header('Content-Disposition: filename="butterfly.gif"');
    	} elseif ($ext == 'png' || $ext=='PNG') {
    
    	}
    	imagejpeg($image, null, 95); // We choose to show a JPEG (quality of 95%)
    	//echo $filename;
    }

	public function previewAction()
	{
		$this->disableLayout();
		$row = $this->news->fetchRow("uid=".$this->params['uid'])->toArray();
		$this->view->row = $row;
		//Zend_Debug::dump($row);
		
	}
    
    public function deleteAction()
    {
        $this->disableLayout();
        $this->norender();
        $filterData = array('uid='.$this->params['uid']);
	    $join = array();
        $detailNews = $this->news->getRow($selectField=array(), $objectRelation=array(), $filterData, $join);
        $images = explode(",",$detailNews['image']);
        //print_r($images);
        $trans = array_flip($images);
        //print_r($trans);
        unset($trans[$this->params['filename']]);
        $images = array_flip($trans);
        //print_r($images);
        
        $arrUpdate = array();
        $arrUpdate['image'] = implode(",",$images);
        $update = $this->news->update($arrUpdate,"uid=".$this->params['uid']);
        if($update)
        {
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/pics/'.$this->params['filename']);
        }
        
    }
    
    public function clearcacheAction()
    {
        //$this->disableLayout();
        $this->norender();
        $this->news->clearCache();
        echo '<div class="alert alert-success">Clear cache successfully executed...</div>';
        
    }
    
    public function testAction()
    {
        $this->params['uid'] = 69;
        $select = $this->news->select();
        $select->order("uid DESC ");
        //$select->limit(0,10);
        $select->where("deleted=0");
        $this->view->news = $this->news->fetchAll($select)->toArray();
        
        $getRelated = $this->newsrelated->select();
        $getRelated->from(array("tt_news_related_mm"),"uid_foreign");
        $getRelated->where("uid_local=".$this->params['uid']);
        $rowsrel = $this->newsrelated->fetchAll($getRelated)->toArray();
        $uid_foreign = array();
        foreach($rowsrel as $reluid)
        {
          $uid_foreign[] = $reluid['uid_foreign'];  
        }
        $this->view->newsrel = $uid_foreign;
    }
    
    
}

?>