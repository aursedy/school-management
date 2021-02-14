<?php 
$update = false;
$con = new DBConnection();
$nazev = $popis = $errorNazev='';
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
            $stm = $con->getPDO()->prepare("INSERT INTO Kategorie (Nazev,Popis) VALUES (:Nazev,:Popis)");

            $stm->bindParam(":Nazev",$nazev);
            $stm->bindParam(":Popis",$popis);

            $stm->execute();

            }catch(PDOException $e){
                echo "New data couldn't be recorded: " . $e->getMessage();
            }
        }
    }

    if(isset($_GET['delete'])){
    	$con->deleteCategorie($_GET['delete']);
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

            $id= 0;
            }catch(PDOException $e){
                echo "New data couldn't be recorded: " . $e->getMessage();
            }
        }
    	
    }
?>