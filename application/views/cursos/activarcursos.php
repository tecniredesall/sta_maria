
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
<?php //echo $eventsClient?>


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

                      window.open("http://www.google.com");
                       
                  },
                  dayClick: function(date, allDay, jsEvent, view) {

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
                        right: 'month,agendaWeek'
                },
                editable: true,
                eventRender: function(event, element)
                {      
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

  


                                