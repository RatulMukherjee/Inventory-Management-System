<?php

require_once('../bl/invoiceBL.php');

 //print_r($_POST);
  $iBL = new InvoiceBL();
  $iBL->generateInvoiceDescription($_POST);


 

?>