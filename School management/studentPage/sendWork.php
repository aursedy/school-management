<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/categorie.php");
require_once("../classes/stMaterial.php");
require_once("../classes/subject.php");
require_once("../classes/studentWork.php");
require_once("controller/sendWork_controller.php");
?>

<title>Poslat úkolu</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

<div class="container">
    <?php if($errorType!=''){ echo '<div style="background-color: red;text-align:center;padding: 20px">'.$errorType.'</div>';} ?>
    <?php echo $statusMessage?>
    <form action ="sendWork.php" method="POST" class="form" enctype="multipart/form-data" style="margin-top: 30px;">

    	<input type="hidden" name="id_ukol" value="<?php echo $id_ukol?>" ><br>
        <label>Soubor: </label>
        <input type="file" name="soubor" ><br>

        <?php $studentWork = new StudentWork($_SESSION['userId'],$id_ukol);
            if($studentWork->jeUkol()==false):?>
                <input type="submit" name="poslat"  value="Poslat">
            <?php else:?>
            	<input type="submit" class="disabled" name="poslat"  value="Už nemůžete poslat úkol" disabled="disabled">
            <?php endif ?>
    </form>
</div>

</body>
</html>