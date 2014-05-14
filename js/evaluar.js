$(function(){

	$("#container").delegate("#fecha_indicador","change",function(){
		console.log("cambio la fecha");
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
						HandlerSlider(
							$(this),
							$(this).data("valor-esperado"),
							$("#select_indicador").val(),
							$(this).data("cedula"),
							$("#fecha_indicador").val()
						);
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
					$(".slider").each(function(){
						HandlerSlider(
							$(this),
							$(this).data("valor-esperado"),
							$(this).data("indicador"),
							$("#select_persona").val(),
							$("#fecha_indicador").val()
						);
					});
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


function HandlerSlider(slider,max,id_indicador,cedula,fecha){
	slider.slider({
		max : max,
		min : 0,
		formater: function(value) {
			return 'Valor obtenido: ' + value;
		},
		//handle : 'circle',
		orientation : 'horizontal',
		step : 1,
		selection : 'before',
		value : slider.val()
	}).on('slideStop', function(ev){
		$.ajax({
			method : "GET",
			url : "response/response_evaluar.php",
			data : {
				opcion : "saveIndicadorPersona",
				accion : slider.data("accion"),
				id_indicador : id_indicador,
				cedula : cedula,
				fecha : fecha,
				valor_obtenido : slider.data("slider").getValue()
			},
			success : function(dato){
				
			}
		});
	});
}