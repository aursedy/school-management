<?php 
$con = DBConnection::getPDO();
$update = false;
$errorPredmet = $errorPopis=$errorDatumPlatnost =$errorCasPlatnost= $msg='';
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
            Work::addWork($popis,$platnost,$predmet);
            $popis= $casPlatnost= $datumPlatnost='';
            $msg = '<div class="alert-ok"> Přidání úkolu proběhlo v poradku!</div>';

        } catch (PDOException $e) {
            $msg = '<div class="alert-delete" >'.$e->getMessage().'</div>';
        }
    }
}

if(isset($_GET['edit'])){
    $update = true;
    $id_ukol = $_GET['edit'];
    $ukol = new Work($_GET['edit']);
    $popis = $ukol->getPopis();
    $platnost = $ukol->getPlatnost();
    $datumPlatnost = substr($platnost,0,10);
    $casPlatnost = substr($platnost,11,5);
    $predmet = $ukol->getId_predmet();
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

    if($errorPredmet ==''&& $errorPopis==''&& $errorDatumPlatnost=='' && $errorCasPlatnost==''){
        try {
            $platnost = $datumPlatnost.' '.$casPlatnost;
            $ukol = new Work($_POST['id']);
            $ukol->update($popis,$platnost,$predmet);

            $popis= $casPlatnost= $datumPlatnost='';
            $update = false;
            $msg = '<div class="alert-update"> Editace úkolu proběhlo v poradku!</div>';

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

if(isset($_GET['delete'])){
    $ukol = new Work($_GET['delete']);
    $ukol->delete();
}

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

?>