<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/class.php");
require_once("crud/CRUD_class.php");
?>

<title>Seznam Tříd</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>
<?php require_once("sideBar.php");?>

<div class="container">
    <?php echo $msg?>
	<form action ="classCDPage.php" method="POST" style="margin-top: 30px">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Nazev </label><br>
        <input type="input" name="nazev" placeholder="nazev" value="<?php echo $nazev?>"><br>
        <?php if($errorNazev!='') { echo '<span style="color: red;">'.$errorNazev.'</span><br>';}?> 

        <label>Kapacita </label><br>
        <select name="kapacita" >
        	<?php foreach($kapacity as $kapacita):?>
        		<?php if($kapacita== $kap): ?>
        		<option value="<?php echo $kapacita?>" selected ><?php echo $kapacita ?></option>

        		<?php else:?>
        		<option value="<?php echo $kapacita?>"><?php echo $kapacita ?></option>

        	    <?php endif?>
            <?php endforeach ?>
        </select><br>

        <!-- -->
        <?php if ($update==false):?>
        <input type="submit" name="save"  value="Save">

        <?php else :?>
        <input type="submit" name="update" value="Update">
        <?php endif?>
        <!-- -->
    </form>
</body>
</html>