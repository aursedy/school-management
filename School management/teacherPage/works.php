<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/work.php");
require_once("crud/CRUD_work.php");
require_once("../controller/teacherPageController.php");
$controller = new TeacherPageController($_SESSION['userId']);
?>

<title>Ukoly</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

    <div class="container">
    <div >
        <?php 
            $controller->printWorks();
        ?>
    </div>
        
</div>

</body>
</html>