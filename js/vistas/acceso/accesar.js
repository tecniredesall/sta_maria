$(document).ready(function()
{
     $(".dy").show(0,function()
     {
         $(this).delay(20000);
         $(this).slideUp(2000, function(){});
     });
});