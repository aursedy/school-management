<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/work.php");
require_once("../classes/studentWork.php");
require_once("crud/workGrades_controller.php");
$znamky =array("A","B","C","D","E","F");
?>

<title>Přidání/Editace úkolu</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>
    
    <?php echo $msg ?>
    <div class="container" >
    <form action ="giveGrade.php" method="POST" class="form" enctype="multipart/form-data">
        <input type="hidden" name="id_ukol" value="<?php echo $id_ukol; ?>">
        <input type="hidden" name="id_student" value="<?php echo $id_student; ?>">

        <label>Známka: </label>
        <select name="znamka">
            <?php foreach($znamky as $znamka):?>
                <?php if($studentWork->getZnamka()==$znamka):?>
                    <option value="<?php echo $znamka ?>" selected>
                        <?php echo $znamka ?>

                <?php else: ?>
                    <option value="<?php echo $znamka ?>">
                        <?php echo $znamka ?>
                <?php endif?>

                </option>
            <?php endforeach ?>
        </select><br>
        <input type="submit" name="givegrade"  value="Dát známku">

    </form>
        
</div>

</body>
</html>