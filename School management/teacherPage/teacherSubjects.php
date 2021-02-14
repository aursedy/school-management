<?php 
require_once("../classes/DBConnection.php");
$con = new DBConnection();
?>

<!DOCTYPE hmtl>
<html>
<head>
<title>Předměti</title>
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
                    <th>Předměti</th>
                    <!--<th>Od</th>-->
                    <!--<th>Do</th>-->
                    <!--<th>Den</th>-->
                </tr>
            </thead>

    <?php 
        $userId = $_SESSION['userId'];
        $result = $con->getPDO()->query("SELECT * FROM Predmety WHERE Id_uzivatel= $userId");

        while(($row = $result->fetch())){
            echo '<tr><td>'.$row['Nazev'].'</td>';
        }
    ?>
        
        </table>
    </div>

</body>
</html>