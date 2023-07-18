<?php

class Customers
{
    private $theCustomerID;
    private $givenName;
    private $surname;
    private $theCustomerAddress;
    private $theEmailAddress;
    private $password;
    private $phoneNumber;

    function __get($name) {
        return $this->$name;
      }
    
    function __set($name,$value) {
       $this->$name = $value;
    }



    


    

    

}

?>