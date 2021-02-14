<?php 
require_once("../classes/DBConnection.php");
require_once("crud/CRUD_work.php");
?>

<!DOCTYPE hmtl>
<html>
<head>
<title>Ukoly</title>
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>

    <div class="container" >
    <form action ="works.php" method="POST" class="form" enctype="multipart/form-data" style="width: 500px;margin-bottom: 30px;">
        <input type="hidden" name="id" value="<?php echo $id_ukol; ?>">

        <label>Popis: </label>
        <textarea style="width: 500px;height: 200px;"  name="popis" placeholder="Popis ukolu" ><?php echo $popis ;?></textarea><br>
        <?php if($errorPopis!=''){ echo '<span style="color: red;">'.$errorPopis.'</span><br>' ;}?>

        <label>Datum platnost: </label>
        <input type="input" name="date" placeholder="yyyy-mm-dd" value="<?php echo $datumPlatnost ;?>"><br>
        <?php if($errorDatumPlatnost!=''){ echo '<span style="color: red;">'.$errorDatumPlatnost.'</span><br>' ;}?>

        <label>Čas platnost: </label>
        <input type="input" name="time" placeholder="hh:mm" value="<?php echo $casPlatnost ;?>"><br>
         <?php if($errorCasPlatnost!=''){ echo '<span style="color: red;">'.$errorCasPlatnost.'</span><br>' ;}?>
        
        <label>Předmět : </label>
        <select name="predmet">
          <?php 
            $id = $_SESSION['userId'];
            $select = $con->getPDO()->query("SELECT * FROM Predmety WHERE Id_uzivatel=$id");
            while($predmet = $select->fetch()){
                echo'<option value="';
                if($predmet==$predmet['Id_predmet']){
                    echo $predmet['Id_predmet'].'">';
                }else{
                    echo $predmet['Id_predmet'].'" selected>';
                }
               
                echo $predmet['Nazev'].'</option>';
            }?>>
            <?php if($errorPredmet!=''){echo '<div style="color: red;">'.$errorPredmet.'</div>';} ?>

        </select><br>

        <!-- -->
        <?php if ($update==false):?>
        <input type="submit" name="save"  value="Přidat">

        <?php else :?>
        <input type="submit" name="update" value="Update">
        <?php endif?>
        <!-- -->

    </form>

    <div style="overflow-y: auto;height: 300px;border: 3px solid #a3a3a3;" >
        <?php 
        $userId = $_SESSION['userId'];
        $result = $con->getPDO()->query("SELECT * FROM Predmety WHERE Id_uzivatel= $userId");

        while(($predmet = $result->fetch())){
            $id_predmet = $predmet['Id_predmet'];
            $select = $con->getPDO()->query("SELECT * FROM Ukoly WHERE Id_predmet= $id_predmet");
            
            echo '<table style="margin-bottom: 50px;" ><caption style="color: blue;font-weight: bold;">'.$predmet['Nazev'].'</caption>';
            echo '<thead><tr><th>Popis</th><th>Platnost do</th><th colspan="2">Akce</th></tr><thead>';

            while(($ukol=$select->fetch())){
                echo '<tr><td>'.$ukol['Popis'].'</td>';
                echo '<td>'.$ukol['Platnost_do'].'</td>';
                echo '<td><a href="works.php?edit='.$ukol['Id_ukol'].'" class="btn edit-btn">Editace</a></td>';
                echo '<td><a href="works.php?delete='.$ukol['Id_ukol'].'" class="btn delete-btn">Odeber</a></td>';
                echo '</tr>';
            }
            echo '</table>';

        }
    ?>
    </div>
        
</div>

</body>
</html>