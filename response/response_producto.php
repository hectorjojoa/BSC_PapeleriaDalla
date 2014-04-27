<?php
	include_once("../handler/HandlerProducto.php");
	$handler_producto = new HandlerProducto();
	function getAllProducto(){
		global $handler_producto;
		$return = "";
		$dato = $handler_producto->getAllProduct();
		$return .= "<table class='table'>
			<tr>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Precio</th>
				<th>Codigo Categoria</th>
				<th>Opciones</th>
			</tr>";
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<tr>
				<td><input type='number' class='form-control' id='id_".$dato[$i]['id']."' name='id' value='".$dato[$i]['id']."' disabled='disabled' /></td>
				<td><input type='text' class='form-control' id='descripcion_".$dato[$i]['id']."' name='descripcion' value='".$dato[$i]['descripcion']."' disabled='disabled' /></td>
				<td><input type='number' class='form-control' id='precio_".$dato[$i]['id']."' name='precio' value='".$dato[$i]['precio']."' disabled='disabled' /></td>
				<td><input type='number' class='form-control' id='id_categoria_".$dato[$i]['id']."' name='precio' value='".$dato[$i]['precio']."' disabled='disabled' /></td>
				
				<td>
					<button data-producto-edit='".$dato[$i]['id']."' class='btn-success'>
						<span class='glyphicon glyphicon-pencil'></span>
					</button>
					<button data-producto-delete='".$dato[$i]['id']."' class='btn-danger'>
						<span class='glyphicon glyphicon-remove'></span>
					</button>
				</td>
			</tr>";
		}
		$return .= "</table>";
		$return .= "<button type='button' id='mostrar_crear_producto' class='btn-primary'>
					<span class='glyphicon glyphicon-gift'></span>
						Ingresar Producto
					<span class='glyphicon glyphicon-arrow-down' id='span_opcion_crear_producto'></span>
				</button>
				<div id='new_producto_campos' data-estado='no_visible'>
					<input type='number' name='id' id='id' placeholder='id'/>
					<input type='text' name='descripcion' id='descripcion' placeholder='descripcion'/>
					<input type='number' name='precio' id='precio' placeholder='precio'/>
					<input type='number' name='id_categoria' id='id_categoria' placeholder='id_categoria'/>
					<button id='save_new_producto'>Guardar</button>
				</div>";
		return $return;
	}

	if (isset($_REQUEST['opcion'])){
		switch ($_REQUEST['opcion']) {
			case 'getAllProduct':
				echo getAllProducto();
				break;
			default:
				echo "Bienvenido a la seccion de administrar producto";
				break;
		}
	}
?>