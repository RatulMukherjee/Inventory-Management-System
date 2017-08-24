<?php

//require_once("Classes/PHPExcel.php");
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

//echo "this is a ".$imageFileType;
if(isset($_POST["upload"])) {
    $uploadOk = 1;
    
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx") {
    echo "Sorry, only excel files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
        echo $file = $_FILES["fileToUpload"]["name"];
//echo $directory;
/*        $excelReader = PHPExcel_IOFactory::createReaderForFile($file);

        $excelObj = $excelReader->load($file);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();
		
        for ($row = 2; $row <= $lastRow; $row++) 
        {
            $str = "insert into table(c1,c2) value('".$worksheet->getCell('C'.$row)->getValue()."','".$worksheet->getCell('D'.$row)->getValue()."')";
            
            echo $str;
			 
		}*/
    } 
    else 
    {
        echo "Sorry, there was an error uploading your file.";
    }
}







?>