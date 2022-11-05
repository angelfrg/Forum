//Funcion para controlar longitud titulo post y cuerpo post
function modificarValor(inputId, spanId, event, longitudCampo){
    var long=document.getElementById(inputId).value.length;

    if(event.keyCode==8){
        if(long>0){
            var valorActual=parseInt(document.getElementById(spanId).innerHTML,10);
            document.getElementById(spanId).innerHTML=""+(valorActual+1);
        }
    }else{
        if(long<longitudCampo){
            document.getElementById(spanId).innerHTML=""+(longitudCampo-1-long);
        }
    }
}