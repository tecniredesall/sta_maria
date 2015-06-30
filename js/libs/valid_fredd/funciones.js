
var ruta_base=$("#_hd_ruta_base_").val();
var  dtitem;
var  dti;


function addDataSessions(vari,valor,fnSuccessData)
{
                
                
                jsontxt='{"json['+vari+']":"'+valor+'"}';
                $.ajax({
                    type: "post",
                    data:$.parseJSON(jsontxt),
                    url: $(window).data("base_url")+"/globales/json/set_data_sessiones",
                    cache: true,
                    dataType: "json",
                    success:  function(data, textStatus, jqXHR )
                    {
                        $.each(data, function(i,item)
                        {
                            if(item==1)
                            {
                                if($.isFunction(fnSuccessData))
                                {
                                    fnSuccessData();
                                }
                                
                            }
                            
                        })
                        
                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        

                    },
                    complete: function(jqXHR,textStatus)
                    {
                        

                    }
               });
     
}

function ajaxJson(jsonParams,fnReady,fnData,fnEach)
{
                
                $.ajax({
                    type: "post",
                    data:jsonParams,
                    url: $(window).data("base_url_index")+"/globales/json",
                    cache: true,
                    dataType: "json",
                    success:  function(data, textStatus, jqXHR )
                    {
                        status=textStatus;
                        if($.isFunction(fnData))
                        {
                                    fnData(data);
                        }
                        $.each(data, function(i,item)
                        {
                            if($.isFunction(fnEach))
                            {
                                    fnEach(i,item);
                            }
                        })
                        if($.isFunction(fnReady))
                        {
                                    fnReady(textStatus);
                        }

                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        
                        if($.isFunction(fnReady))
                        {
                                    fnReady(textStatus);
                        }
                    }
               });
}


function checkTable(etiqueta,fnSelect,fnUnSelect)
{
    function onChange(event)
    {
        
            var row=$(this).parent().parent();
            var id=row.attr("id");
            
            if ( row.hasClass("row_selected") ) {
                row.removeClass("row_selected");
                if($.isFunction(fnUnSelect))
                {
                          fnUnSelect(event,this,row,id);
                }
            }
            else {
                row.addClass("row_selected");
                if($.isFunction(fnSelect))
                {
                          fnSelect(event,this,row,id);
                }
            }
    }

$(etiqueta).off("change",onChange);
$(etiqueta).on("change",onChange);
}

function changeTxt(objtxt,fn,fnEmpty,value)
{
    
    function onkeyup(event)
    {
        
        if(enterTab(event))
                {
                    if(!emptytxt(objtxt.val()))
                    {
                        if($.isFunction(fn))
                        {
                          fn(event,this,value);
                        }
                    }else
                    {
                        if($.isFunction(fn))
                        {
                            fnEmpty(event,this,value);
                        }

                    }
                }
    }


    function onBlur(event)
    {
                    if(!emptytxt(objtxt.val()))
                    {
                        if($.isFunction(fn))
                        {
                            fn(event,this,value);
                        }
                    }else
                    {
                        if($.isFunction(fn))
                        {
                            fnEmpty(event,this,value);
                        }   
                    }
    }


    objtxt.off("keyup",onkeyup);
    objtxt.off("blur",onBlur);
    
    objtxt.on("keyup",onkeyup);
    objtxt.on("blur",onBlur);
}



function FloatFormatToFloat(num)
{
    if(emptytxt(num))
    {
               num=0;
    }else
    {
        num=num.toString().replace(/\$|\./g,'');
        num=num.toString().replace(/\$|\,/g,'.');
    }
    
    return parseFloat(num);
}

function BsToFloat(num)
{
    if(emptytxt(num))
    {
               num=0;
    }else{
        num=num.substr(3, num.length);
        num=num.toString().replace(/\$|\./g,'');
        num=num.toString().replace(/\$|\,/g,'.');
    }
    return parseFloat(num);
}

function FloatTomonedaBsf(num)
{
	num=num.toString().replace(/\$|\./g,',');
        return monedaBsf(num);
}




function monedaBsf(value)
{

        value=moneda(value);
        if(value=="")
        {
            value=0;
        }
        return "Bs."+value;
}
function moneda(num){
	if (parseFloat(num) > 0)
	{

                
                if(num.toString().indexOf(",")==-1)
                {
                    centms="";
                }else
                {
                    centms=num.toString().substr(num.toString().indexOf(",")+1, num.toString().length);
                    centms=centms.toString().replace(/\$|\,/g,'');
                    centms=","+centms;
                    num=num.toString().substr(0, num.toString().indexOf(","));
                }
		num = num.toString().replace(/\$|\,/g,'');
                num = num.toString().replace(/\$|\./g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
                val=(((sign)?'':'-')  + num+centms);
		return val;
        
	} else {
		return "";
            }
        }


        function validarRadios(array_campos)
        {
            band=0;
            var grupos=new Array();
            cnt=$(array_campos).length;

            for(var i=0; i < cnt; i++)
            {
                obj = $(array_campos[i]);
                if(obj.hasClass("not_validate"))
                {
                    continue;
                }
                agregargrp(grupos,obj,"radio");
            }

            for(var x=0;x<grupos.length;x++)
            {
                attr=grupos[x];
                check = $("input[type='radio'][name='"+attr[0]+"']:checked").length;
                if(check<1)
                {
                    band=1;
                    $(".span_rad_"+attr[1]).addClass("error");
                }
            }
            if(band==1)
            {
                return false;
            }else
            {
                return true
            }
        }

        function validarChecks(array_campos)
        {
            band=0;
            var gruposChecks=new Array();
            cnt=$(array_campos).length;
            for(var i=0; i < cnt; i++)
            {
                obj = $(array_campos[i]);
                if(obj.hasClass("not_validate"))
                {
                    continue;
                }
                agregarGrpCheck(gruposChecks,obj);
            }

            for(var x=0;x<gruposChecks.length;x++)
            {

                attr=gruposChecks[x];
                check = $("input[type='checkbox'][grupo='"+attr[0]+"']:checked").length;
                if(check<attr[1])
                {
                    band=1;
                    $(".span_check_"+attr[0]).addClass("error");
                }
            }
            if(band==1)
            {
                return false;
            }else
            {
                return true
            }
        }


        function agregargrp(array_rad,obj,tipo)
        {
            attrname=obj.attr("name");
            attrid=obj.attr("id");
            datos=new Array(attrname,attrid);
            
            if(tipo=="radio")
            {
            }else
            if(tipo=="check")
            {
                datos[2]=obj.attr("cntchecks");
                datos[3]=obj.attr("grupo");
            }
            
            find=false;
            for(var i=0;i<array_rad.length;i++)
            {
                if(array_rad[i][0]==attrname)
                {
                    find=true;
                    break;
                }
            }

            if(find==false)
            {
                array_rad.push(datos);
            }
        }


        function agregarGrpCheck(array_rad,obj)
        {
            
            cntChecks=obj.attr("cntchecks");
            grupos=obj.attr("grupo");
            
            datos=new Array(grupos,cntChecks);

            find=false;
            for(var i=0;i<array_rad.length;i++)
            {
                if(array_rad[i][0]==grupos)
                {
                    find=true;
                    break;
                }
            }
            if(find==false)
            {
                array_rad.push(datos);
            }
        }

        function validarCmpEmail(array_campos)
        {
            band=0;
            cnt=$(array_campos).length;
            for(i=0; i < cnt; i++)
            {

                email = $(array_campos[i]);
                if(email.hasClass("not_validate"))
                {
                    continue;
                }
                if(txtblanco(email)){
                    band=1;
                    email.addClass("error");
                }else
                {
                    if(!email.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i)){

                        band=1;
                        email.addClass("error");
                        email.val("");
                    }
                }               
            }
             if(band==1)
            {
                return false;
            }else
            {
                return true
            }
	}
        
        function txtblanco(campo)
        {
            if(campo.val().match(/^\s+$/) || campo.val().length==0)
            {
                campo.val("");
                return true;

            }else{
                return false;
            }

        }
        
        function emptytxt(txt)
        {
            if(txt.match(/^\s+$/) || txt.length==0)
            {
                return true;
            }else
            {
                return false;
            }
        }


        function validarCmpTexto(array_campos)
        {
            band=0;
            cnt=$(array_campos).length;
            
            for(i=0; i < cnt; i++)
            {
                var txt = $(array_campos[i]);
                if(txt.hasClass("not_validate"))
                {
                    continue;
                }
                if(txtblanco(txt))
                {
                    txt.addClass("error");
                    band=1;
                }
            }
             if(band==1)
            {
                return false;
            }else
            {
                return true;
            }
       }
       
        function validarCmpMoneda(array_campos)
        {
            band=0;
            cnt=$(array_campos).length;
            
            for(i=0; i < cnt; i++)
            {
                var txt = $(array_campos[i]);
                if(txtblanco(txt) || txt.val()=="Bs.")
                {
                    txt.addClass("error");
                    band=1;
                }
            }
             if(band==1)
            {
                return false;
            }else
            {
                return true;
            }
       }
       
       function CmpMonedaInicio(array_campos)
        {
            band=0;
            cnt=$(array_campos).length;
            
            for(i=0; i < cnt; i++)
            {
                
                cmp=$(array_campos[i]);
                if(txtblanco(cmp))
                {
                    cmp.val("Bs.0");
                }
                
            }
             
       }


        function validarCmpArea(array_campos)
        {
            band=0;
            cnt=$(array_campos).length;

            for(i=0; i < cnt; i++)
            {
                var txt = $(array_campos[i]);
                if(txt.hasClass("not_validate"))
                {
                    continue;
                }
                if(txtblanco(txt))
                {
                    txt.addClass("error");
                    band=1;
                }
            }
             if(band==1)
            {
                return false;
            }else
            {
                return true;
            }
       }

        function validarCmpfecha(array_campos)
        {
            cnt=$(array_campos).length;
            band=0;

            
            for(i=0; i < cnt; i++)
            {
                
                fecha = $(array_campos[i]);
                if(fecha.hasClass("not_validate"))
                {
                    continue;
                }
                if(txtblanco(fecha))
                {
                    
                    fecha.addClass("error");
                    fecha.val("");
                    band=1;
                    
                }else
                {
                    if(!fecha.val().match(/^\d{2,4}\-\d{1,2}\-\d{1,2}$/))
                    {
                        fecha.addClass("error");
                        fecha.val("");
                        band=1;
                    }
                }
            }
            if(band==1)
            {
                return false;
            }else
            {
                return true;
            }
        }


        function validarCombos(array_combos)
        {

            cnt=$(array_combos).length;
            band=0;
            for(i=0; i < cnt; i++)
            {
                cmb = $(array_combos[i]);
                if(cmb.hasClass("not_validate"))
                {
                    continue;
                }
                if(cmb.val()=='seleccione')
                {
                    chosen="div#"+cmb.attr("id")+"_chosen a";
                    $(chosen).addClass("error");
                    cmb.addClass("error");
                    band=1;
                }
            }
            if(band==1)
            {
                return false;
            }else
            {
                return true
            }
            band=0;

        }

        function eliminarCmbvacios(array_combos)
        {

            cnt=$(array_combos).length;
            
            for(i=0; i < cnt; i++)
            {
                cmb = $(array_combos[i]);
                if(cmb.val()=='seleccione')
                {
                    
                    selectedOption = $(cmb).find('option:selected');
                    $(selectedOption).attr("value","-1");
                    
                }
            }
        }


        function validarTelefono(array_tlfs)
        {
            band=0;
            cnt=$(array_tlfs).length;
            for(i=0; i < cnt; i++)
            {

                var tlf = $(array_tlfs[i]);
                if(tlf.hasClass("not_validate"))
                {
                    continue;
                }
                if(!txtblanco(tlf))
                {
                        if(tlf.val().match(/^\(\d{4}\)\s\d{3}-\d{2}-\d{2}$/))
                        {
                        }else
                        {
                            tlf.addClass("error");
                            band=1;
                        }
                }else
                {
                        band=1;
                        tlf.addClass("error");
                }
            }
            if(band==1)
            {
                return false;
            }else
            {
                return true
            }
            band=0;
        }






        ////////////////////////////////////////


        function removerClassError(cmp)
        {
            
            cmp.removeClass("error");
	}

        function removerClassCombos(cmb)
        {
                cmb.removeClass("error");   
        }



////////////////////////////////////////////////////////////////////



var letras=' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
var numeros='1234567890';
var signos=',.:;@-_';
var signosmatematicos='+-=()*/';
var personal='<>#$%&?';
var especiales = '\'\"';

function validar(evnt,tipo) {
	var temporal;
	temporal = document.all?parseInt(evnt.keyCode): parseInt(evnt.which);
	if (temporal == 13 || temporal == 8 || temporal == 0 || temporal == 9) return true;
	return (tipo.indexOf(String.fromCharCode(temporal)) != -1);
}

function enterTab(evnt)
{
    var temporal = document.all?parseInt(evnt.keyCode): parseInt(evnt.which);
    if(temporal == 13 || temporal == 8 || temporal == 0 || temporal == 9)
    {
        return true;
    }else
    {
        return false;
    }
    
}

function text_entero(valor){
   //intento convertir a entero.
   //si era un entero no le afecta, si no lo era lo intenta convertir
   valor = parseInt(valor);
    //comprobamos si es un valor entero
    if (isNaN(valor)) {
          //no es entero 0
          return 0;
    }else{
          //es un valor entero
          return valor;
    }
}


var mostrar_msj=false;
function msj_error(mensaje,obj)
{
        obj.css("display","none");
        obj.html("");
   var  msj="<div class='error flash dy' >";
        msj+="<table id='table_show_error'><tbody><tr>";
        msj+="<td valign='top' height='24px' align='right'><img height='24p' src='"+ruta_base+"/img/iconos/error.png'></td>";
        msj+="<td valign='middle' align='left'>"+mensaje+"</td></tr><tr>";
        msj+="</tr></tbody></table></div>";
        obj.css("display","");
        obj.append(msj);
        $("div .dy").show(0,function()
        {
             $(this).delay(20000);
             $(this).slideUp(2000, function(){});
        });
}


function msj_exitoso(mensaje,obj)
{
    alert("bien");
        
        obj.css("display","none");
        obj.html("");
   var  msj="<div class='valid flash dy' >";
        msj+="<table id='table_show_error'><tbody><tr>";
        msj+="<td valign='top' height='24px' align='right'><img height='24p' src='"+ruta_base+"/img/iconos/valid.png'></td>";
        msj+="<td valign='middle' align='left'>"+mensaje+"</td></tr><tr>";
        msj+="</tr></tbody></table></div>";
        obj.css("display","");
        obj.append(msj);
        $("div .dy").show(0,function()
        {
             $(this).delay(20000);
             $(this).slideUp(2000, function(){});
        });
}




