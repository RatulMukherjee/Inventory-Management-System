<?php
    
require_once('../dao/adminDao.php');
class AdminBL 
{
	private $addao;
	public function __construct()
	{
		$this->addao = new AdminDao();
		
	}
    
    public function search ($email, $name){
        
        
        return $this->addao->search($email,$name);
        
    } 
    
    public function searchProducts($brands,$products,$price ){
        
        return $this->addao->searchProducts($brands,$products,$price);
        
    }
    public function showBrands(){
        
        return $this->addao->showBrands();
        
        
    }
    public function showProducts($brand){
        
        return $this->addao->showProducts($brand);
        
        
    }
    public function addProducts($data){
        
        return $this->addao->addProducts($data);
        
        
    }
    
    public function addBrand($obj)
    {
        
        return $this->addao->addBrand($obj);
        
        
    }
    
    public function showList()
    {
        return $this->addao->showList();
    }
    
    public function getUname($email){
        
        return $this->addao->getUname($email);
        
    }
    
    
}

?>