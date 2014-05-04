$(function(){

	$("#container").delegate("#fecha_indicador","change",function(){
		if($("#select_indicador").val() != -1){
			$.ajax({
				method : "GET",
				url : "response/response_evaluar.php",
				data: {
					opcion : "loadPersonByIndicadorFecha",
					id_indicador : $("#select_indicador").val(),
					fecha : $("#fecha_indicador").val()
				},
				success : function(data){
					$("#evaluar_persona").html(data);
				}
			});
		}
		if($("#select_persona").val() != -1){
			$.ajax({
				method : "GET",
				url : "response/response_evaluar.php",
				data: {
					opcion : "getIndicadorByPersonaFecha",
					cedula : $("#select_persona").val(),
					fecha : $("#fecha_indicador").val()
				},
				success : function(data){
					$("#evaluar_indicador").html(data);
				}
			});
		}
	});

	$("#container").delegate("#select_indicador","change",function(){
		if($("#fecha_indicador").val() == ""){
			alert("Seleccione la fecha");
		}else{
			$.ajax({
				method : "GET",
				url : "response/response_evaluar.php",
				data: {
					opcion : "loadPersonByIndicadorFecha",
					id_indicador : $("#select_indicador").val(),
					fecha : $("#fecha_indicador").val()
				},
				success : function(data){
					$("#evaluar_persona").html(data);
				}
			});
		}
	});

	$("#container").delegate("#select_persona","change",function(){
		if($("#fecha_indicador").val() == ""){
			alert("Seleccione la fecha");
		}else{
			$.ajax({
				method : "GET",
				url : "response/response_evaluar.php",
				data: {
					opcion : "getIndicadorByPersonaFecha",
					cedula : $("#select_persona").val(),
					fecha : $("#fecha_indicador").val()
				},
				success : function(data){
					$("#evaluar_indicador").html(data);
				}
			});
		}
	});

	$("#container").delegate("#select_persona","change",function(){
		if($("#fecha_indicador").val() == ""){
			alert("Seleccione la fecha");
		}
	});

});