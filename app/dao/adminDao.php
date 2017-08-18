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
            echo "ID not found";
        }
            
          
        
    }
        
        
     public function searchProducts($brands,$products,$price)
     {
         
         //print_r($brands);
         
         
         $conn= $this->getConnection();
         //echo "hello";
         
         $str="select cid,quantity,model,price,gst from products where cid in (select cid from category where name='".$products."' and ";
         
         
         for($i=0; $i<count($brands);$i++)
         {
             if ($i==0)
             $str.="brand='".$brands[$i]."'";
             else
            {     
             $str.="or brand='".$brands[$i]."'";
             $str.="and name='".$products."'";
            }
         }
         
         $str.=")";
         
         $str.= "and price < ".$price;
         
         //echo $str;
         $result = $conn->query($str);
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
             echo "No stock";
         
         
         
     }
        
        
        
    }




?>