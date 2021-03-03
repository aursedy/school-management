<?php 
    require_once("../classes/user.php");
    require_once("../classes/teacherSubjectsOptions.php");

    /**
     * 
     */
    class teacherPageController extends User
    {
    	
    	function printWorks(){
            $result = $this->con->prepare("SELECT * FROM Predmety WHERE Id_uzivatel= :Id_uzivatel");
            $result->bindParam(":Id_uzivatel", $this->id);
            $result->execute();

            while(($predmet = $result->fetch())){
                $id_predmet = $predmet['Id_predmet'];
                $select = $this->con->prepare("SELECT * FROM Ukoly WHERE Id_predmet= :Id_predmet");
                $select->bindParam(":Id_predmet", $id_predmet);
                $select->execute();
            
                echo '<table style="margin-bottom: 50px;" ><caption style="color: blue;font-weight: bold;">'.$predmet['Nazev'].'</caption>';
                echo '<thead><tr><th>Popis</th><th>Platnost do</th><th colspan="3">Akce</th></tr><thead>';

                while(($ukol=$select->fetch())){
                    echo '<tr><td><a href="popisukolu.php?ukol= '.$ukol['Id_ukol'].'">Popis</a></td>';
                    echo '<td>'.$ukol['Platnost_do'].'</td>';
                    echo '<td><a href="workCDPage.php?edit='.$ukol['Id_ukol'].'" class="btn edit-btn">Editace</a></td>';
                    echo '<td><a href="works.php?delete='.$ukol['Id_ukol'].'" class="btn delete-btn">Odeber</a></td>';
                    echo '<td><a href="workGrades.php?ukol='.$ukol['Id_ukol'].'" class="btn edit-btn">Znamky studenty</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
    	}

    	public function printScheadule(){
            echo '<div class="container">
                      <table>
                            <thead>
                                <tr>
                                    <th>Předmět</th>
                                    <th>Od</th>
                                    <th>Do</th>
                                    <th>Den</th>
                                    <th>Trida</th>
                                </tr>
                            </thead>';

            $result = $this->con->prepare("SELECT * FROM Predmety WHERE Id_uzivatel= :Id_uzivatel");
            $result->bindParam(":Id_uzivatel",$this->id);
            $result->execute();

            while(($predmet = $result->fetch())){
                echo '<tr><td>'.$predmet['Nazev'].'</td>';
                echo '<td>'.$predmet['Start_time'].'</td>';
                echo '<td>'.$predmet['End_time'].'</td>';
                echo '<td>'.$predmet['Den'].'</td>';
                $trida = new Trida($predmet['Id_trida']);
                echo '<td>'.$trida->getNazev().'</td>';
            }

            echo '</table></div>';
        }

    	function printStMaterials(){
    		$userId = $_SESSION['userId'];
            $result = $this->con->prepare("SELECT * FROM Predmety WHERE Id_uzivatel= :Id_uzivatel");
            $result->bindParam(":Id_uzivatel",$this->id);
            $result->execute();

            while(($predmet = $result->fetch())){
                $id_predmet = $predmet['Id_predmet'];
                $select=null;
                $select = $this->con->prepare("SELECT * FROM St_materialy WHERE Id_predmet= :Id_predmet");
                $select->bindParam(":Id_predmet",$id_predmet);
                $select->execute();
            
                echo '<table style="margin-bottom: 50px;" ><caption style="color: blue;font-weight: bold;">'.$predmet['Nazev'].'</caption>';
                echo '<thead>
                        <tr>
                            <th>Nazev</th>
                            <th>Extension</th>
                            <th>Velikost</th>
                            <th>Kategorie</th>
                            <th>Soubor</th>
                            <th>Akce</th>
                        </tr>
                      </thead>';

                while(($stmaterial=$select->fetch())){
                    $kategorie = new Categorie($stmaterial['Id_kategorie']);
                    $nazev = $stmaterial['Nazev'];
                    echo '<tr><td>'.$nazev.'</td>';
                    echo '<td>'.$stmaterial['Extension'].'</td>';
                    echo '<td>'.($stmaterial['Velikost']/1000).' KB</td>';
                    echo'<td>'.$kategorie->getNazev().'</td>';
                    echo '<td><a class="btn edit-btn" href="../uploads/'.$nazev.'">stahnout</a></td>';
                    echo '<td><a class="btn delete-btn" href="studyMaterials.php?delete='.$stmaterial['Id_st_material'].'">Odebirat</a></td';
                    echo '</tr>';
                }
                echo '</table>';

            }

    	}

    	function printCategories(){
    		echo '<div><table>
                      <thead>
                          <tr>
                               <th>Id</th>
                               <th>Nazev</th>
                               <th>Popis</th>
                               <th colspan="2">Akce</th>
                          </tr>
                     </thead>';

            $result =  $this->con->query("SELECT * FROM Kategorie");
            while(($row = $result->fetch())){
            	echo '<tr><td>'.$row['Id_kategorie'].'</td>';
            	echo '<td>'.$row['Nazev'].'</td>';
            	echo '<td>'.$row['Popis'].'</td>';
            	echo '<td><a class="btn edit-btn" href="categoryCDPage.php?edit='.$row['Id_kategorie'].'">Editace</a></td>';
            	echo '<td><a class="btn delete-btn" href="categories.php?delete='.$row['Id_kategorie'].'">Odebirat</a></td></tr>';
            }

            echo ' </table></div>';
    	}
    }

?>