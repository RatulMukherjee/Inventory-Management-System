<?php 
    
require_once('../bl/productBL.php');


/*print_r($_POST);*/

if(isset($_POST['brands'])&&isset($_POST['price'])&&isset($_POST['products']))
{
    
 
    
$d= new ProductBL();
    $d->searchProducts($_POST['brands'],$_POST['products'],$_POST['price']);
    
    
    
}

    
   

 
    


    






?>
