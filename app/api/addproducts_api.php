<?php
//print_r($_POST);
require_once('../bl/productBL.php');

if(isset($_POST['brands'])&&isset($_POST['products'])&&isset($_POST['model'])&&isset($_POST['quantity'])&&isset($_POST['price'])&&isset($_POST['gst']))
    
{
    $d= new ProductBL();
    echo ($d->addProducts($_POST));
}


?>