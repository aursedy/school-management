<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/work.php");
require_once("../classes/subject.php");
require_once("crud/CRUD_work.php");
require_once("../classes/teacherSubjectsOptions.php");
?>

<title>Přidání/Editace úkolu</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>
    
<div class="container" >
    <?php echo $msg; ?>
    <form action ="workCDPage.php" method="POST" style="width: 500px;margin-bottom: 30px;">
        <input type="hidden" name="id" value="<?php echo $id_ukol; ?>">

        <label>Popis </label><br>
        <textarea style="width: 500px;height: 200px;max-width: 500px;"  name="popis" placeholder="Popis ukolu" >
            <?php echo $popis ;?>         
        </textarea><br>
        <?php if($errorPopis!=''){ echo '<span style="color: red;">'.$errorPopis.'</span><br>' ;}?>

        <label>Datum platnost </label><br>
        <input type="input" name="date" placeholder="yyyy-mm-dd" value="<?php echo $datumPlatnost ;?>"><br>
        <?php if($errorDatumPlatnost!=''){ echo '<span style="color: red;">'.$errorDatumPlatnost.'</span><br>' ;}?>

        <label>Čas platnost </label><br>
        <input type="input" name="time" placeholder="hh:mm" value="<?php echo $casPlatnost ;?>"><br>
         <?php if($errorCasPlatnost!=''){ echo '<span style="color: red;">'.$errorCasPlatnost.'</span><br>' ;}?>
        
        <label>Předmět </label><br>
        <select name="predmet">
          <?php 
            $options = new teacherSubjectsOptions($_SESSION['userId']);
            $options->printOptions();
          ?>
        </select><br>
        <?php if($errorPredmet!=''){echo '<div style="color: red;">'.$errorPredmet.'</div>';} ?>

        <!-- -->
        <?php if ($update==false):?>
        <input type="submit" name="save"  value="Přidat">

        <?php else :?>
        <input type="submit" name="update" value="Update">
        <?php endif?>
        <!-- -->

    </form>
        
</div>

</body>
</html>