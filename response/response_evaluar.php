<?php
	include_once('../handler/HandlerEvaluar.php');
	$handler_evaluar = new HandlerEvaluar();

	function getAllPanel(){
		$return = "
			<div style='padding:8px;'>
				<div class='row'>
					<h4 class='col-xs-5'>Seleccione una opción segun la siguiente fecha: </h4>
					<div class='col-xs-5'>
						<input type='text' name='fecha_indicador' id='fecha_indicador' placeholder='Fecha' class='form-control datepicker' />
					</div>
				</div>
				<ul id='tab_menu_evaluar' class='nav nav-tabs'>
					<li class='active'><a href='#indicador' data-toggle='tab'>Por Indicador</a></li>
					<li><a href='#persona' data-toggle='tab'>Por persona</a></li>
				</ul>
				<div id='tab_evaluar' class='tab-content'>
					<div class='tab-pane fade in active' id='indicador'>
						<div class='row'>
							<label for='select_indicador' class='col-xs-4 col-xs-offset-2'>Seleccione un indicador: </label>
							<div class='col-xs-5'>".getSelectIndicador()."</div>
						</div>
						<div class='row'>
							<div class='col-xs-12' id='evaluar_persona'>
								<p>personas que se evauaran segun el indicador seleccionado</p>
							</div>
						</div>
					</div>
					<div class='tab-pane fade' id='persona'>
						<div class='row'>
							<label for='select_persona' class='col-xs-4 col-xs-offset-2'>Seleccione una persona: </label>
							<div class='col-xs-5'>".getSelectPersona()."</div>
						</div>
						<div class='row'>
							<div class='col-xs-12' id='evaluar_indicador'>
								<p>indicadores que se evauaran segun la persona seleccionada</p>
							</div>
						</div>
					</div>
				</div>
			</div>";
		return $return;
	}

	function getSelectIndicador(){
		global $handler_evaluar;
		$indicador = $handler_evaluar->getIndicador();
		$return = "<select id='select_indicador' class='form-control'>";
			$return .= "<option value='-1'>Seleccione</option>";
		for($i = 0; $i < sizeof($indicador); $i++){
			$return .= "<option value='".$indicador[$i]["id"]."' data-valor-esperado='".$indicador[$i]['valor_esperado']."'>".$indicador[$i]["descripcion"]."</option>";
		}
		$return .="</select>";
		return $return;
	}

	function getSelectPersona(){
		global $handler_evaluar;
		$persona = $handler_evaluar->getPersona();
		$return = "<select id='select_persona' class='form-control'>";
			$return .= "<option value='-1'>Seleccione</option>";
		for($i = 0; $i < sizeof($persona); $i++){
			$return .= "<option value='".$persona[$i]["cedula"]."'>
							".$persona[$i]["apellido"]." ".$persona[$i]["nombre"]."
						</option>";
		}
		$return .="</select>";
		return $return;
	}

	function getPersonByIndicadorFecha($id_indicador,$fecha){
		global $handler_evaluar;
		$persona = $handler_evaluar->getPersonByIndicadorFecha($id_indicador,$fecha);
		$return = "<table class='table'>";
			$return .= "
			<tr>
				<th>Cedula</th>
				<th>Nombre</th>
				<th>Indicador</th>
			</tr>";
		for($i = 0; $i < sizeof($persona); $i++){
			$return .= "
			<tr>
				<td>".$persona[$i]['cedula']."</td>
				<td>".$persona[$i]['nombre_persona']."</td>
				<td>
					<input type='text' data-cedula='".$persona[$i]["cedula"]."' class= 'slider' value='".$persona[$i]['valor_obtenido']."' data-accion='".((empty($persona[$i]["valor_obtenido"])?"i":"u"))."' />
				</td>
			</tr>";
		}
		$return .= "</table>";
		return $return;
	}

	function getIndicadorByPersonaFecha($cedula,$fecha){
		global $handler_evaluar;
		$indicador = $handler_evaluar->getIndicadorByPersonaFecha($cedula,$fecha);
		$return = "<table class='table'>";
			$return .= "
			<tr>
				<th>Id Indicador</th>
				<th>Descripcion</th>
				<th>Indicador</th>
			</tr>";
		for ($i=0; $i <sizeof($indicador) ; $i++) { 
			$return .= "
			<tr>
				<td>".$indicador[$i]['id_indicador']."</td>
				<td>".$indicador[$i]['descripcion']."</td>
				<td>
					<input type='text' data-indicador='".$indicador[$i]['id_indicador']."' class='slider' value='".$indicador[$i]['valor_obtenido']."' data-accion='".((empty($indicador[$i]['valor_obtenido'])?"i":"u"))."' />
				</td>
			</tr>";
		}
		$return .= "</table>";
		return $return;
	}

	function saveIndicadorPersona($accion,$id_indicador,$cedula,$fecha,$valor_obtenido){
		global $handler_evaluar;
		$datos = array($accion,$id_indicador,$cedula,$fecha,$valor_obtenido);
		return $handler_evaluar->saveIndicadorPersona($datos);
	}

	if (isset($_REQUEST['opcion'])){
		switch ($_REQUEST['opcion']) {
			case 'getAllPanel':
				echo getAllPanel();
				break;
			case 'loadPersonByIndicadorFecha':
				echo getPersonByIndicadorFecha($_REQUEST['id_indicador'],$_REQUEST['fecha']);
				break;
			case 'getIndicadorByPersonaFecha':
				echo getIndicadorByPersonaFecha($_REQUEST['cedula'],$_REQUEST['fecha']);
				break;
			case 'saveIndicadorPersona':
				echo saveIndicadorPersona($_REQUEST["accion"],$_REQUEST["id_indicador"],$_REQUEST["cedula"],$_REQUEST["fecha"],$_REQUEST["valor_obtenido"]);
				break;
			default:
				echo "Bienvenido a la seccion de administrar indicador";
				break;
		}
	}
?>