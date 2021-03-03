<?php 
require_once("../inc/header.php");
require_once("../classes/user.php");
require_once("../classes/class.php");
require_once("../classes/subject.php");
require_once("crud/CRUD_subject.php");
require_once("../controller/adminPageController.php");
$controller = new AdminPageController($_SESSION['userId']);
?>

<title>Předměti</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">

    <div>
        <?php  
            $controller->printSubjects();
        ?>     
    </div>
        
</div>

</body>
</html>