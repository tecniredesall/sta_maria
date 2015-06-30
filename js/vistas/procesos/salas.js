
    $(document).ready(function()
    {
        var imgEjecutar='<img class="pagado activado" width="15px" src="'+$(window).data('base_url_img')+'/iconos/valid.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        $("tr td.img_ejecutar").each(function()
        {
            if($(this).html()=="t")
            {
                $(this).html(imgEjecutar);
            }
        });

    });


