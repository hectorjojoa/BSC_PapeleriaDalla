$(function(){
	$("#administrar_persona").on("click",function(){
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
	});
	$("#administrar_producto").on("click",function(){
		$.ajax({
			method : "GET",
			url : "response/response_producto.php",
			data: {
				opcion : "getAllProduct"
			},
			success : function(data){
				$("#container").html(data);
			}
		});
	});

$("#administrar_indicador").on("click",function(){
		$.ajax({
			method : "GET",
			url : "response/response_indicador.php",
			data: {
				opcion : "getAllIndicador"
			},
			success : function(data){
				$("#container").html(data);
			}
		});
	});
});