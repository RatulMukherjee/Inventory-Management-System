<?php
class BaseDao{
  private static $conn;

  final public function getConnection(){
    if(!isset($this->conn)){
      if(!file_exists("../dao/config.ini"))
        die("No Configuration file");

      $config=parse_ini_file("../dao/config.ini");

        $hostname=$config["hostname"];
        $username=$config["username"];
        $dbname=$config["dbname"];
        $password=$config["password"];

        if($hostname=="" || $username=="" || $dbname=="")
          die("Hostname/username/dbname/password is missing");
        else
          $this->conn = new mysqli($hostname, $username, $password,$dbname);
    }
    // Check connection
    if ($this->conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $this->conn;
  }

  final public function getArray($result){
    $arr = array();
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
          $arr[]=$row;
        }
         return $arr ;

    }


  }

}



?>