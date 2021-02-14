<?php 
require_once("../classes/DBConnection.php");
require_once("../classes/user.php");
$con = new DBConnection();

$jmeno = $prijmeni = $login = $heslo = $errorJmeno= $errorPrijmeni = $errorLogin=$errorHeslo ='';

if($_SERVER['REQUEST_METHOD']=="POST"){
	if(!empty($_POST['jmeno'])){
		$jmeno = $_POST['jmeno'];
	}else{
		$errorJmeno = "Neplatné jmeno !";
	}

	if(!empty($_POST['prijmeni'])){
		$prijmeni = $_POST['prijmeni'];
	}else{
		$errorPrijmeni = "Neplatné přijmení !";
	}

	if(!empty($_POST['login'])){
		$login = $_POST['login'];
	}else{
		$errorLogin = "Neplatný login !";
	}

	if(!empty($_POST['heslo'])){
		$heslo = $_POST['heslo'];
	}else{
		$errorHeslo= "Neplatné heslo !";
	}

	if($errorJmeno == ''&& $errorPrijmeni== '' && $errorLogin == '' && $errorHeslo == ''){
		try {
			$_SESSION['userFName'] = $jmeno;
			$_SESSION['userLName'] = $prijmeni;
			$_SESSION['userLogin'] = $login;
			$_SESSION['userPass'] = $heslo;

			$user = new User($_SESSION['userId']);
			$user->update($jmeno,$prijmeni,$login,$heslo);
			
		} catch (PDOException $e) {
			echo 'Error update user :'.$e->getMessage();
		}
	}

}

?>
<!DOCTYPE hmtl>
<html>
<head>
<title>Udaje</title>
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>
<div class="container">
	<form method="POST" acion="profile.php" style="margin-top: 30px;">
		<input type="hidden" name="id" value="<?php echo $id?>">
        <label>Jmeno: </label>
        <input type="input" name="jmeno" placeholder="jmeno" value="<?php echo $_SESSION['userFName']?>"><br>

        <label>Přijmení: </label>
        <input type="input" name="prijmeni" placeholder="přijmení" value="<?php echo $_SESSION['userLName']?>"><br>

        <label>Login: </label>
        <input type="input" name="login" placeholder="login" value="<?php echo $_SESSION['userLogin']?>"><br>

        <label>Heslo: </label>
        <input type="input" name="heslo" placeholder="heslo" value="<?php echo $_SESSION['userPass']?>" ><br>

        <input type="submit" name="update" value="Update">
 
	</form>
</div>

</body>
</html>