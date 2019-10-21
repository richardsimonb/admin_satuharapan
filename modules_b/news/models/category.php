<?php
class category extends Ext_Redwhite_Db
{
    protected $_className = __CLASS__;
    protected $_name    = 'tt_news_cat';
    protected $_alias   = 'category';
    protected $_primary = 'uid';
    
    public function categoryArr($parent_category=0,$result=array())
    {
        $rows = $this->fetchAll("parent_category=".$parent_category);
        if($rows){
            $categories = $rows->toArray();
            foreach($categories as  $category)
            {
                
                $result[$category['uid']] = $category;
                $subRows = $this->fetchAll("parent_category=".$category['uid']);
                if($subRows)
                {
                  $result[$category['uid']]['sub'] = $subRows->toArray();
                }
            } 
        }  
        return $result;
    }
    
    public function multiDimensi(&$arrRef=array(),$parent_category=0)
    {
        $rows = $this->fetchAll("parent_category=".$val['parent_category']);
        if($rows)
        {
          foreach ($rows as $key=>$val) {
                $category = $this->multiDimensi($val,$val['parent_category']);
                if ($category) {
                    //reset($arrRef[$key]);
                   // $arrRef[$]
                }
          }
          return $arrRef;   
        } else {
            return false;
        }
           
    }
    
    /*
    function Array_Dimensional_Reset(&$arrRef) {
    foreach ($arrRef as $key=>$val) {
        if (is_array($val)) {
            $this->Array_Dimensional_Reset($val);
            reset($arrRef[$key]);
        }
    }
}
    */
}
?>