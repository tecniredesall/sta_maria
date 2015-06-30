
<div style="display: none">
    <a class="modal clsVentanaIFrame clsBoton" rel="okis">Click</a>
</div>
<div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Formalización de Inscripción</span><a href="<?php echo instancia_controller()->atras; ?>"><span class="span_text_formulario" style="text-align: right; padding-left: 485px"><img id="img-atras" title="Atras" src="<?php echo base_url()."/img/iconos/flecha_atras.png" ?>" width="25px"></span></a>
                <hr class="hr_titulo_formulario"/>
            </div>
    <div id='calendar_default'></div>
</div>
<div style="width: 100%;background-color: #6f6c6c;display: none">
    <table width="99%" align="center">
        <tr>
            <td style="text-align: left">Pre-inscripción Realizada</td>
            <td style="text-align: right"><img id="img-preinscrito" title="Pre-inscripción realizada Correctamente" src="/asl/img/iconos/valid.png" width="15px"></td>
        </tr>
        <tr>
            <td style="text-align: left">Pre-inscripción Realizada</td>
            <td style="text-align: right"><img id="img-preinscrito" title="Pre-inscripción realizada Correctamente" src="/asl/img/iconos/valid.png" width="15px"></td>
        </tr>
        <tr>
            <td style="text-align: left">Pre-inscripción Realizada</td>
            <td style="text-align: right"><img id="img-preinscrito" title="Pre-inscripción realizada Correctamente" src="/asl/img/iconos/valid.png" width="15px"></td>
        </tr>
        <tr>
            <td style="text-align: left">Pre-inscripción Realizada</td>
            <td style="text-align: right"><img id="img-preinscrito" title="Pre-inscripción realizada Correctamente" src="/asl/img/iconos/valid.png" width="15px"></td>
        </tr>
        <tr>
            <td style="text-align: left">Pre-inscripción Realizada</td>
            <td style="text-align: right"><img id="img-preinscrito" title="Pre-inscripción realizada Correctamente" src="/asl/img/iconos/valid.png" width="15px"></td>
        </tr>
        <tr>
            <td style="text-align: left">Pre-inscripción Realizada</td>
            <td style="text-align: right"><img id="img-preinscrito" title="Pre-inscripción realizada Correctamente" src="/asl/img/iconos/valid.png" width="15px"></td>
        </tr>
    </table>
</div>

<script type='text/javascript'>


var ruta="<?php echo base_url("index.php")."/globales/json" ?>";
var base_ruta="";

        
        function salir()
        {
          window.document.location.reload();
        }

        function modificarEvento(value,parametros)
        {

            event=parametros[0];
            if(value==1)
            {
                
                 $.ajax({
                                    type: "post",
                                    data:{mod: "/cursos/inscripcion",fn: 'json_inscribir',tipo:"inscripcion",cnt: 2,param1:event.id,param2:event.cursos_id},
                                    url: ruta,
                                    cache: true,
                                    dataType: "json",
                                    success: function(datos)
                                    {
                                        
                                            $.each(datos, function(i,item){
                                                
                                            
                                                if(item.confirm==1)
                                                {
                                                    
                                                    alert("La Inscripción se realizo Exitosamente");
                                                }else
                                                if(item.confirm==-1)
                                                {
                                                    alert("Error: Maximo Integrantes Permitidos ");
                                                }

                                            });
                                    }
                         });

            }else
            if(value==2)
            {
                        $.ajax({
                                    type: "post",
                                    data:{mod: "/cursos/inscripcion",fn: 'json_cancelar',tipo:"inscripcion",cnt: 2,param1:event.id,param2:event.cursos_id},
                                    url: ruta,
                                    cache: true,
                                    dataType: "json",
                                    success: function(datos)
                                           {
                                                $.each(datos, function(i,item){
                                                    alert("La Inscripción fue cancelada");
                                                });
                                           }
                         });

            }
        }

        var borrar=false;
        var jsev=null;
	$(document).ready(function() {
        ruta_base=$("#_hd_ruta_base_").val();

                eventsClient=<?php echo $eventsClient ?>;
                $.each(eventsClient, function(i,item){
                        item.allDay=false;
                });


		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
                
		$("#calendar_default").fullCalendar({
                  eventClick: function( event, jsEvent, view )
                  {

                       if(event.inscripcion_id==-1)
                       {
                            agregarOpcion('op1',1,"Formalizar Inscripción");
                       }else
                       if(event.inscripcion_id>0 && event.preinscripcion_id>0)
                       {
                            agregarOpcion('op2',2,"Cancelar Inscripción");
                       }


                       param=new Array(3);
                       param[0]=event;
                       param[1]=jsEvent;
                       param[2]=view;
                       setFnCallback(modificarEvento,salir,param);
                       $(".modal").click();

                  },
                buttonText: {
                            prev: "&lt;",
                            next: "&gt;",
                            today:"Hoy",
                            month:"Mes",
                            week:"Semana"
                },
                dayNames:['Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado','Domingo'],
                monthNames:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                dayAbbrevs:['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab','Dom'],
                dayNamesShort:['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab','Dom'],
                header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month'
                },
                editable: false,

                //content : event.title+',semana:'+event.semana,
                eventRender: function(event, element)
                {
                   element.qtip({

                                        content : event.title,
                                        position: {
                                          corner: {
                                             target: 'topMiddle',
                                             tooltip: 'bottomLeft'
                                          }
                                       },
                                        style   : {

                                                    minWidth: 300,
                                                    minHeight: 70,
                                                    padding: 5,
                                                    background: '#A2D959',
                                                    color: 'black',
                                                    textAlign: 'center',
                                                    border: {
                                                        width: 1,
                                                        radius: 3,
                                                        color: '#333333'
                                                    },
                                                    tip: 'bottomLeft',
                                                    name: 'dark' // Inherit the rest of the attributes from the preset dark style
                                        }
                                     });
                                     
                   if(event.estudiantes_id!=-1)
                   {
                       var elem=$(".fc-event-inner",element);
                       if(event.inscripcion_id==-1)
                       {
                            elem.prepend('<div style="width: 100%;background-color: #6f6c6c" ><table width="99%" align="center"><tr><td style="text-align: left">Pre-Inscrito</td><td style="text-align: right"><img id="img-preinscrito" title="Pre-Inscrito" src="'+ruta_base+'/img/iconos/apply.png" width="15px"></td></tr></table></div>');
                       }else
                       if(event.inscripcion_id>0 && event.preinscripcion_id>0)
                       {
                            elem.prepend('<div style="width: 100%;background-color: #6f6c6c" ><table width="99%" align="center"><tr><td style="text-align: left">Inscrito</td><td style="text-align: right"><img id="img-inscrito" title="Inscrito" src="'+ruta_base+'/img/iconos/valid.png" width="15px"></td></tr></table></div>');
                       }
                   }
                },
                    events: eventsClient,
                    timeFormat: 'h:mm{ - h:mm}t'
		});
	});

</script>
<style type='text/css'>

        body {
		margin-top: 20px;

		}
	#calendar_default {
		width: 830px;
		margin: 0 auto;
		}



</style>













