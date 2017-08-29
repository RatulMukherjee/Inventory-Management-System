<?php
//print_r($_POST);
require_once('../bl/productBL.php');
    
    if (isset($_POST['brand']))
    {
        $d= new ProductBL();
        $d->showProducts($_POST['brand']);

    }
?>