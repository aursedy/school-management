<?php 
require_once("DBConnection.php");
class Categorie
{
	protected $con;
	protected $popis;
	protected $nazev;
	protected $id;

	public function __construct($id){
	    $this->con = new DBConnection();	
	    $categorie = $this->con->selectCategorie($id);
	    $this->nazev = $categorie['Nazev'];
	    $this->popis = $categorie['Popis'];
	    $this->id = $id;
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

	public function update($nazev,$popis){
		$update = $this->con->getPDO()->prepare("UPDATE Kategorie SET Nazev= :Nazev, Popis= :Popis WHERE Id_kategorie= :Id ");
	    $update->bindParam(":Nazev",$nazev);
	    $update->bindParam(":Popis",$popis);
	    $update->bindParam(":Id",$this->id);	

	    $update->execute();
	}
}
?>