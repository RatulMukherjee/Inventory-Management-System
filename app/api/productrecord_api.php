<?php

require_once('../bl/inventoryfileBL.php');

if(isset($_POST['c_id'])&&isset($_POST['p_id']))
{
    $ifbl=new inventoryfileBL();
    $ifbl->showRecord($_POST['c_id'],$_POST['p_id']);

}




?>