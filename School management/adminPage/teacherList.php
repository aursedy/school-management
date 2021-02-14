 <?php 
require_once("../classes/DBConnection.php");
require_once("../classes/user.php");
$role = 'ucitel';
require_once("crud/CRUD_user.php");
?>
<!DOCTYPE hmtl>
<html>
<head>
<title>Seznam učitelů</title>
<link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
<link rel="stylesheet" type="text/css" href="../css/dashboardStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">
    <form action ="teacherList.php" method="POST" class="form" style="margin-top: 30px">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Jmeno: </label>
        <input type="input" name="jmeno" placeholder="jmeno" value="<?php echo $jmeno?>"><br>
        <?php if($errorJmeno!=''){echo'<span style="color: red">'.$errorJmeno.'</span><br>';} ?>

        <label>Přijmení: </label>
        <input type="input" name="prijmeni" placeholder="přijmení" value="<?php echo $prijmeni?>"><br>
        <?php if($errorPrijmeni!=''){echo'<span style="color: red">'.$errorPrijmeni.'</span><br>';} ?>

        <label>Login: </label>
        <input type="input" name="login" placeholder="login" value="<?php echo $login?>"><br>
        <?php if($errorLogin!=''){echo'<span style="color: red">'.$errorLogin.'</span><br>';} ?>

        <label>Heslo: </label>
        <input type="input" name="heslo" placeholder="heslo" value="<?php echo $heslo?>" ><br>
        <?php if($errorHeslo!=''){echo'<span style="color: red">'.$errorHeslo.'</span><br>';} ?>

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
                    <th>Jmeno</th>
                    <th>Přijmení</th>
                    <th>Login</th>
                    <th>Heslo</th>
                    <th colspan="2">Akce</th>
                </tr>
            </thead>

    <?php 
        $result =  $con->getPDO()->query("SELECT * FROM Uzivatele WHERE Role='ucitel'");

        while(($row = $result->fetch())):?>
            <tr>
                <td><?php echo $row['Id_uzivatel'] ?></td>
                <td><?php echo $row['Jmeno'] ?></td>
                <td><?php echo $row['Prijmeni'] ?></td>
                <td><?php echo $row['Login'] ?></td>
                <td><?php echo $row['Heslo'] ?></td>
                <td><a class="btn edit-btn" href="teacherList.php?edit=<?php echo $row['Id_uzivatel'] ?>">Editace</a></td>
                <td><a class="btn delete-btn" href="teacherList.php?delete=<?php echo $row['Id_uzivatel'] ?>">Odebirat</a></td>
                <!--<td><a class="btn subject-btn" href="teacherList.php?predmety=<?php //echo $row['Id_uzivatel'] ?>">Predmety</a></td>-->
            </tr>
    <?php endwhile;?>
        </table>
    </div>
        
</div>

</body>
</html>