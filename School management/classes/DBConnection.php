<?php 
session_start();
define("HOST", "localhost");
define("NAME", "school_db");
define("USER", "root");
define("PASSWORD", "root");

class DBConnection{

    private $conn ;


    public function __construct()
    {
        $this->conn = new PDO("mysql:host=" . HOST . ";dbname=" . NAME . "", USER, PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function login($user, $password){
    	$errorMsg ='';
    	try{
    		$select = $this->conn->query("SELECT * FROM Uzivatele WHERE Login= '$user' AND Heslo= '$password'");
    	    $row = $select->fetch();

    	    if($row){
    	    	$_SESSION['userId'] = $row['Id_uzivatel'];
    	    	$_SESSION['userFName'] = $row['Jmeno'];
    	    	$_SESSION['userLName'] = $row['Prijmeni'];
    	    	$_SESSION['userLogin'] = $row['Login'];
    	    	$_SESSION['userPass'] = $row['Heslo'];
    	    	$_SESSION['userRole'] = $row['Role']; 
    	    	return $errorMsg;
    	    }else{
    	    	$errorMsg = 'Neplatný Email nebo Neplatné Heslo !';
    	    	return $errorMsg;
    	    }
    	    
    	}catch(PDOException $e){
    	} 	

    }

    public function selectUser($id){
    	$result = $this->conn->query("SELECT * FROM Uzivatele WHERE Id_uzivatel = $id");
    	return $result->fetch();
    }

    public function selectAll($table){
    	$result = $this->conn->query("SELECT * FROM $table");
    	return $result->fetchAll();
    }


    public function deleteUserSubjects($id){
        $result = $this->conn->prepare("DELETE FROM Predmety_uzivatele WHERE Id_uzivatel=:Id");
        $result->bindParam(":Id",$id);

        $result->execute();
    }

    public function deleteSubject($id){
    	$result = $this->conn->prepare("DELETE FROM Predmety WHERE Id_predmet=:Id");
    	$result->bindParam(":Id",$id);

    	$result->execute();
    }

    public function deleteClass($id){
    	$result = $this->conn->prepare("DELETE FROM Tridy WHERE Id_trida=:Id");
    	$result->bindParam(":Id",$id);

    	$result->execute();
    }

    public function getPDO(){
    	return $this->conn;
    }

    public function selectClass($id){
    	$result = $this->conn->query("SELECT * FROM Tridy WHERE Id_trida=$id");
    	return $result->fetch();
    }
 
    public function selectSubject($id){
    	$result = $this->conn->query("SELECT * FROM Predmety WHERE Id_predmet=$id");
    	return $result->fetch();
    }

    public function selectStMaterial($id){
        $result = $this->conn->query("SELECT * FROM St_materialy WHERE Id_st_material=$id");
        return $result->fetch();
    }

    public function deleteStMaterial($id){
    	$result = $this->conn->prepare("DELETE FROM St_materialy WHERE Id_st_material=:Id");
    	$result->bindParam(":Id",$id);

    	$result->execute();
    }

    public function addUser($fname,$lname,$login,$pass,$role){
    	$stm = $this->conn->prepare("INSERT INTO Uzivatele (Jmeno,Prijmeni,Login,Heslo,Role) VALUES (:Jmeno,:Prijmeni,:Login,:Heslo,:Role)");

    	$stm->bindParam(":Jmeno",$fname);
    	$stm->bindParam(":Prijmeni",$lname);
   		$stm->bindParam(":Login",$login);
   		$stm->bindParam(":Heslo",$pass);
   		$stm->bindParam(":Role",$role);
     	$stm->execute();
    }

    public function selectSubscription($id){
    	$result = $this->conn->query("SELECT * FROM Prihlasky WHERE Id_prihlaska=$id");
    	return $result->fetch();
    }

    public function selectCategorie($id){
        $result = $this->conn->query("SELECT * FROM Kategorie WHERE Id_kategorie=$id");
    	return $result->fetch();
    }

    public function deleteCategorie($id){
        $result = $this->conn->prepare("DELETE FROM Kategorie WHERE Id_kategorie=:Id");
        $result->bindParam(":Id",$id);

        $result->execute();
    }

    public function deleteWork($id){
        $result = $this->conn->prepare("DELETE FROM Ukoly WHERE Id_ukol=:Id");
        $result->bindParam(":Id",$id);

        $result->execute();
    }

    public function selectWork($id){
        $result = $this->conn->query("SELECT * FROM Ukoly WHERE Id_ukol=$id");
        return $result->fetch();
    }

}
?>