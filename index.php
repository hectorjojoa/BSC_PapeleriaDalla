<!DOCTYPE html>
<html>
<head>
	<title>Papeleria</title>
	<script src="js/jquery-2.1.0.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/estilobanner.css">
	<script type="text/javascript" src="js/index.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- SCRIPTS PARA EL FUNCIONAMIENTO DE LOS INCLUDE -->
		<script type="text/javascript" src="js/persona.js"></script>
		<script type="text/javascript" src="js/producto.js"></script>
		<script type="text/javascript" src="js/indicador.js"></script>
	<!--  FIN  -->

</head>
<body>
	<div class="row">
		<div id ="banner" class="colxs-12">
			<img src="images/banner.jpg" id="img_banner">
		</div>
	</div>
	<div>
		Bienvenido XX ------------------------------ cerrar session
	</div>
	<div class="row" id="container_principal">
		<section class="col-xs-10">
			<article>
				<div id="container">
					sadgafsd
				</div>
			</article>
		</section>
		<aside id="menu" class="col-xs-2">
			<?php
				include_once("view/menu_administrador.php");
			?>
		</aside>
	</div>
	<footer id="pie">
		<h5>Copiright Blancolino 2014</h5>
	</footer>
</body>
</html>