<?php
Class dbObj{
    var $dbhost = "localhost";
    var $username = "root";
    var $password = "";
    var $dbname = "request_docu";
    var $conn;
   
    function getConnString(){
        $con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname);
       
        if(mysqli_connect_errno()){
            printf("Connection failed:", mysqli_connect_error());
            exit();
        } else {
            $this-> conn = $con;
        }
        return $this->conn;
    }
}
?>
