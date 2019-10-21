<?php
class feusers extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'rc_feusers';
    protected $_alias   = 'feusers';
    protected $_primary = 'uid';
    
  public function getName($uid){
    return $this->fetchRow("uid=".$uid);
  }
  
  public function hasAccessApi($username,$apiKey){
    $data =  $this->fetchRow("username='".$username ."' AND api_key = '".$apiKey."'");
    if($data){
        return true;
    } else {
        return false;
    }
  }
  

}
?>