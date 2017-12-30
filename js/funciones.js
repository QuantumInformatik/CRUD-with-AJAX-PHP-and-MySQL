$(document).ready(function(){
	$("#btnYou").click(function(){
		$("#contenido").load("ola.html");
	});
	$("#btnRan").click(function(){
		$("#contenido").load("ranking.php");
	});
	
}); 

/*var myPeso = document.getElementById("peso").value;
var myGet =  document.getElementById("get");

myPeso.onkeyup = function(){

	myGet.outerHTML = myPeso.value;
};



