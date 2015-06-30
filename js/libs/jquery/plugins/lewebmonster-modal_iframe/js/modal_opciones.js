

var objdiv;
var table;
var listo=false;
var fnCallback=null;
var fnsalir=null;
var parametros=null;
$(function(){

	//evento que se produce al hacer clic en el boton cerrar de la ventana
	$('.modal_cerrar').on('click',function(eEvento){
                fnCallback($this);
                limpiarObjVariables();
                eEvento.preventDefault();
                var $objVentana=$($(this).parents().get(1));
		//cerramos la ventana suavemente
		$objVentana.fadeOut(200,function(){
			//eliminamos la ventana del DOM
			$(this).remove();
			//ocultamos el overlay suavemente
			$('#divOverlay').fadeOut(400,function(){
				//eliminamos el overlay del DOM
				$(this).remove();
                                fnsalir($this);
			});
		});
                listo=false;
		
	});



	
	$('.modal').on('click',function(eEvento){
                listo=false;
		//prevenir el comportamiento normal del enlace
		eEvento.preventDefault();
		
		//obtenemos la pagina que queremos cargar en la ventana y el titulo
		var strPagina=$(this).attr('href'), strTitulo=$(this).attr('rel');
		
		//creamos la nueva ventana para mostrar el contenido y la capa para el titulo
		var $objVentana=$('<div class="clsVentana">'), $objVentanaTitulo=$('<div class="clsVentanaTitulo">');
		
		//agregamos el titulo establecido y el boton cerrar
		$objVentanaTitulo.append('<strong>&nbsp;&nbsp;&nbsp;&nbsp;</strong>');
		$objVentanaTitulo.append('<a href="" class="modal_cerrar">Cerrar</a>');
		
		//agregamos la capa de titulo a la ventana
		$objVentana.append($objVentanaTitulo);
		
		//creamos la capa que va a mostrar el contenido
		var $objVentanaContenido=$('<div class="clsVentanaContenido">');
		
		//agregamos un iframe y en el source colocamos la pagina que queremos cargar ;)


                $objVentanaContenido.append("<div id='tmp_error_modal' style='display: none;'></div>");
		$objVentanaContenido.append(objdiv);
                objdiv.append(table);
                table.prepend("<tr><td colspan='2'><br/></td></tr>");
                table.append("<tr><td colspan='2'><br/></td></tr>");
                table.append("<tr><td colspan='2' align='center'><input type='button' class='validar' value='Aceptar' name='btn_aceptar' onclick='validarModal()'></td></tr>");
                table.append("<tr><td colspan='2'><br/></td></tr>");
                //$objVentanaContenido.append("<br>");
                //$objVentanaContenido.append("<input type='button' class='validar' value='Aceptar' name='btn_aceptar' onclick='validarModal()'>");
		
		//agregamos la capa de contenido a la ventana
		$objVentana.append($objVentanaContenido);
		
		//creamos el overlay con sus propiedades css y lo agregamos al body
		var $objOverlay=$('<div id="divOverlay">').css({
			opacity: .5,
			display: 'none'
		});
		$('body').append($objOverlay);
		
		//animamos el overlay y cuando su animacion termina seguimos con la ventana
		$objOverlay.fadeIn(function(){
			//agregamos la nueva ventana al body
			$('body').append($objVentana);
			//mostramos la ventana suavemente ;)
			$objVentana.fadeIn();
		});
                
                listo=true;
	});

});




function agregarOpcion(id,valor,informacion)
{
    if(listo==false)
    {
       crearObjVariables();
       listo=true;
    }
    table.append("<tr><th align='left' width='260px'><span>"+informacion+"</span></th><td align='left' width='100px'><span class='span_rad_'><input id='"+id+"'  class='req_radio rad_modal' type='radio' value='"+valor+"' name='opciones'>&nbsp;</span></td></tr>");
    //alert(table.html());
}


function validarModal()
{
     if(validarRadios($(".req_radio")))
     {
            cerrarModal();
            $(".modal_cerrar").click();
     }else
     {
            msj_error("Debe rellenar los campos Obligatorios",$("#tmp_error_modal"));
     }
}

function cerrarModal()
{
    listo=false;
    fnCallback($("input[type='radio'].rad_modal:checked").val(),parametros); 
}

function crearObjVariables()
{
    limpiarObjVariables();
    objdiv=$("<div id='modal_opciones' align='center' style='margin-top: 10px;margin-bottom: 10px'>");
    table=$("<table id='table_opciones' border='0' align='center'  cellpadding='2' cellspacing='2' style='border:2px solid rgba(0, 0, 0,0.3);padding-left: 10px;padding-right: 10px;margin-left: 15px;margin-right: 15px' >");
}

function setFnCallback(fn_,fn_salir_,parametros_)
{
    fnsalir=fn_salir_;
    fnCallback=fn_;
    parametros=parametros_;

}

function setFnSalir(fn_salir_)
{
    fnsalir=fn_salir_;
}


function limpiarObjVariables()
{
    listo=false;
    objdiv=null;
    table=null;
}

