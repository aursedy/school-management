<?php 
session_start();
require_once("DBConnection.php");

class Login 
{
	private $con;

	
	public function __construct()
	{
		$this->con= DBConnection::getPDO();
	}

	public function loginAttempt($user,$password){
		  $errorMsg ='';
    	$select = $this->con->prepare("SELECT * FROM Uzivatele WHERE Login= :Login AND Heslo= :Heslo");
      $select->bindParam(":Login",$user);
      $select->bindParam(":Heslo",$password);
      $select->execute(); 
    	$row = $select->fetch();

    	if($row!=null){
        	$_SESSION['userId'] = $row['Id_uzivatel'];
          $_SESSION['isLogged'] = true;
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
	}
}
?>