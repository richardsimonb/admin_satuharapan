<?php
class feusers extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'fe_users';
    protected $_alias   = 'feuser';
    protected $_primary = 'uid';
    
    protected $_referenceMap    = array(
       'group' => array(
            'columns'           => 'usergroup', 
            'refTableClass'     => 'fegroups',
            'refTableName'      => 'fe_groups', //digunakan untuk join
            'refColumns'        => 'uid', //dari table tblclients
            'refColumnsToFetch' => array('title'),  
        ),
    ); 
    
    public function getValue($uid,$colum='name')
    {
        $row = $this->fetchRow("uid = ".$uid);
        return $row->$colum;
    } 
}
?>