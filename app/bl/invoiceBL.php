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
        $this->idao->generateInvoiceDescription($data);

    }


    public function addInvoiceDetail($data)
    {
        $message=$this->idao->addInvoiceDetail($data);
        echo $message;


    }
  
    }



?>