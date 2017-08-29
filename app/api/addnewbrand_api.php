<?php
require_once('../entity/category.php');
require_once('../bl/productBL.php');
//print_r($_POST);

if (isset($_POST['brand'])&&isset($_POST['product'])&&isset($_POST['type']))
{
    
    $e = new Category();
    
    $e->setBrand($_POST['brand']);
    $e->setName($_POST['product']);
    $e->setType($_POST['type']);
    
    //var_dump($e);
    
  $d= new ProductBL();
    
    $d->addBrand($e);
    
    
    
}




?>