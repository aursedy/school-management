<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/user.php");
$role = 'ucitel';
require_once("crud/CRUD_user.php");
?>

<title>Přidat studenta</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">
    <?php echo $msg?>
	<form action ="teacherAddPage.php" method="POST" class="form" style="margin-top: 30px">
    	<input type="hidden" name="id" value="<?php echo $id?>">
        <label>Jmeno </label><br>
	    <input type="input" name="jmeno" placeholder="jmeno" value="<?php echo $jmeno?>"><br>
        <?php if($errorJmeno!=''){echo '<span style="color: red">'.$errorJmeno.'</span><br>';} ?>

	    <label>Přijmení </label><br>
		<input type="input" name="prijmeni" placeholder="přijmení" value="<?php echo $prijmeni?>"><br>
         <?php if($errorPrijmeni!=''){echo '<span style="color: red">'.$errorPrijmeni.'</span><br>';} ?>

		<label>Login </label><br>
		<input type="input" name="login" placeholder="login" value="<?php echo $login?>"><br>
         <?php if($errorLogin!=''){echo '<span style="color: red">'.$errorLogin.'</span><br>';} ?>

		<label>Heslo </label><br>
		<input type="input" name="heslo" placeholder="heslo" value="<?php echo $heslo?>"><br>
         <?php if($errorHeslo!=''){echo '<span style="color: red">'.$errorHeslo.'</span><br>';} ?>

        <!-- -->
        <?php if ($update==false):?>
		<input type="submit" name="save"  value="save">

		<?php else :?>
	    <input type="submit" name="update" value="Update">
	    <?php endif?>
	    <!-- -->
    </form>
</div>


</body>
</html>