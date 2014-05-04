$(function(){
	$("#container").delegate("#select_indicador","change",function(){
		if($("#fecha_indicador").val() == ""){
			alert("Seleccione la fecha");
		}else{
			$.ajax({
				method : "GET",
				url : "response/response_evaluar.php",
				data: {
					opcion : "loadPersonByIndicador",
					id_indicador : $("#select_indicador").val()
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
		}
	});

});