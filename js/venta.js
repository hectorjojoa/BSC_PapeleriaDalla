$(function(){
	$("#container").delegate("#mostrar_crear_venta","click",function(){
		if($("#new_venta_campos").data("estado")=="visible"){
			$("#new_venta_campos").hide();
			$("#new_venta_campos").data("estado","otro");
			$("#span_opcion_crear_venta").removeClass("glyphicon-arrow-up").addClass("glyphicon-arrow-down");
		}else{
			$("#new_venta_campos").show();
			$("#new_venta_campos").data("estado","visible");
			$("#id").focus();
			$("#span_opcion_crear_venta").removeClass("glyphicon-arrow-down").addClass("glyphicon-arrow-up");
		}
	});

	$("#container").delegate("#save_new_venta","click",function(){
		$.ajax({
			method : "POST",
			url : "handler/HandlerVenta.php",
			data : {
				opcion : "new_venta",
				id : $("#id").val(),
				id_persona : $("#id_persona").val(),
				total : $("#total").val(),
				fecha : $("#fecha").val()
			},
			success : function(dato){
				$("#id").val("");
				$("#id_persona").val("");
				$("#total").val("");
				$("#fecha").val("");
				$.ajax({
					method : "GET",
					url : "response/response_venta.php",
					data: {
						opcion : "getAllVenta"
					},
					success : function(data){
						$("#container").html(data);
					}
				});
				alert("Venta Agregada");
				console.log(dato);
			},
			error : function(){
				console.log("ERROR!!");
				alert("No se pudo agregar venta");
			}
		});
	});
	
	$("#container").delegate("[data-venta-edit]","click",function(){
		var id = $(this).data("venta-edit");
		if($(this).hasClass("btn-success")){
			$("#id_persona_" + id).removeAttr("disabled").focus();
			$("#total_" + id).removeAttr("disabled");
			$("#fecha_" + id).removeAttr("disabled");
			$(this).attr("class","btn-primary");
		}else if($(this).hasClass("btn-primary")){
			$("#id_persona_" + id).attr("disabled","disabled");
			$("#total_" + id).attr("disabled","disabled");
			$("#fecha_" + id).attr("disabled","disabled");
			$.ajax({
				method : "POST",
				url : "handler/HandlerVenta.php",
				data : {
					opcion : "edit_venta",
					id : $("#id_" + id).val(),
					id_persona : $("#id_persona_" + id).val(),
					total : $("#total_" + id).val(),
					fecha : $("#fecha_"+ id).val(),
				},
				success : function(dato){
					console.log(dato);
					alert("Venta Editada");
				},
				error : function(){
					console.log("ERROR!!");
					alert("No se pudo agregar venta");
				}
			});
			$(this).attr("class","btn-success");
		}
	});

	$("#container").delegate("[data-venta-delete]","click",function(){
		var id = $(this).data("venta-delete");
		$.ajax({
			method : "POST",
			url : "handler/HandlerVenta.php",
			data : {
				opcion : "delete_venta",
				id : id
			},
			success : function(dato){
				$.ajax({
					method : "GET",
					url : "response/response_venta.php",
					data: {
						opcion : "getAllVenta"
					},
					success : function(data){
						$("#container").html(data);
					}
				});
				console.log(dato);
				alert("Eliminado bien");
			},
			error : function(){
				console.log("ERROR!!");
				alert("No se pudo eliminar venta");
			}
		});
	});	
});