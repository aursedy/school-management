<?php 
include("../classes/user.php");
class studentWorks extends User
{
    
    public function drawTable(){
        echo '<h1 style="text-align: center;">Seznam úkolů studenta</h1>';
        $userId = $this->id;
        $result = $this->con->getPDO()->query("SELECT * FROM Predmety_uzivatele WHERE Id_uzivatel= $userId");

        while(($row = $result->fetch())){
            $predmet =$this->con->selectSubject($row['Id_predmet']);
            $id_predmet = $predmet['Id_predmet'];
            $select = $this->con->getPDO()->query("SELECT * FROM Ukoly WHERE Id_predmet= $id_predmet");
            
            echo '<table style="margin-bottom: 50px;" ><caption style="color: blue;font-weight: bold;">'.$predmet['Nazev'].'</caption>';
            echo '<thead><tr><th>Popis úkolu</th><th>Platnost do</th></tr><thead>';

            while(($ukol=$select->fetch())){
                echo '<tr><td>'.$ukol['Popis'].'</td>';
                echo '<td>'.$ukol['Platnost_do'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }
}

?>