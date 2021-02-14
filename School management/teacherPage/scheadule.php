<?php 
require_once("../classes/DBConnection.php");
$con = new DBConnection();
?>

<!DOCTYPE hmtl>
<html>
<head>
<title>Rozvrh</title>
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Předmět</th>
                    <th>Od</th>
                    <th>Do</th>
                    <th>Den</th>
                    <th>Trida</th>
                </tr>
            </thead>

    <?php 
        $userId = $_SESSION['userId'];
        $result = $con->getPDO()->query("SELECT * FROM Predmety WHERE Id_uzivatel= $userId");

        while(($predmet = $result->fetch())){
            echo '<tr><td>'.$predmet['Nazev'].'</td>';
            echo '<td>'.$predmet['Start_time'].'</td>';
            echo '<td>'.$predmet['End_time'].'</td>';
            echo '<td>'.$predmet['Den'].'</td>';
            $trida = $con->selectClass($predmet['Id_trida']);
            echo '<td>'.$trida['Nazev'].'</td>';
        }
    ?>
        
        </table>
    </div>

</body>
</html>