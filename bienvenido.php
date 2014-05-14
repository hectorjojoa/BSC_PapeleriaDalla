<!--  login -->
<?php
	session_start();
	if(!isset($_SESSION["usuario"])){
		header ("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Papeleria</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/slider.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/datepicker.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/estilobanner.css">
	<script src="js/jquery-2.1.0.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-slider.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/bienvenido.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php
		if($_SESSION["usuario"]["id_rol"] == 1){
			echo '
				<!-- SCRIPTS PARA EL FUNCIONAMIENTO DE LOS INCLUDE CORRESPONDIENTES A ADMINISTRADOR -->
					<script type="text/javascript" src="js/persona.js"></script>
					<script type="text/javascript" src="js/producto.js"></script>
					<script type="text/javascript" src="js/indicador.js"></script>
					<script type="text/javascript" src="js/evaluar.js"></script>
					<script type="text/javascript" src="js/venta.js"></script>
				<!--  FIN  -->';
		}
		
		if($_SESSION["usuario"]["id_rol"] == 2){
			echo '
				<!-- SCRIPTS PARA EL FUNCIONAMIENTO DE LOS INCLUDE CORRESPONDIENTES A EMPLEADO -->
					<script type="text/javascript" src="js/venta.js"></script>
				<!--  FIN  -->';
		}
	?>

</head>
<body background="images/fondo1.jpg">
	<div class="row">
		<div id ="banner" class="col-xs-12">
			<img src="images/banner.jpg" id="img_banner">
		</div>
	</div>
	<div class="row">
		<div class="col-xs-7 col-xs-offset-3">
			<?php
				echo "<h3>Bienvenido: <b>".$_SESSION["usuario"]["nombre"]." ".$_SESSION["usuario"]["apellido"]."</b></h3>";
			?>
		</div>
		<div class="col-xs-2">
			<button  id="salir" name="salir" class="btn btn-danger">Salir</button>
		</div>
	</div>
	<div class="row" id="container_principal">
		<section class="col-xs-10">
			<article>
				<div id="container" >
					<h4>Seleccione una opcion en el menu del lado derecho.</h4>
					<img src="images/reciclaje.png" id="img">
				</div>
			</article>
		</section>
		<aside id="menu" class="col-xs-2">
			<?php
				if($_SESSION["usuario"]["id_rol"] == 1){
					include_once("view/menu_administrador.php");
				}else if($_SESSION["usuario"]["id_rol"] == 2){
					include_once("view/menu_empleado.php");
				}
			?>
		</aside>
	</div>
	<footer id="pie">
		<h5>Gerencia Tecnologica X</h5>
	</footer>
</body>
</html>