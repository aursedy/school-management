<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../controller/StudentPageController.php");
$controller = new StudentPageController($_SESSION['userId']);
?>

<title>Studijní material</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php")?>

    <div class="container" style="overflow-y: auto;">

    <?php 
        $controller->printStMaterials();
    ?>

    </div>
        
</div>

</body>
</html>