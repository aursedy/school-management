<?php 
$ukol = null;
$id_ukol = 0;
$id_student =0;
$msg = ''; 
$studentWork = null;

if(isset($_GET['ukol'])){
	$ukol = new Work($_GET['ukol']);
}

if(isset($_GET['id_ukol']) && isset($_GET['id_student'])){
	$id_student = $_GET['id_student'];
	$id_ukol = $_GET['id_ukol'];
	$studentWork = new StudentWork($id_student,$id_ukol);
}

if(isset($_POST['givegrade'])){
	$id_student = $_POST['id_student'];
	$id_ukol = $_POST['id_ukol'];
	$studentWork = new StudentWork($id_student,$id_ukol);

	if($studentWork->jeUkol()==false){
		$nazevSouboru = '';
		StudentWork::addStudentWork($id_student,$id_ukol,$nazevSouboru);
		$msg = '<div style="background-color: green; text-align:center;padding: 20px;">Známka byla přidana!</div>';
	}
	
	$studentWork->setZnamka($_POST['znamka']);
	header("location: workGrades.php?ukol=$id_ukol");
}

?>