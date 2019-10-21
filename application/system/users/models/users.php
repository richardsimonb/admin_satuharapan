<?php
class users extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'rc_beusers';
    protected $_alias   = 'users';
    protected $_primary = 'id';
    
  public function getName($uid){
    return $this->fetchRow("id=".$uid);
  }
  
  public function getuser(){
    return array("ok broo");
  }
}
?>