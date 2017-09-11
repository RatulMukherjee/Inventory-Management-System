<?php
require_once('baseDao.php');
require_once("../api/Classes/PHPExcel.php");
require_once("productDao.php");

class InventoryFileDao extends BaseDao{
    
     public function purchaseRecord($data, string $type)
     {
        $arr=array();
        $conn=$this->getConnection();
        $pdao = new ProductDao();
        $arr=$pdao->findID($data); 


        $style_purchase = array('font' => array('size' => 10,'bold' => true,'color' => array('rgb' => 'ff0000')));
        $style_sale = array('font' => array('size' => 10,'bold' => true,'color' => array('rgb' => '0000ff')));


        $fileName="../inventoryfiles/".$data['brands']."_".$arr[0]['cid']."_".$arr[1]['pid'].".xlsx";

         if(file_exists($fileName)) {
            $inputFileType = 'Excel2007';
             $objReader = PHPExcel_IOFactory::createReader($inputFileType);
             $excelObj = $objReader->load($fileName);
              $worksheet = $excelObj->getSheet(0);
             $lastRow = $worksheet->getHighestRow();
             $current_stock=$worksheet->getCell('G'.$lastRow)->getValue();
             
             
             
             $lastRow++;
             if ($type === 'purchase')
             {
                $excelObj->getActiveSheet()->getStyle('A'.$lastRow.':G'.$lastRow)->applyFromArray($style_purchase);
             }  
             else
             {
                $excelObj->getActiveSheet()->getStyle('A'.$lastRow.':G'.$lastRow)->applyFromArray($style_sale);

             } 

             $worksheet->setCellValue('A'.$lastRow, date("Y/m/d"))
            ->setCellValue('B'.$lastRow, $data['vendor'])
            ->setCellValue('C'.$lastRow, $type)
            ->setCellValue('D'.$lastRow, $data['quantity'])
            ->setCellValue('E'.$lastRow, $data['price'])
            ->setCellValue('F'.$lastRow, ($data['quantity']*$data['price']))
            ->setCellValue('G'.$lastRow, ($current_stock+$data['quantity']));
             
             $objWriter = PHPExcel_IOFactory::createWriter($excelObj, 'Excel2007');
             $objWriter->save($fileName);
         }
         
         else
         {
             
             $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Me")->setLastModifiedBy("Me")->setTitle("My Excel Sheet")->setSubject("My Excel Sheet")->setDescription("Excel Sheet")->setKeywords("Excel Sheet")->setCategory("Me");
         
         // Set active sheet index to the first sheet, so Excel opens this as the first sheet
         $objPHPExcel->setActiveSheetIndex(0);

         

         
         // Add column headers
         $header= "Product Details of ".$data['brands']." ".$data['model']."(".$data['part_number'].")";
         $objPHPExcel->getActiveSheet()
                        ->setCellValue('G1', $header)
                        ->setCellValue('A3', 'Date')
                        ->setCellValue('B3', 'Vendor/Customer')
                        ->setCellValue('C3', 'Voucher Type')
                        ->setCellValue('D3', 'Units')
                        ->setCellValue('E3', 'Price per Unit')
                        ->setCellValue('F3', 'Total')
                        ->setCellValue('G3', 'Final Stock');

  
             
            $objPHPExcel->getActiveSheet()->getStyle('A5:G5')->applyFromArray($style_purchase);
             
         
             $objPHPExcel->getActiveSheet()->setCellValue('A5', date("Y/m/d"))
             ->setCellValue('B5', $data['vendor'])
             ->setCellValue('C5', $type)
             ->setCellValue('D5', $data['quantity'])
             ->setCellValue('E5', $data['price'])
             ->setCellValue('F5', ($data['quantity']*$data['price']))
             ->setCellValue('G5', $data['quantity']);

         
         
         
         // Set worksheet title
         $objPHPExcel->getActiveSheet()->setTitle($data['model']);
         
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         $objWriter->save($fileName);




      }
    }

    public function showRecord ( int $cid, int $pid)
    {       
        $pdao = new ProductDao();

        $brandarr=array();
        $brandarr=$pdao->getBrandByCid($cid,$pid); 

        $fileName="../inventoryfiles/".$brandarr[0]['brand']."_".$cid."_".$pid.".xlsx";

        if(file_exists($fileName)) {
            $inputFileType = 'Excel2007';
             $objReader = PHPExcel_IOFactory::createReader($inputFileType);
             $excelObj = $objReader->load($fileName);
              $worksheet = $excelObj->getSheet(0);
             $lastRow = $worksheet->getHighestRow();
             $result=array();
             for ($row = 5; $row <= $lastRow; $row++) 
             { 
                 $arr=array();
                 $arr['product']=$worksheet->getCell('G1')->getValue();
                 $arr['Date']=$worksheet->getCell('A'.$row)->getValue();
                 $arr['Vendor_Customer']=$worksheet->getCell('B'.$row)->getValue();
                 $arr['Voucher_Type']=$worksheet->getCell('C'.$row)->getValue();
                 $arr['Units']=$worksheet->getCell('D'.$row)->getValue();
                 $arr['price']=$worksheet->getCell('E'.$row)->getValue();
                 $arr['Total']=$worksheet->getCell('F'.$row)->getValue();
                 $arr['Final_Stock']=$worksheet->getCell('G'.$row)->getValue();
              
                 $result[]=$arr;
             }
              echo json_encode($result);
            }
            else
            {
                echo "Record Doesnt Exist";


            }

            



    }

}