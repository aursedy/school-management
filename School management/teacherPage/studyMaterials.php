<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/categorie.php");
require_once("../classes/stMaterial.php");
require_once("../classes/subject.php");
require_once("../controller/teacherPageController.php");
$controller = new TeacherPageController($_SESSION['userId']);
?>

<title>St. materialy</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

<div class="container">

    <div >
        <?php 
            $controller->printStMaterials();
        ?>
    </div>
</div>

</body>
</html>