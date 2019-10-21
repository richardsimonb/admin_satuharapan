<?php
class Ext_Controller_Action extends Zend_Controller_Action
{        

    public function run(){
        $config  = Zend_Registry::get('config');
        $this->session                  = new Zend_Session_Namespace();
        if(isset($config['api']['feusers']) AND $config['api']['feusers']){
            if(isset($this->session->userlogin['uid'])){
                if($this->session->userlogin['level'] == 1)
                {
                  $userName  = $config['api']['username'];    
                  $apiKey  = $config['api']['password'];
                } else 
                {
                    $userName = $this->session->userlogin['username'];
                    $apiKey   = $this->session->userlogin['api_key'];     
                }
            } else {
                $userName = $config['api']['username'];
                $apiKey   = $config['api']['password'];
            }
        } else {
            $userName = $config['api']['username'];
            $apiKey   = $config['api']['password'];
        }
        $this->apiLocal                 = new Ext_Api_Local($appsId = null, $userName, null ,$apiKey);
            
        $this->params                   = $this->_request->getParams();
        $this->view->params             = $this->params;
        $this->view->viewUrl            = $this->view->url();
        
        $globalVariable = Zend_Registry::get('GLOBAL_VAR');
        $this->globalVar                = $globalVariable;
        $this->view->tplpath            = $globalVariable['tplpath'];
        $this->view->baseUrl            = $this->view->baseUrl();
        //Zend_Debug::dump($globalVariable);
           
       
    }
 
    public function disableLayout(){
        $this->_helper->layout->disableLayout();
    }
    public function noRender(){
        $this->_helper->viewRenderer->setNoRender(true);
    }
    
  
    /**
     * Function to generate pagination with Smarty Pagination
     * 
     * @param $totalRow = jumlah semua baris dari query yg dihasilkan
     * @param $page = offset dari query
     * @param $limit = limit query
     * @param $id = digunakan jika dalam satu page ada lebih dari 1 paging, maka identifier-nya berupa variable $id
     * @param $urlVar = digunakan jika ada parameter URL yang akan disertakan pada setiap page, misal untuk pencarian
     *                  contoh $urlVar = "/admin/users/index/search/redwhite/";
    */
    public function smartyPagination($totalRow, $page, $limit=20, $id='default', $urlVar=''){
        $config = Zend_Registry::get('config');
        $view = new Ext_View_Smarty($config['smarty']);
        $smarty = $view->getEngine();
        $SmartyPaginate = $view->loadSmartyPagination();        
        if(!$urlVar){
            parse_str($_SERVER['QUERY_STRING'], $result_array);
            unset($result_array['page']);
            $_SERVER['QUERY_STRING'] = http_build_query($result_array);
            $urlVar = $this->view->url() ."?". $_SERVER['QUERY_STRING'];
        }
            
        $SmartyPaginate->reset($id);
        $SmartyPaginate->connect($id);
                
	    $SmartyPaginate->setLimit($limit,$id);
        $SmartyPaginate->setCurrentItem($page);                
                                        
        $SmartyPaginate->setTotal($totalRow,$id);
        $SmartyPaginate->setUrl($urlVar,$id);			
		$SmartyPaginate->setPrevText('<',$id);
		$SmartyPaginate->setNextText('>',$id);
		$SmartyPaginate->setLastText('>>',$id);
		$SmartyPaginate->setFirstText('<<',$id);
        $SmartyPaginate->assign($smarty,"paging_" . time(),$id);         
        $this->view->id_paging = $id;              
    }
    public function paginations($data){
        $url = $this->view->url();
        if($url == '/'){
            $this->view->viewUrl = "";
        }
        $this->view->totalpageWaiting = ceil($data['numrows'] / $this->limit);
        $this->view->page = $this->params['page'];
        $this->view->params = $this->params;
    }
    
    public function modulePathTemplate($module=null){
        $config = Zend_Registry::get('config');
        $moduleDir = $this->getModuleDirectory($module);
        $modPath = str_replace($_SERVER['DOCUMENT_ROOT'],'',$moduleDir);
        //echo $modPath;
        $path = $this->view->baseUrl() . $modPath .'/views/templates/';
        return $path;
    }
    public function getModuleDirectory($module = null)
    {
        if (null === $module) {
            $module = $this->getRequest()->getModuleName();
        }
    
        $controllerDir = $this->getFrontController()->getControllerDirectory($module);
    
        if ((null === $controllerDir) || is_array($controllerDir)) {
            throw new Zend_Controller_Exception('Cannot locate the module directory');
        }
    
        return dirname($controllerDir);
    }
    public function addJs($filename,$module=null){
        if (null === $module) {
           $module = $this->getRequest()->getModuleName();
        }
        //echo $this->modulePathTemplate($module);
        $this->view->headScript()->appendFile($this->view->baseUrl().'/'.$this->modulePathTemplate($module).$filename);
    }
    
    public function addCss($filename,$module=null){
        if (null === $module) {
           $module = $this->getRequest()->getModuleName();
        }
        $this->view->headLink()->appendStylesheet($this->view->baseUrl().'/'.$this->modulePathTemplate($module).$filename);
    }
     public function addPhp($filename,$module=null){
        if (null === $module) {
           $module = $this->getRequest()->getModuleName();
        }
        require_once($this->getModuleDirectory($module).'/'.$filename);
    }

}