<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/class.php");
require_once("../controller/teacherPageController.php");
$controller = new TeacherPageController($_SESSION['userId']);
?>

<title>Rozvrh</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

    <?php 
        $controller->printScheadule();
    ?>

</body>
</html>