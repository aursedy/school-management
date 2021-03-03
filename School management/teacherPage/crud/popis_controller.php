<?php 
$ukol = null;

if(isset($_GET['ukol'])){
	$ukol = new Work($_GET['ukol']);
}
?>