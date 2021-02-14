<?php 
$con = new DBConnection();
$errorPredmet =$errorType=$statusMessage='';
$allowTypes = array('jpg','png','jpeg','gif','pdf','zip','txt','docx','pptx','csv','xls');
$id_kategorie = 0;
$categorySearch = 0;

if(isset($_POST['save']) && !empty($_FILES['soubor']['name'])){ 
    $file = $_FILES['soubor'];
    $ext = pathinfo($file['name'],PATHINFO_EXTENSION);

    if(!isset($_POST['id_predmet'])){
       $errorPredmet = 'Chybí předmět';
    }

    if(!in_array($ext, $allowTypes)){
        $errorType = 'Ten typ souboru není povolen!Povelne jsou : .jpg, .png, .jpeg, .gif, .pdf, .zip, .txt, .docx, .pptx, .csv, .xls';
    }

        
    if($errorPredmet ==''&&$errorType==''){
       
       $insert = $con->getPDO()->prepare("INSERT INTO St_materialy (Id_predmet,Nazev,Velikost,Extension,Id_kategorie) VALUES(:Id_predmet,:Nazev,:Velikost,:Extension,:Id_kategorie)");

       $insert->bindParam(":Id_predmet",$_POST['id_predmet']);
       $insert->bindParam(":Nazev",$file['name']);
       $insert->bindParam(":Velikost",$file['size']);
       $insert->bindParam(":Extension",$ext);
       $insert->bindParam(":Id_kategorie",$_POST['kategorie']);

       $insert->execute();  

       if(move_uploaded_file($file['tmp_name'], "../uploads/" .$file['name'])){
            $statusMessage='<div style="background-color: green; text-align:center;padding: 20px;">File has been uploaded!</div>';
       }else{
            $statusMessage= '<div style="background-color: red; text-align:center;padding: 20px;">Error! File was not uploaded!</div>';
        }

    }   
    
}

if(isset($_POST['search'])){
  $categorySearch = $_POST['category'];
}

if(isset($_GET['delete'])){
  $material = $con->selectStMaterial($_GET['delete']);
  $path = '../uploads/'.$material['Nazev'];
  $con->deleteStMaterial($_GET['delete']);
  unlink($path);
}
?>