<?php 
require_once("DBConnection.php");
class User{

protected $con;
protected $subjects;
protected $id;
private $fname;
private $lname;
private $login;
private $heslo;
private $role;

public function __construct($id){
	$this->con = DBConnection::getPDO();
	//$this->subjects = array();
	$row = $this->con->prepare("SELECT * FROM Uzivatele WHERE Id_uzivatel= :Id_uzivatel");
	$row->bindParam(":Id_uzivatel",$id);
    $row->execute();
    $user = $row->fetch();

    if($user!=null){
    	$this->id = $id;
    	$this->fname = $user['Jmeno'];
    	$this->lname = $user['Prijmeni'];
    	$this->login = $user['Login'];
    	$this->heslo = $user['Heslo'];
    	$this->role = $user['Role'];
    }
}

public function update($fname,$lname,$login,$heslo){

	$update = $this->con->prepare("UPDATE Uzivatele SET Jmeno= :Jmeno, Prijmeni= :Prijmeni, Login= :Login, Heslo= :Heslo WHERE Id_uzivatel= :Id ");
	$update->bindParam(":Jmeno",$fname);
	$update->bindParam(":Prijmeni",$lname);
	$update->bindParam(":Login",$login);
	$update->bindParam(":Heslo",$heslo);
	$update->bindParam(":Id",$this->id);	

	$update->execute();

}

public static function addUser($fname,$lname,$login,$heslo,$role){
	$conn = DBConnection::getPDO();
	$insert = $conn->prepare("INSERT INTO Uzivatele (Jmeno,Prijmeni,Login,Heslo,Role) VALUES (:Jmeno,:Prijmeni,:Login,:Heslo,:Role)");
	$insert->bindParam(":Jmeno",$fname);
	$insert->bindParam(":Prijmeni",$lname);
	$insert->bindParam(":Login",$login);
	$insert->bindParam(":Heslo",$heslo);
	$insert->bindParam(":Role",$role);

	$insert->execute();
}

public static function getAllUsers(){
	$conn = DBConnection::getPDO();
	$users = $conn->query("SELECT * FROM Uzivatele");
	return $users->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteUser(){
    $result = $this->con->prepare("DELETE FROM Uzivatele WHERE Id_uzivatel=:Id");
   	$result->bindParam(":Id",$this->id);
   	$result->execute();

   	$result = $this->con->prepare("DELETE FROM Predmety_uzivatele WHERE Id_uzivatel=:Id");
   	$result->bindParam(":Id",$this->id);
   	$result->execute();
}


public function addSubject($idSubject){
	$add = $this->con->prepare("INSERT INTO Predmety_uzivatele (Id_uzivatel,Id_predmet) VALUES (:Id_uzivatel,:Id_predmet)");
	$add->bindParam(":Id_uzivatel",$this->id);
    $add->bindParam(":Id_predmet",$idSubject);
    $add->execute();
}

public function hasSubject(){
	$select = $this->con->getPDO()->query("SELECT * FROM Predmety WHERE Id_uzivatel=$this->id");
	$result = $select->fetch();

	if($result==null){
		return false;
	}else{
		return true;
	} 
}

public function getFName(){
	return $this->fname;
}

public function getLName(){
	return $this->lname;
}

public function getLogin(){
	return $this->login;
}

public function getPassword(){
	return $this->heslo;
}

public function getRole(){
	return $this->role;
}

public function getId(){
	return $this->id;
}

}
?>