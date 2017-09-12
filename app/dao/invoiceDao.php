<?php
require_once('baseDao.php');



class InvoiceDao extends BaseDao{

public function generateInvoiceDescription($data)
{   

    $conn=$this->getConnection();

    $sql="INSERT INTO invoice_details (`invoice_number`, `type_of_customer`, `order_no`, `billed_to`, `billing_addr`, `shipped_to`, `shipping_addr`, `gstin_no`, `po_date`, `invoice_date`, `payment_method`)
          VALUES ('".$data[1]['value']."','".$data[4]['value']."','".$data[3]['value']."','".$data[7]['value']."','".$data[9]['value']."','"
          .$data[8]['value']."','".$data[10]['value']."','".$data[6]['value']."','".$data[2]['value']."','".$data[0]['value']."','".$data[5]['value']."')";

    
        //echo $sql;

if ($conn->query($sql) === TRUE) 
    {
        $message= '{"error":"False","message":"Success"}'; 
        return $message;
    } 
    else 
    {
         $message='{"error":"True","message":"'.$conn->error.'"}';
        return $message;
    }
}

public function addInvoiceDetail($item,$invoice)
    {
        
        $conn=$this->getConnection();


       
        $sql="INSERT INTO `invoice_description` (`invoice_number`, `brand`, `product`,`model`,`part_number`, `hsn_code`, `no_of_units`, `unit_value`, `cgst`, `sgst`, `igst`) 
        VALUES ('".$invoice['value']."','".$item[0]['value']."','".$item[1]['value']."','".$item[2]['value']."','".$item[3]['value']."','".$item[5]['value']."',".$item[4]['value']."
        ,".$item[6]['value'].",".$item[7]['value'].",".$item[8]['value'].",".$item[9]['value'].")";
        
        
        if ($conn->query($sql) === TRUE) 
        {
            $message= '{"error":"False","message":"Success"}'; 
            return $message;
        } 
        else 
        {
             $message='{"error":"True","message":"'.$conn->error.'"}';
            return $message;
        }

    }



}

