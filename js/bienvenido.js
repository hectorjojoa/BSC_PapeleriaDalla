$(function(){
	$("#salir").on("click",function(){
		$.ajax({
			method : "POST",
			url : "cerrar_session.php",
			success : function(dato){
				alert("Ha cerrado session correctamente.");
				location.href = "index.php";
			},
			error : function () {
				console.log("Error cerrando variables session.");
			}
		});
	});
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
	$("#administrar_venta").on("click",function(){
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

	$("#evaluar_persona").on("click",function(){
		$.ajax({
			method : "GET",
			url : "response/response_evaluar.php",
			data: {
				opcion : "getAllPanel"
			},
			success : function(data){
				$("#container").html(data);
			}
		});
	});	

	$("#container").delegate(".datepicker","focusin",function(){
		$(this).datepicker({
			format :'yyyy-mm-dd',
			startDate : '-1w',
			endDate : '+0d'
		});
	});
	
});