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
        
        public function showBrands(){
            
            $conn=$this->getConnection();
            
            
            $sql= "select distinct brand from category";
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
            
        }
        
        public function showProducts($brand){
            
            $conn=$this->getConnection();
            
            $sql= "select distinct name from category where brand='".$brand."'";
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
        }
        
        public function addProducts($data){
            
         //print_r($data);
            
           
              $conn = $this->getConnection();
            
            $sql= "select cid from category where name='".$data['products']."' and brand='".$data['brands']."'";
            $result = $conn->query($sql);
            $arr =  array();
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                  $arr[]=$row;
                }
            }
            $sql="insert into products(cid,model,quantity,price,gst) values(".$arr[0]['cid'].",'".$data['model']."',".$data['quantity'].",".$data['price'].",".$data['gst'].")";
            
             if ($conn->query($sql) === TRUE) 
            {
                echo "{\"error\":\"False\",\"message\":\"Stock registered Successfully\"}";
            } 
            else 
            {
                echo "{\"error\":\"True\",\"message\":\"".$conn->error."\"}";
            }
        }
        
        
        public function addBrand($obj)
        {
           $conn=$this->getConnection();
            
            $sql ="select cid from category where brand='".$obj->getBrand()."' and name='".$obj->getName()."'";
             $result = $conn->query($sql);
             
            if($result->num_rows != 0)
            {
                 echo "{\"error\":\"True\",\"message\":\"Brand or Product already exists\" }";

            }
            
            else if ($result->num_rows == 0)
            {
                
                $sql="insert into category(name,brand,type) values('".$obj->getName()."','".$obj->getBrand()."','".$obj->getType()."')";
                  if ($conn->query($sql) === TRUE) 
            {
                echo "{\"error\":\"False\",\"message\":\"Brand/Product added Successfully\"}";
            } 
            else 
            {
                echo "{\"error\":\"True\",\"message\":\"".$conn->error."\"}";
            }
                
            }
            
            
            
            
            
            
        }
        
        
        
    }




?>