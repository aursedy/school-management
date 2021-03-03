<?php 
require_once("DBConnection.php");


class StudentWork {
	private $con;
    private $id_student;
    private $id_ukol;
    private $nazev_souboru;
    private $znamka;
    private $jeUkol;

    public function __construct($id_student,$id_ukol){
        $this->con = DBConnection::getPDO();
        $row = $this->con->prepare("SELECT * FROM Ukoly_studenta WHERE Id_ukol = :Id_ukol AND Id_student= :Id_student");
        $row->bindParam(":Id_ukol",$id_ukol);
        $row->bindParam(":Id_student",$id_student);
        $row->execute();
        $work = $row->fetch();

        if($work!=null){
            $this->id_student = $id_student;
            $this->id_ukol = $id_ukol;
            $this->nazev_souboru = $work['Nazev_souboru'];
            $this->znamka = $work['Znamka'];      
            $this->jeUkol = true;        
        }else{
            $this->id_student = $id_student;
            $this->id_ukol = $id_ukol;
            $this->nazev_souboru =null;
            $this->znamka = null;
            $this->jeUkol = false;
        }


    }

    public static function addStudentWork($id_student,$id_ukol,$nazev_souboru){
       $conn = DBConnection::getPDO();
       $insert = $conn->prepare("INSERT INTO Ukoly_studenta (Id_student,Id_ukol,Nazev_souboru) VALUES(:Id_student,:Id_ukol,:Nazev_souboru)");
       $insert->bindParam(":Id_student",$id_student);
       $insert->bindParam(":Id_ukol",$id_ukol);
       $insert->bindParam(":Nazev_souboru",$nazev_souboru);

       $insert->execute();
    }

    public function update($id_student,$id_ukol,$nazev_souboru){
        $update = $conn->prepare("UPDATE Ukoly_studenta SET Nazev_souboru= :Nazev_souboru WHERE Id_student= :Id_student AND Id_ukol= :Id_ukol");
        $update->bindParam(":Id_student",$id_student);
        $update->bindParam(":Id_ukol",$id_ukol);
        $update->bindParam(":Nazev_souboru",$nazev_souboru);

        $update->execute();
    }

    public function getIdStudent(){
        return $this->id_student;
    }

    public function getIdUkol(){
        return $this->id_ukol;
    }

    public function getNazevSouboru(){
        return $this->nazev_souboru;
    }

    public function getZnamka(){
        return $this->znamka;
    }

    public function setZnamka($znamka){
        $this->znamka = $znamka;

        $insert = $this->con->prepare("UPDATE Ukoly_studenta SET Znamka= :Znamka WHERE Id_student= :Id_student AND Id_ukol = :Id_ukol");
        $insert->bindParam(":Znamka",$znamka); 
        $insert->bindParam(":Id_student",$this->id_student); 
        $insert->bindParam(":Id_ukol",$this->id_ukol); 
        $insert->execute();
    }

    public function setNazev($nazev){
        $this->nazev = $nazev;

        $insert = $this->con->prepare("INSERT INTO Ukoly_studenta (Nazev_souboru) VALUES(:Nazev)");
        $insert->bindParam(":Nazev",$nazev); 
        $insert->execute();
    }

    public function jeUkol(){
        return $this->jeUkol;
    }

}
?>