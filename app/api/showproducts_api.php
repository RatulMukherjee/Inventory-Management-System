<?php
//print_r($_POST);
require_once('../bl/adminBL.php');
    
    if (isset($_POST['brand'])){
        $d= new AdminBL();
        $d->showProducts($_POST['brand']);

    }
?>