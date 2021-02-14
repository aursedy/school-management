<?php 
$nazev = $errorNazev='';
$kap = 0;
$id = 0;
$update = false;
$kapacity = array(10,15,20,25,30,35,40,45,50);
$con = new DBConnection();

if(isset($_POST['save'])){

    if(!empty($_POST['nazev'])){
        $nazev = $_POST['nazev'];
    }else{
        $errorNazev = "Neplatný Název!";
    }

    $kap = $_POST['kapacita'];

    if($errorNazev==''){
        try{
        $stm = $con->getPDO()->prepare("INSERT INTO Tridy (Nazev,Kapacita) VALUES (:Nazev,:Kapacita)");

        $stm->bindParam(":Nazev",$nazev);
        $stm->bindParam(":Kapacita",$kap);
        $stm->execute();

        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }      
}

if(isset($_GET['delete'])){
    $con->deleteClass($_GET['delete']);
}

if(isset($_GET['edit'])){
    $trida = $con->selectClass($_GET['edit']);
 	$id = $_GET['edit'];
 	$nazev = $trida['Nazev'];
 	$kap = $trida['Kapacita'];
 	$update = true;
}

if(isset($_POST['update'])){
 	if(!empty($_POST['nazev'])){
        $nazev = $_POST['nazev'];
    }else{
        $errorJmeno = "Neplatný název!";
    }

    try{
        $stm = $con->getPDO()->prepare("UPDATE Tridy SET Nazev= :Nazev , Kapacita= :Kapacita WHERE Id_trida= :Id");

        $stm->bindParam(":Nazev",$nazev);
        $stm->bindParam(":Kapacita",$_POST['kapacita']);
        $stm->bindParam(":Id",$_POST['id']);

        $stm->execute();

    }catch(PDOException $e){
        echo "New data couldn't be recorded: " . $e->getMessage();
    }
}

?>