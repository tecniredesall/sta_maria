
<div style="display: none">
    <a href="<?php echo base_url("index.php")."/cursos/asignarcursos/index" ?>"  class="clsVentanaIFrame clsBoton" rel="okis">Clic aqu&iacute; para abrir la ventana modal</a>
</div>
<div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Agregar Cursos Al Cronograma</span>
                <hr class="hr_titulo_formulario"/>
            </div>
       
<div id='calendar'></div>
</div>



<script type='text/javascript'>

        var ruta_iframe="<?php echo base_url("index.php")."/cursos/asignarcursos/index" ?>";
        var borrar=false;
        var jsev=null;
	$(document).ready(function() {

                eventsClient=<?php echo $eventsClient ?>;
                $.each(eventsClient, function(i,item){
                        item.allDay=false;
                });
                
                var ruta="<?php echo base_url("index.php")."/globales/json" ?>";
                var relid=-1;
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$("#calendar").fullCalendar({
                  eventClick: function( event, jsEvent, view )
                  {

                        
                      borrar=false;
                      if(jsEvent.target.nodeName=="IMG")
                      {
                       
                            
                          if(jsEvent.target.id=="img-borrar")
                          {
                            borrar=true;
                          }
                      }

                      if(borrar==false)
                      {
                          borrar=true;   
                          if(event.id<0 && event.idbd==-1){
                              fc_inicio=$.fullCalendar.formatDate(event.start, "yyyy-MM-dd");
                              fc_fin=$.fullCalendar.formatDate(event.end, "yyyy-MM-dd");
                              $.ajax({
                                    type: "post",
                                    data:{mod: "/cursos/calendario",fn: 'json_insertar',tipo:"calendario",cnt: 2,param1:fc_inicio,param2:fc_fin},
                                    url: ruta,
                                    cache: true,
                                    dataType: "json",
                                    success: function(datos)
                                           {

                                                    $.each(datos, function(i,item){
                                                    event.idbd=item.id;
                                                    $(".clsVentanaIFrame").attr("href","");
                                                    $(".clsVentanaIFrame").attr("href",ruta_iframe+"/"+event.idbd);
                                                    $(".clsVentanaIFrame").click();

                                                });
                                           }
                               });
                            }else
                            {
                                
                                    $(".clsVentanaIFrame").attr("href","");
                                    $(".clsVentanaIFrame").attr("href",ruta_iframe+"/"+event.id);
                                    $(".clsVentanaIFrame").click();
                                

                            }
                            
                      }else
                      if(borrar==true)
                      {
                      
                        if(event.idbd>0)
                        {
                              $.ajax({
                                    type: "post",
                                    data:{mod: "/cursos/calendario",fn: 'json_eliminar',tipo:"calendario",cnt: 1,param1:event.idbd},
                                    url: ruta,
                                    cache: true,
                                    dataType: "json",
                                    success: function(datos)
                                           {
                                                $.each(datos, function(i,item){
                                                         if(item.confirm==1)
                                                         {
                                                                $('#calendar').fullCalendar('removeEvents', event.id);
                                                         }else
                                                         {
                                                                alert("El Curso no  se puede borrar, ya esta iniciado");
                                                         }
                                                });
                                           }
                               });
                            
                        }else
                        {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                        }
                        borrar=false;
                      }
                      
                       
                  },
                  dayClick: function(date, allDay, jsEvent, view) {

                        relid--;
                        $("#calendar").fullCalendar( "renderEvent", {
                                        id: relid,
                                        idbd: -1,
                                        title: '\nNuevo Curso',
					start: new Date(date.getFullYear(), date.getMonth(), date.getDate(), 6, 0),
                                        end: new Date(date.getFullYear(), date.getMonth(), date.getDate(), 18, 0),
                                        allDay: false,
                                        color: ''
				},true);
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
                        right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                eventRender: function(event, element)
                {
                    //element.removeClass("fc-event-skin");
                    //$(".fc-event-inner",element).removeClass("fc-event-skin");
                    //alert("ok");
                    //element.addClass("nuevo");
                    //$(".fc-event-inner",element).addClass("nuevo");
                    
                    var elem=$(".fc-event-inner",element);
                    elem.prepend('<div style="text-align: right"><span style="text-align: right"><a href="javascript:" style="width: 50px;text-align: right"><img id="img-borrar" title="Eliminar Curso" src="/asl/img/icons/delete.png" width="15px"></a></span></div>');
                    
                },
                    events: eventsClient,
                    timeFormat: 'h:mm{ - h:mm}t'
		});

	});



</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
	#calendar {
		width: 840px;
		margin: 0 auto;
		}

       

</style>

  


                                