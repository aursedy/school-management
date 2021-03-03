<?php 
$con = DBConnection::getPDO();
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
       
      StMaterial::addStMaterial($file['name'],$file['size'],$ext,$_POST['kategorie'],$_POST['id_predmet']);

      if(move_uploaded_file($file['tmp_name'], "../uploads/" .$file['name'])){
        $statusMessage='<div style="background-color: green; text-align:center;padding: 20px;">File has been uploaded!</div>';
      }else{
        $statusMessage= '<div class="alert-ok">Error! File was not uploaded!</div>';
      }

    }   
    
}

if(isset($_POST['search'])){
  $categorySearch = $_POST['category'];
}

if(isset($_GET['delete'])){
  $material = new StMaterial($_GET['delete']);
  $path = '../uploads/'.$material->getNazev();
  $material->delete();
  unlink($path);
}
?>