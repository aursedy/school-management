<?php 
    require_once("../classes/class.php");
    require_once("../classes/subject.php");
    require_once("../classes/user.php");
    require_once("../classes/studentWork.php");

    /**
     * 
     */
    class studentPageController extends User
    {

        function printScheadule(){
            echo ' <div class="container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Předmět</th>
                                    <th>Od</th>
                                    <th>Do</th>
                                    <th>Den</th>
                                    <th>Trida</th>
                                    <th>Učitel</th>
                                </tr>
                            </thead>';
            $result = $this->con->prepare("SELECT * FROM Predmety_uzivatele WHERE Id_uzivatel= :Id_uzivatel");
            $result->bindParam(":Id_uzivatel",$this->id);
            $result->execute();

            while(($row = $result->fetch())){
                $predmet = new Subject($row['Id_predmet']);
                echo '<tr><td>'.$predmet->getNazev().'</td>';
                echo '<td>'.$predmet->getStartTime().'</td>';
                echo '<td>'.$predmet->getEndTime().'</td>';
                echo '<td>'.$predmet->getDen().'</td>';
                $trida = new Trida($predmet->getIdTrida());
                echo '<td>'.$trida->getNazev().'</td>';
                $ucitel = new User($predmet->getIdUcitel());
                echo '<td>'.$ucitel->getFName().' '.$ucitel->getLName() .'</td></tr>';
            }

            echo '</table></div>';
        }

        function printSubjects(){
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
 
        $result = $this->con->query("SELECT * FROM Predmety");

        while(($row = $result->fetch())){
            echo '<tr>
                <td>'.$row['Id_predmet'].'</td>
                <td>'.$row['Nazev'].'</td>
                <td>'. $row['Start_time'] .'</td>
                <td>'. $row['End_time'] .'</td>
                <td>'. $row['Den'].'</td>';
                    $id_predmet = $row['Id_predmet'];
                    $userId  = $this->id;
                    $stm = $this->con->prepare("SELECT * FROM Predmety_uzivatele WHERE Id_predmet= :Id_predmet AND Id_uzivatel= :Id_uzivatel ");
                    $stm->bindParam(":Id_predmet",$id_predmet);
                    $stm->bindParam(":Id_uzivatel",$userId);
                    $stm->execute();

                    $predmet =$stm->fetch();
                    if($predmet==null){
                        echo' <td><a class="btn edit-btn" href="../studentPage/subjectList.php?add='.$id_predmet.'">Přidat</a></td>';
                    }else{
                        echo '<td><a class="btn delete-btn" href="../studentPage/subjectList.php?delete='.$id_predmet.'">Odebirat</a></td></tr>';
                    }
        } 
            
        echo '</table>';
        }

        function printStMaterials(){
            $result = $this->con->prepare("SELECT * FROM Predmety_uzivatele WHERE Id_uzivatel= :Id_uzivatel");
            $result->bindParam(":Id_uzivatel",$this->id);
            $result->execute();

            while(($row = $result->fetch())){
                $predmet = new Subject($row['Id_predmet']);
                $id_predmet = $predmet->getId();
                $select = $this->con->prepare("SELECT * FROM St_materialy WHERE Id_predmet= :Id_predmet");
                $select->bindParam(":Id_predmet",$id_predmet);
                $select->execute();
            
                echo '<table style="margin-bottom: 50px;" >
                <caption style= "color: blue; font-weight: bold; ">'.$predmet->getNazev().'</caption>';

                echo '<thead>
                        <tr>
                            <th>Nazev</th>
                            <th>Extension</th>
                            <th>Velikost</th>
                            <th>Soubor</th>
                        </tr>
                      <thead>';

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

        function printStudentWorks(){
            echo '<h1 style="text-align: center;">Seznam úkolů studenta</h1>';
            $result = $this->con->prepare("SELECT * FROM Predmety_uzivatele WHERE Id_uzivatel= :Id_uzivatel");
            $result->bindParam(":Id_uzivatel",$this->id);
            $result->execute();

            while(($row = $result->fetch())){
                $predmet =new Subject($row['Id_predmet']);
                $id_predmet = $predmet->getId();
                $select = $this->con->prepare("SELECT * FROM Ukoly WHERE Id_predmet= :Id_predmet");
                $select->bindParam(":Id_predmet",$id_predmet);
                $select->execute();
            
                echo '<table style="margin-bottom: 50px;" ><caption style="color: blue; font-weight: bold;">'.$predmet->getNazev().'</caption>';

                echo '<thead>
                            <tr>
                                <th>Popis úkolu</th>
                                <th>Platnost do</th>
                                <th>Známka</th>
                                <th>Akce</th>
                            </tr>
                      <thead>';

                while(($ukol=$select->fetch())){
                    $studentWork = new studentWork($this->id,$ukol['Id_ukol']);
                    $znamka ='';

                    if($studentWork->getZnamka()!=null){
                        $znamka = $studentWork->getZnamka();
                    }
                    echo '<tr><td><a href=../studentPage/popisukolu.php?ukol="'.$ukol['Id_ukol'].'">Popis</a></td>';
                    echo '<td>'.$ukol['Platnost_do'].'</td>';
                    echo '<td>'.$znamka.'</td>';
                    if($studentWork->jeUkol()==false){
                        echo '<td><a class="akce-btn" href="../studentPage/sendWork.php?ukol='.$ukol['Id_ukol'].'">poslat ukol</a></td>';
                    }
                    
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
    }

?>