<?php 
$nazev = $errorNazev=$msg='' ;
$kap = 0;
$id = 0;
$update = false;
$kapacity = array(10,15,20,25,30,35,40,45,50);
$con = DBConnection::getPDO();

if(isset($_POST['save'])){

    if(!empty($_POST['nazev'])){
        $nazev = $_POST['nazev'];
    }else{
        $errorNazev = "Neplatný Název!";
    }

    $kap = $_POST['kapacita'];

    if($errorNazev==''){
        try{
            Trida::addClass($nazev,$kap);
            $msg = '<div class="alert-ok">Přidání Třidy proběhlo v poradku!</div>';
        }catch(PDOException $e){
            echo "New data couldn't be recorded: " . $e->getMessage();
        }
    }      
}

if(isset($_GET['delete'])){
    $class = new Trida($_GET['delete']);
    $class->delete();
}

if(isset($_GET['edit'])){
    $trida = new Trida($_GET['edit']);
 	$id = $_GET['edit'];
 	$nazev = $trida->getNazev();
 	$kap = $trida->getKapacita();
 	$update = true;
}

if(isset($_POST['update'])){
 	if(!empty($_POST['nazev'])){
        $nazev = $_POST['nazev'];
    }else{
        $errorJmeno = "Neplatný název!";
    }

    $kap = $_POST['kapacita'];

    try{
        $trida = new Trida($_POST['id']);
        $trida->update($nazev,$kap);
        $kap = 0;
        $nazev = '';
         $msg = '<div class="alert-update">Editace Třidy proběhlo v poradku!</div>';
    }catch(PDOException $e){
        echo "Data couldn't be updated: " . $e->getMessage();
    }
}

?>