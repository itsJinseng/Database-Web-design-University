<?php

require_once "../Model/recipes.php";
require_once "../Model/dataAccess.php";
require_once "../controller/recipelist.php";





if(isset($_REQUEST["thumbsUp"]))
{
    
    $thumbedItem = $_REQUEST["thumbsUp"];
    upDoot($thumbedItem);
}
 
else
{

    $thumbedItem = $_REQUEST["thumbsDown"];
    downDoot($thumbedItem);

}

require_once "../view/recipelist_view.php";


?>

