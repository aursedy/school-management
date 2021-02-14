<?php 
require_once("../classes/user.php");
/**
 * Student Study material
 */
class StudStM extends User
{
	
	public function drawTable(){
		$userId = $this->id;
        $result = $this->con->getPDO()->query("SELECT * FROM Predmety_uzivatele WHERE Id_uzivatel= $userId");

        while(($row = $result->fetch())){
            $predmet = $this->con->selectSubject($row['Id_predmet']);
            $id_predmet = $predmet['Id_predmet'];
            $select = $this->con->getPDO()->query("SELECT * FROM St_materialy WHERE Id_predmet= $id_predmet");
            
            echo '<table style="margin-bottom: 50px;" ><caption style="color: blue;font-weight: bold;">'.$predmet['Nazev'].'</caption>';
            echo '<thead><tr><th>Nazev</th><th>Extension</th><th>Velikost</th><th>Soubor</th></tr><thead>';

            while(($stmaterial=$select->fetch())){
                $nazev = $stmaterial['Nazev'];
                echo '<tr><td>'.$nazev.'</td>';
                echo '<td>'.$stmaterial['Extension'].'</td>';
                echo '<td>'.($stmaterial['Velikost']/1000).' KB</td>';
                echo '<td><a class="btn edit-btn" href="../uploads/'.$nazev.'">stahnout</a></td>';
                echo '</tr>';
            }
            echo '</table>';

        }
	}
}
?>