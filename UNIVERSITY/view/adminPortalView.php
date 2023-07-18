<!doctype html>
<?php require_once("../controller/adminPortalController.php"); ?>
<html>
  <head>
    <title>Add Recipes!</title>
    <link rel="stylesheet" href="../style.css">

  </head>
  <body>
    <?php if ($status): ?>
      <p style="color: green"><?=$status?></p>
    <?php endif ?> 
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <form action="../controller/adminPortalController.php" method="POST">
      Admin Username: <input name = "ADDadminUsername"/><br/>
      Admin Password  <input name = "ADDadminPassword" type="password"/><br/>
      Recipe : <input name="ADDrecipeName"/><br/>
      Ingredients: <input name="ADDIngredients"/><br/>
      Instructions : <input name="ADDInstructions"/><br/>
      Dietary requirements : <input name="ADDdietaryRequirements"/><br/>
      Price: <input name = "ADDPrice"/><br/>
      <input type="submit"/>
    </form>
<br/>
    <a> To update an existing recipe:</a>
    <form action="../controller/adminPortalController.php" method="get">
    Admin Username: <input name = "UPtheAdminUsername"/><br/>
    Admin Password: <input name = "UPtheAdminPassword" type="password"/><br/>
    

    <label for="a">Choose a recipe:</label>
    <select name ="b" id = "b">
    <?php foreach ($results as $Recipes): ?>     
    <option value = <?= $theRecipeName = $Recipes->recipeName?>><?= $theRecipeName = $Recipes->recipeName?></option> 
    <?php endforeach ?> 
    </select> 
    </br>
    
    Ingredients: <input name="UPIngredients"/><br/>
    Instructions : <input name="UPInstructions"/><br/>
    Dietary requirements : <input name="UPdietaryRequirements"/><br/>
    Price: <input name = "UPPrice"/><br/>
    <input type="submit"/>
    </form>

   <br>
   


   <a href="../controller/recipelist.php">Home Page</a>


  </body>
</html>