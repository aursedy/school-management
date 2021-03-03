<?php 
require_once("classes/DBConnection.php");
require_once("classes/user.php");
$con = new DBConnection();
$jmeno = $prijmeni = $login = $heslo ='';
$errorJmeno = $errorPrijmeni = $errorLogin =$errorHeslo = '';

if(isset($_POST['save'])){

    	if(!empty($_POST['jmeno'])){
    		$jmeno = $_POST['jmeno'];
    	}else{
    		$errorJmeno = "Neplatné Jmeno!";
    	}

    	if(!empty($_POST['prijmeni'])){
    		$prijmeni = $_POST['prijmeni'];
    	}else{
    		$errorPrijmeni = "Neplatné přijmení!";
    	}

    	if(!empty($_POST['login'])){
    		$login = $_POST['login'];
    	}else{
    		$errorLogin= "Neplatný login!";
    	}

    	if(!empty($_POST['heslo'])){
    		$heslo = $_POST['heslo'];
    	}else{
    		$errorHeslo = "Neplatné heslo!";
    	}

    	if($errorJmeno == ''&& $errorPrijmeni== '' && $errorLogin == '' && $errorHeslo == ''){
    	    try{
    		    $stm = $con->getPDO()->prepare("INSERT INTO Uzivatele (Jmeno,Prijmeni,Login,Heslo) VALUES (:Jmeno,:Prijmeni,:Login,:Heslo)");

    		    $stm->bindParam(":Jmeno",$jmeno);
    		    $stm->bindParam(":Prijmeni",$prijmeni);
    		    $stm->bindParam(":Login",$login);
    		    $stm->bindParam(":Heslo",$heslo);

    		    $stm->execute();

    		    header("location: index.php");
    	    }catch(PDOException $e){
    		    echo "New data couldn't be recorded: " . $e->getMessage();
    	    }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Přihlaška</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/tableStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body class="index-body">
<?php require_once("inc/navigationBar.php");?>
<div class="welcome">
	<form action ="prihlaska.php" method="POST" class="register-form" style="width: 300px;margin: auto">

        <label>Jmeno: </label>
	    <input type="input" name="jmeno" placeholder="jmeno" ><br>
	    <?php if ($errorJmeno!=''){echo '<span style="color: red">'.$errorJmeno.'</span><br>';}?>

	    <label>Přijmení: </label>
		<input type="input" name="prijmeni" placeholder="přijmení" ><br>
		<?php if ($errorJmeno!=''){echo '<span style="color: red">'.$errorPrijmeni.'</span><br>';}?>

		<label>Login: </label>
		<input type="input" name="login" placeholder="login"><br>
		<?php if ($errorJmeno!=''){echo '<span style="color: red">'.$errorLogin.'</span><br>';}?>

		<label>Heslo: </label>
		<input type="password" name="heslo" placeholder="heslo"><br>
		<?php if ($errorJmeno!=''){echo '<span style="color: red">'.$errorHeslo.'</span><br>';}?>

		<input style="margin-top: 20px" type="submit" value="Podat přihlašku" name="save">
    </form>
</div>
</header>
</body>
</html>