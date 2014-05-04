<?php
	include_once("../class/SQL.php");
	include_once("HandlerIndicador.php");
	include_once("HandlerPersona.php");

	class HandlerEvaluar{

		private $conexion,
				$handler_indicador,
				$handler_persona;

		public function __construct(){
			$this->conexion = new Query();
			$this->handler_indicador = new HandlerIndicador();
			$this->handler_persona = new HandlerPersona();
		}

		public function getIndicador(){
			return $this->handler_indicador->getAllIndicador();
		}

		public function getPersona(){
			return $this->handler_persona->getAllPerson();
		}

		public function getPersonByIndicador($id_indicador){
			$query = "	SELECT P.cedula,CONCAT(P.apellido,' ',P.nombre)AS 'nombre_persona',IP.valor_obtenido
					  	FROM persona P
							LEFT JOIN indicadorpersona IP ON P.cedula = IP.id_persona AND IP.id_indicador = $id_indicador";

			return $this->conexion->runQuery($query);
		}
	}
?>