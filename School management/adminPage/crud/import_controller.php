<?php 
$con = DBConnection::getPDO();
$statusMessage='';


if(isset($_POST['load']) && !empty($_FILES['soubor']['name'])){ 
  $file = $_FILES['soubor'];
  $import = new Import();
  $statusMessage = $import->importUsers($file);

  if($statusMessage==''){
    $statusMessage= '<div style="background-color: red; text-align:center;padding: 20px;">Error! File was not uploaded!</div>';
  }
    
}

?>