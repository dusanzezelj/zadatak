<?php
require_once 'Database.php';
abstract class User {
    protected $db;
    protected $id, $userName, $password, $email, $phone, $mobile;
    public function __construct($db, $userName, $password, $email, $phone, $mobile) {
        $this->db=$db;
        $this->email=$email;
        $this->mobile=$mobile;
         $this->phone=$phone;
        $this->password=$password;
        $this->userName=$userName;
    }
    public function authenticate($username, $password){
        $query="select * from user where UserName='".$username."' and Password='".sha1($password)."'";
        $num=$this->db->getNumRows($query);
        if($num > 0){
            throw new Exception("Error: User already exists");
        }
    }
        public abstract function create();
        public function delete(){
            $query="update user set Active='-1' where ID='".$this->id."'";
            $result=$this->db->query($query);
            if(!$result){
                return false;
            } 
            return true;
        }           
}

?>
