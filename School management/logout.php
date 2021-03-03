<?php 
session_start();

   unset($_SESSION["userId"]);
   unset($_SESSION["userFName"]);
   unset($_SESSION["userLName"]);
   unset($_SESSION["userLogin"]);
   unset($_SESSION["userPass"]);
   unset($_SESSION["userRole"]);
   
header('Refresh: 2; URL = login.php');

?>
