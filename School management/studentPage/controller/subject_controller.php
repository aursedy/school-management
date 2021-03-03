<?php 
$con = new DBConnection();

if(isset($_GET['add'])){
    $userId = $_SESSION['userId'];
    $id = $_GET['add'];
    $select = $con->getPDO()->query("SELECT * FROM Predmety_uzivatele WHERE Id_predmet= $id AND Id_uzivatel= $userId");
    $result = $select->fetch();

    if($result==null){
        try{
            $stm = $con->getPDO()->prepare("INSERT INTO Predmety_uzivatele (Id_predmet,Id_uzivatel) VALUES (:Id_predmet,:Id_uzivatel)");

            $stm->bindParam(":Id_predmet",$_GET['add']);
            $stm->bindParam(":Id_uzivatel",$_SESSION['userId']);;

            $stm->execute();

        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }
    
}

if(isset($_GET['delete'])){
    $id_predmet = $_GET['delete'];
	$result = $con->getPDO()->prepare("DELETE FROM Predmety_uzivatele WHERE Id_predmet=:Id_predmet AND Id_uzivatel= :Id_uzivatel");

    $result->bindParam(":Id_predmet",$id_predmet);
    $result->bindParam(":Id_uzivatel",$_SESSION['userId']);

    $result->execute();
}
?>