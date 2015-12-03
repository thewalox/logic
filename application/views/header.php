<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo $titulo; ?></title>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-fileinput.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jasny-bootstrap.min.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sub-menus.css" media="screen">

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/number-format.js"></script>

</head>
<body>
	
	<header>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
						<span class="sr-only">Desplegar / Ocultar Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo base_url(); ?>home" class="navbar-brand">Logistica <?php echo $this->session->userdata('sess_empresa'); ?></a>
				</div>
				<div class="collapse navbar-collapse" id="menu">
					<ul class="nav navbar-nav">
						<li class="active"><a href="<?php echo base_url(); ?>home">Inicio</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tarifas <span class="caret"></span></a>
							<ul class="dropdown-menu">
					            <li><a href="<?php echo base_url(); ?>tarifas/form_crear">Crear Tarifa</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="<?php echo base_url(); ?>tarifas/form_buscar">Editar Tarifa</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="<?php echo base_url(); ?>tarifas/form_importar_lote">Importar Tarifas en Lote</a></li>
				          	</ul>				
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transportadores <span class="caret"></span></a>
							<ul class="dropdown-menu">
					            <li><a href="<?php echo base_url(); ?>transportadores/form_crear">Crear Transportador</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="<?php echo base_url(); ?>transportadores/form_buscar">Editar Transportador</a></li>
				          	</ul>				
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Servicios <span class="caret"></span></a>
							<ul class="dropdown-menu">
					            <li><a href="<?php echo base_url(); ?>servicios/form_crear">Crear Servicio</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="<?php echo base_url(); ?>servicios/form_buscar">Editar Servicio</a></li>
				          	</ul>				
						</li>
						<li class="menu-item dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestion de Facturacion <span class="caret"></span></a>
							<ul class="dropdown-menu">
					            <li><a href="<?php echo base_url(); ?>gestion/form_importar">Importar Facturacion SAP</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="<?php echo base_url(); ?>gestion/form_buscar">Registro de facturas y entregas</a></li>
					            <li role="separator" class="divider"></li>
					           	<li class="menu-item dropdown dropdown-submenu">
		                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas</a>
		                            <ul class="dropdown-menu">
		                                <li class="menu-item "><a href="<?php echo base_url(); ?>consultas/form_consulta_factura">Facturas y Entregas</a></li>
		                            </ul>
	                        	</li>
				          	</ul>				
						</li>

						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('sess_name_user'); ?><span class="caret"></span></a>
							<ul class="dropdown-menu">
					            <li><a href="<?php echo base_url(); ?>login/logout"><strong>Cerrar Sesion </strong><span class="glyphicon glyphicon-off"></span></a></li>
				          	</ul>				
						</li>
      				</ul>
				</div>
			</div>
		</nav>
	</header>