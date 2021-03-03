<?php 
require_once("DBConnection.php");
class Categorie
{
	protected $con;
	protected $popis;
	protected $nazev;
	protected $id;

	public function __construct($id){
	    $this->con = DBConnection::getPDO();
	    $result = $this->con->prepare("SELECT * FROM Kategorie WHERE Id_kategorie= :Id_kategorie");
	    $result->bindParam(":Id_kategorie",$id);
	    $result->execute();
    	$category=  $result->fetch();

    	if($category!=null){
    		$this->nazev = $category['Nazev'];
	        $this->popis = $category['Popis'];
	        $this->id = $id;
    	}
	}

	public static function addCategory($nazev,$popis){
		$conn = DBConnection::getPDO();
		$stm = $conn->prepare("INSERT INTO Kategorie (Nazev,Popis) VALUES (:Nazev,:Popis)");
        $stm->bindParam(":Nazev",$nazev);
        $stm->bindParam(":Popis",$popis);

        $stm->execute();
	}

	
	public function update($nazev,$popis){
		$update = $this->con->prepare("UPDATE Kategorie SET Nazev= :Nazev, Popis= :Popis WHERE Id_kategorie= :Id");
	    $update->bindParam(":Nazev",$nazev);
	    $update->bindParam(":Popis",$popis);
	    $update->bindParam(":Id",$this->id);	

	    $update->execute();
	}

	public function delete(){
        $result = $this->con->prepare("DELETE FROM Kategorie WHERE Id_kategorie=:Id");
        $result->bindParam(":Id",$this->id);

        $result->execute();
    }

    public function getId(){
		return $this->$id;
	}

	public function getNazev(){
		return $this->nazev;
	}

	public function getPopis(){
		return $this->popis;
	}

}
?>