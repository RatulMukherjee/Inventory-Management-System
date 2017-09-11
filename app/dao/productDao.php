<?php


require_once('baseDao.php');

class ProductDao extends BaseDao{
    
     public function searchProducts($brands,$products,$price)
     {
     
         $conn= $this->getConnection();
         
         
         
         /*QUERY TO FIND DETAILS OF A SPECIFIC PRODUCT OF SPECIFIED BRANDS*/
         $str='';
         
        if ($products != "none" && $brands != "none") {
         
         $str.="select cid,pid,quantity,part_number,product_dscp,model,price,gst from products where cid in (select cid from category where name='".$products."' and ";
         
         
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
     }

         
         /*QUERY TO FIND ALL PRODUCTS OF A PARTICULAR TYPE (NO BRANDS SPECIFIED)*/
         
         else if  ($products != "none" && $brands == "none")
         {
            
             $str.="select cid,pid,quantity,part_number,product_dscp,model,price,gst from products where cid in (select cid from category where name='".$products."') and price < ".$price;
             
             //echo $str;
             
         }
         else if($products == "none" && $brands != "none")
         {
              $str.="select cid,pid,quantity,part_number,product_dscp,model,price,gst from products where cid in (select cid from category where ";   
              for($i=0; $i<count($brands);$i++)
              {
                  if ($i== 0)
                    $str.="brand='".$brands[$i]."'";
                  else
                    $str.="or brand='".$brands[$i]."'";
                  
              }
                $str.=")";
               $str.= "and price < ".$price;
              
              //echo $str;
         }

         
         
         else
         {
             $str.="select cid,pid,quantity,part_number,product_dscp,model,price,gst from products where price <".$price;
             //echo $str;
             
         }
         
         
        $result = $conn->query($str);
             $arr =  array();
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                  $arr[]=$row;
                }
                 $data =  array();
                 $data["error"]="False";    
                $data[]=$arr;
                echo json_encode($data); 
               
         
         
         
            }
         else {
             
             $arr["error"]= "True";
             echo json_encode($arr);
         }
     }


        
        public function showBrands(){
            
            $conn=$this->getConnection();
            
            
            $sql= "select distinct brand from category";
            $result = $conn->query($sql);
             $arr =  array();
             $arr=$this->getArray($result);
                echo json_encode($arr);
            
        }
        
        public function showProducts($brand){
            
            $conn=$this->getConnection();
            
            $sql= "select distinct name from category where brand='".$brand."'";
            $result = $conn->query($sql);
             $arr =  array();
             $arr=$this->getArray($result);
                echo json_encode($arr);
            
        }

        public function getBrandByCid(int $cid)
        {
            $conn=$this->getConnection();
            
            $sql= "select brand,name from category where cid=".$cid ;
            $result = $conn->query($sql);
             $arr =  array();
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                  $arr[]=$row;
                }
                return $arr;
            }
            else
            {
                $error=false;                    
                return $error;
            } 
        }


        public function getPartNumber($data)
        {
            $conn=$this->getConnection();

            $sql="select part_number from products where model='".$data['model']."'";

            //echo $sql;
            $result=$conn->query($sql); 
            $arr= array();

            $arr= $this->getArray($result);

            return $arr;




            

        }
        
        public function modelExists($model,$part_number){
            
            $conn = $this->getConnection();
            
            
            $sql = "SELECT cid from products where model='".$model."' and part_number='".$part_number."'";
             
            return $conn->query($sql)->num_rows;
        }
        


            // FINDS CID/PID OF A GIVEN PRODUCT WITH A SPECIFIC PART NUMBER


        public function findID($data)
        {

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

            if ($this->modelExists($data['model'],$data['part_number']) != 0)
            {
                $sql="select pid from products where model='".$data['model']."' and part_number='".$data['part_number']."' and cid=".$arr[0]['cid']; 
                
                $result = $conn->query($sql);
                
                if($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                    {
                      $arr[]=$row;
                    }
                }

                
                
                
                
            } 
            return $arr; 
            
            
        }


        // END OF FUNCTION-----------------------------------------------------------------------
        
        
    //    FUNCTION TO ADD A NEW PRODUCT TO THE INVENTORY DATABASE OR UPDATE STOCK------------------------------ 
        
        public function addProducts($data){
            
             
            $arr =  array();
            $arr=$this->findID($data);
            
           
            $conn = $this->getConnection();
            $sql='';
            
          if ($this->modelExists($data['model'],$data['part_number']) == 0)
            {
                $sql.="insert into products(cid,model,quantity,price,gst,part_number,product_dscp) values(".$arr[0]['cid'].",'".$data['model']."',".$data['quantity'].",".$data['price'].",".$data['gst'].",'".$data['part_number']."','".$data['product_dscp']."')";
            }
            else
            {
                $sql.="Update products
                      SET quantity= quantity+'".$data['quantity']."',price='".$data['price']."',gst='".$data['gst']."'
                       where pid=".$arr[1]['pid'];
            }
            
            
            
            //echo $sql;
           
        if ($conn->query($sql) === TRUE) 
            {
               return '{"error":"False","message":"Stock registered/updated Successfully"}';
            } 
            else 
            {
                return '{"error":"True","message":"'.$conn->error.'"}';
            }
                 
                    
        }


        // END OF FUNCTION-------------------------------------------------------------------------------------- 
        
        
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
        public function showList()
            
        {
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
               $brands=json_encode($arr);

            }
             //$brands = $this->showBrands();    
         $sql1= "select distinct name from category";
            $result = $conn->query($sql1);
             $arr1 =  array();
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                  $arr1[]=$row;
                }
               $products= json_encode($arr1);
            
             echo json_encode(array_merge(json_decode($brands, true),json_decode($products, true)));

            }
        }
    
        public function editProduct($data){
            
            
            $conn=$this->getConnection();
            
            
            $sql="Update products
                      SET quantity='".$data['quantitymod']."',price='".$data['pricemod']."',gst='".$data['gstmod']."',model='".$data['modelmod']."' where pid='".$data['pidmod']."'";
            
            if ($conn->query($sql) === TRUE) 
            {
              echo '{"error":"False","message":"Stock registered/updated Successfully"}';
            } 
            else 
            {
                echo '{"error":"True","message":"'.$conn->error.'"}';
            }
        }
}




?>