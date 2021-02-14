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

/*public function __construct(){
	$this->con = new DBConnection();
	$this->subjects = array();
	$this->id = 0;
	$this->fname='';
	$this->lname='';
	$this->login='';
	$this->heslo='';
	$this->role='';
}*/

public function __construct($id){
	$this->con = new DBConnection();
	$this->subjects = array();
	$this->id = $id;
	$user =$this->con->selectUser($id);
	$this->fname=$user['Jmeno'];
	$this->lname=$user['Prijmeni'];
	$this->login=$user['Login'];
	$this->heslo=$user['Heslo'];
	$this->role=$user['Role'];
}

public function update($fname,$lname,$login,$heslo){

	$update = $this->con->getPDO()->prepare("UPDATE Uzivatele SET Jmeno= :Jmeno, Prijmeni= :Prijmeni, Login= :Login, Heslo= :Heslo WHERE Id_uzivatel= :Id ");
	$update->bindParam(":Jmeno",$fname);
	$update->bindParam(":Prijmeni",$lname);
	$update->bindParam(":Login",$login);
	$update->bindParam(":Heslo",$heslo);
	$update->bindParam(":Id",$this->id);	

	$update->execute();

}


public function getId(){
	return $this->id;
}

public function getFname(){
	return $this->fname;
}

public function getLname(){
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

public function addSubject($idSubject){
	try {
		$add = $this->con->prepare("INSERT INTO Predmety_uzivatele (Id_uzivatel,Id_predmet) VALUES (:Id_uzivatel,:Id_predmet)");
	    $add->bindParam(":Id_uzivatel",$this->id);
	    $add->bindParam(":Id_predmet",$idSubject);

	    $add->execute();
	} catch (PDOException $e) {
		echo'ERROR ADD USER SUBJECT '.$e->getMessage();
	}	
}

public function deleteUser($id){
    	$result = $this->conn->prepare("DELETE FROM Uzivatele WHERE Id_uzivatel=:Id");
    	$result->bindParam(":Id",$id);

    	$result->execute();
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


}
?>