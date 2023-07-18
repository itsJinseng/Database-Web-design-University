<?php
  session_start();
  require_once ("../Model/Customers.php");
  require_once ("../Model/dataAccess.php");

  $status = false;

//User enter their details 

  if(isset($_REQUEST["givenName"]))
  {
    $givenName = $_REQUEST["givenName"];
    $surname = $_REQUEST["surname"];
    $password = $_REQUEST["password"];
    $email = $_REQUEST["email"];
    $customerAddress = $_REQUEST["theCustomerAddress"];
    $phoneNumber = $_REQUEST["phoneNumber"];

    if($givenName != "" && $surname != "" && $password != "" && $email != "" && $customerAddress != "" && $phoneNumber != "")
    {
      $theCustomer = new Customers();
      $theCustomer->theCustomerID = "";
      $theCustomer->givenName = htmlentities($givenName);
      $theCustomer->surname = htmlentities($surname);
      $theCustomer->theCustomerAddress = htmlentities($customerAddress);
      $theCustomer->theEmailAddress = htmlentities($email);
      $theCustomer->password = htmlentities($password);
      $theCustomer->phoneNumber = htmlentities($phoneNumber);
      

      if(checkUserExits($theCustomer) == false)
      {
        //print_r("User already exists");
      }

      else{
        addCustomer($theCustomer);
        $_SESSION["theAccUser"] = showLoginPage($theCustomer);
        $status = "$givenName has been added.";
      }
    }
   } 
   require_once ("../view/addUserView.php"); 
?>