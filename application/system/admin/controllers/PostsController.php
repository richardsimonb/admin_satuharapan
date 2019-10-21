<?php

class admin_PostsController extends Ext_Controller_Action

{

    function init(){

       $this->run();

       $postType = $this->apiLocal->get('/posts/posttype');

       $this->view->postType = $postType['data'];

       $mimeType = $this->apiLocal->get('/posts/mimetype');

       $this->view->mimeType = $mimeType['data'];

       $poststatus = $this->apiLocal->get('/posts/poststatus');

       $this->view->poststatus = $poststatus['data'];

	}

    

    public function indexAction()

    { 

        if(isset($this->params['act'])){

            switch($this->params['act']){

                case 'delete':

                    $detail = $this->apiLocal->get("/posts/".$this->params['id']);

                    $delete = $this->apiLocal->delete("/posts/".$this->params['id']);

                    if($delete['status'] == 'success'){

                       if($detail['data']['post_media']){

                         unlink($_SERVER['DOCUMENT_ROOT'].$this->baseUrl .'/tmp/media/' . $detail['data']['post_media']);

                       }

                       $status = "success";

                       $message = "Data successfully deleted";    

                    } else {

                       $status = "error";

                       $message = "Data unsuccessfully deleted"; 

                    }

                    

                break;

                case 'trash':

                    $updateArr=array("post_status"=>"trash");

                    $exe = $this->apiLocal->put("/posts/".$this->params['id'],$updateArr);

                    if($exe['status'] == 'success'){

                       $status = "success";

                       $message = "Data successfully move to trash";    

                    } else {

                       $status = "error";

                       $message = "Data unsuccessfully executed"; 

                    }

                break;

                case 'publish':

                    $updateArr=array("post_status"=>"publish");

                    $exe = $this->apiLocal->put("/posts/".$this->params['id'],$updateArr);

                    if($exe['status'] == 'success'){

                       $status = "success";

                       $message = "Data successfully published";    

                    } else {

                       $status = "error";

                       $message = "Data unsuccessfully executed"; 

                    }

                break;

                case 'newpost':

                    if($this->newPost()){

                       $status = "success";

                       $message = "Data successfully added";    

                    } else {

                       $status = "error";

                       $message = "Data unsuccessfully added"; 

                    }

                break;

                case 'banned':

                break;

            }

            

            $this->view->status = $status;

            $this->view->message = $message;

        }

        

        $postType = $this->apiLocal->get('/posts/posttype');

        $this->view->postType = $postType['data'];

        

        $filter = array();

        $this->limit = 30;

        if(!isset($this->params['page'])){

            $this->params['page'] = 0;

        } 

        $filter[] = 'offset='.$this->params['page'];

        $filter[] = 'limit='. $this->limit;

        $filter[] = 'objectRel=users';

        $filter[] = 'order[posts.ID]=desc';

        if(isset($this->params['post_type']) AND $this->params['post_type'] != 'all'){

            $filter[] = 'filter[post_type]='.$this->params['post_type'];

        } 

        if(isset($this->params['post_status']) AND !empty($this->params['post_status'])){

            $filter[] = 'filter[post_status]='.$this->params['post_status'];

        } else {

            $filter[] = 'filter[post_status]=publish';

        }

        if(isset($this->params['post_parent']) AND !empty($this->params['post_parent'])){

            $filter[] = 'filter[post_parent]='.$this->params['post_parent'];

            $parentPost = $this->apiLocal->get('/posts/'.$this->params['post_parent']);

            $this->view->parentPost = $parentPost['data'];

        } 

        

        $posts = $this->apiLocal->get('/posts?'. implode("&",$filter),array());

        $this->view->posts = $posts['data'];

        $this->smartyPagination($posts['numrows'],$this->params['page'],$this->limit);           

        

    }

    

    public function editAction(){

        //Zend_Debug::dump($_FILES);

        if(isset($this->params['update'])){

            if($_FILES['file']['name']){

                $filename = trim($_FILES['file']['name']);

                $filename = time() . "_" . str_replace(' ','_',$filename);

                $this->params['f']['post_media'] = $filename;

                $dest = $_SERVER['DOCUMENT_ROOT'] . "/tmp/media/" .$filename; 

                $upload = move_uploaded_file($_FILES['file']['tmp_name'],$dest);

            }

            

            if(!empty($this->params['newMimeType'])){

                $this->params['f']['post_mime_type'] = $this->params['newMimeType'];

            }

             $execute  = $this->apiLocal->put('/posts/'.$this->params['id'],$this->params['f']);

             if($execute['status'] == 'success'){

               $status = "success";

               $message = "Data successfully updated";    

             } else {

               $status = "error";

               $message = "Data unsuccessfully update"; 

             }

            $this->view->status = $status;

            $this->view->message = $message;

        }

        $detail = $this->apiLocal->get("/posts/".$this->params['id']);

         $detail['data']['post_content'] = stripslashes($detail['data']['post_content'] ); 

        $this->view->detail  = $detail['data'];

        $this->view->params = $this->params;

    }

    public function newAction(){

        

    }

    

    public function newPost(){

        //Zend_Debug::dump($this->params);

        if($_FILES['file']['name']){

            $filename = trim($_FILES['file']['name']);

            $filename = time() . "_" . str_replace(' ','_',$filename);

            $this->params['f']['post_media'] = $filename;

            $dest = $_SERVER['DOCUMENT_ROOT'] . "/tmp/media/" .$filename; 

            $upload = move_uploaded_file($_FILES['file']['tmp_name'],$dest);

        }

        if(!empty($this->params['newMimeType'])){

            $this->params['f']['post_mime_type'] = $this->params['newMimeType'];

        }

        if(!empty($this->params['newPostType'])){

            $this->params['f']['post_type'] = $this->params['newPostType'];

        }

        $this->params['f']['post_author'] = $this->session->user['ID'];

        $execute  = $this->apiLocal->post('/posts',$this->params['f']);

        //Zend_Debug::dump($execute);

        if($execute['results']=='success'){

            

            return true;

        } else {

            return false;

        }

    }

}//end class