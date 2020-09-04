function switchOn (id) {
	$("#switch"+id).attr("onclick","switchOff ("+id+")");
	$("#switch"+id).attr("class","switchOff");
	$.ajax({
		type: "POST",
		url: "/ajax/setinginv/setinvclassout",
		data: { id:id}
	})
	.done(function( otv ) {
		if (otv)  {
			if (otv=="stophis"){
				/*окно счет не может быть выключен в этом месяце та как уже оплачен*/
				getwindow (1,1,280,false,true);
				getbackgroundFull ();
				$(".titlWinRight").attr("onclick","closeWin ()");
				titWin("<div style='margin-top:25px;'><span class='wintext'>Этот счет, не может быть выключен в этом месяце, та как уже оплачен!</span></div>");
				setTimeout(backswitch, 1500, id);
			}
			window.opener.location.reload();
		}
		else window.location.reload();
	});
}
function backswitch (id) {
	$("#switch"+id).attr("onclick","switchOn ("+id+")");
	$("#switch"+id).attr("class","switchOn");
}
function switchOff (id) {
	$("#switch"+id).attr("onclick","switchOn ("+id+")");
	$("#switch"+id).attr("class","switchOn");
	$.ajax({
		type: "POST",
		url: "/ajax/setinginv/setinvclassoin",
		data: { id:id}
	})
	.done(function( otv ) {
		if (otv)  {window.opener.location.reload();}
		else window.location.reload();
	});
}
function viewnewinvoice () {
	getwindow (1,1,480,false,true);
	getbackgroundFull ();
	$(".titlWinRight").attr("onclick","viewnewinvoicehtml ()");
	titWin("<div style='margin-top:25px;'><span class='wintext'>Будьте внимательны при создании счета.  Изменения суммы и названия счета после его создания можно только через админа.</span></div>");
}
function viewnewinvoicehtml () {
	closeWin ();
	$.ajax({
		type: "POST",
		url: "/ajax/setinginv/viewnewinvoice"
	})
	.done(function( otv ) {
		$("#newinvoice").html(otv);
		sellcftinv ();
	});
	
}
function sellcftinv () {
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: "/ajax/setinginv/colorarray"
	})
	.done(function( otv ) {
		var mascolor = otv
		$('#selcategorinv').on('change', function () {
			var selectVal = $("#selcategorinv option:selected").val();
			$('#selcategorinv').attr ('style','background:rgba('+mascolor[selectVal]+',0.8)');
			if (selectVal==5) {
				$("input[name='summ']").val(0);
			}
		});
	});
	
}
function savenewinvoice () {
	var selectVal = $("#selcategorinv option:selected").val();
	if (selectVal==0)  {senterror (3); return;}
	var namei = $("input[name='namei']").val();
	if (namei=="") {senterror (1); return;}
	var disclosure = $("input[name='disclosure']").val();
	var summ = $("input[name='summ']").val();
	if (summ=="") {senterror (2); return;}
	if (summ==0 && selectVal!=5) {senterror (4); return;}
	$.ajax({
		type: "POST",
		url: "/ajax/setinginv/savenewinvoice",
		data: { selectVal:selectVal,namei:namei,disclosure:disclosure,summ:summ }
	})
	.done(function( otv ) {
		if (otv)  {window.location.reload();}
	});
	
		
}
function senterror (f) {
	if (f==4) {
		getwindow (1,1,280,false,true);
		getbackgroundFull ();
		$(".titlWinRight").attr("onclick","closeWin ()");
		titWin("<div style='margin-top:25px;'><span class='wintext'>Сумма не может быть равное 0</span></div>");
	}
	if (f==3) {
		getwindow (1,1,280,false,true);
		getbackgroundFull ();
		$(".titlWinRight").attr("onclick","closeWin ()");
		titWin("<div style='margin-top:25px;'><span class='wintext'>Нужно выбрать категория счета.</span></div>");
	}
	if (f==2) {
		getwindow (1,1,280,false,true);
		getbackgroundFull ();
		$(".titlWinRight").attr("onclick","closeWin ()");
		titWin("<div style='margin-top:25px;'><span class='wintext'>Нужно внести сумму для счета.</span></div>");
	}
	if (f==1) {
		getwindow (1,1,280,false,true);
		getbackgroundFull ();
		$(".titlWinRight").attr("onclick","closeWin ()");
		titWin("<div style='margin-top:25px;'><span class='wintext'>Нужно дать названия новому счету.</span></div>");
	}
} 