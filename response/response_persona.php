<?php
	include_once("../handler/HandlerPersona.php");
	$handler_persona = new HandlerPersona();
	function getAllPerson(){
		global $handler_persona;
		$return = "";
		$dato = $handler_persona->getAllPerson();
		$return .= "<table class='table'>
			<tr>
				<th>Cedula</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Fecha Nacimiento</th>
				<th>Telefono</th>
				<th>Opciones</th>
			</tr>";
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<tr>
				<td><input type='number' class='form-control' id='cedula_".$dato[$i]['cedula']."' name='cedula' value='".$dato[$i]['cedula']."' disabled='disabled' /></td>
				<td><input type='text' class='form-control' id='nombre_".$dato[$i]['cedula']."' name='nombre' value='".$dato[$i]['nombre']."' disabled='disabled' /></td>
				<td><input type='text' class='form-control' id='apellido_".$dato[$i]['cedula']."' name='apellido' value='".$dato[$i]['apellido']."' disabled='disabled' /></td>
				<td><input type='date' class='form-control' id='fecha_nac_".$dato[$i]['cedula']."' name='fecha_nac' value='".$dato[$i]['fecha_nac']."' disabled='disabled' /></td>
				<td><input type='text' class='form-control' id='telefono_".$dato[$i]['cedula']."' name='telefono' value='".$dato[$i]['telefono']."' disabled='disabled' /></td>
				<td>
					<button data-persona-edit='".$dato[$i]['cedula']."' class='btn-success'>
						<span class='glyphicon glyphicon-pencil'></span>
					</button>
					<button data-persona-delete='".$dato[$i]['cedula']."' class='btn-danger'>
						<span class='glyphicon glyphicon-remove'></span>
					</button>
				</td>
			</tr>";
		}
		$return .= "</table>";
		$return .= "<button type='button' id='mostrar_crear_persona' class='btn-primary'>
				<span class='glyphicon glyphicon-user'></span>
					Crear Emplado
				<span class='glyphicon glyphicon-arrow-down' id='span_opcion_crear_persona'></span>
			</button>
			<div id='new_persona_campos' data-estado='no_visible'>
				<input type='number' name='cedula' id='cedula' placeholder='cedula'/>
				<input type='text' name='nombre' id='nombre' placeholder='nombre'/>
				<input type='text' name='apellido' id='apellido' placeholder='apellido'/>
				<input type='date' name='fecha_nac' id='fecha_nac' placeholder='fecha_nacimiento'/>
				<input type='number' name='telefono' id='telefono' placeholder='telefono'/>
				<button id='save_new_persona'>Guardar</button>
			</div>";
		return $return;
	}

	if (isset($_REQUEST['opcion'])){
		switch ($_REQUEST['opcion']) {
			case 'getAllPerson':
				echo getAllPerson();
				break;
			default:
				echo "Bienvenido a la seccion de administrar persona";
				break;
		}
	}
?>