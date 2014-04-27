<?php
	include_once("../class/SQL.php");
	class HandlerIndex{

		private $conexion;

		public function __construct(){
			$this->conexion = new Query();
		}

		public function validateLogin($cedula,$password){
			$campos = array("cedula","password");
			$datos = array($cedula,$password);
			$resultado = $this->conexion->getRowsQuery('persona',$campos,$datos);
			return $resultado;
		}
	}
	if(isset($_POST['opcion'])){
		$handler_index = new HandlerIndex();
		switch ($_POST['opcion']) {
			case 'try_login':
				$user = $handler_index->validateLogin($_POST['cedula'],$_POST['password']);
				if(empty($user)){
					$user[0] = 0;
				}
				$user = $user[0];
				print_r(json_encode($user));
				break;
			default:
				echo "Otra opcion: ".$_POST['opcion'];
				break;
		}
	}

?>