<?php
 
/**
 * Person title helper
 *
 */
class Ext_Plugins_View extends Zend_Controller_Plugin_Abstract 
{   
    /**
     * Returns an HTML string for a select elemtn
     * containing titles as options
     *
     * @param string $name
     * @param mixed $selected
     * @param boolean $emptyFirst
     * @param array $attributes
     * @return string
     */
    public function tes(Zend_View_Helper_Abstract $view)
    {
        
        return $view->view->tes = "OK";
    }
}