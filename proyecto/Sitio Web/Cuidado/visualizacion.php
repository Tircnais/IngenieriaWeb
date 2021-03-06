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
	
	<title>Visualización - Loja, Cuidado cercano</title>

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

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php"><span class="icon-home2"></span>Inicio</a></li>
					<li><a href="sidebar-left.php"><span class="icon-folder-open"></span>Administración</a></li>
					<li><a href="sidebar-right.html"><span class="icon-location"></span>¿A donde ir?</a></li>
					<li class="active"><a href="#"><span class="icon-eye"></span>Visualización</a></li>
					<li><a href="about.html"><span class="icon-address-book"></span>Nosotros</a></li>
					<li><a href="contact.html"><span class="icon-user"></span>Contacto</a></li>
					<li><a class="btn" href="signin.html">Ingresar / Registrarse</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Inicio</a></li>
			<li class="active">Visualización</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-md-8 maincontent">
				<header class="page-header">
				    <h1 class="page-title">Centros.</h1>
				</header>
				<p>
                    <?php
                        $miconexion->consulta("select nombre, Direccion, Latitud, Longitud from CENTROS");
                        $miconexion->verconsulta();
                    ?>
                </p>
				<h2>Paradas</h2>
				<p>
				    <?php
                        $miconexion->consulta("select * from Paradas");
                        $miconexion->verconsulta();
                        //select r.TituloRuta, p.latitud, p.latitud from paradas p, rutas r WHERE p.idRuta=r.idRuta
                    ?>
				</p>
				<blockquote>Si desea realizar cambios dirijase a la administracción del Sitio.</blockquote>
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-md-4 sidebar sidebar-right">
				<div class="row widget">
					<div class="col-xs-12">
						<h4>USUARIOS</h4>
                            <?php
                                $miconexion->consulta("select nombre, apellido, usuario, correo from USUARIOS u");
                                $miconexion->verconsulta();
                            ?>
					</div>
				</div>
				<div class="row widget">
					<div class="col-xs-12">
						<h4>CATEGORIAS</h4>
						<p>
                            <?php
                                $miconexion->consulta("select * from CATEGORIAS");
                                $miconexion->verconsulta();
                                //select Nombre from CATEGORIAS
                            ?>
                        </p>
					</div>
				</div>
				<div class="row widget">
					<div class="col-xs-12">
						<h4>RUTAS</h4>
						<p>
                            <?php
                                $miconexion->consulta("select * from RUTAS");
                                $miconexion->verconsulta();
                                //select TituloRuta, LineaRuta from RUTAS
                            ?>
                        </p>
					</div>
				</div>
			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	

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
								<a href="index.php">Inicio</a> | 
								<a href="about.html">Nosotros</a> |
								<a href="sidebar-right.html">¿A donde ir?</a> |
								<a href="contact.html">Contacto</a> |
								<b><a href="signup.html">Registrate</a></b>
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