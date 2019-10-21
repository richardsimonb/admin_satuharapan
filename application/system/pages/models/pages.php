<?php
class pages extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'rc_pages';
    protected $_alias   = 'pages';
    protected $_primary = 'uid';
    
  public function getName($uid){
    return $this->fetchRow("uid=".$uid);
  }
}
?>