$(function(){

	//$("#new_indicador_campos").hide();

	$("#container").delegate("#mostrar_crear_indicador","click",function(){
		if($("#new_indicador_campos").data("estado") == "visible"){
			$("#new_indicador_campos").hide();
			$("#new_indicador_campos").data("estado","otro");
			$("#span_opcion_crear_indicador").removeClass("glyphicon-arrow-up").addClass("glyphicon-arrow-down");
		}else{
			$("#new_indicador_campos").show();
			$("#new_indicador_campos").data("estado","visible");
			$("#id").focus();
			$("#span_opcion_crear_indicador").removeClass("glyphicon-arrow-down").addClass("glyphicon-arrow-up");
		}
	});
	
	$("#container").delegate("#save_new_indicador","click",function(){
		$.ajax({
			method : "POST",
			url : "handler/HandlerIndicador.php",
			data : {
				opcion : "new_indicador",
				id : $("#id").val(),
				descripcion : $("#descripcion").val(),
				valor_esperado : $("#valor_esperado").val()
				
			},
			success : function(dato){
				$("#id").val("");
				$("#descripcion").val("");
				$("#valor_esperado").val("");
				
				alert("Agregado bien");
				console.log(dato);
			},
			error : function(){
				console.log("ERROR!!");
				alert("No se pudo agregar indicador");
			}
		});
	});

	$("#container").delegate("[data-indicador-edit]","click",function(){
		var id = $(this).data("indicador-edit");
		console.log("editando a: " + id);
		if($(this).hasClass("btn-success")){
			$("#descripcion_" + id).removeAttr("disabled").focus();
			$("#valor_esperado" + id).removeAttr("disabled");
			
			$(this).attr("class","btn-primary");
		}else if($(this).hasClass("btn-primary")){
			$("#descripcion_" + id).attr("disabled","disabled");
			$("#valor_esperado" + id).attr("disabled","disabled");
			$.ajax({
				method : "POST",
				url : "handler/HandlerIndicador.php",
				data : {
					opcion : "edit_indicador",
					id : $("#id_" + id).val(),
					descripcion : $("#descripcion_" + id).val(),
					valor_esperado : $("#valor_esperado_" + id).val(),
					
				},
				success : function(dato){
					console.log(dato);
					alert("Editado bien");
				},
				error : function(){
					console.log("ERROR!!");
					alert("No se pudo agregar indicador");
				}
			});
			$(this).attr("class","btn-success");
		}
	});

	$("#container").delegate("[data-indicador-delete]","click",function(){
		var id = $(this).data("indicador-delete");
		$.ajax({
			method : "POST",
			url : "handler/HandlerIndicador.php",
			data : {
				opcion : "delete_indicador",
				id : id
			},
			success : function(dato){
				console.log(dato);
				alert("Eliminado bien");
			},
			error : function(){
				console.log("ERROR!!");
				alert("No se pudo eliminar indicador");
			}
		});
	});
});