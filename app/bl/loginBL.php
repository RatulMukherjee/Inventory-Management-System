<?php
    
require_once('../dao/loginDao.php');
class LoginBL 
{
	private $ldao;
	public function __construct()
	{
		$this->ldao = new LoginDao();
		
	}
    public function register($data)
    {
        return $this->ldao->register($data);
    }
    public function login ($email,$password)
    {
        return $this->ldao->login($email,$password);
        
    }

}

?>