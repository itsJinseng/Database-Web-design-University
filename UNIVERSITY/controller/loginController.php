<?php
require_once "../Model/Customers.php";
require_once "../Model/dataAccess.php";
session_start();

$status = false;

if(isset($_REQUEST["email"]))
{
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];

  if($password != "" && $email != "")
  {
    $theCustomer = new Customers();
    $theCustomer->theCustomerID = "";
    $theCustomer->theEmailAddress = htmlentities($email);
    $theCustomer->password = htmlentities($password);
    
    if(checkUserExits($theCustomer) == false)
    {
      $_SESSION["theAccUser"] = showLoginPage($theCustomer);
      $status = "You have now logged in, continue browsing the website";
    }

    else{
        $status  = "You do not have an account registered, please register an account in the sign up page";
    }
  }
}
require_once "../view/loginView.php";
?>