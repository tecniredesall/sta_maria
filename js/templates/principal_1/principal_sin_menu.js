$(window).ready(function()
{
     $(".dy").show(0,function()
     {
         $(this).delay(20000);
         $(this).slideUp(2000, function(){});
     });
     
    
    

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


