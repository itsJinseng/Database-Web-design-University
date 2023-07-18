<?php
require_once "../Model/Customers.php";
require_once "../Model/dataAccess.php";
require_once "../controller/thebasket.php";

$status = false;

if(isset($_REQUEST["email"]))
{
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];


  if($password != "" && $email != "")
    {
      $theChecker = new Customers();
      $theChecker->theEmailAddress = htmlentities($email);
      $theChecker->password = htmlentities($password);
     
     

      if(checkUser($theChecker) == false)
      {
        $status = "you dont have an account, please make one";

      }

      else{
          
          
        $status = "items have been added.";
        unset($_SESSION["basket"]);

      }

    }
    require_once ("../view/shoppingBasket_view.php"); 
  }
?>