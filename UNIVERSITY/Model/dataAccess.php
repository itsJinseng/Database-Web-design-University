<?php
//setting up the pdo 
$pdo = new PDO("mysql:host=localhost;dbname=db_teal",
               "teal",
               "ookongup",
               [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
               
//getting call recipes from the recipes database 
function getAllRecipes()
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM Recipes");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS,"Recipes");
    return $results;
}

//getting the recipes via order . for the notification at the bottom of page
function getRecipesByAsc()
{
global $pdo;
$statement = $pdo->prepare("SELECT * FROM Recipes ORDER BY productID ");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_CLASS,"Recipes");
return $results;

}

function getRecipesByRating()
{
  global $pdo;
  $statement = $pdo->prepare("SELECT * FROM Recipes ORDER BY Rating ASC");
  $statement->execute([]);
  $results = $statement->fetchAll(PDO::FETCH_CLASS, "Recipes");
  return $results;
}
function getRecipesByRatingDesc()
{
  global $pdo;
  $statement = $pdo->prepare("SELECT * FROM Recipes ORDER BY Rating Desc");
  $statement->execute([]);
  $results = $statement->fetchAll(PDO::FETCH_CLASS, "Recipes");
  return $results;
}





//getting all recipes from recipes table by ID
/* function getRecipesByID($productID)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM Recipes WHERE productID = ?");
    $statement->execute([$productID]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS,"Recipes");
    return $results;
} */
//////////////////////////////////////////////////////////////
function getRecipesBySearch($productID)
{

    global $pdo;
    $likeVar = "'%".$productID."%'";
    $statement = $pdo->prepare("SELECT * FROM Recipes WHERE recipeName LIKE $likeVar OR ingredients LIKE $likeVar OR boxTypeID LIKE $likeVar ");
/*     $statement = bind_param("s", $likeVar);
 */     $statement->execute([$likeVar]); 
   /*  $statement->execute(); */
    $results = $statement->fetchAll(PDO::FETCH_CLASS,"Recipes");
    return $results;
}





/////////////////////////////////////////////////////////////
//getting all recipes from recipes table by name 
function getRecipesByRecipeName($recipeName)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT * FROM Recipes WHERE recipeName = ?");
  $statement->execute([$recipeName]);
  $results = $statement->fetchAll(PDO::FETCH_CLASS, "Recipes");
  return $results;
}

//adding customers to customer table 
function addCustomer($theCustomer)
{
  global $pdo;
  $statement = $pdo->prepare("INSERT INTO Customers (givenName, surname, customerAddress,theEmailAddress, password, phoneNumber) VALUES (?,?,?,?,?,?)");
  $statement->execute([
                       $theCustomer->givenName, 
                       $theCustomer->surname, 
                       $theCustomer->theCustomerAddress,
                       $theCustomer->theEmailAddress,
                       $theCustomer->password, 
                       $theCustomer->phoneNumber]);
}

//Selects Product ID entered with Recipes ID, returns recipe with same ID
function getItemsInBasket($productID)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT productID, recipeName, ingredients, instructions, boxTypeID, price FROM Recipes WHERE productID = ?");
  $statement->execute([$productID]);
  $results = $statement->fetchAll(PDO::FETCH_CLASS, "Recipes");
  return $results[0];
}


//check function data access
//to see if the user already exits called by addUserController
//if return is true then don't add that user
// else continue with add user 

function checkUserExits($theCustomer)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT givenName, surname, customerAddress,theEmailAddress, password, phoneNumber FROM Customers WHERE theEmailAddress = ? AND password = ?");
  $statement->execute([$theCustomer->theEmailAddress,
                       $theCustomer->password]);

  $results = $statement->fetchAll(PDO::FETCH_CLASS, "Customers");
  return count($results) == 0; //Will return true if there is not a user
}

function checkUser($theChecker)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT givenName, surname, customerAddress,theEmailAddress, password, phoneNumber FROM Customers WHERE theEmailAddress = ? AND password = ?");
  $statement->execute([$theChecker->theEmailAddress,
                       $theChecker->password]);
  $results = $statement->fetchAll(PDO::FETCH_CLASS, "Customers");
  return count($results) == 1; //Will return true if there is a user
}
/*Get e mail user inputted
Find the e mail in database table 
Return the givenName and surname that has that email
*/
function showLoginPage($theCustomer)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT givenName, surname FROM Customers WHERE theEmailAddress = ?"); 
  $statement->execute([$theCustomer->theEmailAddress]);
  $logDetails = $statement->fetchAll(PDO::FETCH_CLASS, "Customers");
  return $logDetails;
}

function checkAdmin($admin)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT givenName, surname, adminPowers FROM Customers WHERE theEmailAddress = ? AND password = ? and adminPowers = ?");
  $statement->execute([$admin->theEmailAddress,
                       $admin->password,
                      '1']); //1 - is a identifier for admins, 0 is customers, 1 is admin 
  $results = $statement->fetchAll(PDO::FETCH_CLASS, "Customers");
  return count($results) == 1; //Will return true if there is a user
}

//In development  
function addOrder($theCustomer, $ordersArray)
{
  global $pdo;
  $statement = $pdo->prepare("INSERT INTO Orders (customer_email, recipe_id) VALUES (?,?)");
  $statement->execute([
                       $theCustomer->theEmailAddress, 
                       $ordersArray]);
}

function login($customerDetails)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT givenName, surname FROM Customers WHERE theEmailAddress = ? AND password = ?");
  $statement->execute([$customerDetails->theEmailAddress,
                       $customerDetails->password]);
  $loginDetails = $statement->fetchAll(PDO::FETCH_CLASS, "Customers");
  return $loginDetails;
}

function addRecipe($recipe)
{
  global $pdo;
  $statement = $pdo->prepare("INSERT INTO Recipes (recipeName, ingredients, instructions, boxTypeID, price) VALUES(?,?,?,?,?)");
  $statement->execute([$recipe->recipeName,
                       $recipe->ingredients,
                       $recipe->instructions,
                       $recipe->boxTypeID,
                       $recipe->price]);
}

 function updateRecipe($recipe)
{
  global $pdo;
 

  $statement = $pdo->prepare("UPDATE Recipes SET ingredients = ?, instructions = ?, boxTypeID = ?, price = ?  WHERE recipeName = ?");
  $statement->execute([
                       $recipe->ingredients,
                       $recipe->instructions,
                       $recipe->boxTypeID,
                       $recipe->price,
                       $recipe->recipeName]);
} 

/////////////////////////////////////Adding rating here ///////////////////////////////////////////

function getRating($thumbedItem)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT Rating FROM Recipes WHERE productID = ? ");
  $statement->execute([$thumbedItem]);
  $theDetails = $statement->fetchAll(PDO::FETCH_CLASS, "Recipes");
  return $theDetails;
} 



function upDoot($thumbedItem)
{
  global $pdo;
  $statement = $pdo->prepare("UPDATE Recipes SET Rating = Rating + 1 WHERE productID = ? ");
  $statement->execute([$thumbedItem]);
  return;
  
  
                       
} 
function downDoot($thumbedItem)
{
  global $pdo;
  $statement = $pdo->prepare("UPDATE Recipes SET Rating = Rating - 1 WHERE productID = ? ");
  $statement->execute([$thumbedItem]);
                       
} 
///////////////////////////////////////////////////////////////////////////////////////////////////





function getRecipesByStartOfName($partialRecipe)
{
  global $pdo;
  $statement = $pdo->prepare('SELECT DISTINCT recipeName FROM Recipes
                              WHERE recipeName like ?');
  $statement->execute(["%$partialRecipe%"]);
  // no point doing a fetch_class - we're only going to be returning surnames
  // FETCH_COLUMN does precisely what you'd expect - brings back a single column
  // in this case, we'll get an array of all the surnames.
  // ********* This non FETCH_CLASS use of PDO is considered acceptable! *********
  $theseRecipes = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
  return $theseRecipes;
}

/*
function pullFromBasket($order)
{
  global $pdo;
  $statement = $pdo->prepare("SELECT productID, recipeName, price FROM Recipes")
  //$statement->execute($order);
}
*/
?>