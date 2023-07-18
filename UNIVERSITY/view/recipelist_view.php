<?php
//session_start();
require_once "../Model/recipes.php";
require_once "../Model/Customers.php";
require_once "../Model/dataAccess.php";
//require_once "../controller/whoHasLogin.php";
//require_once "../controller/thebasket.php";
//require_once "../controller/recipelist.php";
?>

<!doctype html>
<html>
<head>
<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="clientSearch.js"></script>
      <link rel="stylesheet" href="../style.css">
      <title>Recipes</title>
</head>
<body>

    <div id="navbar">    
    <h1> <a href="https://kunet.uk/teal/UNIVERSITY/controller/recipelist.php">Recipes for disaster</a></h1>
    <a href="https://kunet.uk/teal/UNIVERSITY/view/loginView.php">Login here</a>


    
  

      <div id="niceajaxsearch">
      <form method = "post" action = "recipelist.php">
      What are you looking for?:  
    <input name="inputRecipe" input type="text" placeholder="Search by Recipe Name, Ingredients or Dietary Requirements"  name="ajaxsearchRecipe"/> <input id="ajaxsearchbutton" type="submit" value="Search" input type="submit" />
    <div class="results">
        <div class="result"></div>
      </div>
    </div>


    <form method = "post" action = "../controller/recipelist.php">
    <p>Sort by rating: </p>

    <input type="radio" id="theRatingTop" name = "theRatingTop">
      <label for="theRatingTop">Highest to Lowest</label>

      <input type="radio" id="theRatingDown" name="theRatingDown">
  <label for="theRatingDown">Lowest to Highest</label>
      <input type="submit" value="Submit">
    </form>
    <br/>

    

 <!--    <div id="niceajaxsearch">
      <input type="text" placeholder="Search"/>
      <div class="results">
        <div class="result">data</div>
      </div>
    </div> -->


    <?//php getUserDetails($theCustomer)?>
    <?php foreach ( $theAccUser as $Customers): ?>
        <tr>
            <td> Welcome!  <?=$Customers->givenName?></td>
            <td> <?=$Customers->surname?></td>

           <!-- this actually gives you the who is login deets. gives surname, lastname using 
           sessions like a basket and places it into a varuiable of $xyz and then diplays it like
            a basket would on the home screen -->

         
        </tr>
      <?php endforeach?> 



 
    <h2>View our recently added Recipes!</h2>
    </div>

    <table>
      <thead>
        <tr>
          <th>Recipe name</th>
          <th>Ingredients</th>
          <th>Instructions</th>
          <th>Diet</th>
          <th>Price</th>
          <th>Add to basket</th>
          <th>What do you rate?</th>
          <th>Ratings</th>


        </tr>

  <?php foreach (array_reverse($results) as $Recipes): ?>
   <tr>
        <td><?=$Recipes->recipeName?></td>
        <td><?=$Recipes->ingredients?></td>
        <td><?=$Recipes->instructions?></td>
        <td><?=$Recipes->boxTypeID?></td>
        <td>£<?=$Recipes->price?></td>
        <td><a href="recipelist.php?add=<?= $Recipes->productID ?>"><img src="../img/add-to-basket.png" alt="basket icon" style="width:42px;height:42px;">
</a></td>
        <td><a href="https://kunet.uk/teal/UNIVERSITY/controller/recipelist.php?thumbsUp=<?= $Recipes->productID ?>">
          <img src="../img/like.png" alt="Rating Thumbs Up" style="width:42px;height:42px;">
        </a>
            <a href="https://kunet.uk/teal/UNIVERSITY/controller/recipelist.php?thumbsDown=<?= $Recipes->productID ?>">
            <img src="../img/dislike.png" alt="Rating Thumbs Down" style="width:42px;height:42px;">
</a>
</td>
            <td><?=$Recipes->Rating?></td>

   </tr> 
   <?php endforeach ?>
   </table>
 <!--
   <table>
      <tbody>
        <?php foreach ($basket as $Recipes): ?>
        <tr>
            <td><?=$Recipes->recipeName?></td>
            <td><?=$Recipes->ingredients?></td>
            <td><?=$Recipes->instructions?></td>
            <td><?=$Recipes->boxTypeID?></td>
            <td><?=$Recipes->price?></td>
        </tr>
      <?php endforeach?> 
  -->
    </table> 
  
   <div id="footer">
   <a><?= count($basket) ?>  Items added to <a href="../view/shoppingBasket_view.php"> <img src="../img/shopping-bag.png" alt="basket icon" style="width:42px;height:42px;"></a> 
   <a href="https://kunet.uk/teal/UNIVERSITY/controller/adminPortalController.php"><img src="../img/portal.png" alt="Admin Portal icon" style="width:42px;height:42px;"></a>
   </div>
</body>
</html>