<?php 
require_once("../classes/DBConnection.php");
require_once("../classes/categorie.php");
require_once("crud/CRUD_categories.php");
?>
<!DOCTYPE hmtl>
<html>
<head>
<title>Seznam kategorií</title>
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">
	<form action ="categories.php" method="POST" class="form" style="margin-top: 30px">
    	<input type="hidden" name="id" value="<?php echo $id?>">
        <label>Nazev: </label>
	    <input type="input" name="nazev" placeholder="nazev" value="<?php echo $nazev?>"><br>
        <?php if($errorNazev!=''){echo '<span style="color: red">'.$errorNazev.'</span><br>';} ?>

	    <label>Popis: </label>
		<textarea placeholder="Popis kategorie" name="popis"><?php echo $popis ?></textarea><br>

		<?php if ($update==false):?>
        <input type="submit" name="save"  value="save">

        <?php else :?>
        <input type="submit" name="update" value="Update">
        <?php endif?>
    </form>

    <div style="overflow-y: auto;height: 300px;border: 3px solid #a3a3a3;">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nazev</th>
                    <th>Popis</th>
                    <th colspan="2">Akce</th>
                </tr>
            </thead>

    <?php 
        $con = new DBConnection();
        $result =  $con->getPDO()->query("SELECT * FROM Kategorie");

        while(($row = $result->fetch())):?>
            <tr>
                <td><?php echo $row['Id_kategorie'] ?></td>
                <td><?php echo $row['Nazev'] ?></td>
                <td><?php echo $row['Popis'] ?></td>
                <td><a class="btn edit-btn" href="categories.php?edit=<?php echo $row['Id_kategorie'] ?>">Editace</a></td>
                <td><a class="btn delete-btn" href="categories.php?delete=<?php echo $row['Id_kategorie'] ?>">Odebirat</a></td>
            </tr>
    <?php endwhile;?>
        </table>
    </div>
		
</div>



</body>
</html>