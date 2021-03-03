<?php 

class Subject{

protected $con;
protected $id;
private $nazev;
private $id_trida;
private $id_ucitel;
private $start_time;
private $end_time;
private $den;

	public function __construct($id){
		$this->con = DBConnection::getPDO();
	    $row = $this->con->prepare("SELECT * FROM Predmety WHERE Id_predmet= :Id_predmet");
        $row->bindParam(":Id_predmet",$id);
        $row->execute();
        $subject = $row->fetch();

        if($subject!=null){
    	    $this->id = $id;
    	    $this->nazev = $subject['Nazev'];
    	    $this->id_trida = $subject['Id_trida'];
    	    $this->id_ucitel = $subject['Id_uzivatel'];
    	    $this->start_time = $subject['Start_time'];
    	    $this->end_time = $subject['End_time'];
    	    $this->den = $subject['Den'];
        }
	}

	public function update($nazev,$id_trida,$id_ucitel,$start_time,$end_time,$den){

	    $stm = $this->con->prepare("UPDATE Predmety SET Nazev= :Nazev, Start_time = :Start_time, End_time= :End_time, Id_trida= :Id_trida, Den= :Den, Id_uzivatel= :Id_uzivatel WHERE Id_predmet= :Id");

        $stm->bindParam(":Nazev",$nazev);
        $stm->bindParam(":Start_time",$start_time);
        $stm->bindParam(":End_time",$end_time);
        $stm->bindParam(":Id_trida",$id_trida);
        $stm->bindParam(":Den",$den);
        $stm->bindParam(":Id_uzivatel",$id_ucitel);
        $stm->bindParam(":Id",$this->id);

        $stm->execute();

    }

    public function delete(){
    	$result = $this->con->prepare("DELETE FROM Predmety WHERE Id_predmet=:Id");
    	$result->bindParam(":Id",$this->id);

    	$result->execute();
    }

    public static function addSubject($nazev,$id_trida,$id_ucitel,$start_time,$end_time,$den){
        $conn = DBConnection::getPDO();
    	$stm = $conn->prepare("INSERT INTO Predmety (Nazev,Start_time,End_time,Den,Id_trida,Id_uzivatel) VALUES(:Nazev,:Start_time,:End_time,:Den,:Id_trida,:Id_uzivatel) ");

        $stm->bindParam(":Nazev",$nazev);
        $stm->bindParam(":Start_time",$start_time);
        $stm->bindParam(":End_time",$end_time);
        $stm->bindParam(":Id_trida",$id_trida);
        $stm->bindParam(":Den",$den);
        $stm->bindParam(":Id_uzivatel",$id_ucitel);

        $stm->execute();

    }

    public function getNazev(){
    	return $this->nazev;
    }

    public function getIdTrida(){
    	return $this->id_trida;
    }

    public function getIdUcitel(){
    	return $this->id_ucitel;
    }

    public function getStartTime(){
    	return $this->start_time;
    }

    public function getEndTime(){
    	return $this->end_time;
    }

    public function getDen(){
    	return $this->den;
    }

    public function getId(){
        return $this->id;
    }

}
?>