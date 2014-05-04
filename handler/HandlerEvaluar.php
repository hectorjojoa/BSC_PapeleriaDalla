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
	}
?>