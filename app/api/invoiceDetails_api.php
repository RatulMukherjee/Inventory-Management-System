<?php

    
require_once('../bl/invoiceBL.php');
require_once('../bl/inventoryfileBL.php');

    $iBL = new InvoiceBL();
    $response=json_decode($iBL->generateInvoiceDescription($_POST['details']));

    if ($response->error === "False" && $response->message === "Success" )  
    {
        
        
        for($i=0; $i<count($_POST['items']); $i++)
        {
            $response=json_decode($iBL->addInvoiceDetail($_POST['items'][$i],$_POST['details'][1])); 
            
                if ($response->error === "True")
                {
                    echo json_encode($response);
                    break;
                }
            $data= array();   
            $data['brands']= $_POST['items'][$i][0]['value'];
            $data['products']= $_POST['items'][$i][1]['value'];
            $data['vendor']=$_POST['details'][7]['value'];
            $data['quantity']=($_POST['items'][$i][4]['value'])*-1;
            $data['price']=$_POST['items'][$i][6]['value'];
            $data['model']=$_POST['items'][$i][2]['value'];
            $data['part_number']=$_POST['items'][$i][3]['value'];
            
            //print_r($data);
            
            $if=new InventoryFileBL();
            $if->purchaseRecord($data,$type="sale");
            
            
           
            
            
            
            
                



        }
    
    }
    else
    {
        echo json_encode($response);
    }



   




?>