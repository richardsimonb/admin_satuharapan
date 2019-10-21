<?php 
require_once("excell/PHPExcel.php");
class Ext_Global_Excell {
	
	public  static function createExcell($filename,$header=array(),$titleheader=array(),$datas=array(),$format='2007'){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("saepulloh")
		->setLastModifiedBy("saepulloh")
		->setTitle("Office 2007 XLSX Test Document")
		->setSubject("Office 2007 XLSX Test Document")
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		->setKeywords("office 2007 openxml php")
		->setCategory("Test result file");
		$col = 0;
		$row = 1;
		//print_r($header); die();
		$default_border = array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('rgb'=>'1006A3')
		);
		$style_header = array(
				
				'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb'=>'E1E0F7'),
				),
				'font' => array(
						'bold' => true,
						'size' => 12
				)
		);
		
		if(count($header)){
			foreach ($header as $text){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $text);
				//merge cell
				$startColumn = 0;
				$endColumn = count($titleheader) - 1;
				//echo PHPExcel_Cell::stringFromColumnIndex($startColumn); die();
				$mergeRange = PHPExcel_Cell::stringFromColumnIndex($startColumn) .  $row .':' . PHPExcel_Cell::stringFromColumnIndex($endColumn) . $row;
				$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($startColumn).$row)->applyFromArray($style_header);
				$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($startColumn).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $objPHPExcel->getActiveSheet()->mergeCells($mergeRange);
				$row++;
			}
		}
		
		$row++;
		if(count($titleheader)){
			$col=0;
			foreach ($titleheader as $text){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $text);
				$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($col).$row)->applyFromArray($style_header);
                $col++;
			}
            
		}
        
		$row++;
        
		if(count($datas)){
			foreach ($datas as $data){
			  //print_r($datas); die();
				$col=0;
				foreach ($data as $text){
				    $type = PHPExcel_Cell_DataType::TYPE_STRING;
					//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row)->setValueExplicit($text, $type);;
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit(PHPExcel_Cell::stringFromColumnIndex($col).$row, $text, PHPExcel_Cell_DataType::TYPE_STRING);
					$col++;
				}
				$row++;
			}
		}
		//style
		
	
		//$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style_header);		
        $columnID = 'A';
        $lastColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
        //die($lastColumn);
        do {
           $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
           $objPHPExcel->getActiveSheet()->getStyle($columnID.'1')->applyFromArray($style_header);
           $columnID++;
        } while ($columnID != $lastColumn);
		
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($filename);
		
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		if($format == '2003')
        {
             //(Excel2003)
           	header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
            header('Cache-Control: max-age=0');
    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    		    
        } else {
            // (Excel2007)
    		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
    		header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        }
        //die();
		$objWriter->save('php://output');
		exit;
	}
	
}

?>