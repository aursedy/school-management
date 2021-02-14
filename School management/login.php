<?php 
require_once("inc/header.php");
require_once("classes/DBConnection.php");
$errorLogin = $errorHeslo =$errorMsg= '';

if($_SERVER['REQUEST_METHOD']=="POST"){

	if(!empty($_POST['login']) && !empty($_POST['heslo'])){
		$con = new DBConnection();
		$errorMsg = $con->login($_POST['login'],$_POST['heslo']);

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
<title>Hlávni stránka</title>
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