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
    
    
    
}

?>