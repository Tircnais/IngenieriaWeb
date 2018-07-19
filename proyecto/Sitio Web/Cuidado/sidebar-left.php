<?php
	include("dll/config.php");
	include("dll/mysql.php");
	$miconexion = new DB_mysql;
	$miconexion->conectar("cuidado", "127.0.0.1", "root", "");
    //$miconexion->DB_mysql("cuidado", "127.0.0.1", "root", "");

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Administracción - Loja, Cuidado cercano</title>

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
					<li class="active"><a href="sidebar-left.php"><span class="icon-folder-open"></span>Administración</a></li>
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

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">
		
		<ol class="breadcrumb">
			<li><a href="index.php">Inicio</a></li>
			<li class="active">Administración</li>
		</ol>

		<div class="row">
			<!-- Sidebar -->
			<aside class="col-md-5 sidebar sidebar-left">
				<div class="row widget">
					<div class="col-xs-12">
                        <section class="row">
                            <h1 class="col-xs-8 page-title">Gestión de RUTAS.</h1>
                            <button type='button' class='btn btn-default verde col-xs-4' data-toggle='modal' data-target='#modalRuta'><span class="icon-plus"></span>Agregar</button>
                            <div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalRuta' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title text-center' id='myModalLabel'>Agregar</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <form method='POST' action='dll/crud.php'>
                                                <div class='form-group'>
                                                    <?php
                                                        $miconexion->consulta("select * from Rutas");
                                                        $numcampos = $miconexion->numcampos();
                                                        for($i=1; $i < $numcampos; $i++) {
                                                            $campo = $miconexion->nombrecampo($i);
                                                            $campo = $campo->name;
                                                            echo "<label for='".$campo."'>".ucwords($campo)."</label><input class='form-control input-sm' name='".$campo."' id='".$campo."' /><br>";
                                                        }
                                                    ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-lg-offset-4 text-right">
                                                        <button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='idRuta' value="add" />GUARDAR</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="table-responsive">
                            <?php
                                $miconexion->consulta("select * from rutas");
                                $miconexion->crudRutas();
                            ?>
                        </section>
					</div>
				</div>
				<div class="row widget">
					<div class="col-xs-12">
					    <section class="row">
                            <h1 class="col-xs-8 page-title">Gestión de CATEGORIAS.</h1>
                            <button type='button' class='btn btn-default verde col-xs-4' data-toggle='modal' data-target='#modalCategoria'><span class="icon-plus"></span>Agregar</button>
                            <div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalCategoria' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title text-center' id='myModalLabel'>Agregar</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <form method='POST' action='dll/crud.php'>
                                                <div class='form-group'>
                                                    <?php
                                                        $miconexion->consulta("select * from categorias");
                                                        $numcampos = $miconexion->numcampos();
                                                        for($i=1; $i < $numcampos; $i++) {
                                                            $campo = $miconexion->nombrecampo($i);
                                                            $campo = $campo->name;
                                                            echo "<label for='".$campo."'>".ucwords($campo)."</label><input class='form-control input-sm' name='".$campo."' id='".$campo."' /><br>";
                                                        }
                                                    ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-lg-offset-4 text-right">
                                                        <button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='uid' value="add" />GUARDAR</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="table-responsive">
                            <?php
                                $miconexion->consulta("select * from categorias");
                                $miconexion->crudCategorias();
                            ?>
                        </section>
					</div>
				</div>
			</aside>
			<!-- /Sidebar -->

			<!-- Article main content -->
			<article class="col-md-7 maincontent">
                <div class="row">
                    <div class="col-xs-12">
                        <section class="row">
                            <h1 class="col-xs-8 page-title">Gestión de usuarios.</h1>
                            <button type='button' class='btn btn-default verde col-xs-4' data-toggle='modal' data-target='#modalUsuario'><span class="icon-plus"></span>Agregar</button>
                            <div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalUsuario' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title text-center' id='myModalLabel'>Agregar</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <form method='POST' action='dll/crud.php'>
                                                <div class='form-group'>
                                                    <?php
                                                        $miconexion->consulta("select * from usuarios");
                                                        $numcampos = $miconexion->numcampos();
                                                        for($i=1; $i < $numcampos; $i++) {
                                                            $campo = $miconexion->nombrecampo($i);
                                                            $campo = $campo->name;
                                                            echo "<label for='".$campo."'>".ucwords($campo)."</label><input class='form-control input-sm' name='".$campo."' id='".$campo."' /><br>";
                                                        }
                                                    ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-lg-offset-4 text-right">
                                                        <button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='uid' value="add" />GUARDAR</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="table-responsive">
                            <?php
                                $miconexion->consulta("select * from usuarios");
                                $miconexion->crudUsuarios();
                            ?>
                        </section>
                    </div>
                    <section class="row">
                        <h1 class="col-xs-8 page-title">Gestión de CENTROS.</h1>
                        <button type='button' class='btn btn-default verde col-xs-4' data-toggle='modal' data-target='#modalCentros'><span class="icon-plus"></span>Agregar</button>
                        <div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalCentros' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <h4 class='modal-title text-center' id='myModalLabel'>Agregar</h4>
                                    </div>
                                    <div class='modal-body'>
                                        <form method='POST' action='dll/crud.php'>
                                            <div class='form-group'>
                                                <?php
                                                    $miconexion->consulta("select * from Centros");
                                                    $numcampos = $miconexion->numcampos();
                                                    for($i=1; $i < $numcampos; $i++) {
                                                        $campo = $miconexion->nombrecampo($i);
                                                        $campo = $campo->name;
                                                        echo "<label for='".$campo."'>".ucwords($campo)."</label><input class='form-control input-sm' name='".$campo."' id='".$campo."' /><br>";
                                                    }
                                                ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-lg-offset-4 text-right">
                                                    <button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='idCentro' value="add" />GUARDAR</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="table-responsive">
                        <?php
                            $miconexion->consulta("select * from centros");
                            $miconexion->crudCentros();
                        ?>
                    </section>
                    <section class="row">
                        <h1 class="col-xs-8 page-title">Gestión de PARADAS.</h1>
                        <button type='button' class='btn btn-default verde col-xs-4' data-toggle='modal' data-target='#modalParadas'><span class="icon-plus"></span>Agregar</button>
                        <div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalParadas' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <h4 class='modal-title text-center' id='myModalLabel'>Agregar</h4>
                                    </div>
                                    <div class='modal-body'>
                                        <form method='POST' action='dll/crud.php'>
                                            <div class='form-group'>
                                                <?php
                                                    $miconexion->consulta("select * from Paradas");
                                                    $numcampos = $miconexion->numcampos();
                                                    for($i=1; $i < $numcampos; $i++) {
                                                        $campo = $miconexion->nombrecampo($i);
                                                        $campo = $campo->name;
                                                        echo "<label for='".$campo."'>".ucwords($campo)."</label><input class='form-control input-sm' name='".$campo."' id='".$campo."' /><br>";
                                                    }
                                                ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-lg-offset-4 text-right">
                                                    <button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='idParada' value="add" />GUARDAR</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="table-responsive">
                        <?php
                            $miconexion->consulta("select * from paradas");
                            //select r.TituloRuta, p.latitud, p.latitud from paradas p, rutas r WHERE p.idRuta=r.idRuta;
                            $miconexion->crudParadas();
                        ?>
                    </section>
				    <blockquote>Tenga presente qque cualquier cambio no realizado correctamente puede volcarse en un mal funcionamiento del sistema de orientación.</blockquote>
				</div>
			</article>
			<!-- /Article -->

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
								<a href="contact.html">Contactos</a> |
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
	<!-- MIS acciones -->
	<script type="text/javascript" src="assets/js/acciones.js"></script>
</body>
</html>