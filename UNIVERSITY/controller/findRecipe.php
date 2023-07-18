<?php
header('Content-Type: application/json');
require_once ("../Model/recipes.php");
require_once ("../Model/dataAccess.php");

if (!isset($_REQUEST["recipe"]))
{
  echo json_encode([]); // send empty array, Paul this is for ajax don't take this away from us 
}
else {
  $findingRecipes = getRecipesByStartOfName($_REQUEST["recipe"]);
  echo json_encode($findingRecipes);
}
?>
