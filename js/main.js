 $(document).ready(function(){
 	$('#fins').submit(function(e){ //ACTIVAMOS EL ENVENTO ENVIAR EN EL FORMULARIO
 		e.preventDefault(); //PREVENIMOS QUE SE RECARGUE LA PAGINA, AUNQUE SE PUEDE ENTENDER DE OTRA MANERA. 
 		var data=$(this).serializeArray();// SIRIALAIZ, Para volver los datos del formulario en una matriz de dos columnas name y value
 		data.push({name:'c',value:'insert'}); //Insertar "Un nuevo registro a la matriz" o agregar un nuevo elemento al conjunto. 
 		$.ajax({
 			url:'php/procesador.php',
 			type: 'POST',
 			data: data,
 			success: function(dat){
 				if (dat==1) {
	 				$('#spanInsert').html("<div class='alert alert-success'><strong>Insertado!</strong></div>");
	 			    $('input[type=text]').focus();
		 			setTimeout(function(){
		 			$('input[type=text]').val('');
		 			$('input[type=number]').val('');
		 			$('#spanInsert').hide(); 
		 			}, 700);
		 			 showRecords(); //mostrar
		 			 $('#spanInsert').show(); 
		 			 
	 			}else{
	 			    $('#spanInsert').html('Hubo un error.');
	 			 	setTimeout(function(){
		 			$('input[type=text]').val('');
		 			$('input[type=number]').val('');
		 			$('#spanInsert').hide();
		 			}, 600);
	 			}
 			}
 		})
 	});
 })
 
document.getElementById("load").onload = function() {showRecords()};
function hideFmod(){
	$('#fmod').hide();
	$('#fins').css('display','inline');
}
function showRecords(){
	$.ajax({
		url:'php/procesador.php',
		type: 'get',
		success: function(dat){
      var show = $("#divShowRecords");
   	  show.html(dat); 
		}
    })//ajax
}
function deleteRow(id){
	var idRm = id;//id remove(rm).
    var sendRm = 'id='+idRm;//dato a enviar.
		$.ajax({
			url:'php/procesador.php?d=delete',
			type: 'POST',
			data: sendRm,
			success: function(){
				$('#spanRemove').html("<div class='alert alert-danger'><strong>Eliminado!</strong></div>");
				setTimeout(function(){
				$('#spanRemove').hide();
				}, 700);
				showRecords();
				$('#spanRemove').show();
			}
        })
}
function sendData(name){
	var idMd= name;//id a modificar
	var carry = 'formMd';
		$.ajax({
	            url:   'php/procesador.php',
	            type:  'POST',
                data: {sendMd:idMd,caMd:carry},
	            success:  function (response) {
	            	 $('#fins').hide();
	                    $('#fmod').css('display','inline');
	                    $("#fmod").html(response);
	            }
	    });
}
function updateRow(){
	 var datosUp = $("#fmod").serializeArray();
 		datosUp.push({name:'u',value:'update'});
 		$.ajax({
 			url:'php/procesador.php',
 			type: 'POST',
 			data: datosUp			
 		})//ajax
 			.done(function(){ 
 				$('#spanModify').html("<div class='alert alert-info'><strong>Actualizado!</strong></div>");	
				$('#fmod').hide();
				setTimeout(function(){
				$('#spanModify').hide();
				}, 700);
 				$('#fins').css('display','inline');
 			    $('input[type=text]').focus();
	 			showRecords();
		})
}





