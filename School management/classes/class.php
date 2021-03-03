<?php 
require_once("DBConnection.php");

class Trida {
	protected $con;
	protected $id;
	private $nazev;
	private $kapacita;
	
	public function __construct($id){
		$this->con = DBConnection::getPDO();
	    //$this->subjects = array();
	    $row = $this->con->prepare("SELECT * FROM Tridy WHERE Id_trida = :Id_trida");
	    $row->bindParam(":Id_trida",$id);
	    $row->execute();
        $class = $row->fetch();
        if($class!=null){
    	    $this->id = $id;
    	    $this->nazev = $class['Nazev'];
    	    $this->kapacita = $class['Kapacita'];
        }
	}

	public function update($nazev,$kapacita){
	    $update = $this->con->prepare("UPDATE Tridy SET Nazev= :Nazev, Kapacita= :Kapacita WHERE Id_trida= :Id ");
	    $update->bindParam(":Nazev",$nazev);
	    $update->bindParam(":Kapacita",$kapacita);
	    $update->bindParam(":Id",$this->id);	

	    $update->execute();
    }

    public function delete(){
	    $result = $this->con->prepare("DELETE FROM Tridy WHERE Id_trida=:Id");
    	$result->bindParam(":Id",$this->id);

    	$result->execute();
    }

    public static function addClass($nazev,$kapacita){
    	$conn = DBConnection::getPDO();
	    $update = $conn->prepare("INSERT INTO Tridy (Nazev,Kapacita) VALUES (:Nazev,:Kapacita)");
	    $update->bindParam(":Nazev",$nazev);
	    $update->bindParam(":Kapacita",$kapacita);

	    $update->execute();
    }

    public function getKapacita(){
    	return $this->kapacita;
    }

    public function getNazev(){
    	return $this->nazev;
    }
}
?>