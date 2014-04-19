<?php
require_once 'User.php';

class NaturalUser extends User{
   private $firstName, $lastName, $address, $city, $country;
   public function __construct($db, $userName, $password, $email, $phone, $mobile, $firstName, $lastName, $address, $city, $country) {
       parent::__construct($db, $userName, $password, $email, $phone, $mobile);
       $this->firstName=$firstName;
       $this->lastName=$lastName;
       $this->address=$address;
       $this->city=$city;
       $this->country=$country;
   }
   public function create() {
       $query="insert into user(FirstName, LastName, UserName, Password, Email, Phone, Mobile, Address, City, Country, Active, UserType)";
       $query.=" values ('$this->firstName', '$this->lastName', '$this->userName', '$this->password', '$this->email', '$this->phone', ";
       $query.="'$this->mobile', '$this->address', '$this->city', '$this->country', 1, 1)";
       $result= $this->db->query($query);
       if(!$result){
           throw new Exception("Error in executing query!");
       }
       return $this->db->getLastInsertID();
   }
   
}

?>
