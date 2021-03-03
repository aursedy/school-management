<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/class.php");
require_once("../classes/subject.php");
require_once("../controller/studentPageController.php");

$controller =  new StudentPageController($_SESSION['userId']);
?>

<title>Rozvrh</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php 
    require_once("header.php");
    require_once("sidebar.php");
    $controller->printScheadule();
?>

    

</body>
</html>