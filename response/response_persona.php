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
				<th>Rol</th>
				<th>Opciones</th>
			</tr>";
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<tr>
				<td><input maxlength='10' type='number' class='form-control' id='cedula_".$dato[$i]['cedula']."' name='cedula' value='".$dato[$i]['cedula']."' disabled='disabled' /></td>
				<td><input maxlength='10' type='text' class='form-control' id='nombre_".$dato[$i]['cedula']."' name='nombre' value='".$dato[$i]['nombre']."' disabled='disabled' /></td>
				<td><input maxlength='10' type='text' class='form-control' id='apellido_".$dato[$i]['cedula']."' name='apellido' value='".$dato[$i]['apellido']."' disabled='disabled' /></td>
				<td><input maxlength='10' type='text' class='form-control datepicker' id='fecha_nac_".$dato[$i]['cedula']."' name='fecha_nac' value='".$dato[$i]['fecha_nac']."' disabled='disabled' /></td>
				<td><input maxlength='10' type='text' class='form-control' id='telefono_".$dato[$i]['cedula']."' name='telefono' value='".$dato[$i]['telefono']."' disabled='disabled' /></td>
				<td>".getRolPersona($dato[$i]['id_rol'],$dato[$i]['cedula'])."</td>
				<td>
					<button data-persona-edit='".$dato[$i]['cedula']."' class='btn-success'>
						<span class='glyphicon glyphicon glyphicon glyphicon-pencil'></span>
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
			<div id='new_persona_campos' data-estado='no_visible' style='display: none;'>
				<table class='table'>
					<tr>
						<td><input maxlength='10' type='number' name='cedula' id='cedula' placeholder='Cedula' class='form-control'/></td>
						<td><input maxlength='10' type='text' name='nombre' id='nombre' placeholder='Nombre' class='form-control'/></td>
						<td><input maxlength='10' type='text' name='apellido' id='apellido' placeholder='Apellido' class='form-control'/></td>
						<td><input maxlength='10' type='text' name='fecha_nac' id='fecha_nac' placeholder='Fecha De Nacimiento' class='form-control datepicker'/></td>
						<td><input maxlength='10' type='number' name='telefono' id='telefono' placeholder='Telefono' class='form-control'/></td>
						<td>".getRolPersona(0,0)."</td>
						<td><button id='save_new_persona' class='btn-success'>Guardar</button></td>
					</tr>
				</table>
			</div>";
		return $return;
	}

	function getRolPersona($id_rol,$cedula){
		global $handler_persona;
		if($id_rol == 0){
			$return = "<select id='id_rol' name='id_rol' class='form-control'>";
		}else{
			$return = "<select id='id_rol_".$cedula."' name='id_rol_".$cedula."' class='form-control' disabled='disabled'>";
		}
		$dato = $handler_persona->getAllRol();
		for($i = 0; $i < sizeof($dato); $i++){
			$return .= "<option value='".$dato[$i]['id']."' ".(($dato[$i]['id'] == $id_rol)?"selected":" ").">".$dato[$i]['descripcion']."</option>";
		}
		$return .= "</select>";
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