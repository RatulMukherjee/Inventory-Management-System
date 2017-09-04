<?php
//print_r($_POST);
require_once('../bl/productBL.php');
require_once('../bl/inventoryfileBL.php');

//print_r($_POST);

if(isset($_POST['brands'])&&isset($_POST['products'])&&isset($_POST['model'])&&isset($_POST['quantity'])&&isset($_POST['price'])&&isset($_POST['gst'])&&isset($_POST['part_number'])&&isset($_POST['product_dscp']))
  {    
      
        $d= new ProductBL();
        echo ($d->addProducts($_POST));
      
      $if=new InventoryFileBL();
      $if->purchaseRecord($_POST,$type="purchase");


 }



?>