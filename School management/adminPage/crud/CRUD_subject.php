<?php 
$update = false;
$con = DBConnection::getPDO();
$nazev = $den =$errorNazev=$errorStartTime=$errorEndTime= $errorUcitel= $msg ='';
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
    $id_trida = $_POST['id_trida'];

    if(!empty($_POST['start_time']) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/",$_POST['start_time'])==true){
        $start_time = $_POST['start_time'];
    }else{
        $errorStartTime= "Neplatný start time!";
    }

    if(!empty($_POST['end_time']) && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/",$_POST['end_time'])==true){
        $end_time = $_POST['end_time'];
    }else{
        $errorEndTime = "Neplatný end time!";
    }

    if(!empty($_POST['ucitel'])){
        $id_uzivatel = $_POST['ucitel'];
    }


    if($errorNazev==''&&$errorStartTime==''&&$errorEndTime==''){
        try{
            Subject::addSubject($nazev,$id_trida,$id_uzivatel,$start_time,$end_time,$den);
            $msg = '<div class="alert-ok">Přidání předmětu proběhlo v poradku!</div>';

        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }
        
}

if(isset($_GET['delete'])){
    $sub = new Subject($_GET['delete']);
	$sub->delete();
}

if(isset($_GET['edit'])){
    $sub = new Subject($_GET['edit']);
	$id = $_GET['edit'];
	$nazev = $sub->getNazev();
	$den = $sub->getDen();
	$start_time = $sub->getStartTime();
	$end_time = $sub->getEndTime();
	$update = true;
	$id_trida = $sub->getIdTrida();
    $id_uzivatel = $sub->getIdUcitel();
}

if(isset($_POST['update'])){
	if(!empty($_POST['nazev'])){
        $nazev = $_POST['nazev'];
    }else{
        $errorNazev = "Neplatný název!";
    }
        
    $den = $_POST['den'];
    $id_trida = $_POST['id_trida'];
 
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
            $subject = new Subject($_POST['id']);
            $subject->update($nazev,$id_trida,$id_uzivatel,$start_time,$end_time,$den);

            $nazev = $den ='';
            $start_time = $end_time = '00:00';
            $id= $id_trida= 0;
            $msg = '<div class="alert-update">Editace předmětu proběhlo v poradku!</div>';

        }catch(PDOException $e){
            echo "New data couldn't be updated: " . $e->getMessage();
        }
    }           
}
?>