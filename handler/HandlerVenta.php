<?php
	include_once("../class/SQL.php");
	class HandlerVenta{

		private $conexion;

		public function __construct(){
			$this->conexion = new Query();
		}

		public function getAllVenta(){
			return $this->conexion->getTable('venta','id',2);
		}

		//public function getAllPersona(){
			//return $this->conexion->getTable('persona','id',2);
		//}

		public function alterVenta($datos){
			return $this->conexion->runStoredProcedure("SP_AlterVenta",1,$datos);
		}

	}

	if(isset($_POST['opcion'])){
		$handler_venta = new HandlerVenta();
		$datos = null;
		switch ($_POST['opcion']) {
			case 'new_venta':
				$datos = array(1,$_POST['id'],$_POST['id_persona'],$_POST['total'],$_POST['fecha']);
				break;
			case 'edit_venta':
				$datos = array(2,$_POST['id'],$_POST['id_persona'],$_POST['total'],$_POST['fecha']);
				break;
			case 'delete_venta':
				$datos = array(3,$_POST['id'],'0','0','0');
				break;
			default:
				echo "Otra opcion: ".$_POST['opcion'];
				break;
		}

		$a =  $handler_venta->alterVenta($datos);
		var_dump($a);
	}
?>