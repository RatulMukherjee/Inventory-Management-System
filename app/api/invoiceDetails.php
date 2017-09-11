<?php

    
require_once('../bl/invoiceBL.php');


$iBL = new InvoiceBL();
$iBL->addInvoiceDetail($_POST);





?>