<?php
    
require_once('../dao/productDao.php');
class ProductBL 
{
	private $addao;
	public function __construct()
	{
		$this->addao = new ProductDao();
		
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
    
 
    
    public function editProduct($data){
        
        return $this->addao->editProduct($data);
        
    }
    
    
    
}

?>