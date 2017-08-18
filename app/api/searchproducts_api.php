<?php 
    
require_once('../bl/adminBL.php');

if(isset($_POST['brands'])&&isset($_POST['price'])&&isset($_POST['products']))
{
    

    
    $d= new AdminBL();
    $d->searchProducts($_POST['brands'],$_POST['products'],$_POST['price']);
    
    
    
}

    
   

 
    


    






?>
