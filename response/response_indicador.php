<?php
	include_once("../handler/HandlerIndicador.php");
	$handler_indicador = new HandlerIndicador();
	function getAllIndicador(){
		global $handler_indicador;
		$return = "";
		$dato = $handler_indicador->getAllIndicador();
		$return .= "<table class='table'>
			<tr>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Puntaje esperado</th>
				<th>Opciones</th>
			</tr>";
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<tr>
				<td><input type='number' class='form-control' id='id_".$dato[$i]['id']."' name='id' value='".$dato[$i]['id']."' disabled='disabled' /></td>
				<td><input type='text' class='form-control' id='descripcion_".$dato[$i]['id']."' name='descripcion' value='".$dato[$i]['descripcion']."' disabled='disabled' /></td>
				<td><input type='number' class='form-control' id='valor_esperado_".$dato[$i]['id']."' name='valor_esperado' value='".$dato[$i]['valor_esperado']."' disabled='disabled' /></td>
				<td>
					<button data-indicador-edit='".$dato[$i]['id']."' class='btn-success'>
						<span class='glyphicon glyphicon-pencil'></span>
					</button>
					<button data-indicador-delete='".$dato[$i]['id']."' class='btn-danger'>
						<span class='glyphicon glyphicon-remove'></span>
					</button>
				</td>
			</tr>";
		}
		$return .= "</table>";
		$return .= "<button type='button' id='mostrar_crear_indicador' class='btn-primary'>
				<span class='glyphicon glyphicon-fire'></span>
					Crear indicador
				<span class='glyphicon glyphicon-arrow-down' id='span_opcion_crear_indicador'></span>
			</button>
			<div id='new_indicador_campos' data-estado='no_visible' style='display: none;'>
				<table class='table'>
					<tr>
						<td><input type='number' name='id' id='id' placeholder='Id' class='form-control'/></td>
						<td><input type='text' name='descripcion' id='descripcion' placeholder='Descripcion' class='form-control'/></td>
						<td><input type='number' name='valor_esperado' id='valor_esperado' placeholder='valor_esperado' class='form-control'/></td>
						<td><button id='save_new_indicador' class='btn-success'>Guardar</button></td>
					</tr>
				</table>
			</div>";
		return $return;
	}

	if (isset($_REQUEST['opcion'])){
		switch ($_REQUEST['opcion']) {
			case 'getAllIndicador':
				echo getAllIndicador();
				break;
			default:
				echo "Bienvenido a la seccion de administrar indicador";
				break;
		}
	}
?>