<?php
$update = false;
$con = new DBConnection();
$jmeno = $prijmeni = $login = $heslo =$errorJmeno = $errorPrijmeni = $errorLogin = $errorHeslo ='';
$id= 0;

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

    if($errorJmeno ==''&& $errorPrijmeni ==''&& $errorLogin ==''&& $errorHeslo ==''){
        try{
        $stm = $con->getPDO()->prepare("INSERT INTO Uzivatele (Jmeno,Prijmeni,Login,Heslo,Role) VALUES (:Jmeno,:Prijmeni,:Login,:Heslo,:Role)");

        $stm->bindParam(":Jmeno",$jmeno);
        $stm->bindParam(":Prijmeni",$prijmeni);
        $stm->bindParam(":Login",$login);
        $stm->bindParam(":Heslo",$heslo);
        $stm->bindParam(":Role",$role);

        $stm->execute();

        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }
}

if(isset($_GET['delete'])){
	$con->deleteUser($_GET['delete']);
    $con->deleteUserSubjects($_GET['delete']);
}

if(isset($_GET['edit'])){
	$user = new User($_GET['edit']);
	$id=$_GET['edit'];
	$jmeno = $user->getFName();
	$prijmeni = $user->getLName();
	$heslo = $user->getPassword();
	$login = $user->getLogin();
	$update=true;
}

if(isset($_POST['update'])){

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

    if($errorJmeno==''&&$errorPrijmeni==''&&$errorLogin==''&&$errorHeslo==''){ 
        try{
        $user = new User($_POST['id']);
        $user->update($_POST['jmeno'],$_POST['prijmeni'],$_POST['login'],$_POST['heslo']);

        $jmeno = $prijmeni = $login = $heslo ='';

        $id= 0;
        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }
    	
}
?>