<?php 
require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/categorie.php");
require_once("crud/CRUD_categories.php");
?>

<title>Přidání/Editace kategorie</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">
    <?php echo $msg ?>
	<form action ="categoryCDPage.php" method="POST" class="form" style="width: 500px;margin-bottom: 30px;">
    	<input type="hidden" name="id" value="<?php echo $id?>">
        <label>Nazev </label><br>
	    <input type="input" name="nazev" placeholder="nazev" value="<?php echo $nazev?>"><br>
        <?php if($errorNazev!=''){echo '<span style="color: red">'.$errorNazev.'</span><br>';} ?>

	    <label>Popis </label><br>
		<textarea placeholder="Popis kategorie" name="popis" style="width: 500px;height: 200px;max-width: 500px;"><?php echo $popis ?></textarea><br>

		<?php if ($update==false):?>
        <input type="submit" name="save"  value="save">

        <?php else :?>
        <input type="submit" name="update" value="Update">
        <?php endif?>
    </form>
</body>
</html>