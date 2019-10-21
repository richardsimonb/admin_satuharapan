<?php
class admin_ModuleController extends Ext_Controller_Action
{
    function init(){
       $this->run();
	}
    
    public function indexAction()
    {   
        if(isset($_FILES['file']['name'])){
            
            //die($_FILES['file']['name']);
            //die(basename($_FILES['file']['name']));            
            $moduleName = str_replace('.zip','',$_FILES['file']['name']);
            if($moduleName){
                $source = "assets/backup/" . basename($_FILES['file']['name']);
                $tmp_name =  $_FILES["tmp"]["tmp_name"];                
                move_uploaded_file($tmp_name, $source);
                $target_directory= $this->getModuleDirectory($moduleName);
                $filter = new Zend_Filter_Decompress(array(
                    'adapter' => 'Zip',
                    'options' => array(
                    'target' => $target_directory,
                    )
                ));
                $compressed = $filter->filter($source);
            }
        }
        
        $module_dir = $this->getFrontController()->getControllerDirectory();
        $this->view->module = $module_dir;
    }
    
   
    public function downloadAction(){
        $source =  $this->getModuleDirectory($this->params['name']);
        ///die($path);
        $filter = new Zend_Filter_Compress(array(
            'adapter' => 'Zip',
            'options' => array(
                'archive' => 'assets/backup/'.$this->params['name'].'.zip'
            ),
        ));
         //http://articles.tutorboy.com/2010/05/15/compress-and-decompress-using-zend-library/
        // For file
        //$source = $_SERVER['DOCUMENT_ROOT'].'/application/system';
        //$source = $path;
        //echo $source; die();
        //$source = '/opt/folder/';
         
        $compressed = $filter->filter($source);
        if($compressed){
            $this->_redirect('/assets/backup/'.$this->params['name'].'.zip');
        } else {
            throw new Zend_Controller_Exception('Cannot locate the module directory');
        }
    }
    
    public function updateAction(){
        
    }
    
    public function getList() {
        $module_dir = $this->getFrontController()->getControllerDirectory();
        $resources = array();

        foreach($module_dir as $dir=>$dirpath) {
            $diritem = new DirectoryIterator($dirpath);
            foreach($diritem as $item) {
                if($item->isFile()) {
                    if(strstr($item->getFilename(),'Controller.php')!=FALSE) {
                        include_once $dirpath.'/'.$item->getFilename();
                    }
                }
            }

            foreach(get_declared_classes() as $class){
                if(is_subclass_of($class, 'Zend_Controller_Action')) {
                    $functions = array();

                    foreach(get_class_methods($class) as $method) {
                        if(strstr($method, 'Action')!=false) {
                            array_push($functions,substr($method,0,strpos($method,"Action")));
                        }
                    }
                    $c = strtolower(substr($class,0,strpos($class,"Controller")));
                    $resources[$dir][$c] = $functions;
                }
            }
        }
        return $resources;
    }
    
   
}

