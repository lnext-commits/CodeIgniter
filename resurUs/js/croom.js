function saveRoom (id) {
	$("#imgSave"+id).attr('src','/resurUs/images/loading59.gif');
	var teacher = $("input[name=teacher"+id+"]").val();
	var year = $("input[name=year"+id+"]").val();
	$.ajax({
		type: "POST",
		url: "/ajaxAdmin/room/saveRoom",
		data: {id:id,teacher:teacher,year:year}
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
function addRoom (){
	$.ajax({
		type: "POST",
		url: "/ajaxAdmin/room/getViewNewRoom",
		data: {}
	})
	.done(function( otv ) {
		$("#newRoom").html(otv);
		$("#imgNewRoom").html(" ");
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