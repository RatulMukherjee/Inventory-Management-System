<?php
    require_once('baseDao.php');
    class LoginDao extends BaseDao
    {   
        public function register($obj){
            
             $conn=$this->getConnection();
            
            
            $sql = "INSERT into users (uname,password,email) 
                     Values('".$obj->getUname()."','".$obj->getPassword()."','".$obj->getEmail()."') ";
            
            echo $sql;
         
            if ($conn->query($sql) === TRUE) 
            {
                echo "Success";
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        
        
    }




?>