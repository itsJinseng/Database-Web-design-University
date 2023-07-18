<?php
require_once "../Model/recipes.php";
require_once "../controller/thebasket.php";
require_once "../Model/dataAccess.php";
require_once ("../Model/order.php");


?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
<title> My basket </title>

</head>


<body>


<table>
      <thead> 
        <tr>
          <th>Recipe name</th>
          <th>Ingredients</th>
          <th>Instructions</th>
          <th>Diet</th>
          <th>Price</th>
        </tr> 

  <?php foreach ($basket as $Recipes): ?>
   <tr>
        <td><?=$Recipes->recipeName?> <?=$Recipes->productID ?> </td>
        <td><?=$Recipes->ingredients?></td>
        <td><?=$Recipes->instructions?></td>
        <td><?=$Recipes->boxTypeID?></td>
        <td>£<?=$Recipes->price?></td>
   </tr> 
   <?php endforeach ?>



   </table> 
      <?php  if ($status): ?>
      <p style="color: green"><?=$status?></p>
    <?php endif  ?> 
<br><br><br>
<h3> Enter your username and password below to order your items</h3>
<h4> Please note that pressing submit below will transmit your order </h4>
<br>
<form action="../controller/thebasket.php" method="POST">

      E Mail: <input name="email"/><br/>
      Password: <input name = "password" type="password"/><br/>
      <input type="submit"/>
    </form>
        <br>
        <br>
        <br>
<a> Dont have an account? <a href = "../controller/addUserController.php"> Sign up here</a>
<p> or </p>
    <a href="../controller/recipelist.php"> Continue Shopping</a>
</body>
</html>
