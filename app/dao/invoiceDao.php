<?php
require_once('baseDao.php');



class InvoiceDao extends BaseDao{

public function generateInvoiceDescription($data)
{   
    $conn=$this->getConnection();

    $sql="INSERT INTO invoice_details (`invoice_number`, `type_of_customer`, `order_no`, `billed_to`, `billing_addr`, `shipped_to`, `shipping_addr`, `gstin_no`, `po_date`, `invoice_date`, `payment_method`)
          VALUES ('".$data['invoice_number']."','".$data['type_of_customer']."','".$data['order_no']."','".$data['billed_to']."','".$data['billing_addr']."','".$data['shipped_to']."','".$data['shipping_addr']."','".$data['gstin_no']."','".$data['po_date']."','".$data['invoice_date']."','".$data['payment_method']."')";

    if ($conn->query($sql) === TRUE) 
    {
        echo "{\"error\":\"False\",\"message\":\"Success\"}";
    } 
    else 
    {
        echo "{\"error\":\"True\",\"message\":\"".$conn->error."\"}";
        return;
    }
}

public function addInvoiceDetail($data)
    {
        
        $conn=$this->getConnection();
        //print_r($data);
        $sql="INSERT INTO `invoice_description` (`invoice_number`, `brand`, `product`, `hsn_code`, `no_of_units`, `unit_value`, `cgst`, `sgst`, `igst`) VALUES ('".$data['invoice_number']."','".$data['brand']."','".$data['product']."','".$data['hsn_code']."',".$data['no_of_units'].",".$data['unit_value'].",".$data['cgst'].",".$data['sgst'].",".$data['igst'].")";


        if ($conn->query($sql) === TRUE) 
        {
            $message="{\"error\":\"False\",\"message\":\"Success\"}";
            return $message;
        } 
        else 
        {
            $message="{\"error\":\"True\",\"message\":\"".$conn->error."\"}";
            return $message;
            
        }

    }



}

