<?php
//include("config.php");
	$link = mysqli_connect($db_host, $db_user, $db_pass) or die('No se pudo conectar a la db'.mysqli_error());
	mysqli_select_db($link,$db_name) or die ('No se puede seleccionar la base de datos');


	//$enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	//if ($enlace) {
	//	echo "string1244";
	//}
?>
