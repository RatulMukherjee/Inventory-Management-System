<?php

require_once('../bl/productBL.php');

$iBL= new ProductBL();
$iBL->getPartNumber($_POST);




?>