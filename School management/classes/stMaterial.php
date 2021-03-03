<?php 
require_once("DBConnection.php");

class StMaterial{
	protected $con;
	private $nazev;
	private $velikost;
	private $extension;
	private $id_predmet;
	private $id_kategorie;


	public function __construct($id){
		$this->con = DBConnection::getPDO();
	    $row = $this->con->prepare("SELECT * FROM St_materialy WHERE Id_st_material= :Id_st_material");
	    $row->bindParam(":Id_st_material",$id);
	    $row->execute();
        $material = $row->fetch();
        if($material!=null){
    	    $this->id = $id;
    	    $this->nazev = $material['Nazev'];
    	    $this->velikost = $material['Velikost'];
    	    $this->extension = $material['Extension'];
    	    $this->id_predmet = $material['Id_predmet'];
    	    $this->id_kategorie = $material['Id_kategorie'];
        }
	}

	public static function addStMaterial($nazev,$velikost,$extension,$id_kategorie,$id_predmet){
		$conn = DBConnection::getPDO();
		$insert = $conn->prepare("INSERT INTO St_materialy (Id_predmet,Nazev,Velikost,Extension,Id_kategorie) VALUES(:Id_predmet,:Nazev,:Velikost,:Extension,:Id_kategorie)");

       $insert->bindParam(":Id_predmet",$id_predmet);
       $insert->bindParam(":Nazev",$nazev);
       $insert->bindParam(":Velikost",$velikost);
       $insert->bindParam(":Extension",$extension);
       $insert->bindParam(":Id_kategorie",$id_kategorie);

       $insert->execute();  

	}

	public function delete(){
		$result = $this->con->prepare("DELETE FROM St_materialy WHERE Id_st_material=:Id");
   	    $result->bindParam(":Id",$this->id);
   	    $result->execute();
	}

	public function getNazev(){
		return $this->nazev;
	}

	public function getVelikost(){
		return $this->velikost;
	}

	public function getExtension(){
		return $this->extension;
	}

	public function getIdPremdet(){
		return $this->id_predmet;
	}
}

?>