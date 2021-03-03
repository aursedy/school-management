<?php
$update = false;
$con = DBConnection::getPDO();
$jmeno = $prijmeni = $login = $heslo =$errorJmeno = $errorPrijmeni = $errorLogin = $errorHeslo = $msg='';
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
            User::addUser($jmeno,$prijmeni,$login,$heslo,$role);
            $jmeno = $prijmeni = $login = $heslo ='';
            $id= 0;
            $msg = '<div class="alert-ok">Přidání uživatele proběhlo v poradku!</div>';

        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }
}

if(isset($_GET['delete'])){
	$user = new User($_GET['delete']);
    $user->deleteUser();
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
            $msg = '<div class="alert-update">Editace uživatele proběhlo v poradku!</div>';
            
            if($user->getRole()=='student'){
                header("location: studentList.php");
            }else if($user->getRole()=='ucitel'){
                header("location: teacherList.php");
            }
            
        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }
    	
}
?>