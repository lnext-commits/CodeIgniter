function viewtaboutgo (idinv,idfun) {
	$.ajax({
			type: "POST",
			url: "/ajax/invoice/viewtaboutgo",
			data: {idinv:idinv,idfun:idfun}
		})
		.done(function( otv ) {
			$(".textinvbox").hide("blind", 500);
			$("#boxtab"+idfun).html(otv).hide().show( "blind", 500);
		}); 
}
function viewtabingo (idinv,idfun) {
	$.ajax({
			type: "POST",
			url: "/ajax/invoice/viewtabingo",
			data: {idinv:idinv,idfun:idfun}
		})
		.done(function( otv ) {
			$(".textinvbox").hide("blind", 500);
			$("#boxtab"+idfun).html(otv).hide().show( "blind", 500);
		}); 
}
function abate (idf,idinv) {
	getwindow (1,1,450,true,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","saveabate ("+idf+","+idinv+")");
	$.ajax({
			type: "POST",
			url: "/ajax/invoice/abate",
			data: {idinv:idinv}
		})
		.done(function( otv ) {
			titWin(otv);
		}); 
}
function saveabate (idf,idinv) {
	var summ=$("input[name='cash']").val();
	var comm=$("input[name='comm']").val();
	$.ajax({
			type: "POST",
			url: "/Ajax/invoice/saveabate",
			data: {idinv:idinv,idf:idf,summ:summ,comm:comm}
		})
		.done(function( otv ) {
			if (otv)  {closeWin (); window.location.reload();}
			else titWin("Данные не сохранены");
		}); 	
		/**/
}