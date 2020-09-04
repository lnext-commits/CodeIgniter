/************WINDOW begin********************/
var z=0;
function getwindow (n,wW,wH){
	z++;
	$("body").append("<div id=windowI"+z+">");
	$("body").append("<div id=dgFORwin"+z+">");
	$("#windowI"+z).html("<div class='bodyWin bodyWin"+z+"'><div class='titlWinLeft titlWin'><img src='/window/icowin/"+n+".png' class='icoWin zInd' /></div><div class='titlWinRight titlWin'><img src='/window/icowin/close.png' class='icoWinClose cur' onclick='closeWin ()' /></div><div class='titlWinCenter titlWin titlWinCenter"+z+"'></div><div class='clean'></div><div id='contWin"+z+"'></div></div>");
	$(".bodyWin"+z).css("z-index",z*1000+100).draggable();
	if (wW) $(".bodyWin"+z).css ("width",wW);
	if (wH) $(".bodyWin"+z).css ("height",wH);
}
function getbackgroundFull () {
	$("#dgFORwin"+z).html("<div class='cover-div"+z+" cover-div'></div>");
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
	$(".bodyWin"+z).css({"left":õ,"top":y});
}
function positionWinObjet (ob) {
	$(".bodyWin"+z).css(ob);
}
function closeWin () {
	$("#windowI"+z).remove();
	$("#dgFORwin"+z).remove();
	z--;
}
/************WINDOW end********************/
