<?php
	include_once("../class/SQL.php");
	class HandlerProducto{

		private $conexion;

		public function __construct(){
			$this->conexion = new Query();
		}

		public function getAllProduct(){
			return $this->conexion->getTable('producto','id',2);
		}

		public function alterProduct($datos){
			return $this->conexion->runStoredProcedure("SP_AlterProducto",1,$datos);
		}

	}

	if(isset($_POST['opcion'])){
		$handler_producto = new HandlerProducto();
		$datos = null;
		switch ($_POST['opcion']) {
			case 'new_producto':
				$datos = array(1,$_POST['id'],$_POST['descripcion'],$_POST['precio'],$_POST['id_categoria']);
				break;
			case 'edit_producto':
				$datos = array(2,$_POST['id'],$_POST['descripcion'],$_POST['precio'],$_POST['id_categoria']);
				break;
			case 'delete_producto':
				$datos = array(3,$_POST['id'],'0','0','0');
				break;
			default:
				echo "Otra opcion: ".$_POST['opcion'];
				break;
		}

		$a =  $handler_producto->alterProducto($datos);
		var_dump($a);
	}
?>