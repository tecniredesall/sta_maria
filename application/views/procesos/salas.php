
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

   <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Pacientes Asignados a Tratamientos</span>
                <hr class="hr_titulo_formulario"/>
            </div>
                   
   </div>




<div>
    
    <table id="tbPacientes" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th >Cédula</th>
            <th >Nombre</th>
        </tr>
    </thead>
 
</table>

</div>


<? echo form_close() ?>
<script>


    $(document).ready(function()
    {
var imgEspera='<img class="espera" width="15px" src="'+$(window).data('base_url_img')+'/iconos/apply.png" alt="Ejecutado" title="Agendado" style="margin-left: 2px"/>'
var imgEjecutado='<img class="ejecutado activado" width="15px" src="'+$(window).data('base_url_img')+'/iconos/valid.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var tablePacientes = $('#tbPacientes').DataTable( {
        "sScrollY": 300,"bJQueryUI": true, "sPaginationType": "full_numbers",
        "columns": [
            {
                "class":          'details-control',
                "orderable":      false,
                "data":           "img",
                "defaultContent": ''
            },
            { "data": "cedula" },
            { "data": "nombre" },
        ],
        "order": [[0, 'asc']]
    } );
    


      $('#tbPacientes tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tablePacientes.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row

            if((row_last=$("#tbPacientes").data("row_last")) && (tr_last=$("#tbPacientes").data("tr_last")))
            {
                if(row_last!=row)
                {
                    row_last.child.hide();
                    tr_last.removeClass('shown');
                }
            }

            row.child( format(row.data())).show();
            tr.addClass('shown');
            $("#tbPacientes").data("row_last",row);
            $("#tbPacientes").data("tr_last",tr);
        }
    } );


        function format ( d ) {
        // `d` is the original data object for the row

        var tbProcedencia= '<br/><table class="" cellpadding="5" cellspacing="0" width="90%" border="0" style="padding-left:50px;">'+
                            '<tr role="row" class="even row_procedencia">'+
                '<td >Tratamiento Anterior:</td>'+
                '<td >Sala: </td>'+
                '</tr><tr class="even row_procedencia">'+
                '<td >Tratamiento Siguiente:</td>'+
                '<td >Sala:</td>'+
                '</tr>'+
        '</table></br>';


        var tb= '<br/><table class="display" cellpadding="5" cellspacing="0" width="90%" border="0" style="padding-left:50px;">';
        var tr="";
        
        $.each(d.otherdata, function(i,item)
        {
            var class_img="";
            if (item.img_ejecutar=="f")
            {
                img=imgEspera;
            }else
            {
                img=imgEjecutado;
                class_img=" row_activate ";
            }
            var _class="";
            if(i%2==0)
            {
                _class="odd";
            }else
            {
                _class="even";
            }
            tr=tr+'<tr id="'+item.id+'" class="'+_class+class_img+'" role="row">'+
                '<td width="8px" align="right"><b>Tratamiento:</b></td>'+
                '<td style="text-align: left" align="left">'+item.nombre_servicios+'</td>'+
                '<td align="right">Hora Inicio:</td>'+
                '<td style="text-align: left">'+item.hora_inicio+'</td>'+
                '<td align="right">Hora Fin:</td>'+
                '<td align="left">'+item.hora_fin+'</td>'+
                '<td align="right">Ubicación:</td>'+
                '<td>'+item.salas_dist_id+'</td>'+
                '<td class="img_accion">'+img+'</td>'+
                
            '</tr>';
        $("#tbPacientes").on("click"," tr#"+item.id+" td.img_accion img.espera",$.fnopciones);
        });
        tb=tb+tr+'</table><br/>';
        
        return tbProcedencia+tb;

    }

    $.fnopciones=function(event){


                                            var agenda_id=$(this).parent().parent().attr("id");
                                            if($(this).hasClass("espera")){
                                                var tr=$(this).parent().parent();

                                                $(this).parent().append(imgEjecutado);
                                                $(this).remove();
                                                 $.ajax({
                                                    type: "post",
                                                    data:{"mod":"procesos/salas","fn":"ejecutarCita","cnt":"1","param1":agenda_id,"tipo":"activar"},
                                                    url: $(window).data('base_url_index')+"/globales/json",
                                                    cache: true,
                                                    dataType: "json",
                                                    success: function(datos)
                                                           {
                                                                    var row_activate=tr;
                                                                    $.each(datos, function(i,item)
                                                                    {
                                                                        if(item.act==1)
                                                                        {
                                                                            row_activate.removeClass("row_activate");
                                                                            row_activate.addClass("row_activate");
                                                                        }
                                                                    });


                                                           }
                                                });




                                            }
                                    }



    function loadData()
    {
        $.ajax({
                    type: "post",
                    data:{"mod":"procesos/salas","fn":"tbTratamientosDia","cnt":"1","param1":1,"tipo":"tbPacientes"},
                    url: $(window).data('base_url_index')+"/globales/json",
                    cache: true,
                    dataType: "json",
                    success: function(datos)
                           {
                               verver=datos;
                                    $.each(datos, function(i,item)
                                    {
                                        tablePacientes.row.add( {"img":"","cedula":item.cedula,"nombre":item.paciente_nombres,"otherdata":item.otherdata}).draw();
                                    });

                           }
                });
    }
    
    loadData();
    
        
    });
 
    
</script>


<style>
table.display tr.odd.row_activate td {
    background-color: #78ce9f;
}

table.display tr.even.row_activate td {
    background-color: #addbc2;
}

table.display tr.even.row_procedencia td {
    background-color: #ecedc4;
}


</style>
