<?php 
require_once("../classes/user.php");

class StudentSubjects extends User
{
	
    public function drawTable(){
        echo '<table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nazev</th>
                    <th>Od</th>
                    <th>Do</th>
                    <th>Den</th>
                    <th colspan="2">Akce</th>
                </tr>
            </thead>';
 
        $result = $this->con->getPDO()->query("SELECT * FROM Predmety");

        while(($row = $result->fetch())){
            echo '<tr>
                <td>'.$row['Id_predmet'].'</td>
                <td>'.$row['Nazev'].'</td>
                <td>'. $row['Start_time'] .'</td>
                <td>'. $row['End_time'] .'</td>
                <td>'. $row['Den'].'</td>';
                    $id_predmet = $row['Id_predmet'];
                    $userId  = $this->id;
                    $stm = $this->con->getPDO()->query("SELECT * FROM Predmety_uzivatele WHERE Id_predmet= $id_predmet AND Id_uzivatel= $userId");
                    $predmet =$stm->fetch();
                    if($predmet==null){
                        echo' <td><a class="btn edit-btn" href="../studentPage/subjectList.php?add='.$id_predmet.'">Přidat</a></td>';
                    }else{
                        echo '<td><a class="btn delete-btn" href="../studentPage/subjectList.php?delete='.$id_predmet.'">Odebirat</a></td></tr>';
                    }
        } 
            
        echo '</table>';
    }
	
}
 