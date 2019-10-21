<?php
class Ext_Db_Rowset extends Zend_Db_Table_Rowset_Abstract
{
    /**
     * Grande total for limited result sets
     * 
     * @var int
     */
    protected $_total;
 
    /**
     * Constructor
     * 
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
 
        if(isset($config['total'])) {
            $this->_total = (int) $config['total'];
        } else {
            $this->_total = $this->_count;
        }
    }
 
    /**
     * Returns the grande total
     *
     * @return int
     */
    public function total()
    {
        return $this->_total;
    }
}
?>