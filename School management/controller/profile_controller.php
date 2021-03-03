<?php 

$jmeno = $prijmeni = $login = $heslo = $errorJmeno= $errorPrijmeni = $errorLogin=$errorHeslo =$msg = '';

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
			$msg = '<div class="alert-update"> Editace udaje proběhlo v pořádku</div>';

		} catch (PDOException $e) {
			echo 'Error update user :'.$e->getMessage();
		}
	}
}

?>