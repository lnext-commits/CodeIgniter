function topay (idinv,retained_money){
	getwindow (1,1,450,true,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","runtopay ("+idinv+")");
	$.ajax({
			type: "POST",
			url: "/ajax/distribution/topayview",
			data: { idinv:idinv, retained_money:retained_money}
		})
		.done(function( otv ) {
			titWin(otv);
		}); 
}
function runtopay (idinv){
	if ($('input[name="mission"]').is(':checked')){
		var radio=$("input[name='mission']:checked").val();
		var cash=$("input[name='cash']").val();
		$.ajax({
			type: "POST",
			url: "/ajax/distribution/need"+radio,
			data: { idinv:idinv, cash:cash}
		})
		.done(function( otv ) {
			if (otv)  {closeWin (); window.location.reload();}
			else titWin("Данные не сохранены");
		});
		return;
	}
	$.ajax({
			type: "POST",
			url: "/ajax/distribution/topaydo",
			data: { idinv:idinv}
		})
		.done(function( otv ) {
			if (otv)  {closeWin (); window.location.reload();}
			else titWin("Данные не сохранены");
		}); 
}