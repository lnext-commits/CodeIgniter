function viewtabout (m) {
	$.ajax({
			type: "POST",
			url: "/ajax/current/viewtabout",
			data: {m:m}
		})
		.done(function( otv ) {
			$(".textinvbox").hide("blind", 500);
			$("#boxtab"+m).html(otv).hide().show( "blind", 500);
		}); 
}
function saveneed (m){
	var summ = $("input[name='cash']").val();
	var comm = $("input[name='comm']").val();
	if (summ==0) {senterror (1); return;}
	$.ajax({
			type: "POST",
			url: "/ajax/current/saveneed",
			data: {summ:summ, comm:comm}
		})
		.done(function( otv ) {
			if (otv)  {window.location.reload();}
			else alert ("данные не сохранены");
		}); 
}
function senterror (f) {
	if (f==2) {
		getwindow (1,1,280,false,true);
		getbackgroundFull ();
		$(".titlWinRight").attr("onclick","closeWin ()");
		titWin("<div style='margin-top:25px;'><span class='wintext'>Сумма не может быть равное 0</span></div>");
	}
	if (f==1) {
		getwindow (1,1,280,false,true);
		getbackgroundFull ();
		$(".titlWinRight").attr("onclick","closeWin ()");
		titWin("<div style='margin-top:25px;'><span class='wintext'>нужно внести сумму</span></div>");
	}
}
function getviewcoming () {
	$.ajax({
			type: "POST",
			url: "/ajax/current/viewtabin",
			data: {}
		})
		.done(function( otv ) {
			$("#boxcoming").html(otv).show( "blind", 500);
		}); 
}