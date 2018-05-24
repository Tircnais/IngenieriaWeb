<?php
	include("../dll/config.php");
	include("../dll/mysql.php");
	extract ($_POST);

	$query="INSERT INTO `registros`(`nombres`, `apellidos`, `direccion`, `correo`, `cedula`, `telefono`, `fecha_nacimiento`, `tipo`, `curso`, `taller`) VALUES ('$nombres','$apellidos','$direccion','$correo','$cedula','$telefono','$fecha_nacimiento','$tipo','$curso','$talleres[0]')";
    $result = mysqli_query($link, $query) or die('error de sql');

    $sql2="select max(id) from registros";
    $result2 = mysqli_query($link, $sql2) or die('error al obtener el ID-max');
    //Obtener el id del ultimo registro
	while ($line = mysqli_fetch_array($result2)) {
		$id_registro = $line[0];
	}
    /*inserto e la tabla de muchos a muchos*/
    for ($i=0; $i < count($talleres); $i++) { 
		//	echo $talleres[$i];
		$sql3 = "INSERT INTO `registrotaller`(`id_registro`, `id_taller`) VALUES ('$id_registro','$talleres[$i]')";
		//"insert into registrotaller values ('','$id_registro','')"
		$result3= mysqli_query($link, $sql3) or die('error de insercion en talleres '.mysqli_error($link));
	}
    echo'<script>alert("Datos guardados")</script>';
    echo "<script>location.href='../internas/listar_registro.php'</script>";

?>