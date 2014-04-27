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
				<th>Categoria</th>
				<th>Opciones</th>
			</tr>";
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<tr>
				<td><input type='number' class='form-control' id='id_".$dato[$i]['id']."' name='id' value='".$dato[$i]['id']."' disabled='disabled' /></td>
				<td><input type='text' class='form-control' id='descripcion_".$dato[$i]['id']."' name='descripcion' value='".$dato[$i]['descripcion']."' disabled='disabled' /></td>
				<td><input type='number' class='form-control' id='precio_".$dato[$i]['id']."' name='precio' value='".$dato[$i]['precio']."' disabled='disabled' /></td>
				<td>".getCategoriaProducto($dato[$i]['id'],$dato[$i]['id_categoria'])."</td>
				
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
				<div id='new_producto_campos' data-estado='no_visible' style='display: none;'>
					<table class='table'>
						<tr>
							<td><input type='number' name='id' id='id' placeholder='Id' class='form-control'/></td>
							<td><input type='text' name='descripcion' id='descripcion' placeholder='Descripcion' class='form-control'/></td>
							<td><input type='number' name='precio' id='precio' placeholder='Precio' class='form-control'/></td>
							<td>".getCategoriaProducto(0,0)."</td>
							<td><button id='save_new_producto' class='btn-success'>Guardar</button></td>
						</tr>
					</table>
				</div>";
		return $return;
	}

	function getCategoriaProducto($id_producto,$id_categoria){
		global $handler_producto;
		if($id_producto == 0){
			$return = "<select id='id_categoria' name='id_categoria' class='form-control'>";
		}else{
			$return = "<select id='id_categoria_".$id_producto."' name='id_categoria_".$id_producto."' class='form-control' disabled='disabled'>";
		}
		$dato = $handler_producto->getAllCategory();
		for ($i=0; $i < sizeof($dato); $i++) { 
			$return .= "<option value='".$dato[$i]['id']."' ".(($dato[$i]['id'] == $id_categoria)?"selected":" ").">".$dato[$i]['descripcion']."</option>";
		}
		$return .= "</select>";
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