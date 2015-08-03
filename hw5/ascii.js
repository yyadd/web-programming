"use strict";
var myVar;
var intervalTime = 250;
var count;
var res;
function $(id) {
	return document.getElementById(id);
}
function function1() {
	$("text").value = ANIMATIONS[$("xx").value];
}
function function2() {
	$("text").style.fontSize = $("yy").value;
}
function function3() {
	count = 0;
	$('dd').disabled = true;
	$('ddd').disabled = false;
	$('xx').disabled = true;
	res = ($("text").value).split("=====");
	myVar = setInterval(show,intervalTime, res);
}
function show(res) {
	$("text").value = res[count];
	count = (count+1)%(res.length);
}
function function4() {
	clearInterval(myVar);
	$("text").value = ANIMATIONS[$("xx").value];
	$('dd').disabled = false;
	$('ddd').disabled = true;
	$('xx').disabled = false;
	res = null;
}
function function5() {
	if($('ss').checked) {
		intervalTime = 50;
	}
	else {
		intervalTime = 250;
	}
	if(myVar !== null) {
		clearInterval(myVar);
		myVar = setInterval(show,intervalTime,res);
	}

}
