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
</head>
<body>
	<div class="row">
		<div id ="banner" class="col-xs-12">
			<img src="images/banner.jpg" id="img_banner">
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<form id="form_login" class="form-horizontal" action="bienvenido.php" method="POST">
				<fieldset>
				<legend>Login</legend>
				<div class="form-group">
					<label class="col-xs-4 control-label" for="textinput">Cedula</label>  
					<div class="col-xs-4">
						<input id="cedula" name="cedula" placeholder="Cedula" class="form-control input-xs" required="" type="text">
						<span class="help-block">Ingrese su cedula</span>  
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-4 control-label" for="password">Password</label>
					<div class="col-xs-4">
						<input id="password" name="password" placeholder="Password" class="form-control input-xs" required="" type="password">
						<span class="help-block">Ingrese su password</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-4 control-label" for="entrar"></label>
					<div class="col-xs-4">
						<button id="entrar" name="entrar" class="btn btn-primary">Entrar</button>
					</div>
				</div>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>