<?php 
require_once("../classes/DBConnection.php");
require_once("controller/subject_controller.php");
require_once("../classes/student/studentSubjects.php");
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

<?php require_once("sidebar.php")?>
    <div class="container" style="overflow-y: auto;">
        <?php 
        $userSubjects = new studentSubjects($_SESSION['userId']);
        $userSubjects->drawTable();
        ?>
    </div>
        
</body>
</html>