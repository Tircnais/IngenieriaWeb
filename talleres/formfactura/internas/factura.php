<?php
    include("../dll/config.php");
    include("../dll/mysql.php");
    extract($_POST);
    $id = $_GET['idregistro'];
    $nombre="";
    $apellido="";
    $cedula="";
    $edad="";
    $curso="";
    
    //Subtotal
    $subtotal=0;
    //costo evento
    $costo_evento=100;
    //costos
    $v_curso=80;
    $v_taller=10;
    //Descuento segun el tipo de usuario
    $desc[0]=0.10; //Prof
    $desc[1]=0.20; //Est
    $desc[2]=0.00; //Est
    $valor_curso = 0;
    $valor_taller = 0;
    $descaplicado=0;

    //Tipo usuario
    $usr[0]="Profesor";
    $usr[1]="Estudiante";
    $usr[2]="Externo";
    $tipo=0;
    
    $sqlregistro = "select * from registros WHERE id = $id";
    //Obetener Registro
    $registros = mysqli_query($link, $sqlregistro) or die('error de sql');
    while ($registro = mysqli_fetch_array($registros,MYSQLI_ASSOC)) {
        $nombre = $registro['nombres'];
        $apellido = $registro['apellidos'];
        $cedula = $registro['cedula'];
        $fecha = $registro['fecha_nacimiento'];
        
        // algoritmo para calcular la edad
        $tiempo = strtotime($fecha);
        $ahora = time();
        $edad = ($ahora-$tiempo)/(60*60*24*365.25);
        $edad = floor($edad);
        
        // Descuento
        switch ($registro['tipo']) {
            case "P":
                $tipo=1;
                break;
            case "E":
                $tipo=2;
                break;
            default:
                $tipo=3;
        }
        
        // Comprobar curso inscrito
        if (isset($registro['curso']) && !empty($registro['curso'])) {
            //Sumamos el valor del curso
            if ($registro['curso']!= "-"){
                $valor_curso += $v_curso;
                //Nombre del curso
                switch ($registro['curso']) {
                    case "J":
                        $curso="JAVA";
                        break;
                    case "P":
                        $curso="Python";
                        break;
                    case "A":
                        $curso="Android";
                        break;
                    default:
                        $curso="ErroR Curso";
                }
            }
        }
        
        //Obtener talleres con el ID
        $sqltalleres = "select * from registrotaller rt, talleres t where id_registro = $id and t.id = rt.id_taller";
        $talleres = mysqli_query($link, $sqltalleres) or die('Error SQL consulta tallers');
        $talleres_array = array();
        //obtenemos el valor para los talleres
        while ($taller = mysqli_fetch_array($talleres,MYSQLI_ASSOC)) { 
            array_push($talleres_array, $taller['nombre']);
            $valor_taller += $v_taller;
        }
    }
    $subtotal = $costo_evento;
    $subtotal += $valor_curso;
    $subtotal += $valor_taller;

    $descaplicado = $desc[$tipo-1];
    $descaplicado = $subtotal * $descaplicado;

    $valor_pago = $subtotal - $descaplicado;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo $site_factura ?></title>
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
		<h1>Factura de Registro <span class="slogan">with PHP</span></h1>
	</header>
	<nav>
		<a href="">Home</a>
		<a href="">Evento</a>
		<a href="">Registro</a>
		<a href="">Contactos</a>
		<a href="">Sistema</a>
	</nav>
	<main class="lista">
        <section class="factura centrar">
            <h2 class='fuente6'>Detalle de FACTURA</h2>
            <div class="cliente">
                <p class="negro fuente4">Cliente: <span class="negrita azul"><?php echo $nombre .", ". $apellido ?></span></p>
                <p class="negro fuente5">Cedula: <span class="azul"><?php echo $cedula ?></span></p>
                <p class="negro fuente6">Edad: <span class="azul"><?php echo $edad ?></span></p>
                <p class="negro fuente7">Tipo de Usuario: <span class="azul"><?php echo $usr[$tipo-1] ?></span></p>
            </div>
            <div class="items">
                <table class="detalle negro fuente8">
                    <tr>
                        <th>Descripción</th>
                        <th>Costo</th>
                    </tr>
                    <tr>
                        <td class="textizq">Inscripcion</td>
                        <td class="textder"><?php echo $costo_evento ?></td>
                    </tr>
                    <?php
                        //revisar el case de CURSO
                        if ($curso) { ?>
                            <tr>
                                <td class="textizq"><?php echo $curso ?></td>
                                <td class="textder"><?php echo $v_curso ?></td>
                            </tr>
                    <?php
                        }
                     ?>
                    <?php
                        if (!empty($talleres_array)) {
                            for ($i=0; $i < count($talleres_array); $i++) { ?>
                                <tr>
                                    <td class="textizq"><?php echo $talleres_array[$i] ?></td>
                                    <td class="textder"><?php echo $v_taller ?></td>
                                </tr>
                    <?php 
                            }
                        }
                     ?>
                    <tr>
                        <td class="textder fnegro blanco fuente13">Subtotal:</td>
                        <td class="textder fblanco negro fuente13"><?php echo $subtotal ?></td>
                    </tr>
                    <tr>
                        <td class="textder fnegro blanco fuente13">Descuento (<?php echo $desc[$tipo-1]*100 ?>%)</td>
                        <td class="textder fblanco negro fuente13"><?php echo $descaplicado ?></td>
                    </tr>
                    <tr>
                        <td class="textder fnegro blanco fuente13">Valor a pagar:</td>
                        <td class="textder fblanco negro fuente13"><?php echo $valor_pago ?></td>
                    </tr>
                </table>
            </div>
        </section>
	</main>
	<footer>
		<h6>Derechos Reservados</h6>
	</footer>
</body>
</html>