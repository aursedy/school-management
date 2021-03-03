<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/categorie.php");
require_once("../classes/stMaterial.php");
require_once("../classes/subject.php");
require_once("crud/st_Material_controller.php");
require_once("../classes/teacherSubjectsOptions.php");
?>

<title>Přidání st. material</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

<div class="container">
    <?php if($errorType!=''){ echo '<div style="background-color: red;text-align:center;padding: 20px">'.$errorType.'</div>';} ?>
    <?php echo $statusMessage?>
    <form action ="stMaterialAddPage.php" method="POST" enctype="multipart/form-data" style="margin-top: 30px;">

        <label>Předmět </label><br>
        <select name="id_predmet">
            <?php 
                $options =  new teacherSubjectsOptions($_SESSION['userId']);
                $options->printOptions();
            ?>
            <?php if($errorPredmet!=''){echo '<div style="color: red;">'.$errorPredmet.'</div>';} ?>

        </select><br>

        <label>Soubor </label><br>
        <input type="file" name="soubor" ><br>

        <label>Kategorie </label><br>
        <select name="kategorie">
            <?php $select = $con->query("SELECT Id_kategorie,Nazev FROM Kategorie");
            while($kategorie = $select->fetch()):?>>
                <option value="<?php echo $kategorie['Id_kategorie']?>"><?php echo $kategorie['Nazev']?></option>

            <?php endwhile ?>

        </select><br>
        <input type="submit" name="save"  value="Přidat">
    </form>
</div>

</body>
</html>