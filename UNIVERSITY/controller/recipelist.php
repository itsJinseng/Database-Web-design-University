<?php


require_once "../Model/recipes.php";
require_once "../Model/Customers.php";
require_once "../Model/dataAccess.php";
require_once "../Model/order.php";
session_start();



if(isset($_REQUEST["thumbsUp"]))
{
  
    $thumbedItem = $_REQUEST["thumbsUp"];
    upDoot($thumbedItem);
}
 
if (isset($_REQUEST["thumbsDown"]))
{
    

    $thumbedItem = $_REQUEST["thumbsDown"];
    downDoot($thumbedItem);

}


if (!isset($_SESSION["theAccUser"]))
{
    $_SESSION["theAccUser"] = []; 
}

$theAccUser = $_SESSION["theAccUser"]; 



if (isset($_REQUEST["inputRecipe"]) && $_REQUEST["inputRecipe"] != "")
{

    $results = getRecipesBySearch($_REQUEST["inputRecipe"]); 
}
else
{
    $results = getAllRecipes();

}
///////////////////////////////////////////////////////////////////////////////
if (isset($_REQUEST["theRatingTop"]))
{

    $results = getRecipesByRating(); 
}

else if (isset($_REQUEST["theRatingDown"]))
{
    $results = getRecipesByRatingDesc();
}

else{

}
/////////////////////////////////////////////////////////////////////////////
if (!isset($_SESSION["basket"]))
{
    $_SESSION["basket"] = [];
    $_SESSION["orders"] = [];                          
}

$basket = $_SESSION["basket"];


if(isset($_REQUEST["add"]))
{
    
    
    $addedItem = $_REQUEST["add"];
    $addedShoppingBasket = getItemsInBasket($addedItem);
    $basket[] = $addedShoppingBasket;
    $_SESSION["basket"] = $basket;
}




    require_once "../view/recipelist_view.php";

?>