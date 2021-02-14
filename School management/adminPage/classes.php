<?php 
require_once("../classes/DBConnection.php");
require_once("crud/CRUD_class.php");
?>
<!DOCTYPE hmtl>
<html>
<head>
<title>Seznam Tříd</title>
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>
<?php require_once("sideBar.php");?>

<div class="container">
	<form action ="classes.php" method="POST" style="margin-top: 30px">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Nazev: </label>
        <input type="input" name="nazev" placeholder="nazev" value="<?php echo $nazev?>"><br>
        <?php if($errorNazev!='') { echo '<span style="color: red;">'.$errorNazev.'</span><br>';}?> 

        <label>Kapacita: </label>
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

    <div style="overflow-y: auto;height: 300px">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nazev</th>
                    <th>Kapacita</th>
                    <th colspan="2">Akce</th>
                </tr>
            </thead>

    <?php 
        $result = $con->getPDO()->query("SELECT * FROM Tridy");

        while(($row = $result->fetch())):?>
            <tr>
                <td><?php echo $row['Id_trida'] ?></td>
                <td><?php echo $row['Nazev'] ?></td>
                <td><?php echo $row['Kapacita'] ?></td>
                <td><a class="btn edit-btn" href="classes.php?edit=<?php echo $row['Id_trida'] ?>">Editace</a></td>
                <td><a class="btn delete-btn" href="classes.php?delete=<?php echo $row['Id_trida'] ?>">Odebirat</a></td>
            </tr>
        <?php endwhile;?>
        </table>
    </div>
</div>

</body>
</html>