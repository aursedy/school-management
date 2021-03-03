 <?php 
 require_once("../inc/header.php");
require_once("../classes/DBConnection.php");
require_once("../classes/user.php");
require_once("crud/CRUD_user.php");
?>

<title>Seznam učitelů</title>
</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sideBar.php");?>

<div class="container">
    <div>
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
        $result =  $con->query("SELECT * FROM Uzivatele WHERE Role='ucitel'");

        while(($row = $result->fetch())):?>
            <tr>
                <td><?php echo $row['Id_uzivatel'] ?></td>
                <td><?php echo $row['Jmeno'] ?></td>
                <td><?php echo $row['Prijmeni'] ?></td>
                <td><?php echo $row['Login'] ?></td>
                <td><?php echo $row['Heslo'] ?></td>
                <td><a class="btn edit-btn" href="userEditPage.php?edit=<?php echo $row['Id_uzivatel'] ?>">Editace</a></td>
                <td><a class="btn delete-btn" href="teacherList.php?delete=<?php echo $row['Id_uzivatel'] ?>">Odebirat</a></td>
            </tr>
    <?php endwhile;?>
        </table>
    </div>
        
</div>

</body>
</html>