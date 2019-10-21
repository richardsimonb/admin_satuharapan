<?php
class vfeusers extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'vfeusers';
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
    
    public function sql()
    {
        $sql  = 'SELECT * FROM  fe_users a
                LEFT JOIN (SELECT a.cruser_id, COUNT(*) jumlah_berita,IF(b.publish,b.publish,0) publish,IF(c.unpublish,c.unpublish,0) unpublish
                FROM tt_news a 
                LEFT JOIN (SELECT cruser_id, COUNT(*) publish FROM tt_news WHERE hidden=0 GROUP BY cruser_id ) b ON  a.cruser_id = b.cruser_id
                LEFT JOIN (SELECT cruser_id, COUNT(*) unpublish FROM tt_news WHERE hidden=1 GROUP BY cruser_id ) c ON  a.cruser_id = c.cruser_id
                GROUP BY a.cruser_id) x ON a.uid = x.cruser_id';
    }
}
?>