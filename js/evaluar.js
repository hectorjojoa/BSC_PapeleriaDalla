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
			var selected = $(this).find('option:selected');
       		var extra = selected.data('valor-esperado');
       		$(this).data("valor-esperado",extra);
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
					$(".slider").each(function(){
						$(this).slider({
							max : $("#select_indicador").data("valor-esperado"),
							min : 0,
							formater: function(value) {
								return 'Valor obtenido: ' + value;
							},
							//handle : 'circle',
							orientation : 'horizontal',
							step : 1,
							selection : 'before',
							value : $(this).val()
						}).on('slideStop', function(ev){
							$.ajax({
								method : "GET",
								url : "response/response_evaluar.php",
								data : {
									opcion : "saveIndicadorPersona",
									accion : $(this).data("accion"),
									id_indicador : $("#select_indicador").val(),
									cedula : $(this).data("cedula"),
									fecha : $("#fecha_indicador").val(),
									valor_obtenido : $(this).data("slider").getValue()
								},
								success : function(dato){
									console.log(dato);
								}
							});
						});
					});
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