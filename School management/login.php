<?php 
require_once("classes/DBConnection.php");
require_once("classes/login.php");
$errorLogin = $errorHeslo =$errorMsg= '';

if($_SERVER['REQUEST_METHOD']=="POST"){

	if(!empty($_POST['login']) && !empty($_POST['heslo'])){
		$con = new Login();
		$errorMsg = $con->loginAttempt($_POST['login'],$_POST['heslo']);

		if($errorMsg==''){
			if($_SESSION['userRole']=="student"){
				header("location: studentPage/dashboard.php");
			}else if($_SESSION['userRole']=="ucitel"){
				header("location: teacherPage/dashboard.php");
			}else if($_SESSION['userRole']=="Admin"){
				header("location: adminPage/dashboard.php");
			}
		}
	}

	if(empty($_POST['login'])){
        $errorLogin = 'Neplatný login !';
	}

	if(empty($_POST['heslo'])){
		$errorHeslo = 'Neplatný heslo !';	
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Hlávni stránka</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/tableStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body class="index-body">
<?php require_once("inc/navigationBar.php");?>

<form class="login-form" method="POST" action="">
	<?php if($errorMsg!='') { echo '<div class="row">'.$errorMsg.'</div>';}?> 

	<div class="row"><i class="fa fa-user"></i><input type="input" name="login" placeholder="Login"></div>
	<?php if($errorLogin!='') { echo '<div class="row">'.$errorLogin.'</div>';}?> 

	<div class="row"><i class="fa fa-unlock-alt"></i><input type="password" name="heslo" placeholder="Heslo"></div>
	<?php if($errorHeslo!='') { echo '<div class="row">'.$errorHeslo.'</div>';}?> 

	<input type="submit" name="submit" value="přihlásit"><br>
</form>

</header>
</body>
</html>