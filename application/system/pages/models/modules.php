<?php
class modules extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'rc_pages_mm_modules';
    protected $_alias   = 'modules';
    protected $_primary = 'uid';
    
  public function getName($uid){
    return $this->fetchRow("uid=".$uid);
  }
  
}
?>