<?php
require_once('../bl/loginBL.php');
//print_r($_POST);

$d = new LoginBl();

$d->login($_POST['email'],$_POST['password']);

?>