/************WINDOW begin********************/
var z=0;
function getwindow (n,wW,wH,p,centr){
	z++;
	$("body").append("<div id=windowI"+z+">");
	$("body").append("<div id=dgFORwin"+z+">");
	var mtop=(wH-128)/2;
	if (p==11) $("#windowI"+z).html("<div class='bodyWin bodyWin"+z+"'>   <div class='titlWinLeft titlWin cur'  onclick='closeWin ()'> <img src='resurUs/images/error.png' style='margin-top:"+mtop+"px; width:128px'> <span class='textbutton22'>отмена</span></div>    <div class='titlWinRight titlWin cur'><img src='resurUs/images/go-next.png' style='margin-top:"+mtop+"px; width:128px'><span class='textbutton23'>продолжить</span></div> <div class='titlWinCenter titlWin titlWinCenter"+z+"'></div>    <div class='clean'></div>   </div>");
	else if (p) $("#windowI"+z).html("<div class='bodyWin bodyWin"+z+"'>   <div class='titlWinLeft titlWin cur'  onclick='closeWin ()'><img src='resurUs/images/error.png' style='margin-top:"+mtop+"px; width:128px'></div>    <div class='titlWinRight titlWin cur'><img src='resurUs/images/floopy.png' style='margin-top:"+mtop+"px; width:128px'></div> <div class='titlWinCenter titlWin titlWinCenter"+z+"'></div>    <div class='clean'></div>   </div>");
	else $("#windowI"+z).		html("<div class='bodyWin bodyWin"+z+"'>   <div class='titlWinLeft titlWin cur'  onclick='closeWin ()'><img src='/resurUs/images/error.png' style='margin-top:"+mtop+"px; width:128px'></div>  <div class='titlWinRight titlWin cur'><img src='/resurUs/images/tick.png' style='margin-top:"+mtop+"px; width:128px'></div> <div class='titlWinCenter titlWin titlWinCenter"+z+"'></div>    <div class='clean'></div>   </div>");
	
	$(".bodyWin"+z).css("z-index",z*1000+100).draggable();
	if (wW) {if (wW>0)$(".bodyWin"+z).css ("width","97%");}
	else $(".bodyWin"+z).css ("width","500px");
	if (wH) {if (wH>0) $(".bodyWin"+z).css ("height",wH); $(".titlWinLeft").css ("height",wH-6); $(".titlWinCenter").css ("height",wH-6); $(".titlWinRight").css ("height",wH-6);  }
	else $(".bodyWin"+z).css ("height","200px");
	
	
	if (centr) positionWinCenret (wW,wH);
}
function getbackgroundFull () {
	$("#dgFORwin"+z).html("<div class='cover-div cover-div"+z+" '></div>");
	$(".cover-div"+z).css("z-index",z*1000);
}
function titWin (tit) {
	$(".titlWinCenter"+z).html(tit);
}
function ContenWin (cont) {
	$("#contWin"+z).html(cont);
}
function titContenWin (tit,cont) {
	$(".titlWinCenter"+z).html(tit);
	$("#contWin"+z).html(cont);
}
function positionWin (x,y) {
	$(".bodyWin"+z).css({"left":""+x+"px","top":""+y+"px"});
}
function positionWinCenret (w,h) {
	if (w==-1) w=$(".bodyWin"+z).width();
	if (h==-1) h=$(".bodyWin"+z).height();
	var x=($(window).width()*3/100)/2;
	var y=$(document).scrollTop()+30;
	positionWin (x,y);
}
function positionWinObjet (ob) {
	$(".bodyWin"+z).css(ob);
}
function closeWin (pz) {
	if (pz) {
		$("#windowI"+pz).remove();
		$("#dgFORwin"+pz).remove();
	}else{
		if (z>0) {
			$("#windowI"+z).remove();
			$("#dgFORwin"+z).remove();
			z--;
		}
	}
}
function attentionWin (str) {
	var x=$(window).width()/2-117;
	var y=$(window).height()/2-50+$(window).scrollTop();
	getwindow (3,234,130);
	getbackgroundFull (); 
	positionWin (x,y);
	titContenWin("ВНИМАНИЕ","<div style='text-align:center; margin-top:15px;' >"+str+"</div>");
}
/************WINDOW end********************/
