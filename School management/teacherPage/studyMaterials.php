<?php 
require_once("../classes/DBConnection.php");
require_once("crud/st_Material_controller.php");
?>

<!DOCTYPE hmtl>
<html>
<head>
<title>Předměti</title>
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

<div class="container">
    <?php if($errorType!=''){ echo '<div style="background-color: red;text-align:center;padding: 20px">'.$errorType.'</div>';} ?>
    <?php echo $statusMessage?>
    <form action ="studyMaterials.php" method="POST" class="form" enctype="multipart/form-data" style="margin-top: 30px;">

        <label>Předmět: </label>
        <select name="id_predmet">
            <?php 
            $id = $_SESSION['userId'];
            $select = $con->getPDO()->query("SELECT Id_predmet FROM Predmety WHERE Id_uzivatel=$id");
            while($result = $select->fetch()){
                $predmet = $con->selectSubject($result['Id_predmet']);
                echo'<option value="'.$predmet['Id_predmet'].'">';
                echo $predmet['Nazev'].'</option>';
            }?>>
            <?php if($errorPredmet!=''){echo '<div style="color: red;">'.$errorPredmet.'</div>';} ?>

        </select><br>

        <label>Soubor: </label>
        <input type="file" name="soubor" ><br>

        <label>Kategorie: </label>
        <select name="kategorie">
            <?php $select = $con->getPDO()->query("SELECT Id_kategorie,Nazev FROM Kategorie");
            while($kategorie = $select->fetch()):?>>
                <option value="<?php echo $kategorie['Id_kategorie']?>"><?php echo $kategorie['Nazev']?></option>

            <?php endwhile ?>

        </select><br>

        <input type="submit" name="save"  value="Přidat">

    </form>
    <form class="form" action="studyMaterials.php" method="POST">
        <label>Kategorie: </label>
        <select name="category">
            <option value="0">Všechny</option>
            <?php $select = $con->getPDO()->query("SELECT Id_kategorie,Nazev FROM Kategorie");
            while($kategorie = $select->fetch()):?>>
                <?php if($categorySearch==$kategorie['Id_kategorie']):?>
                <option value="<?php echo $kategorie['Id_kategorie']?>" selected><?php echo $kategorie['Nazev']?></option>
                <?php else:?>
                <option value="<?php echo $kategorie['Id_kategorie']?>"><?php echo $kategorie['Nazev']?></option>
                <?php endif?>

            <?php endwhile ?>

        </select><br>
        <input type="submit" name="search"  value="Hledat" >
        
    </form>

    <div style="overflow-y: auto;overflow-x: auto;height: 300px;border: 3px solid #a3a3a3;">
        <?php 
        $userId = $_SESSION['userId'];
        $result = $con->getPDO()->query("SELECT * FROM Predmety WHERE Id_uzivatel= $userId");

        while(($predmet = $result->fetch())){
            $id_predmet = $predmet['Id_predmet'];
            $select=null;
            if($categorySearch==0){
                $select = $con->getPDO()->query("SELECT * FROM St_materialy WHERE Id_predmet= $id_predmet");
            }else{
                $select = $con->getPDO()->query("SELECT * FROM St_materialy WHERE Id_predmet= $id_predmet AND Id_kategorie= $categorySearch");
            }
            
            echo '<table style="margin-bottom: 50px;" ><caption style="color: blue;font-weight: bold;">'.$predmet['Nazev'].'</caption>';
            echo '<thead><tr><th>Nazev</th><th>Extension</th><th>Velikost</th><th>Kategorie</th><th>Soubor</th><th>Akce</th></tr><thead>';

            while(($stmaterial=$select->fetch())){
                $kategorie =$con->selectCategorie($stmaterial['Id_kategorie']);
                $nazev = $stmaterial['Nazev'];
                echo '<tr><td>'.$nazev.'</td>';
                echo '<td>'.$stmaterial['Extension'].'</td>';
                echo '<td>'.($stmaterial['Velikost']/1000).' KB</td>';
                echo'<td>'.$kategorie['Nazev'].'</td>';
                echo '<td><a class="btn edit-btn" href="../uploads/'.$nazev.'">stahnout</a></td>';
                echo '<td><a class="btn delete-btn" href="studyMaterials.php?delete='.$stmaterial['Id_st_material'].' ">Odebirat</a></td';
                echo '</tr>';
            }
            echo '</table>';

        }
    ?>
    </div>

    

</div>

</body>
</html>