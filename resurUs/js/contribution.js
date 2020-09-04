function addcash (idboy){
	getwindow (1,1,350,true,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","savecash ("+idboy+")");
	$.ajax({
			type: "POST",
			url: "/ajax/schoolboy/addcash",
			data: {idboy:idboy}
		})
		.done(function( otv ) {
			titWin(otv);
		}); 
}
function savecash (idboy) {
	var cash=$("input[name='cash']").val ();
	if (cash) {
		$.ajax({
				type: "POST",
				url: "/ajax/schoolboy/savecash",
				data: {cash:cash, idboy:idboy }
			})
			.done(function( otv ) {
				if (otv)  {
					if (otv=="er") {titWin("ноль внести нельзя"); return;}
					closeWin (); window.location.reload();
				}
				else titWin("Данные не сохранены");
			});
	}
}
function addboy () {
	getwindow (1,1,400,true,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","savenewboy ()");
	$.ajax({
			type: "POST",
			url: "/ajax/schoolboy/viewaddnew"
		})
		.done(function( otv ) {
			titWin(otv);
		}); 
}
function savenewboy () {
	var fio=$("input[name='fio']").val ();
	var idlgota=$(".sellgota").val();
	$.ajax({
			type: "POST",
			url: "/ajax/schoolboy/savenewboy",
			data: {fio:fio, idlgota:idlgota }//
		})
		.done(function( otv ) {
			if (otv)  {closeWin (); window.location.reload();}
			else titWin("Данные не сохранены");
		});
}
function editboy (idboy) {
	getwindow (1,1,400,true,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","saveeditboy ("+idboy+")");
	$.ajax({
			type: "POST",
			url: "/ajax/schoolboy/editboy",
			data: {idboy:idboy}
		})
		.done(function( otv ) {
			titWin(otv);
		}); 
}
function saveeditboy (idboy) {
	var fio=$("input[name='fio']").val ();
	var idlgota=$(".sellgota").val();
	$.ajax({
			type: "POST",
			url: "/ajax/schoolboy/saveeditboy",
			data: {fio:fio, idlgota:idlgota, idboy:idboy }//
		})
		.done(function( otv ) {
			if (otv)  {closeWin (); window.location.reload();}
			else titWin("Данные не сохранены");
		});
}
function installationClass (idclass) {
	$.ajax({
			type: "POST",
			url: "/ajax/installation/installationClass",
			data: { idclass:idclass}//
		})
		.done(function( otv ) {
			if (otv)  window.location.reload();
			else alert("Данные не сохранены");
		});
}
function  nextmonth (idclass) {
	getwindow (1,1,450,11,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","nextmonthgo ("+idclass+")");
	titWin("<div class='box_addcash'>Внимание сейчас будут начислены взносы на текуший месяц. Если нужно внести измениния по скидкам, нажмите отмену, и внесите изменения.</div>");
}
function nextmonthgo (idclass) {
	$.ajax({
			type: "POST",
			url: "/ajax/installation/nextmonthgo/",
			data: { idclass:idclass}//
		})
		.done(function( otv ) {
			if (otv) {
				if (otv=="nothis") {
					closeWin (); 
					getwindow (1,1,450,11,true);
					getbackgroundFull ();
					$(".titlWinRight").attr("onclick","location.href='/distribution'");
					titWin("<div class='box_addcash'>Внимание не закрыты все счета в распределении средств.</div>");
					$(".textbutton23").text("перейти");
					return;
				}
				if (otv=="money") {
					closeWin (); 
					getwindow (1,1,450,11,true);
					getbackgroundFull ();
					$(".titlWinRight").attr("onclick","location.href='/distribution'");
					titWin("<div class='box_addcash'>Внимание! на руках остались средства. Нужно этот остаток перевести в нужды класса в накопительный счет</div>");
					$(".textbutton23").text("перейти");
					return;
				}
				window.location.reload();
			}
			else alert("Данные не сохранены");
		});
}
function history (idboy){
	var helpDisc=window.open("/help/history_schoolboy/"+idboy, "history","width=800,height=550");
	// var path = window.location.pathname; // path only
	// var url      = window.location.href;     // full URL
}