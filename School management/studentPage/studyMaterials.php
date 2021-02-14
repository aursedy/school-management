<?php 
require_once("../classes/DBConnection.php");
require_once("../classes/student/studentStudyMaterials.php");
?>

<!DOCTYPE hmtl>
<html>
<head>
<title>Studijní material</title>
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php")?>

    <div class="container" style="overflow-y: auto;">

    <?php 
    $stMaterials = new StudStM($_SESSION['userId']);
    $stMaterials->drawTable();
    ?>

    </div>
        
</div>

</body>
</html>