<?php 
$update = false;
$con = new DBConnection();
$nazev = $den =$errorNazev=$errorStartTime=$errorEndTime= $errorUcitel='';
$start_time = $end_time = '00:00';
$id= $id_trida= $id_uzivatel= 0;
$dny = array("Pondeli","Utery","Streda","Ctvrtek","Patek");

if(isset($_POST['save'])){

    if(!empty($_POST['nazev'])){
        $nazev = $_POST['nazev'];
    }else{
        $errorNazev = "Neplatný Název!";
    }

    $den = $_POST['den'];

    if(!empty($_POST['start_time']) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/",$_POST['time'])==true){
        $start_time = $_POST['start_time'];
    }else{
        $errorStartTime= "Neplatný start time!";
    }

    if(!empty($_POST['end_time']) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/",$_POST['time'])==true){
        $end_time = $_POST['end_time'];
    }else{
        $errorEndTime = "Neplatný end time!";
    }

    if(!empty($_POST['ucitel'])){
        $id_uzivatel = $_POST['ucitel'];
    }


    if($errorNazev==''&&$errorStartTime==''&&$errorEndTime==''){
        try{
        $stm = $con->getPDO()->prepare("INSERT INTO Predmety (Nazev,Start_time,End_time,Id_trida,Id_uzivatel,Den) VALUES (:Nazev,:Start_time,:End_time,:Id_trida,:Id_uzivatel,:Den)");

        $stm->bindParam(":Nazev",$nazev);
        $stm->bindParam(":Start_time",$start_time);
        $stm->bindParam(":End_time",$end_time);
        $stm->bindParam(":Id_uzivatel",$id_uzivatel);
        $stm->bindParam(":Id_trida",$_POST['id_trida']);
        $stm->bindParam(":Den",$_POST['den']);

        $stm->execute();

        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }
        
}

if(isset($_GET['delete'])){
	$con->deleteSubject($_GET['delete']);
}

if(isset($_GET['edit'])){
	$predmet = $con->selectSubject($_GET['edit']);
	$id = $_GET['edit'];
	$nazev = $predmet['Nazev'];
	$den = $predmet['Den'];
	$start_time = $predmet['Start_time'];
	$end_time = $predmet['End_time'];
	$update = true;
	$id_trida = $predmet['Id_trida'];
    $id_uzivatel = $predmet['Id_uzivatel'];
}

if(isset($_POST['update'])){
	if(!empty($_POST['nazev'])){
        $nazev = $_POST['nazev'];
    }else{
        $errorNazev = "Neplatný název!";
    }
        
    $den = $_POST['den'];
 
    if(!empty($_POST['start_time'])){
        $start_time = $_POST['start_time'];
    }else{
        $errorStartTime= "Neplatný start time!";
    }

    if(!empty($_POST['end_time'])){
        $end_time = $_POST['end_time'];
    }else{
        $errorEndTime = "Neplatný end time!";
    }

    if(!empty($_POST['ucitel'])){
        $id_uzivatel = $_POST['ucitel'];
    }

    if($errorNazev==''&&$errorStartTime==''&&$errorEndTime=='' && $errorUcitel==''){
        try{
            $stm = $con->getPDO()->prepare("UPDATE Predmety SET Nazev= :Nazev, Start_time = :Start_time, End_time= :End_time, Id_trida= :Id_trida, Den= :Den, Id_uzivatel= :Id_uzivatel WHERE Id_predmet= :Id");

            $stm->bindParam(":Nazev",$nazev);
            $stm->bindParam(":Start_time",$start_time);
            $stm->bindParam(":End_time",$end_time);
            $stm->bindParam(":Id_trida",$_POST['id_trida']);
            $stm->bindParam(":Den",$den);
            $stm->bindParam(":Id_uzivatel",$id_uzivatel);
            $stm->bindParam(":Id",$_POST['id']);

            $stm->execute();

            $nazev = $den ='';
            $start_time = $end_time = '00:00';
            $id= $id_trida= 0;

        }catch(PDOException $e){
            echo "New data couldn't be updated: " . $e->getMessage();
        }
    }           
}
?>