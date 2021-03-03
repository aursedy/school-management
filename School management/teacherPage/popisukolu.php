<?php 
require_once("../inc/header.php");
require_once("../classes/user.php");
require_once("../classes/work.php");
require_once("crud/popis_controller.php");
?>

<title>School management system</title>

</head>

<body style="padding: 0px;margin: 0px;">
<?php require_once("header.php");?>

<?php require_once("sidebar.php");?>
<div class="container">
	<form style="width: 500px;">
		<textarea disabled="disabled" style="width: 500px;height: 300px;max-width: 500px;">
			<?php  echo $ukol->getPopis();?>
		</textarea>
	</form>
</div>

</body>
</html>