<?php 
require_once("../inc/header.php");
require_once("../classes/categorie.php");
//require_once("../classes/stMaterial.php");
require_once("crud/CRUD_categories.php");
require_once("../controller/teacherPageController.php");
$controller = new TeacherPageController($_SESSION['userId']);
?>

<title>Seznam kategorií</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">
     <div>
        <?php 
            $controller->printCategories();
        ?>
    </div>   
		
</div>



</body>
</html>