<?php

require_once('../bl/productBL.php');
require_once('../entity/category.php');
if (isset($_POST['modelmod'])&&isset($_POST['pricemod'])&&isset($_POST['quantitymod'])&&isset($_POST['part_numbermod'])&&isset($_POST['product_dscpmod'])&&isset($_POST['gstmod'])&&isset($_POST['pidmod'])){
    
    $d= new ProductBL();
       
    $d->editProduct($_POST);
    
//print_r($_POST);    
    
    
    
}




?>