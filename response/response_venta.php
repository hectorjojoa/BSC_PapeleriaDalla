<?php
	include_once("../handler/HandlerVenta.php");
	$handler_venta = new HandlerVenta();
	function getAllVenta(){
		global $handler_venta;
		$return = "";
		$dato = $handler_venta->getAllVenta();
		$return .= "<table class='table'>
			<tr>
				<th>Codigo de venta</th>
				<th>codigo empleado</th>
				<th>Total</th>
				<th>Fecha</th>
				<th>Opciones</th>
			</tr>";
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<tr>
				<td><input maxlength='10' type='number' class='form-control' id='id_".$dato[$i]['id']."' name='id' value='".$dato[$i]['id']."' disabled='disabled' /></td>
				<td><input maxlength='10' type='number' class='form-control' id='id_personal_".$dato[$i]['id']."' name='id_persona' value='".$dato[$i]['id_persona']."' disabled='disabled' /></td>
				<td><input maxlength='10' type='number' class='form-control' id='total_".$dato[$i]['id']."' name='total' value='".$dato[$i]['total']."' disabled='disabled' /></td>
				<td><input maxlength='10' type='text' class='form-control datepicker' id='fecha_".$dato[$i]['id']."' name='fecha' value='".$dato[$i]['fecha']."' disabled='disabled' /></td>
				
				<td>
					<button data-venta-edit='".$dato[$i]['id']."' class='btn-success'>
						<span class='glyphicon glyphicon-pencil'></span>
					</button>
					<button data-venta-delete='".$dato[$i]['id']."' class='btn-danger'>
						<span class='glyphicon glyphicon-remove'></span>
					</button>
				</td>
			</tr>";
		}
		$return .= "</table>";
		$return .= "<button type='button' id='mostrar_crear_venta' class='btn-primary'>
					<span class='glyphicon glyphicon-gift'></span>
						Ingresar venta
					<span class='glyphicon glyphicon-arrow-down' id='span_opcion_crear_venta'></span>
				</button>
				<div id='new_venta_campos' data-estado='no_visible' style='display: none;'>
					<table class='table'>
						<tr>
							<td><input maxlength='10' type='number' name='id' id='id' placeholder='Id' class='form-control'/></td>
							<td><input maxlength='10' type='number name='id' id='id_persona' placeholder='cedula del empleado' class='form-control'/></td>
							<td><input maxlength='10' type='number' name='total' id='total' placeholder='total' class='form-control'/></td>
							<td><input maxlength='10' type='date' name='fecha' id='fecha' placeholder='fecha' class='form-control'/></td>
							<td><button id='save_new_venta' class='btn-success'>Guardar</button></td>
						</tr>
					</table>
				</div>";
		return $return;
	}

	/*function getIdPersona($id,$id_persona){
		global $handler_venta;
		if($id == 0){
			$return = "<select id='id_persona' name='id_persona' class='form-control'>";
		}else{
			$return = "<select id='id_persona_".$id."' name='id_persona_".$id."' class='form-control' disabled='disabled'>";
		}
		$dato = $handler_venta->getAllPersona();
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<option value='".$dato[$i]['id']."' ".(($dato[$i]['id'] == $id_persona)?"selected":" ").">".$dato[$i]['cedula']."</option>";
		}
		$return .= "</select>";
		return $return;
	}*/

	if (isset($_REQUEST['opcion'])){
		switch ($_REQUEST['opcion']) {
			case 'getAllVenta':
				echo getAllVenta();
				break;
			default:
				echo "Bienvenido a la seccion de administrar venta";
				break;
		}
	}
?>