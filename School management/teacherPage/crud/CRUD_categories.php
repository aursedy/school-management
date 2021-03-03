<?php 
$update = false;
$con = DBConnection::getPDO();
$nazev = $popis = $errorNazev=$msg='';
$id = 0;

if(isset($_POST['save'])){

    	if(!empty($_POST['nazev'])){
            $nazev = $_POST['nazev'];
        }else{
            $errorNazev = "Neplatný název!";
        }

        if(!empty($_POST['popis'])){
            $popis= $_POST['popis'];
        }

        if($errorNazev==''){
            try{
                Categorie::addCategory($nazev,$popis);
                $msg = '<div class="alert-ok">Přidání kategorie proběhlo v poradku!</div>';
            }catch(PDOException $e){
                echo "New data couldn't be recorded: " . $e->getMessage();
            }
        }
    }

    if(isset($_GET['delete'])){
    	$cat = new Categorie($_GET['delete']);
        $cat->delete();
    }

    if(isset($_GET['edit'])){
        $update = true;
    	$cat = new Categorie($_GET['edit']);
    	$id=$_GET['edit'];
    	$nazev = $cat->getNazev();
    	$popis = $cat->getPopis();
    }

    if(isset($_POST['update'])){

    	if(!empty($_POST['nazev'])){
    		$nazev = $_POST['nazev'];
    	}else{
    		$errorNazev = "Neplatný Název!";
    	}

        if($errorNazev==''){ 
            try{
            $cat = new Categorie($_POST['id']);
            $cat->update($_POST['nazev'],$_POST['popis']);

            $nazev = $popis ='';
             $msg = '<div class="alert-update">Přidání kategorie proběhlo v poradku!</div>';

            $id= 0;
            }catch(PDOException $e){
                echo "New data couldn't be recorded: " . $e->getMessage();
            }
        }
    	
    }
?>