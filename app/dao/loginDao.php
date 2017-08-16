<?php
    require_once('baseDao.php');
    class LoginDao extends BaseDao
    {   
        public function register($obj){
            
             $conn=$this->getConnection();
            
            
            $sql = "INSERT into users (uname,password,email) 
                     Values('".$obj->getUname()."','".$obj->getPassword()."','".$obj->getEmail()."') ";
            
            //echo $sql;
         
            if ($conn->query($sql) === TRUE) 
            {
                echo "{\"error\":\"False\",\"message\":\"Success\"}";
            } 
            else 
            {
                echo "{\"error\":\"True\",\"message\":\"".$conn->error."\"}";
            }
        }
        
        
        public function login($email,$pass)
        {
            $conn=$this->getConnection();
            $stmt=$conn->prepare("select password from users where email=?"); 
            $stmt->bind_param("s", $email); 
            $stmt->execute();
            $stmt->store_result();
            $count=$stmt->num_rows;
            
          
           
             $stmt->bind_result($row);
                
                if($count == 1){
                if($stmt->fetch()) 
                {
                    
                        if ($row == $pass)
                        {
                            echo "{\"error\":\"False\",\"message\":\"Success\"}";
                        }
                        else
                        {
                            echo "{\"error\":\"False\",\"message\":\"Password Incorrect\"}";
                            
                        }
                }
                }
            else
            {
                
                echo "{\"error\":\"False\",\"message\":\"Incorrect Email\"}";
                
            }
                
            
        
            
            
           
            
        
        }
        
        
    }




?>