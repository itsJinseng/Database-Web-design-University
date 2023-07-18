<?php
// M
require_once "../Model/Customers.php";
require_once "../Model/recipes.php";
require_once "../Model/dataAccess.php";
require_once "../Model/order.php";

session_start();

$status = false;

if (!isset($_SESSION["basket"]))
{
    $_SESSION["basket"] = []; 
}

$basket = $_SESSION["basket"]; 
$ordersArray = "";

foreach ($basket as $recipe)
{
  $ordersArray = $ordersArray.$recipe->productID.",";
}
$ordersArray = rtrim($ordersArray,',');

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
      addOrder($theCustomer, $ordersArray);
      $status = "You have ordered your items successfully";
    }

    else{
      $status =  "Login details incorrect please try again";
      
    }

  }
}
//V
require_once ("../view/shoppingBasket_view.php"); 








?>