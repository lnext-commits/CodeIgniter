function delScoreWindow(id){
	getwindow (1,1,350,true,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","delScore ("+id+")");
	titWin("<h1>Удалить счет?</h1>"); 
}
function delScore (id){
	$.ajax({
		type: "POST",
		url: "/ajaxAdmin/score/delInvoice",
		data: {id:id}
	})
	.done(function( otv ) {
		if (otv) window.location.reload();
		else alert("not data base");
	}); 
}