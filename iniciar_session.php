<?php
	session_start();
	$_SESSION["usuario"]["cedula"] = $_POST["cedula"];
	$_SESSION["usuario"]["nombre"] = $_POST["nombre"];
	$_SESSION["usuario"]["apellido"] = $_POST["apellido"];
	$_SESSION["usuario"]["id_rol"] = $_POST["id_rol"];
?>