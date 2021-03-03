<?php 
$con = DBConnection::getPDO();
$errorType=$statusMessage='';
$id_ukol = 0;
$allowTypes = array('jpg','png','jpeg','gif','pdf','zip','txt','docx','pptx','csv','xls');

if(isset($_POST['poslat']) && !empty($_FILES['soubor']['name'])){ 
  $file = $_FILES['soubor'];
  $ext = pathinfo($file['name'],PATHINFO_EXTENSION);

  if(!in_array($ext, $allowTypes)){
    $errorType = 'Ten typ souboru není povolen!Povelne jsou : .jpg, .png, .jpeg, .gif, .pdf, .zip, .txt, .docx, .pptx, .csv, .xls';
  }

        
  if($errorType==''){
    if(move_uploaded_file($file['tmp_name'], "../uploads/" .$file['name'])){
      $statusMessage='<div class="alert-ok">File has been uploaded!</div>';
      $studentWork = new StudentWork($_SESSION['userId'],$_POST['id_ukol']);

      if($studentWork->jeUkol()==true){
        //obderu predchozi soubor
        $path = '../uploads/'.$studentWork->getNazevSouboru();
        unlink($path);

        //ukladám nový soubor
        $studentWork->setNazev($file['name']);
      }else{
        StudentWork::addStudentWork($_SESSION['userId'],$_POST['id_ukol'],$file['name']);
      }

    }else{
      $statusMessage= '<div class="alert-error">Error! File was not uploaded!</div>';
    }
  }      
}

if(isset($_GET['ukol'])){
  $id_ukol = $_GET['ukol'];
}


?>