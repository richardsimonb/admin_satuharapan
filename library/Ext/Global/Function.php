<?php
	/*	
	TO DO		: MENAMPUNG SEMUA FUNGSI YG DIPANGGIL BERULANG-X
	AUTHOR		: NU GELLO
	UPDATE/TIME	: 29-09-2009 / 20:04
	*/	
	class Ext_Global_Function {                 
		public static function authenticate(){
			$auth = Zend_Auth::getInstance();
			$result = $auth->getIdentity();	           	
			return $result;		
		}
       public static function siteURL()
        {
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $domainName = $_SERVER['HTTP_HOST'];
            $darray = explode('.', $domainName);
			if($darray[0]=="www"){
				return $protocol.$domainName;
			}
			else
			{
				return $protocol."www.".$domainName;
			}
        }		
		public static function filterInput($value){
			$filterInput = new Zend_Filter();
			$filterInput->addFilter(new Zend_Filter_StringTrim())
            			->addFilter(new Zend_Filter_StripTags());            
            return $filterInput->filter($value);
		}
		public static function filterEmail($email){
			$validator = new Zend_Validate_EmailAddress();
			return $validator->isValid($email);			
		}
		public static function filterDate($date){//format tanggal 2001-1-1
			$validator = new Zend_Date();			
			return $validator->isDate($date,"yyyy-M-d");
		}
        public static function getDataFromQuery($query){
			$DBAdapter = Zend_Db_Table::getDefaultAdapter();            
			$DBAdapter->setFetchMode(Zend_Db::FETCH_ASSOC);						
			$result = $DBAdapter->fetchAll($query);
			return $result;	
		}
        public static function getDataFromMultipleTables($maintable, $maincols='*', $joinTable=array(), $joinWhere=array(), 
                               $joinCols=array(), $order,$where=null,$count=null,$offset=null,$group=null){
            
            die("Masih dalam pengembangan");
            $DBAdapter = Zend_Db_Table::getDefaultAdapter();
			$DBAdapter->setFetchMode(Zend_Db::FETCH_ASSOC);
			$SELECT    = new Zend_Db_Select($DBAdapter);

			if($where==null){
				if($group==null){
					$SELECT ->from($tbl,$cols)
                            ->order($order)
                            ->limit($count,$offset);
				}else{
					$SELECT ->from($tbl,$cols)
                            ->order($order)
                            ->limit($count,$offset)
                            ->group($group);
				}								
			}else{
				if($group==null){
					$SELECT ->from($tbl,$cols)
                            ->where($where)
                            ->order($order)
                            ->limit($count,$offset);
				}else{
					$SELECT ->from($tbl,$cols)
                            ->where($where)
                            ->order($order)
                            ->limit($count,$offset)
                            ->group($group);
				}
			}			
			$result = $DBAdapter->fetchAll($SELECT);
			$SELECT->reset();
			return $result;
            
        }
		public static function getDataFetchAll($tbl,$cols='*',$order,$where=null,$count=null,$offset=null,$group=null){
			$DBAdapter = Zend_Db_Table::getDefaultAdapter();
			$DBAdapter->setFetchMode(Zend_Db::FETCH_ASSOC);
			$SELECT    = new Zend_Db_Select($DBAdapter);

			if($where==null){
				if($group==null){
					$SELECT ->from($tbl,$cols)
                            ->order($order)
                            ->limit($count,$offset);
				}else{
					$SELECT ->from($tbl,$cols)
                            ->order($order)
                            ->limit($count,$offset)
                            ->group($group);
				}								
			}else{
				if($group==null){
					$SELECT ->from($tbl,$cols)
                            ->where($where)
                            ->order($order)
                            ->limit($count,$offset);
				}else{
					$SELECT ->from($tbl,$cols)
                            ->where($where)
                            ->order($order)
                            ->limit($count,$offset)
                            ->group($group);
				}
			}			
			$result = $DBAdapter->fetchAll($SELECT);
			$SELECT->reset();
			return $result;
		}
		public static function getDataFetchRow($tbl,$where,$cols='*'){
			$DBAdapter = Zend_Db_Table::getDefaultAdapter();
			$DBAdapter->setFetchMode(Zend_Db::FETCH_ASSOC);			
			$SELECT    = new Zend_Db_Select($DBAdapter);
			
			$SELECT	->from($tbl,$cols)
					->where($where);
			
			$result = $DBAdapter->fetchRow($SELECT);
			$SELECT->reset();
			return $result;
		}
		public static function insertData($table, $data){
            $DBAdapter = Zend_Db_Table::getDefaultAdapter();
			$DBAdapter->setFetchMode(Zend_Db::FETCH_ASSOC);                                        				
			if($DBAdapter->insert($table,$data)){
				return true;
			}else{
				return false;
			}
		}
		public static function deleteData($table,$where){
            $DBAdapter = Zend_Db_Table::getDefaultAdapter();
			$DBAdapter->setFetchMode(Zend_Db::FETCH_ASSOC);                                        				
			if($DBAdapter->delete($table,$where)){
				return true;
			}else{
				return false;
			}            
		}        		
		public static function updateData($table,$data,$where){
            $DBAdapter = Zend_Db_Table::getDefaultAdapter();
			$DBAdapter->setFetchMode(Zend_Db::FETCH_ASSOC);                                        				
			if($DBAdapter->update($table,$data,$where)){
				return true;
			}else{
				return false;
			}            
		} 
        public static function lastInsertId(){
			$DBAdapter = Zend_Db_Table::getDefaultAdapter();
			$lastId = $DBAdapter->lastInsertId();			
			return $lastId;
		}           
		public function base64_encode_image($filename=string,$filetype=string) {
		    if ($filename) {
		        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
		        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
		    }
		}
        
     public static   function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755)) 
        { 
            $result=false; 
            
            if (is_file($source)) { 
                if ($dest[strlen($dest)-1]=='/') { 
                    if (!file_exists($dest)) { 
                        cmfcDirectory::makeAll($dest,$options['folderPermission'],true); 
                    } 
                    $__dest=$dest."/".basename($source); 
                } else { 
                    $__dest=$dest; 
                } 
                $result=copy($source, $__dest); 
                chmod($__dest,$options['filePermission']); 
                
            } elseif(is_dir($source)) { 
                if ($dest[strlen($dest)-1]=='/') { 
                    if ($source[strlen($source)-1]=='/') { 
                        //Copy only contents 
                    } else { 
                        //Change parent itself and its contents 
                        $dest=$dest.basename($source); 
                        @mkdir($dest); 
                        chmod($dest,$options['filePermission']); 
                    } 
                } else { 
                    if ($source[strlen($source)-1]=='/') { 
                        //Copy parent directory with new name and all its content 
                        @mkdir($dest,$options['folderPermission']); 
                        chmod($dest,$options['filePermission']); 
                    } else { 
                        //Copy parent directory with new name and all its content 
                        @mkdir($dest,$options['folderPermission']); 
                        chmod($dest,$options['filePermission']); 
                    } 
                } 
    
                $dirHandle=opendir($source); 
                while($file=readdir($dirHandle)) 
                { 
                    if($file!="." && $file!="..") 
                    { 
                         if(!is_dir($source."/".$file)) { 
                            $__dest=$dest."/".$file; 
                        } else { 
                            $__dest=$dest."/".$file; 
                        } 
                        //echo "$source/$file ||| $__dest<br />"; 
                        $result=smartCopy($source."/".$file, $__dest, $options); 
                    } 
                } 
                closedir($dirHandle); 
                
            } else { 
                $result=false; 
            } 
            return $result; 
        }   
        
      public static  function age($age){
        list($year,$month,$day) = explode("-",$age);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($day_diff < 0 || $month_diff < 0) {
          $year_diff--;
        }
        return $year_diff;
      }          
      ///
      public static function uploadFiles() {
            $num_args = func_num_args();
            $arg_list = func_get_args();
           
            $valReturn = false;
            $i = 0;
            $unlinkElement = array();
            foreach($arg_list as $key=>$value) {
                if(is_array($value) AND is_array($value[0])) {
                    if($value[0]['error'] == 0 AND isset($value[1])) {
                        if($value[0]['size'] > 0 AND $value[0]['size'] < 1048576) {
                            $typeAccepted = array("image/pjpeg","image/jpeg", "image/gif", "image/png","application/pdf");
                            if(in_array($value[0]['type'],$typeAccepted)) {   
                                $destination = $value[1];
                                if(isset($value[2])) {
                                    $extension = substr($value[0]['name'] , strrpos($value[0]['name'] , '.') +1);
                                    $destination .= (str_replace(" ","-",$value[2])).".".$extension;
                                } else {
                                    $destination .= $value[0]['name'];
                                }
                               
                                if(move_uploaded_file($value[0]['tmp_name'],$destination)) {
                                    $i++;
                                    $unlinkElement[] = $destination;
                                }
                            }
                        }
                    }
                }
            }
            if($i == $num_args) {
                $valReturn = (str_replace(" ","-",$value[2])).".".$extension;
            } else {
                foreach($unlinkElement as $value) {
                    unlink($value);
                }
            }
            return $valReturn;
        }
        public static function convert_local($datetime, $format = 'd M Y \a\t G:i T')

	{

		$local_dt = new DateTime($datetime, new DateTimeZone('UTC'));

		$local_dt->setTimezone(new DateTimeZone(date_default_timezone_get()));

		return (string) $local_dt->format($format);

	}

    

	public  function convert_to_timezone($datetime, $timezone, $format = 'd M Y \a\t G:i T')

	{

		$local_dt = new DateTime($datetime, new DateTimeZone('UTC'));

		$local_dt->setTimezone(new DateTimeZone($timezone));

		return (string) $local_dt->format($format);

	}

    

    public  function convert_timezone_to_utc($datetime, $timezone, $format = 'd M Y \a\t G:i T')

	{

		$local_dt = new DateTime($datetime,new DateTimeZone($timezone));

		$local_dt->setTimezone(new DateTimeZone('UTC'));

		return (string) $local_dt->format($format);

	}

    public  function convert_utc_to_timezone($datetime, $timezone, $format = 'd M Y \a\t G:i')

	{

		$local_dt = new DateTime($datetime,new DateTimeZone('UTC'));

		$local_dt->setTimezone(new DateTimeZone($timezone));

		return (string) $local_dt->format($format);

	}
    
    
    public  function array_to_string(array $datetime, $format = 'c')

	{

		// Extract array variables into scope

		extract($datetime, EXTR_SKIP);



		// Check month is in the right format

		$month = date("n", strtotime('01-'.$month.'-'.$year.' 00:00:00'));



		// Created new DateTime object and set the date and time

		$dt = new DateTime();

		$dt->setDate($year, $month, $day);

		$dt->setTime($hour, $minute);



		// Convert all dates to UTC timezone

		$dt->setTimezone(new DateTimeZone('UTC'));



		// Return correctly formated DateTime string

		return (string) $dt->format($format);

	}
    
    
    public function timeAgo( $timestamp )

    {

    	// Configuration

    	$singular 				= array( 'second' , 'minute' , 'hour' , 'day' , 'week' , 'month' , 'year' , 'decade'  );

    	$plural 				= array( 'seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'years', 'decades' );

    	$suffix 				= 'ago';

    	$now 					= 'now';

    

    	// Prepare

    	$time 					= time();

    	$difference 			= $time - $timestamp;

    	$lengths 				= array( 1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600 );

    

    	// Calculate lowest dividable amount

    	for( $i = 7; $i >= 0 && ( $amount = $difference / $lengths[$i] ) <= 1; --$i );

    

    	// Now or in the future

    	if( $amount <= 0 ) 		return $now;

    

    	// Return as string

    	$amount 				= floor( $amount );

    

    	return $amount . ' ' . ( $amount > 1 ? $plural[$i] : $singular[$i] ) . ' ' . $suffix;

    }

     public static  function executeCurl($url){    		

    	$ch = curl_init();

    	curl_setopt($ch, CURLOPT_URL, $url);

    	curl_setopt($ch, CURLOPT_TIMEOUT, 100);

    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    	$data = curl_exec($ch);

    	curl_close($ch);

    	return $data;

    }
    public static function cutAfter($string, $len = 30, $append = '...') {
            return (strlen($string) > $len) ? 
              substr($string, 0, $len - strlen($append)) . $append : 
              $string;
    }
	
	public function test()
	{
		echo "OK";
	}    

    
} //end class