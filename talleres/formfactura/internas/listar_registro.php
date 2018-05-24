<?php
include("../dll/config.php");
include("../dll/mysql.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $site_lista ?></title>
	<meta charset="utf-8">
	<meta charset="utf-8">
	<meta name="description" content="Formulario con PHP">
	<meta name="keykords" charset="formulario, PHP">
	<meta name="autor" content="UTPL by @ceaguirre6">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" type="image/x-icon" href="../images/utpl.jpg">
	<!--img en la pestaña-->
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/icons.css">

	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Cookie|Dancing+Script|Great+Vibes|Handlee|Indie+Flower|Jura|Kaushan+Script|Kavivanar|Lobster|Marck+Script|Pacifico|Sacramento|Satisfy|Shadows+Into+Light" rel="stylesheet">
</head>
<body>
	<header>
		<h1>Lista de participantes <span class="slogan">2018</span></h1>
	</header>
	<nav>
		<a href="">Home</a>
		<a href="">Evento</a>
		<a href="">Registro</a>
		<a href="">Contactos</a>
		<a href="">Sistema</a>
	</nav>
	<main class="lista">
		<h2>Listado de inscritos</h2>
		<table class="centrar">
		    <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Cedula</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Fecha Nacimiento</th>
                <th>Factura</th>
		    </tr>
            <?php
                $sqlregistros = "select * from registros";
                //ejecutamos $sqlregistros
                $registros = mysqli_query($link, $sqlregistros) or die('error de sql');
                //ingresagos en un array ($registros)
                while ($registro = mysqli_fetch_array($registros,MYSQLI_ASSOC)) {
                    //Se ontiene el id de c/registro
                    $idregistro = $registro['id'];
                    //Conseguir talleres
                    $sql2 = "select * from registrotaller, talleres WHERE id_registro = $idregistro and talleres.id = registrotaller.id_taller";
                    $talleres = mysqli_query($link, $sql2) or die('Revisar SQL JOIN tablas');
                    $talleres_string = "";
                    while ($taller = mysqli_fetch_array($talleres,MYSQLI_ASSOC)) { 
                        $talleres_string =  $talleres_string.$taller['nombre']." ";
                    }
             ?>
                   <tr>
                       <td><?php echo $registro['nombres'] ?></td>
                       <td><?php echo $registro['apellidos'] ?></td>
                       <td><?php echo $registro['direccion'] ?></td>
                       <td><?php echo $registro['cedula'] ?></td>
                       <td><?php echo $registro['telefono'] ?></td>
                       <td><?php echo $registro['correo'] ?></td>
                       <td><?php echo $registro['fecha_nacimiento'] ?></td>
                       <td><a href="factura.php?idregistro=<?php echo $idregistro ?>">Revisar</a></td>
                   </tr>
           <?php
                }
            ?>
        </table>
	</main>
	<footer>
		<h6>Derechos Reservados UTPL 2018</h6>
	</footer>
</body>
</html>
