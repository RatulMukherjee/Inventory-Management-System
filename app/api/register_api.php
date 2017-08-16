<?php

//print_r($_POST);
require_once('../entity/users.php');
require_once('../bl/loginBL.php');

if(isset($_POST['uname'])&&isset($_POST['password'])&&isset($_POST['email']))
{
    
    $data= new users();
    $data->setUname($_POST['uname']);
    $data->setPassword($_POST['password']);
    $data->setEmail($_POST['email']);
    
    
    //echo json_encode($data);
    
    $d= new LoginBL();
    $d->register($data);
    
    
    
}



?>