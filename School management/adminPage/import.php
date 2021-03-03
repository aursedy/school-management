<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/import.php");
require_once("crud/import_controller.php");
?>

<title>Importovat</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

<div class="container">
    <?php echo $statusMessage?>
    <form action ="import.php" method="POST" class="form" enctype="multipart/form-data" style="margin-top: 30px;">
        <label>Soubor: </label>
        <input type="file" name="soubor" ><br>

        <input type="submit" name="load"  value="Load">

    </form>
</div>

</body>
</html>