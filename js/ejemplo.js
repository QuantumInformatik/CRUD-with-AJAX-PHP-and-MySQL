$(document).ready(function(){

$( "button" ).click(function() {
 
  switch ( $( "button" ).index( this ) ) {
    case 0 :
      $( "span" ).html( "Hola caso 0"  );
      break;
    case 1 :
        $( "span" ).html( "Hola caso 1"  );
      break;
    case 2 :
      $( "span" ).html( "Hola caso 2"  );
      break;
    case 3 :
     $( "span" ).html( "Hola caso 3"  );
      break;
  }
 
});

})