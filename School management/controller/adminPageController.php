<?php 
    require_once("../classes/user.php");

    /**
     * 
     */
    class AdminPageController extends User
    {
    	
        function printUsers($role){
        	echo '<table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Jmeno</th>
                                <th>Přijmení</th>
                                <th>Login</th>
                                <th>Heslo</th>
                                <th colspan="2">Akce</th>
                            </tr>
                        </thead>';
            $result =  $this->con->prepare("SELECT * FROM Uzivatele WHERE Role= :Role");
            $result->bindParam(":Role",$role);
            $result->execute();

            while(($row = $result->fetch())){
                echo'<tr>';
                echo '<td>'.$row['Id_uzivatel'].'</td>';
                echo '<td>'.$row['Jmeno'].'</td>';
                echo '<td>'.$row['Prijmeni'].'</td>';
                echo '<td>'.$row['Login'].'</td>';
                echo '<td>'.$row['Heslo'].'</td>';
                echo '<td><a class="btn edit-btn" href="../adminPage/userEditPage.php?edit='.$row['Id_uzivatel'].'">Editace</a></td>';
                echo '<td><a class="btn delete-btn" href="../adminPage/studentList.php?delete='.$row['Id_uzivatel'].'">Odebirat</a></td>';    
                echo'</tr>';
            }
            echo ' </table></div>';
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
                                <th>trida</th>
                                <th>ucitel</th>
                                <th colspan="2">Akce</th>
                            </tr>
                        </thead>';
            $result = $this->con->query("SELECT * FROM Predmety");
            while(($row = $result->fetch())){
            	echo'<tr>';
            	echo '<td>'.$row['Id_predmet'].'</td>';
                echo '<td>'.$row['Nazev'].'</td>';
                echo '<td>'.$row['Start_time'].'</td>';
                echo '<td>'.$row['End_time'].'</td>';
                echo '<td>'.$row['Den'].'</td>';
                $trida = new Trida($row['Id_trida']);
                echo '<td>'.$trida->getNazev().'</td>';
                $user = new User($row['Id_uzivatel']);
                echo '<td>'.$user->getFName().' '.$user->getLName() .'</td>';
                echo '<td><a class="btn edit-btn" href="subjectCDPage.php?edit='.$row['Id_predmet'].'">Editace</a></td>';
                echo '<td><a class="btn delete-btn" href="subjectList.php?delete='.$row['Id_predmet'].'">Odebirat</a></td></tr>';
            }    
            echo '</table>';                   
        }

        function printClasses(){
        	echo '<table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nazev</th>
                                <th>Kapacita</th>
                                <th colspan="2">Akce</th>
                            </tr>
                        </thead>';

                        $result = $this->con->query("SELECT * FROM Tridy");

            while(($row = $result->fetch())){
        	    echo '<tr>';
        	    echo '<td>'.$row['Id_trida'].'</td>';
        	    echo '<td>'.$row['Nazev'].'</td>';
        	    echo '<td>'.$row['Kapacita'].'</td>';
        	    echo '<td><a class="btn edit-btn" href="classCDPage.php?edit='.$row['Id_trida'].'">Editace</a></td>';
        	    echo '<td><a class="btn delete-btn" href="classes.php?delete='.$row['Id_trida'].'">Odebirat</a></td>';
        	    echo '<tr>';
            }
            echo '</table>'; 
        }
    }

?>