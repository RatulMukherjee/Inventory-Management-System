<?php

require_once("Classes/PHPExcel.php");
require_once('../bl/adminBL.php');
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 0;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

//echo $target_file;
if(isset($_FILES['file']['name'])) {
    $uploadOk = 1;
    
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "xlsx") {
    echo "Sorry, only excel files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) 
{
    echo "Sorry, your file was not uploaded.";

} 
else 
{
    
    
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        
        
          
            $dir="uploads/".$_FILES["file"]["name"];
            $inputFileType = 'Excel2007';
   

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $excelObj = $objReader->load($dir);
         $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();
        
		$result=array();
        for ($row = 2; $row <= $lastRow; $row++) 
        {
           
            
            $arr=array();
            $arr['brands']=$worksheet->getCell('A'.$row)->getValue();
            $arr['products']=$worksheet->getCell('B'.$row)->getValue();
            $arr['model']=$worksheet->getCell('C'.$row)->getValue();
            $arr['quantity']=$worksheet->getCell('D'.$row)->getValue();
            $arr['price']=$worksheet->getCell('E'.$row)->getValue();
            $arr['gst']=$worksheet->getCell('F'.$row)->getValue();
            
            
            
            $bl =new AdminBL();
            $result[$row-2]=$bl->addProducts($arr);
		}
        
        echo json_encode($result);
    } 
    else 
    {
        echo "Sorry, there was an error uploading your file.";
    }
}







?>