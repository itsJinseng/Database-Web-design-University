<?php
require_once( "../Model/dataAccess.php");
require_once("../Model/recipes.php");
require_once("../Model/Customers.php");
session_start();

$isUserAdmin = false;
$status = false;

$results = getAllRecipes();

if(isset($_REQUEST["ADDadminUsername"]))
{
  $adminEmail = $_REQUEST["ADDadminUsername"];
  $adminPassword = $_REQUEST["ADDadminPassword"];
  $recipeName = $_REQUEST["ADDrecipeName"];
  $ingredients = $_REQUEST["ADDIngredients"];
  $instructions = $_REQUEST["ADDInstructions"];
  $dietaryRequirements = $_REQUEST["ADDdietaryRequirements"];
  $price = $_REQUEST["ADDPrice"];

  if($adminEmail != "" && $adminPassword != "" && $recipeName != "" && $ingredients != "" && $instructions != "" && $dietaryRequirements != "" && $price != "")
  {
    $theAdmin = new Customers();
    $theAdmin->theEmailAddress = htmlentities($adminEmail);
    $theAdmin->password = htmlentities($adminPassword);

    $inputRecipe = new Recipes();
    $inputRecipe->recipeName = htmlentities($recipeName);
    $inputRecipe->ingredients = htmlentities($ingredients);
    $inputRecipe->instructions = htmlentities($instructions);
    $inputRecipe->boxTypeID = htmlentities($dietaryRequirements);
    $inputRecipe->price = htmlentities($price);

    if(checkAdmin($theAdmin) == true)
    {
      $status = "You are an admin, recipe should of been added";
      addRecipe($inputRecipe);
    }

    else
    {
      $status = "You should not be here";
    }
  }


  
}

if(isset($_REQUEST["UPtheAdminUsername"] ))
{
  $adminEmail = $_REQUEST["UPtheAdminUsername"];
  $adminPassword = $_REQUEST["UPtheAdminPassword"];
  $theRecipeName = $_REQUEST["b"];
  $ingredients = $_REQUEST["UPIngredients"];
  $instructions = $_REQUEST["UPInstructions"];
  $dietaryRequirements = $_REQUEST["UPdietaryRequirements"];
  $price = $_REQUEST["UPPrice"];

  if($adminEmail != "" && $adminPassword != "" && $theRecipeName != "" && $ingredients != "" && $instructions != "" && $dietaryRequirements != "" && $price != "")
  {
    $theAdmin = new Customers();
    $theAdmin->theEmailAddress = htmlentities($adminEmail);
    $theAdmin->password = htmlentities($adminPassword);

    $inputRecipe = new Recipes();
    $inputRecipe->recipeName = htmlentities($theRecipeName);
    $inputRecipe->ingredients = htmlentities($ingredients);
    $inputRecipe->instructions = htmlentities($instructions);
    $inputRecipe->boxTypeID = htmlentities($dietaryRequirements);
    $inputRecipe->price = htmlentities($price);


    if(checkAdmin($theAdmin) == true)
    {
      $status = "You are an admin, recipe should of been updated";
      
      updateRecipe($inputRecipe);
    }

    else
    {
      $status = "You should not be here";
    }
  }

  

  
}


require_once "../view/adminPortalView.php";

?>