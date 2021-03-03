<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../controller/studentPageController.php");
$controller = new StudentPageController($_SESSION['userId']);
?> 

<title>Úkoly</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

    <div style="overflow-y: auto;" class="container" >
       <?php 
           $controller->printStudentWorks();
       ?>
    </div>

</body>
</html>