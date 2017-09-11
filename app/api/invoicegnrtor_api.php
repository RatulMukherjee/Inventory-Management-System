<?php

require_once('../bl/invoiceBL.php');

 $iBL = new InvoiceBL();
 $iBL->generateInvoiceDescription($_POST);

//print_r($_POST);

?>