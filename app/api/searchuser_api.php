<?php

//print_r($_GET);
require_once('../bl/adminBL.php');

if(isset($_POST['name'])&&isset($_POST['email']))
{
    $d= new AdminBL();
    $d->search($_POST['email'],$_POST['name']);
}


?>