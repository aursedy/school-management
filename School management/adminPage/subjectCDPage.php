<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/user.php");
require_once("../classes/subject.php");
require_once("crud/CRUD_subject.php");
?>

<title>Předměti</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">
    <?php echo $msg?>
    <form action ="subjectCDPage.php" method="POST" style="margin-top: 30px">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Nazev </label><br>
        <input type="input" name="nazev" placeholder="nazev" value="<?php echo $nazev?>"><br>
        <?php if($errorNazev!=''){echo'<span style="color: red">'.$errorNazev.'</span><br>';} ?>

        <label>Od </label><br>
        <input type="input" name="start_time" placeholder="start_time" value="<?php echo $start_time?>"><br>
        <?php if($errorStartTime!=''){echo'<span style="color: red">'.$errorStartTime.'</span><br>';} ?>

        <label>Do </label><br>
        <input type="input" name="end_time" placeholder="end_time" value="<?php echo $end_time?>"><br>
        <?php if($errorEndTime!=''){echo'<span style="color: red">'.$errorEndTime.'</span><br>';} ?>

        <label>Den </label><br>
        <select name="den">
            <?php foreach($dny as $d):?>
                <?php if($d==$den):?>
                <option value="<?php echo $d?>" selected ><?php echo $d ?></option>
                
                <?php else:?>
                <option value="<?php echo $d?>"><?php echo $d ?></option>
                <?php endif ?>

             <?php endforeach ?>
        </select><br>

        <label>Třída </label><br>
        <select name="id_trida">
            <?php $select = $con->query("SELECT Id_trida,Nazev FROM Tridy");
            while($trida = $select->fetch()):?>
                <?php if($trida['Id_trida']==$id_trida): ?>
                <option value="<?php echo $trida['Id_trida']?>" selected><?php echo $trida['Nazev']?></option>

                <?php else: ?>
                <option value="<?php echo $trida['Id_trida']?>"><?php echo $trida['Nazev']?></option>

                <?php endif?>
             <?php endwhile ?>

        </select><br>

        <label>Ucitel </label><br>
        <select name="ucitel">
            <?php $select = $con->query("SELECT Id_uzivatel,Jmeno FROM Uzivatele WHERE Role='ucitel'");
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

</body>
</html>