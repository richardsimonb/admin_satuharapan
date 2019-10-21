<?php
class users_ProfileController extends Ext_Controller_Action{

	function init(){
       $this->run();
	}
    public function indexAction(){   
        //print_r($this->params);
        if(isset($this->params['id'])){
            $userDb = $this->apiLocal->get("/feusers/".$this->params['id']);
            if(isset($userDb['data']['uid'])){
                //$userDb['data']['birthday'] = $this->age_from_dob($userDb['data']['birthday']);
                //$userDb['data']['birthday'] = (date("dm", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("dm") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
                $this->view->user = $userDb['data'];

            }
        }
        $sharefb = array();
        $sharefb['url'] = "http://speedy.dev.pusatmedia.com/";
        $sharefb['title'] = "Ms&MrSpeedy";
        $sharefb['image'] = "";
        
        $this->view->sharefb = $sharefb; 
    }
    function age_from_dob($dob ='') {
        if($dob){
            list($d,$m,$y) = explode('/', $dob);
            if (($m = (date('m') - $m)) < 0) {
                $y++;
            } elseif ($m == 0 && date('d') - $d < 0) {
                $y++;
            }
            return date('Y') - $y;
        }else{
            return '-';
        }
    }
} //end of class