$(function(){
	console.log("entro 1");
	$("#container").delegate(".datepicker","focusin",function(){
		console.log("entro 2");
		$(this).datepicker({
			format :'yyyy-mm-dd',
			startDate : '-1w',
			endDate : '+0d'
		});
	});
});