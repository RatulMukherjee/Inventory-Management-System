<?php
    
require_once('../dao/inventoryfileDao.php');
class InventoryFileBL 
{
	private $ifdao;
	public function __construct()
	{
		$this->ifdao = new InventoryFileDao();
		
	}
    public function purchaseRecord($data,string $type)

    {
       return $this->ifdao->purchaseRecord($data,$type);

    }

    public function showRecord( int $cid, int $pid )
    {
        return $this->ifdao->showRecord($cid, $pid);
    }
    }



?>