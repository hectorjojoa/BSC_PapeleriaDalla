$(function(){
	$("#form_login").submit(function(event){
		$.ajax({
			method : "POST",
			url : "handler/HandlerIndex.php",
			data : {
				opcion : "try_login",
				cedula : $("#cedula").val(),
				password : $("#password").val()
				
			},
			success : function(dato){
				if(dato == 0){
					alert("Usuario invalido.");
				}else{
					dato = JSON.parse(dato);
					$.ajax({
						method : "POST",
						url : "iniciar_session.php",
						data : dato,
						success : function(dato){
							location.href = "bienvenido.php";
						},
						error : function () {
							console.log("Error cargando variables session.");
						}
					});
					console.log(dato);
				}
			},
			error : function(){
				console.log("ERROR!!");
				//alert("No se pudo agregar indicador");
			}
		});
		event.preventDefault();
	});
});