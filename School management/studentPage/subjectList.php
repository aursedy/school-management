<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("controller/subject_controller.php");
require_once("../controller/studentPageController.php");
$controller = new StudentPageController($_SESSION['userId']);
?>

<title>Předměti</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php")?>
    <div class="container" style="overflow-y: auto;">
        <?php 
            $controller->printSubjects();
        ?>
    </div>
        
</body>
</html>