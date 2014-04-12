<?php
require_once 'config.php';
class Database {
    private $conn;
    private $lastQuery;
    public function __construct() {
        $this->connect();
       $this->lastQuery="";
    }
    public function connect(){
        global $db_server;
        global $db_pass;
        global $db_name;
        global $db_user;
         $this->conn= mysqli_connect($db_server, $db_user, $db_pass, $db_name);        
        if(mysqli_connect_errno()){
            die(mysqli_connect_error());
        }
    }
    public function closeConnection() {
           if(isset($this->conn)) {
               mysqli_close($this->conn);
		unset($this->conn);
                unset($this->lastQuery);
		}
    }
    public function query($sql){
       if(!empty($sql)){
           $this->lastQuery=$sql;
           return mysqli_query($this->conn, $sql);
       } 
    }
    public function getNumRows($result){
        //$res=$this->query($result);
        return mysqli_num_rows($result);
    }
    public function getAffectedRows(){
        return mysqli_affected_rows($this->conn);
    }
    public function getLastInsertID(){
        return mysqli_insert_id($this->conn);
    }
    public function fetchArray($result){
        return mysqli_fetch_array($result);
    }
  
}
$db= new Database();

?>
