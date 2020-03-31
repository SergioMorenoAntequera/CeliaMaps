var cpu = $("#cPopUp");
var cpuX = $("#cPopUp .cornerButton");
var text = $("#cPopUp .text");


cpuX.click(function(e){
    cpuHide();
});

///////////////////////////////////////////////////////////////////////////
// ENSEÑAR EL MENÚ Y OCULTARLO ////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//Muestra el popup
function cpuShow(){
    cpu.show(150);
}
//Oculta el popup
function cpuHide(){
    cpu.fadeOut(150);
}
// Muestra o oculta según
function cpuToggle(){
    if(cpu.css("opacity") < 1){
        cpuShow();
    } else {
        cpuHide();
    }
}

///////////////////////////////////////////////////////////////////////////
// MODIFICAR TEXTO ////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
// Cambia el texto y lo muestra, todo en uno
function cpuShowText(message){
    text.text(message);
    cpuShow();
}
// Cambia el texto
function cpuSetText(message){
    text.text(message);
}
// Recoge el texto
function cpuGetText(){
    return text.text();
}

