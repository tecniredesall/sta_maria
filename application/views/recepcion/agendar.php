




<body>
	<div id='wrap'>

            <div id='external-events' style="overflow-y: auto">
			<h4>Servicios y Tratamientos</h4>
                        
		</div>

		<div id='calendar'></div>
		<div style='clear:both'></div>

	</div>
</body>

<script>
        var json;
        var moment;
        var _calevent;
        var tite;
        var ver;
        
	$(document).ready(function() {

            var imgApply="<span class='fc-title fc-img'><img width='16px' class='imgApply'  title='Agendado' alt='Agendado' src='"+$(window).data("base_url_img")+"/iconos/valid.png'></span>";
            var plan_id=null;

            $.divClick=function(event){
                  view = $('#calendar').fullCalendar('getView');
                        finicio=moment(view.start).format("YYYY-MM-DD");
                        ffin=moment(view.end).format("YYYY-MM-DD");


                        if($("#calendar").list().getColumn($(this).data("values")[0], "calidx")<moment(view.end).valueOf())
                        {
                          ffin2=$("#calendar").list().getColumn($(this).data("values")[0], "calfin");
                          finicio2=$("#calendar").list().getColumn($(this).data("values")[0], "calfin");
                         if(ffin2==-1)
                          {
                              ffin2=ffin;
                              finicio2=finicio;

                          }else
                          {
                              finicio2=ffin2;
                          }
                          $("#calendar").list().addRowOverWrite($(this).data("values")[0], new Array(["calidx",moment(view.end).valueOf()],["calini",finicio2],["calfin",ffin]));

                        $.ajax({
                            type: "post",
                            data:{"mod":"recepcion/agendar","fn":"itemsCal","cnt":"3","param1":$(this).data("values")[0],"param2":finicio2,"param3":ffin,"tipo":"source"},
                            url: $(window).data('base_url_index')+"/globales/json",
                            cache: true,
                            dataType: "json",
                            success: function(datos)
                                   {
                                            
                                            $('#calendar').fullCalendar( 'addEventSource', datos );
                                            $.each(datos, function(i,item)
                                            {
                                                /*var event={"id":item.id,
                                                            "title":item.title,
                                                            "start":item.start,
                                                            
                                                            "color":item.color,
                                                            "agd":item.agd,
                                                            "servicios_id":item.servicios_id};*/
                                                //var copiedEventObject = $.extend({}, event);
                                                //$('#calendar').fullCalendar('renderEvent', item, true);
                                            });

                                   }
                        });
                        }
            };

            $.agregarLstServicios=function(id,nombre,cant,color)
            {
                    

                    div=$("<div id="+id+" class='fc-event' style='background-color:"+color+";border-color:"+color+" ><span class='content' >"+nombre+"</span>-<span class='cant'>"+cant+"</span></div>");
                    $(div).data("values", new Array(id,nombre,cant,0));
                    $(div).on("click",$.divClick);
                    $("#external-events").append(div);
                    
                    

            }

            $.changeListServ=function(id,cant)
            {
                $("div#"+id+" span.cant").html(cant);
            }

            
            $.removeListServ=function(id)
            {
                alert("hola");
                $("div#"+id).remove();
                $('#calendar').fullCalendar('removeEvents', id);
            }
            
            

            $.initialize=function()
            {
                    
                    
                    if(window.opener==null)
                    {
                        window.close() ;
                    }else
                    {
                            $(window).on('beforeunload', function(event){
                                window.opener.$.wCalendarCerrar();
                            });
                            plan_id=window.opener.$(window.opener.document).data("plan_id");
                            if(plan_id==null)
                            {
                                window.close();
                            }
                    }

                    
                    sol=window.opener.$.list.getData();
                    for(i=0;i<sol.length;i++)
                    {

                        id=sol[i][0];
                        item=window.opener.$.list.getColumn(sol[i][0],"items");
                        cant=window.opener.$.list.getColumn(sol[i][0],"cant");
                        color=window.opener.$.list.getColumn(sol[i][0],"color");
                        
                        $.agregarLstServicios(id,item,cant,color);
                    }

                    //$.eventServ();
                    
                   
            }

           

	
		
                    /*$('#external-events .fc-event').each(function() {
		
                            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                            // it doesn't need to have a start or end
                            var eventObject = {
                                    title: $.trim($(this).text()) // use the element's text as the event title
                            };

                            // store the Event Object in the DOM element so we can get to it later
                            $(this).data('eventObject', eventObject);

                            // make the event draggable using jQuery UI
                            $(this).draggable({
                                    zIndex: 999,
                                    revert: true,      // will cause the event to go back to its
                                    revertDuration: 0  //  original position after the drag
                            });
                    });*/
                            

		/* initialize the calendar
		-----------------------------------------------------------------*/
		
		$('#calendar').fullCalendar({
                        slotDuration:'00:15:00',
                        minTime:'07:00:00',
                        maxTime:'18:00:00',
                        slotEventOverlap: false,
                        eventLimit: true,
                        timeFormat: 'h:mm{ - h:mm}t',
                        buttonText: {
                            day: "Dia",
                            today:"Hoy",
                            month:"Mes"
                           
                        },
                        dayNames:['Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado','Domingo'],
                        monthNames:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        dayAbbrevs:['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab','Dom'],
                        dayNamesShort:['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab','Dom'],
                       
			header: {
				left: 'prev,next today',
				center: 'title'
			},
			editable: false,
			droppable: false, // this allows things to be dropped onto the calendar !!!
			drop: function(date) { // this function is called when something is dropped	
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                                
                                agen=parseInt(window.opener.$.list.getColumn($(this).attr("id"), "agendado"));
                                cant=parseInt(window.opener.$.list.getColumn($(this).attr("id"), "cant"));
                                if(cant>agen)
                                {
                                    window.opener.$.list.setColumn($(this).attr("id"), "agendado", agen+1);
                                    if(cant<=agen+1)
                                    {
                                        //$(this).removeClass("fc-event");
                                    }
                                }
				// is the "remove after drop" checkbox checked?
						
			},
                        eventRender: function(calEvent, element) {

                            ver=element;
                            if(calEvent.agd==1)
                            {
                                $(element).children(".fc-content").prepend(imgApply);
                            }
                        },
                        dayRender: function( date, cell )  {
                            //alert("ss");
                        },
                        viewRender: function(view,element) {
                            //alert('The new title of the view is ' + view.title);
                        },
                        eventClick: function(calEvent, jsEvent, view) {

                        
                        
                        var div=$("div#external-events div#"+calEvent.servicios_id);
                        var values=div.data("values");
                        calEvent.title=""+values[1]+"";
                        
                            if(values[2]>values[3])
                            {
                              
                                if(calEvent.agd==null || calEvent.agd==0)
                                {
                                    values[3]++;
                                    if(values[2]==values[3])
                                    {
                                        div.prepend(imgApply);
                                        div.off("click",$.divClick);

                                    }
                                    div.data("values",values);
                                }else
                                if(calEvent.agd=1)
                                {
                                    return;
                                }
                               
                            }else
                            {
                                return;
                            }

                        
                            
                        if(confirm("Desea Agendar Este dia")==true)
                        {
                            
                            
                            fechaEvent=moment(calEvent.start).format("YYYY-MM-DD");
                            $.ajax({
                                type: "post",
                                data:{"mod":"recepcion/agendar","fn":"addPreAgenda","cnt":"6","param1":plan_id,"param2":calEvent.solicitudes_id,"param3":calEvent.servicios_id,"param4":calEvent.salas_id,"param5":calEvent.salas_dist_id,"param6":fechaEvent,"tipo":"add"},
                                url: $(window).data('base_url_index')+"/globales/json",
                                cache: true,
                                dataType: "json",
                                success: function(datos)
                                       {

                                                
                                                $.each(datos, function(i,item)
                                                {
                                                    if(item.agd==1)
                                                    {
                                                        calEvent.agd=1;
                                                    }
                                                });
                                                $('#calendar').fullCalendar('renderEvent', calEvent);
                                       }
                            });

                            
                       }

                       
                    }
		});
                $.initialize();
                
                
                
	});

</script>
<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
	}
		
	#wrap {
		width: 1000px;
		margin: 0 auto;
	}
		
	#external-events {
                height: 600px;
		float: left;
		width: 210px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
	}
		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}
		
	#external-events .fc-event {
		margin: 10px 0;
		cursor: pointer;
	}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
	}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
                padding-right: 10px;
		float: right;
		width: 750px;
                
                
	}

        .imgApply
        {
            width: 14px;
            vertical-align: middle;

        }

        .fc-img
        {
           vertical-align: middle;
        }

</style>


  


                                