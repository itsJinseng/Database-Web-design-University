<!doctype html>
<?php require_once("../controller/addUserController.php"); ?>
<html>
  <head>
    <title>Add customer</title>
    <link rel="stylesheet" href="../style.css">

  </head>
  <body>
    <?php if ($status): ?>
      <p style="color: green"><?=$status?></p>
    <?php endif ?>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <form action="../controller/addUserController.php" method="POST">
      Givenname: <input name="givenName"/><br/>
      Surname: <input name="surname"/><br/>
      Your Address: <input name="theCustomerAddress"/><br/>
      E Mail: <input name="email"/><br/>
      Password: <input name = "password" type="password"/><br/>
      Phone Number: <input name="phoneNumber"/><br/>
      <input type="submit"/>
    </form>
    <a href="../controller/recipelist.php">Or go back to list</a>

  </body>
</html>