<?php
    include("dll/config.php");
    include("dll/mysql.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo $site_name ?></title>
	<meta charset="utf-8">
	<meta name="description" content="Formulario con PHP">
	<meta name="keykords" charset="formulario, PHP">
	<meta name="autor" content="UTPL by @ceaguirre6">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" type="image/x-icon" href="images/utpl.jpg">
	<!--img en la pestaña-->
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/icons.css">	

	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Cookie|Dancing+Script|Great+Vibes|Handlee|Indie+Flower|Jura|Kaushan+Script|Kavivanar|Lobster|Marck+Script|Pacifico|Sacramento|Satisfy|Shadows+Into+Light" rel="stylesheet">
</head>
<body>
    <header>
		<h1>1er Congreso de Software 2018</h1>
	</header>
	<nav>
		<a href="">Home</a>
		<a href="">Evento</a>
		<a href="">Registro</a>
		<a href="">Contactos</a>
		<a href="">Sistema</a>
	</nav>
	<main>
        <section class="fila fondo">
            <section class="sectform">
                <form method="POST" action="internas/procesar.php">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese su nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese su apellido">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su direccion">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su telefono">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese su email">
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Ingrese su fecha de nacimiento">
                    </div>
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su cedula">
                    </div>
                    <div class="form-group">
                        <label for="tipo_user">Tipo de usuario</label>
                        <select class="form-control" id="tipo_user" name="tipo">
                            <option>Profesor</option>
                            <option>Estudiante</option>
                            <option>Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="curso">Curso</label>
                        <select class="form-control" id="curso" name="curso">
                            <option>-----</option>
                            <option>Java</option>
                            <option>Android</option>
                            <option>Python</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="taller">Taller</label>
                            <?php 
                                $query = "select * from talleres";
                                $talleres = mysqli_query($link, $query) or die('error de sql');
                                while ($taller = mysqli_fetch_array($talleres,MYSQLI_ASSOC)) { ?>
	
				                <input type="checkbox" name="talleres[]" class="check" value="<?php echo $taller['id']; ?>" id="<?php echo $taller['nombre']; ?>"><?php echo $taller['nombre']; ?><br>
			                 <?php } ?>
                    </div>
                    <br><button class="fuente2 btnguardar centerv2 centerh"><span class="icon-checkmark"></span>Guardar</button><br><br>
                </form>
            </section>
        </section>
	</main>
	<footer>
		<h6>Derechos Reservados</h6>
	</footer>
</body>
</html>