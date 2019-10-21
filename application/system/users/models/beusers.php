<?php
class beusers extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'rc_beusers';
    protected $_alias   = 'beusers';
    protected $_primary = 'uid';
    
  public function getName($uid){
    return $this->fetchRow("uid=".$uid);
  }
  
 
}
?>