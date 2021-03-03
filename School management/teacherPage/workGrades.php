<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/work.php");
require_once("../classes/subject.php");
require_once("../classes/studentWork.php");
require_once("../classes/user.php");
require_once("crud/workGrades_controller.php");
?>

<title>Ukoly</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

    <div class="container">
    <div >
        <?php 
        $con = DBConnection::getPDO();
        $predmet = new Subject($ukol->getId_predmet());
        $id = $predmet->getId();
        $select =  $con->prepare("SELECT * FROM Predmety_uzivatele WHERE Id_predmet= :Id_predmet");
        $select->bindParam(":Id_predmet",$id);
        $select->execute();

        echo '<table>
                <thead>
                    <tr>
                      <th>Jméno</th>
                      <th>Přijmení</th>
                      <th>Ukol</th>
                      <th>Známka</th>
                      <th>Akce</th>
                  </tr>
                </thead>';
        while($row= $select->fetch()){
            $student =  new User($row['Id_uzivatel']);
            $studentWork =  new StudentWork($student->getId(),$ukol->getId());
            echo '<tr><td>'.$student->getFName().'</td><td>'.$student->getFName().'</td>';
            
            if($studentWork->jeUkol()==true){
                echo '<td><a class="btn edit-btn"  href="../uploads/'.$studentWork->getNazevSouboru().'">stahnout</a></td>';
                echo '<td>'.$studentWork->getZnamka().'</td>';
            }else{
                echo '<td>Zatim nic...</td>';
                echo '<td>/</td>';
            }

            echo '<td><a class="akce-btn" href="giveGrade.php?id_student='.$student->getId().'&id_ukol='.$ukol->getId().'">dat známku</a></td><tr>';
        }

        echo '</table>';
    ?>
    </div>

        
</div>

</body>
</html>