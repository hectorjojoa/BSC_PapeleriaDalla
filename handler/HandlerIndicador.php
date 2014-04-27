<?php
	include_once("../class/SQL.php");
	class HandlerIndicador{

		private $conexion;

		public function __construct(){
			$this->conexion = new Query();
		}

		public function getAllIndicador(){
			return $this->conexion->getTable('indicador','id',2);
		}

		public function alterIndicador($datos){
			return $this->conexion->runStoredProcedure("SP_AlterIndicador",1,$datos);
		}

	}

	if(isset($_POST['opcion'])){
		$handler_indicador = new HandlerIndicador();
		$datos = null;
		switch ($_POST['opcion']) {
			case 'new_indicador':
				$datos = array(1,$_POST['id'],$_POST['descripcion'],$_POST['valor_esperado']);
				break;
			case 'edit_indicador':
				$datos = array(2,$_POST['id'],$_POST['descripcion'],$_POST['valor_esperado']);
				break;
			case 'delete_indicador':
				$datos = array(3,$_POST['id'],'0','0');
				break;
			default:
				echo "Otra opcion: ".$_POST['opcion'];
				break;
		}

		$a =  $handler_indicador->alterIndicador($datos);
		var_dump($a);
	}
?>