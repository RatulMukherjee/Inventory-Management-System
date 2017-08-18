<?php
//print_r($_POST);
require_once('../bl/adminBL.php');

if(isset($_POST['brands'])&&isset($_POST['products'])&&isset($_POST['model'])&&isset($_POST['quantity'])&&isset($_POST['price'])&&isset($_POST['gst']))
    
{
    $d= new AdminBL();
    $d->addProducts($_POST);
}


?>