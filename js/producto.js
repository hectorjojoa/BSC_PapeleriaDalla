$(function(){

	//$("#new_producto_campos").hide();

	$("#container").delegate("#mostrar_crear_producto","click",function(){
		if($("#new_producto_campos").data("estado") == "visible"){
			$("#new_producto_campos").hide();
			$("#new_producto_campos").data("estado","otro");
			$("#span_opcion_crear_producto").removeClass("glyphicon-arrow-up").addClass("glyphicon-arrow-down");
		}else{
			$("#new_producto_campos").show();
			$("#new_producto_campos").data("estado","visible");
			$("#id").focus();
			$("#span_opcion_crear_producto").removeClass("glyphicon-arrow-down").addClass("glyphicon-arrow-up");
		}
	});
	
	$("#container").delegate("#save_new_producto","click",function(){
		$.ajax({
			method : "POST",
			url : "handler/HandlerProducto.php",
			data : {
				opcion : "new_producto",
				id : $("#id").val(),
				descripcion : $("#descripcion").val(),
				precio : $("#precio").val(),
				id_categoria : $("#id_categoria").val()
			},
			success : function(dato){
				$("#id").val("");
				$("#descripcion").val("");
				$("#precio").val("");
				$("#id_categoria").val("");
				alert("Agregado bien");
				console.log(dato);
			},
			error : function(){
				console.log("ERROR!!");
				alert("No se pudo agregar producto");
			}
		});
	});

	$("#container").delegate("[data-producto-edit]","click",function(){
		var id = $(this).data("producto-edit");
		if($(this).hasClass("btn-success")){
			$("#descripcion_" + id).removeAttr("disabled").focus();
			$("#precio_" + id).removeAttr("disabled");
			$("#id_categoria_" + id).removeAttr("disabled");
			$(this).attr("class","btn-primary");
		}else if($(this).hasClass("btn-primary")){
			$("#descripcion_" + id).attr("disabled","disabled");
			$("#precio_" + id).attr("disabled","disabled");
			$("#id_categoria_" + id).attr("disabled");
			$.ajax({
				method : "POST",
				url : "handler/HandlerProducto.php",
				data : {
					opcion : "edit_producto",
					id : $("#id_" + id).val(),
					descripcion : $("#descripcion_" + id).val(),
					precio : $("#precio_" + id).val(),
					id_categoria : $("#id_categoria_"+ id).val(),
				},
				success : function(dato){
					console.log(dato);
					alert("Editado bien");
				},
				error : function(){
					console.log("ERROR!!");
					alert("No se pudo agregar producto");
				}
			});
			$(this).attr("class","btn-success");
		}
	});

	$("#container").delegate("[data-producto-delete]","click",function(){
		var id = $(this).data("producto-delete");
		$.ajax({
			method : "POST",
			url : "handler/HandlerProducto.php",
			data : {
				opcion : "delete_producto",
				id : id
			},
			success : function(dato){
				console.log(dato);
				alert("Eliminado bien");
			},
			error : function(){
				console.log("ERROR!!");
				alert("No se pudo eliminar producto");
			}
		});
	});
});