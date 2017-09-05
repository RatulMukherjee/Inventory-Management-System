<?php
    require_once('baseDao.php');
    class AdminDao extends BaseDao
    {   
        public function search($email,$name){
            
             $conn=$this->getConnection();
            
            $sql="select * from users where uname='".$name."' or email='".$email."'";
            
            //echo $sql;
            $result = $conn->query($sql);
         $arr =  array();
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
              $arr[]=$row;
            }
            echo json_encode($arr);

        }
        else

        {
            echo "404";
        }
            
          
        
    }
        
        public function getUname($email)
        {
            $conn=$this->getConnection();
            
            $sql="select uname from users where email='".$email."'";
             $result = $conn->query($sql);
             $arr =  array();
             $arr=$this->getArray($result);

             echo json_encode($arr);
        }
        
     
        
        
        
        
        
        
        
    }




?>