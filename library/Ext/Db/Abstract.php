<?php
abstract class Ext_Db_Abstract extends Zend_Db_Table_Abstract
{
    /**
     * Classname for rowset
     *
     * @var string
     */
    protected $_rowsetClass = 'Ext_Db_Rowset';
 
    /**
     * Fetches all rows.
     *
     * Honors the Zend_Db_Adapter fetch mode.
     *
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @param int                               $count  OPTIONAL An SQL LIMIT count.
     * @param int                               $offset OPTIONAL An SQL LIMIT offset.
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode.
     */
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        // This is all straight out of Zend_Db_Table_Abstract::fetchAll()
 
        if (!($where instanceof Zend_Db_Table_Select)) {
            $select = $this->select();
 
            if ($where !== null) {
                $this->_where($select, $where);
            }
 
            if ($order !== null) {
                $this->_order($select, $order);
            }
 
            if ($count !== null || $offset !== null) {
                $select->limit($count, $offset);
            }
 
        } else {
            $select = $where;
        }
 
        $rows = $this->_fetch($select);
 
        $data  = array(
            'table'    => $this,
            'data'     => $rows,
            'readOnly' => $select->isReadOnly(),
            'rowClass' => $this->_rowClass,
            'stored'   => true
        );
 
        // Here's where it gets interesting
        if ($select->getPart(Zend_Db_Select::LIMIT_COUNT) || $select->getPart(Zend_Db_Select::LIMIT_OFFSET)) {
            // Limit exists, reset unnecessary parameters and columns and re-issue query returning the count
            $select->reset(Zend_Db_Select::LIMIT_COUNT)
                   ->reset(Zend_Db_Select::LIMIT_OFFSET)
                   ->reset(Zend_Db_Select::ORDER)
                   ->reset(Zend_Db_Select::COLUMNS)
                   ->columns('COUNT(1)');
 
            $data['total'] = (int) $this->_db->fetchOne($select);
        }
 
        @Zend_Loader::loadClass($this->_rowsetClass);
        return new $this->_rowsetClass($data);
    }
}
?>