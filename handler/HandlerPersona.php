<?php
	include_once("../class/SQL.php");
	class HandlerPersona{

		private $conexion;

		public function __construct(){
			$this->conexion = new Query();
		}

		public function getAllPerson(){
			return $this->conexion->getTable('persona','nombre',2);
		}

		public function getAllRol(){
			return $this->conexion->getTable('rol','id',2);
		}

		public function alterPersona($datos){
			return $this->conexion->runStoredProcedure("SP_AlterPersona",1,$datos);
		}

	}

	if(isset($_POST['opcion'])){
		$handler_persona = new HandlerPersona();
		$datos = null;
		switch ($_POST['opcion']) {
			case 'new_persona':
				$datos = array(1,$_POST['cedula'],$_POST['nombre'],$_POST['apellido'],$_POST['fecha_nac'],$_POST['telefono'],$_POST['id_rol']);
				break;
			case 'edit_persona':
				$datos = array(2,$_POST['cedula'],$_POST['nombre'],$_POST['apellido'],$_POST['fecha_nac'],$_POST['telefono'],$_POST['id_rol']);
				break;
			case 'delete_persona':
				$datos = array(3,$_POST['cedula'],'0','0','0','0',2);
				break;
			default:
				echo "Otra opcion: ".$_POST['opcion'];
				break;
		}

		$a =  $handler_persona->alterPersona($datos);
		var_dump($a);
	}
?>