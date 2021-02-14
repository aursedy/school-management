<?php 
require_once("../classes/DBConnection.php");
require_once("../classes/user.php");
require_once("crud/CRUD_subject.php");
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

<?php require_once("sideBar.php");?>

<div class="container">
    <form action ="subjectList.php" method="POST" style="margin-top: 30px">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Nazev: </label>
        <input type="input" name="nazev" placeholder="nazev" value="<?php echo $nazev?>"><br>
        <?php if($errorNazev!=''){echo'<span style="color: red">'.$errorNazev.'</span><br>';} ?>

        <label>Od: </label>
        <input type="input" name="start_time" placeholder="start_time" value="<?php echo $start_time?>"><br>
        <?php if($errorStartTime!=''){echo'<span style="color: red">'.$errorStartTime.'</span><br>';} ?>

        <label>Do: </label>
        <input type="input" name="end_time" placeholder="end_time" value="<?php echo $end_time?>"><br>
        <?php if($errorEndTime!=''){echo'<span style="color: red">'.$errorEndTime.'</span><br>';} ?>

        <label>Den: </label>
        <select name="den">
        	<?php foreach($dny as $d):?>
        		<?php if($d==$den):?>
        		<option value="<?php echo $d?>" selected ><?php echo $d ?></option>
        		
        		<?php else:?>
        		<option value="<?php echo $d?>"><?php echo $d ?></option>
        	    <?php endif ?>

             <?php endforeach ?>
        </select><br>

        <label>Třída: </label>
        <select name="id_trida">
        	<?php $select = $con->getPDO()->query("SELECT Id_trida,Nazev FROM Tridy");
        	while($trida = $select->fetch()):?>
        		<?php if($trida['Id_trida']==$id_trida): ?>
        		<option value="<?php echo $trida['Id_trida']?>" selected><?php echo $trida['Nazev']?></option>

        		<?php else: ?>
        		<option value="<?php echo $trida['Id_trida']?>"><?php echo $trida['Nazev']?></option>

        		<?php endif?>
             <?php endwhile ?>

        </select><br>

        <label>Ucitel: </label>
        <select name="ucitel">
            <?php $select = $con->getPDO()->query("SELECT Id_uzivatel,Jmeno FROM Uzivatele WHERE Role='ucitel'");
            while($ucitel = $select->fetch()):?>
                <?php if($ucitel['Id_uzivatel']==$id_uzivatel): ?>
                <option value="<?php echo $ucitel['Id_uzivatel']?>" selected><?php echo $ucitel['Jmeno']?></option>

                <?php else: ?>
                <option value="<?php echo $ucitel['Id_uzivatel']?>"><?php echo $ucitel['Jmeno']?></option>

                <?php endif?>
             <?php endwhile ?>

        </select><br>

        <!-- -->
        <?php if ($update==false):?>
        <input type="submit" name="save"  value="Přidat">

        <?php else :?>
        <input type="submit" name="update" value="Update">
        <?php endif?>
        <!-- -->
    </form>

    <div style="overflow-y: auto;height: 300px">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nazev</th>
                    <th>Od</th>
                    <th>Do</th>
                    <th>Den</th>
                    <th>Učitel</th>
                    <th colspan="2">Akce</th>
                </tr>
            </thead>

    <?php 
        $result = $con->getPDO()->query("SELECT * FROM Predmety");

        while(($row = $result->fetch())):?>
            <tr>
                <td><?php echo $row['Id_predmet'] ?></td>
                <td><?php echo $row['Nazev'] ?></td>
                <td><?php echo $row['Start_time'] ?></td>
                <td><?php echo $row['End_time'] ?></td>
                <td><?php echo $row['Den'] ?></td>
                <td>
                    <?php 
                    $user = new User($row['Id_uzivatel']);
                    echo $user->getFName();
                    ?>
                </td>
                <td><a class="btn edit-btn" href="subjectList.php?edit=<?php echo $row['Id_predmet'] ?>">Editace</a></td>
                <td><a class="btn delete-btn" href="subjectList.php?delete=<?php echo $row['Id_predmet'] ?>">Odebirat</a></td>
            </tr>
        <?php endwhile;?>
        </table>
    </div>
        
</div>

</body>
</html>