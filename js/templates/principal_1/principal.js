$(window).ready(function()
{
     $(".dy").show(0,function()
     {
         $(this).delay(20000);
         $(this).slideUp(2000, function(){});
     });
     
    //setTimeout("alert('5 seconds later!')", 5000);


    

    salirPrograma=function()
    {
             window.location.assign($(window).data("base_url_index")+"/user/salir");
    }

    activarTiempo=function()
    {
        setTimeout("salirPrograma()", (parseInt($(window).data("sess_expiration"))*1000));
    }
    setTimeout("activarTiempo()",5000);
    

     var config = {
      '.chosen-select'           : {
        disable_search_threshold: 10,
        no_results_text: "Sin Resultados!",
        width: "90%"
      },
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    
    }

});


