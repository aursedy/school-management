<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/user.php");
require_once("../controller/profile_controller.php");
?>

<title>Udaje</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>
<div class="container">
        <?php echo $msg ?>
	<form method="POST" acion="profile.php" style="margin-top: 30px;">
		<input type="hidden" name="id" value="<?php echo $id?>">
        <label>Jmeno </label><br>
        <input type="input" name="jmeno" placeholder="jmeno" value="<?php echo $_SESSION['userFName']?>"><br>

        <label>Přijmení </label><br>
        <input type="input" name="prijmeni" placeholder="přijmení" value="<?php echo $_SESSION['userLName']?>"><br>

        <label>Login </label><br>
        <input type="input" name="login" placeholder="login" value="<?php echo $_SESSION['userLogin']?>"><br>

        <label>Heslo </label><br>
        <input type="input" name="heslo" placeholder="heslo" value="<?php echo $_SESSION['userPass']?>" ><br>

        <input type="submit" name="update" value="Update">
 
	</form>
</div>

</body>
</html>