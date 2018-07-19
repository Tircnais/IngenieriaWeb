<?php
	include("dll/mysql.php");
	$miconexion = new DB_mysql;
	$miconexion->conectar("cuidado", "127.0.0.1", "root", "");

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Loja, Cuidado cercano</title>

	<link rel="shortcut icon" href="assets/images/logo.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/estilos.css">
	<link rel="stylesheet" href="assets/css/icons.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="home">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li class="active"><a href="#"><span class="icon-home2"></span>Inicio</a></li>
					<li><a href="sidebar-left.php"><span class="icon-folder-open"></span>Administración</a></li>
					<li><a href="sidebar-right.html"><span class="icon-location"></span>¿A donde ir?</a></li>
					<li><a href="visualizacion.php"><span class="icon-eye"></span>Visualización</a></li>
					<li><a href="about.html"><span class="icon-address-book"></span>Nosotros</a></li>
					<li><a href="contact.html"><span class="icon-user"></span>Contacto</a></li>
					<li><a class="btn" href="signin.html">Ingresar / Registrarse</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<!-- Header -->
	<header id="head">
		<div class="container">
			<div class="row">
				<h1 class="lead">IMPRESIONANTE, ADAPTABLE, GRATIS</h1>
				<p class="tagline">PROGRESSUS: plantilla gratuita de arranque de negocios por <a href="http://www.gettemplate.com/?utm_source=progressus&amp;utm_medium=template&amp;utm_campaign=progressus">Obtener Plantilla</a></p>
				<p><a class="btn btn-default btn-lg" role="button">Mas información</a> <a class="btn btn-action btn-lg" role="button">DESCARGAR AHORA</a></p>
			</div>
		</div>
	</header>
	<!-- /Header -->

	<!-- Intro -->
	<div class="container text-center">
		<br> <br>
		<h2 class="thin">¿Necesitas algo?</h2>
		<p class="text-muted">
			Tienes alguna emergencia o necesitas compar algo y no sabes ¿donde ir? puedo ayudar a orientarte<br> 
			Para esto usare el Bus como medio de transporte público.
		</p>
	</div>
	<!-- /Intro-->
		
	<!-- Highlights - jumbotron -->
	<div class="jumbotron top-space">
		<div class="container">
			
			<h3 class="text-center thin">Razones para usar nuestra ayuda</h3>
			
			<div class="row">
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-cogs fa-5"></i>Ubicación precisa</h4></div>
					<div class="h-body text-center">
						<p>Al preguntar a un transeunte por un lugar por lo general hay algo que no logramos entender, es por ello que este servicio es una buena opción; te guia por a tu destino de forma clara y simple.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-flash fa-5"></i>Hospitales</h4></div>
					<div class="h-body text-center">
						<p>Los accidentes son algo que le puede ocurrir a cualquier persona y para ello te ofrecezco la orientación al hospital más cercano.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-heart fa-5"></i>Farmacias</h4></div>
					<div class="h-body text-center">
						<p>Requieres comprar medicamentos y no sabes/recuerdas la dirección de la misma. Te ayudo a encontrar la más cerca a tí.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-smile-o fa-5"></i>Medio de Transporte</h4></div>
					<div class="h-body text-center">
						<p>Para facilitar el servicio se ha incorporado el <strong>BUS</strong> como transporte al mismo tiempo que se considera la economía del usuario.</p>
					</div>
				</div>
			</div> <!-- /row  -->
		
		</div>
	</div>
	<!-- /Highlights -->

	<!-- container -->
	<div class="container">

		<h2 class="text-center top-space">Preguntas frecuentes</h2>
		<br>

		<div class="row">
			<div class="col-sm-6">
				<h3>¿Cómo funciona?</h3>
				<p class="text-justify">Obtenemos tu ubicación actual, seleccionas el hospital/farmacia al que quieres ir; despues te indico cuál ruta de BUS deberás tomar, la parada en la que debes abordar y en la que tendras que quedarte.</p>
			</div>
			<div class="col-sm-6">
				<h3>¿Cuáles son la rutas disponibles?</h3>
				<p class="borde3 fnegro blanco">
				    <?php
                        $miconexion->consulta("select * from RUTAS r");
                        $miconexion->ver();
                        //select TituloRuta, LineaRuta from RUTAS
                    ?>
				</p>
			</div>
		</div> <!-- /row -->

		<div class="row">
			<div class="col-sm-6">
				<h3>¿Que puedo ver?</h3>
				<p class="borde3 fnegro blanco">
					<?php
                        $miconexion->consulta("select * from CATEGORIAS");
                        $miconexion->ver();
                    ?>
				</p>
			</div>
			<div class="col-sm-6">
				<h3>Algunos de centros disponibles</h3>
				<p class="text-justify">
					<?php
                        $miconexion->consulta("select * from CENTROS limit 5");
                        $miconexion->ver();
                    ?>
				</p>
			</div>
		</div> <!-- /row -->

		<div class="jumbotron top-space">
			<h4>Revise la planificación del avance y desarrollo del proyecto en el siguiente enlace.</h4>
     		<p class="text-right"><a href="https://cuidadocercano.sprintground.com/login.php?page=%2Freleaseplanning.php" class="btn btn-primary btn-large">Revisar »</a></p>
  		</div>

</div>	<!-- /container -->
	
	<!-- Social links. @TODO: replace by link/instructions in template -->
	<section id="social">
		<div class="container">
			<div class="wrapper clearfix">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_linkedin_counter"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				</div>
				<!-- AddThis Button END -->
			</div>
		</div>
	</section>
	<!-- /social links -->


	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-3 widget">
						<h3 class="widget-title">Contactos</h3>
						<div class="widget-body">
							<p>+593 98 9873237<br>
								<a href="mailto:#">ceaguirre6@utpl.edu.ec</a><br>
								<br>
								Entre la que cruza y la que pasa.
							</p>	
						</div>
					</div>
					<div class="col-xs-12 col-md-3 widget">
						<h3 class="widget-title">Sígueme</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>
					<div class="col-xs-12 col-md-6 widget">
						<h3 class="widget-title">Proyecto de Ingeniería Web</h3>
						<div class="widget-body">
							<p>Sistema de orientación para localizar Hospitales/Farmacias en caso de requerir de ayuda medica o necesitar adquirir medicamentos. La movilidad está pensada para atender a casos fortuitos de manera que se utilice el transporte público.</p>
						</div>
					</div>
				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">		
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Inicio</a> | 
								<a href="about.html">Nosotros</a> |
								<a href="sidebar-right.html">¿A donde ir?</a> |
								<a href="contact.html">Contactos</a> |
								<b><a href="signup.html">Regístrate</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2018, Cristian Aguirre. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a> 
							</p>
						</div>
					</div>
				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>


	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>