<?php
    
require_once('../dao/invoiceDao.php');
class InvoiceBL 
{
	private $idao;
	public function __construct()
	{
		$this->idao = new InvoiceDao();
		
    }
    
    public function generateInvoiceDescription($data)
    {
        return $this->idao->generateInvoiceDescription($data);
         

    }


    public function addInvoiceDetail($item,$invoice_number)
    {
        return $this->idao->addInvoiceDetail($item,$invoice_number);
        


    }
  
    }



?>