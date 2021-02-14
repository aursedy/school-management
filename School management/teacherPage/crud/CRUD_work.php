<?php 
$con = new DBConnection();
$update = false;
$errorPredmet = $errorPopis=$errorDatumPlatnost =$errorCasPlatnost='';
$popis= $datumPlatnost=$casPlatnost='';
$predmet =$id_ukol = 0;

if(isset($_POST['save'])){

    if(isset($_POST['predmet'])){
        $predmet = $_POST['predmet'];
    }else{
        $errorPredmet = "Musí být předmět ukolu";
    }

    if(!empty($_POST['popis'])){
        $popis = $_POST['popis'];
    }else{
        $errorPopis = "Musí být popis ukolu";
    }

    if(!empty($_POST['date']) && validateDate($_POST['date'])==true){
        $datumPlatnost = $_POST['date'];
    }else{
        $errorDatumPlatnost = "Neplatný datum platnost";
    }

    if(!empty($_POST['time']) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/",$_POST['time'])==true){
        $casPlatnost = $_POST['time'];
    }else{
        $errorCasPlatnost = "Neplatný čas platnost";
    }

    if($errorPredmet ==''&&$errorPopis==''&& $errorDatumPlatnost=='' && $errorCasPlatnost==''){
        try {
            $platnost = $datumPlatnost.' '.$casPlatnost;
            $insert=$con->getPDO()->prepare("INSERT INTO Ukoly (Popis,Platnost_do,Id_predmet) VALUES (:Popis,:Platnost_do,:Id_predmet)");
            $insert->bindParam(":Popis",$popis);
            $insert->bindParam(":Platnost_do",$platnost);
            $insert->bindParam(":Id_predmet",$_POST['predmet']);

            $insert->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

if(isset($_GET['edit'])){
    $update = true;
    $id_ukol = $_GET['edit'];
    $ukol = $con->selectWork($_GET['edit']);
    $popis = $ukol['Popis'];
    $platnost = $ukol['Platnost_do'];
    $datumPlatnost = substr($platnost,0,10);
    $casPlatnost = substr($platnost,11);
    $predmet = $ukol['Id_predmet'];
}

if(isset($_POST['update'])){
    if(isset($_POST['predmet'])){
        $predmet = $_POST['predmet'];
    }else{
        $errorPredmet = "Musí být předmět ukolu";
    }

    if(!empty($_POST['popis'])){
        $popis = $_POST['popis'];
    }else{
        $errorPopis = "Musí být popis ukolu";
    }

    if(!empty($_POST['date']) && validateDate($_POST['date'])==true){
        $datumPlatnost = $_POST['date'];
    }else{
        $errorDatumPlatnost = "Neplatný datum platnost";
    }

    if(!empty($_POST['time']) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/",$_POST['time'])==true){
        $casPlatnost = $_POST['time'];
    }else{
        $errorCasPlatnost = "Neplatný čas platnost";
    }

    if($errorPredmet ==''&&$errorPopis==''&& $errorDatumPlatnost=='' && $errorCasPlatnost==''){
        try {
            $platnost = $datumPlatnost.' '.$casPlatnost;
            $update=$con->getPDO()->prepare("UPDATE Ukoly SET Popis= :Popis, Platnost_do= :Platnost_do, Id_predmet= :Id_predmet WHERE Id_ukol= :Id");
            $update->bindParam(":Popis",$popis);
            $update->bindParam(":Platnost_do",$platnost);
            $update->bindParam(":Id_predmet",$predmet);
            $update->bindParam(":Id",$_POST['id']);

            $update->execute();

            $popis= $casPlatnost= $datumPlatnost='';
            $update = false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

if(isset($_GET['delete'])){
    $con->deleteWork($_GET['delete']);
}

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

?>