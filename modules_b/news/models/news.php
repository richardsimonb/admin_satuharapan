<?php
class news extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'tt_news';
    protected $_alias   = 'news';
    protected $_primary = 'uid';
	
	protected $_referenceMap    = array(
       'newscatmm' => array(
            'columns'           => 'uid', 
            'refTableClass'     => 'newscatmm',
            'refTableName'      => 'tt_news_cat_mm', //digunakan untuk join
            'refColumns'        => 'uid_local', //dari table tblclients
            'refColumnsToFetch' => array('uid_foreign'),  
        ),
    );  
    
    public function clearCache()
    {
         $sql = "TRUNCATE TABLE cache_pages";
         $stm = $this->_db->query($sql);
         $stm->execute();
         $sql = "TRUNCATE TABLE cache_pagesection";
         $stm = $this->_db->query($sql);
         $stm->execute();
         $sql = "TRUNCATE TABLE cache_treelist";
         $stm = $this->_db->query($sql);
         $stm->execute();
    }
    
    public function totalPosting($where=array())
    {
        $sql = "SELECT COUNT(*) jumlah FROM tt_news WHERE " .implode(" AND ",$where);
        $stm = $this->_db->query($sql);
        return $stm->fetch();
                
    }
}
?>