
// para este tipo de  modal creamos un
// <div class="modal_div">
//  <div class="modal_div_interno">
//      body to show
//  </div>
// </div>
//

 var fnDivModalStart_;
 var fnDivModalClose_;

 function inizializateParams(fnStart,fnClose)
 {
    fnDivModalStart_=fnStart;
    fnDivModalClose_=fnClose;
 }

 function closeModal(event){

                if($.isFunction(fnDivModalClose_))
                {
                          fnDivModalClose_();
                }
                event.stopImmediatePropagation ();
                event.stopPropagation()
                event.preventDefault();

                    $(".modal_div_interno").appendTo(".modal_div");
                    $(".modal_div").hide();
                    var $objVentana=$($(this).parents().get(1));
                    //cerramos la ventana suavemente
                    $objVentana.fadeOut(200,function(){
                            //eliminamos la ventana del DOM
                            $(this).remove();
                            //ocultamos el overlay suavemente
                            $('#divOverlay').fadeOut(400,function(){
                                    //eliminamos el overlay del DOM
                                    $(this).remove();
                            });
                    });

                   

        }

function modalDiv(eEvento)
{
    eEvento.preventDefault();

		//obtenemos la pagina que queremos cargar en la ventana y el titulo
		var strPagina=$(this).attr('href'), strTitulo=$(this).attr('rel');

		//creamos la nueva ventana para mostrar el contenido y la capa para el titulo
		var $objVentana=$('<div class="clsVentana">'), $objVentanaTitulo=$('<div class="clsVentanaTitulo">');

		//agregamos el titulo establecido y el boton cerrar
		$objVentanaTitulo.append('<strong>&nbsp;&nbsp;&nbsp;&nbsp;</strong>');
		$objVentanaTitulo.append($('<a href="" class="modal_cerrar">Cerrar</a>').on('click',closeModal));

		//agregamos la capa de titulo a la ventana
		$objVentana.append($objVentanaTitulo);

		//creamos la capa que va a mostrar el contenido
		$objVentanaContenido=$('<div class="clsVentanaContenido">');
                $objVentana.append($objVentanaContenido);
                $(".modal_div").prepend($objVentana);
                $(".modal_div_interno").appendTo("div.clsVentanaContenido");







		//creamos el overlay con sus propiedades css y lo agregamos al body
		var $objOverlay=$('<div id="divOverlay">').css({
			opacity: .5,
			display: 'none'
		});
		$('body').append($objOverlay);

		//animamos el overlay y cuando su animacion termina seguimos con la ventana
		$objOverlay.fadeIn(function(){
			//agregamos la nueva ventana al body
			//$('body').append($objVentana);
			//mostramos la ventana suavemente ;)
			$objVentana.fadeIn();
                        $(".modal_div").show();
		});

}

$(function(){

	
        
	$('.button_modal_div').on('click',modalDiv);


});


