<?php

//print_r($_POST);

require_once('../bl/adminBL.php');


$d = new AdminBL();
$d->getUname($_POST['email']);      



?>