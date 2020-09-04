function refresh (idboy){
	getwindow (1,1,250,false,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","refreshboy ("+idboy+")");
	$.ajax({
			type: "POST",
			url: "/ajax/schoolboy/refresh",
			data: {idboy:idboy}
		})
		.done(function( otv ) {
			titWin(otv);
		}); 
}
function refreshboy (idboy) {
		$.ajax({
				type: "POST",
				url: "/ajax/schoolboy/refreshboy",
				data: {idboy:idboy }
			})
			.done(function( otv ) {
				if (otv)  {
					window.opener.location.reload();
					closeWin (); 
					window.location.reload();
				}else titWin("Данные не сохранены");
			});
}
function history (idboy){
	var helpDisc=window.open("/help/history_oldschoolboy/"+idboy, "history","width=800,height=550");
}