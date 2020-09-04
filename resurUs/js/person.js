function savePerson (id) {
	$("#imgSave"+id).attr('src','/resurUs/images/loading59.gif');
	var fio = $("input[name=fio"+id+"]").val();
	var pass = $("input[name=pass"+id+"]").val();
	var tipPerson = $("select[name=tipPerson"+id+"]").val();
	var access = $("select[name=access"+id+"]").val();
	var room = $("select[name=room"+id+"]").val();
	$.ajax({
		type: "POST",
		url: "/ajaxAdmin/person/savePerson",
		data: {id:id,fio:fio,pass:pass,tipPerson:tipPerson,access:access,room:room}
	})
	.done(function( otv ) {
		if (otv) {
			setTimeout(getImgTick, 1000, id);
			
		}else {
			setTimeout(getImgRemove, 1000, id);
		}
		setTimeout(getImgFloopy, 3000, id);
	}); 
}
function addPerson (){
	$.ajax({
		type: "POST",
		url: "/ajaxAdmin/person/getViewNewPerson",
		data: {}
	})
	.done(function( otv ) {
		$("#newPerson").html(otv);
		$("#imgNewPerson").html(" ");
	}); 
}
function getImgFloopy (id){
	$("#imgSave"+id).attr('src','/resurUs/images/floopy.png');
}
function getImgTick (id){
	$("#imgSave"+id).attr('src','/resurUs/images/tick.png');
}
function getImgRemove (id){
	$("#imgSave"+id).attr('src','/resurUs/images/remove.png');
}