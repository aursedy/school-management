<?php 
require_once("DBConnection.php");


class Work
{
	protected $id;
	protected $con;
	private $popis;
	private $platnost;
	private $id_predmet;

	public function __construct($id){
		$this->con = DBConnection::getPDO();
	    $row = $this->con->prepare("SELECT * FROM Ukoly WHERE Id_ukol= :Id_ukol");
        $row->bindParam(":Id_ukol",$id);
        $row->execute();
        $work = $row->fetch();

        if($work!=null){
    	    $this->id = $id;
    	    $this->popis = $work['Popis'];
    	    $this->platnost = $work['Platnost_do'];
            $this->id_predmet = $work['Id_predmet'];
       	}
    }

    public static function addWork($popis,$platnost,$predmet){
    	$conn = DBConnection::getPDO();
	    $insert = $conn->prepare("INSERT INTO Ukoly (Popis,Platnost_do,Id_predmet) VALUES(:Popis,:Platnost_do,:Id_predmet)");
	    $insert->bindParam(":Popis",$popis);
	    $insert->bindParam(":Platnost_do",$platnost);
	    $insert->bindParam(":Id_predmet",$predmet);

	    $insert->execute();
    }

    public function update($popis,$platnost,$predmet){	
    	$update = $this->con->prepare("UPDATE Ukoly SET Popis= :Popis, Platnost_do= :Platnost_do, Id_predmet= :Id_predmet WHERE Id_ukol= :Id ");
	    $update->bindParam(":Popis",$popis);
	    $update->bindParam(":Platnost_do",$platnost);
	    $update->bindParam(":Id_predmet",$predmet);
	    $update->bindParam(":Id",$this->id);	

	    $update->execute();
    }

    public function delete(){
    	$result = $this->con->prepare("DELETE FROM Ukoly WHERE Id_ukol=:Id");
   	    $result->bindParam(":Id",$this->id);
   	    $result->execute();
    }

    public function getPopis(){
    	return $this->popis;
    }

    public function getPlatnost(){
    	return $this->platnost;
    }

    public function getId_predmet(){
    	return $this->id_predmet;
    }

    public function getId(){
        return $this->id;
    }
}
?>