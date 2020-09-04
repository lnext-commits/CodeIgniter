function savePrivilege (id) {
	$("#imgSave"+id).attr('src','/resurUs/images/loading59.gif');
	var namel = $("input[name=namel"+id+"]").val();
	var summ = $("input[name=summ"+id+"]").val();
	$.ajax({
		type: "POST",
		url: "/ajaxAdmin/privilege/savePrivilege",
		data: {id:id,namel:namel,summ:summ}
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
function addPrivilege (){
	$.ajax({
		type: "POST",
		url: "/ajaxAdmin/privilege/getViewNewPrivilege",
		data: {}
	})
	.done(function( otv ) {
		$("#newPrivilege").html(otv);
		$("#imgNewPrivilege").html(" ");
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