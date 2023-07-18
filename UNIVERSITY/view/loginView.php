<?php
require_once "../Model/Customers.php";
require_once "../controller/loginController.php";
?>

<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../style.css">

    </head>
<body>

<?php if ($status): ?>
    <p style="color:green"><?=$status?></p>
<?php endif ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
Login here:
<form method = "post" action = "../controller/loginController.php">
    Email:
    <input name = "email" type="email"/>
    <br>
    Password:
    <input name = "password" type="password"/>
    <input type = "submit"/>
</form>
<br>
<a> Dont have an account? <a href = "../controller/addUserController.php"> Sign up here</a>
<p> or </p>
<a href = "../controller/recipelist.php"> Go back to Home Page</a>

</body>
</html>

