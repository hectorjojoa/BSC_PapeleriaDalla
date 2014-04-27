$(function(){

	//$("#new_persona_campos").hide();

	$("#container").delegate("#mostrar_crear_persona","click",function(){
		if($("#new_persona_campos").data("estado") == "visible"){
			$("#new_persona_campos").hide();
			$("#new_persona_campos").data("estado","otro");
			$("#span_opcion_crear_persona").removeClass("glyphicon-arrow-up").addClass("glyphicon-arrow-down");
		}else{
			$("#new_persona_campos").show();
			$("#new_persona_campos").data("estado","visible");
			$("#cedula").focus();
			$("#span_opcion_crear_persona").removeClass("glyphicon-arrow-down").addClass("glyphicon-arrow-up");
		}
	});
	
	$("#container").delegate("#save_new_persona","click",function(){
		$.ajax({
			method : "POST",
			url : "handler/HandlerPersona.php",
			data : {
				opcion : "new_persona",
				cedula : $("#cedula").val(),
				nombre : $("#nombre").val(),
				apellido : $("#apellido").val(),
				fecha_nac : $("#fecha_nac").val(),
				telefono : $("#telefono").val()
			},
			success : function(dato){
				$("#cedula").val("");
				$("#nombre").val("");
				$("#apellido").val("");
				$("#fecha_nac").val("");
				$("#telefono").val("");
				$.ajax({
					method : "GET",
					url : "response/response_persona.php",
					data: {
						opcion : "getAllPerson"
					},
					success : function(data){
						$("#container").html(data);
					}
				});
				alert("Agregado bien");
				console.log(dato);
			},
			error : function(){
				console.log("ERROR!!");
				alert("No se pudo agregar persona");
			}
		});
	});

	$("#container").delegate("[data-persona-edit]","click",function(){
		var id = $(this).data("persona-edit");
		console.log("editando a: " + id);
		if($(this).hasClass("btn-success")){
			$("#nombre_" + id).removeAttr("disabled").focus();
			$("#apellido_" + id).removeAttr("disabled");
			$("#fecha_nac_" + id).removeAttr("disabled");
			$("#telefono_" + id).removeAttr("disabled");
			$(this).attr("class","btn-primary");
		}else if($(this).hasClass("btn-primary")){
			$("#nombre_" + id).attr("disabled","disabled");
			$("#apellido_" + id).attr("disabled","disabled");
			$("#fecha_nac_" + id).attr("disabled","disabled");
			$("#telefono_" + id).attr("disabled","disabled");
			$.ajax({
				method : "POST",
				url : "handler/HandlerPersona.php",
				data : {
					opcion : "edit_persona",
					cedula : $("#cedula_" + id).val(),
					nombre : $("#nombre_" + id).val(),
					apellido : $("#apellido_" + id).val(),
					fecha_nac : $("#fecha_nac_" + id).val(),
					telefono : $("#telefono_" + id).val()
				},
				success : function(dato){
					console.log(dato);
					alert("Editado bien");
				},
				error : function(){
					console.log("ERROR!!");
					alert("No se pudo agregar persona");
				}
			});
			$(this).attr("class","btn-success");
		}
	});

	$("#container").delegate("[data-persona-delete]","click",function(){
		var id = $(this).data("persona-delete");
		$.ajax({
			method : "POST",
			url : "handler/HandlerPersona.php",
			data : {
				opcion : "delete_persona",
				cedula : id
			},
			success : function(dato){
				$.ajax({
					method : "GET",
					url : "response/response_persona.php",
					data: {
						opcion : "getAllPerson"
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
				alert("No se pudo eliminar persona");
			}
		});
	});
});