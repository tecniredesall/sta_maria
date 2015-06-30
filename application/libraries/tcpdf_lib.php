<?php if(!defined('BASEPATH'))         exit('No direct script access allowed');

include_once(APPPATH."libraries/tcpdf/config/lang/eng.php") ;
include_once(APPPATH."libraries/tcpdf/tcpdf.php") ;
class Tcpdf_lib extends TCPDF
{
    
    private $sub_orientacion='P';
    private $sub_unit='mm';
    private $sub_format='LETTER';
    private $sub_unicode=true;
    private $sub_encoding='UTF-8';
    private $sub_diskcache=false;
    private $sub_pdfa=false;


    public $margenPie=10;
    public $rutaImgs="../../../../img/";

    
    public $paramCfg=array("autor"=>"fhidalgo","destPdf"=>"I","nombrePdf"=>"REPORTE_PDF");
    public $paramGenerales=array("titulo"=>"SN_TITULO","imgHeader"=>"generales/cintillo_header_fcite_aragua.jpg","margenIzquierda"=>10,"margenDerecha"=>10,"margenArriba"=>20,"margenEncabezado"=>PDF_MARGIN_HEADER,"margenPie"=>PDF_MARGIN_FOOTER,"letraAlineacionH"=>"C");

    
    public $paramEncab=array("imprimirPdf"=>true,"letra"=>"times","tamanoLetra"=>13,"tamanoAlto"=>"12","marco"=>TRUE,"letraCursiva"=>FALSE,"letraNegrita"=>TRUE,"letraSubrayada"=>FALSE,"letraAlineacionH"=>"C");
    public $paramTabla=array("imprimirPdf"=>true,"letra"=>"times","tamanoLetra"=>11,"tamanoAlto"=>"11","marco"=>TRUE,"letraCursiva"=>FALSE,"letraNegrita"=>FALSE,"letraSubrayada"=>FALSE,"letraAlineacionH"=>"C");

    
    
    
    function  __construct($param=array())
    {
            if (!empty ($param))
            {
                parent::__construct($this->vfParams("orientacion",$param),$this->vfParams("unit",$param), $this->vfParams("format",$param), $this->vfParams("unicode",$param), $this->vfParams("encoding",$param), $this->vfParams("diskcache",$param), $this->vfParams("pdfa",$param));

            }else
            {
                parent::__construct();
                
            }
            
            

    }
    
    private function vfParams($params,$arr_valores)
    {
        $vari="sub_".$params;
        if(isset($this->$vari))
        {
            if(isset($arr_valores[$params]))
            {
                $this->$vari=$arr_valores[$params];
                return $arr_valores[$params];
            }else
            {
                return $this->$vari;
            }
        }
    }



    public function inicializacion()
    {
        $this->SetCreator(PDF_CREATOR);
        
        //public $paramGenerales=array("titulo"=>"SN_TITULO","imgHeader"=>"generales/cintillo_header_fcite_aragua.jpg","margenIzquierda"=>10,"margenDerecha"=>10,"margenArriba"=>10,"margenEncabezado"=>PDF_MARGIN_HEADER,"margenPie"=>PDF_MARGIN_FOOTER,"letraAlineacionH"=>"C");
        $this->SetAuthor(in_bsq_array_keys($this->paramCfg, "autor"));
        $this->SetHeaderData($this->rutaImgs.in_bsq_array_keys($this->paramGenerales, "imgHeader"), 197, "", "",$tc=array(0,64,0), $lc=array(255,255,255));

        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $this->SetMargins(in_bsq_array_keys($this->paramGenerales, "margenIzquierda"), in_bsq_array_keys($this->paramGenerales, "margenArriba"), in_bsq_array_keys($this->paramGenerales, "margenDerecha"),true);

        $this->SetHeaderMargin(in_bsq_array_keys($this->paramGenerales, "margenEncabezado"));
        $this->SetFooterMargin(in_bsq_array_keys($this->paramGenerales, "margenPie"));

        $this->setFontSubsetting(true);
        $this->SetFont('times', '', 11, '', true);

        //$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $this->AddPage();
        $this->SetFont('times', 'B', 15, '', true);
        $this->Write($h=0, in_bsq_array_keys($this->paramGenerales, "titulo"), $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
        $this->ln(5);
    }



    public function Encabezado_lib()
    {

    }

    public function EncabezadoTabla_lib($data=array())
    {
         
         
         if(!empty ($data))
         {
             foreach($data as $keys=>$values)
             {
                 
                 if(!is_null($val=in_bsq_array_keys($values, "imprimirPdf")))
                 {
                     if($val==true)
                     {
                            $this->imprimirCeldasEncabezado($keys, $values);
                     }else
                     {
                         continue;
                     }
                 }else
                 {
                    $this->imprimirCeldasEncabezado($keys, $values);
                 };
             }
             
         }
    }

    public function tabla_lib($datainfo=array(),$dataValor=array())
    {
        
         $this->ln();
         $out=false;
         if(!empty ($dataValor) && !empty ($datainfo))
         {
            
             foreach ($dataValor as $campoData)
             {

                 
                 
                 foreach($datainfo as $keys=>$values)
                 {

                     
                     if($this->GetY()+$this->buscarCfg("tamanoAlto",$this->paramTabla,$values)+10>($this->getPageHeight() - $this->getFooterMargin() - $this->margenPie))
                     {
                        $this->AddPage();

                     }

                     if(!is_null($val=in_bsq_array_keys($values, "imprimirPdf")))
                     {
                         if($val==true)
                         {
                                $out=true;
                                $campo=in_bsq_array_keys($values, "campo");
                                $this->imprimirCeldasTabla($campoData->$campo, $values);
                         }else
                         {
                             continue;
                         }
                     }else
                     {
                        $out=true;
                        $campo=in_bsq_array_keys($values, "campo");
                        $this->imprimirCeldasTabla($campoData->$campo, $values);
                     };
                 }
                 
                 if($out)
                 {
                    $out=false;
                    $this->ln();
                 }
             }


         }
    }

    
    private function imprimirCeldasEncabezado($nombreColum,$valores)
    {

        $tamano=in_bsq_array_keys($valores, "tamanoW");
        if($tamano)
        {
                #6f6f6f
                $this->SetFillColor(191, 191, 191);
                $this->SetFont($this->buscarCfg("letra",$this->paramEncab,$valores), $this->tipoLetra($this->paramEncab,$valores), $this->buscarCfg("tamanoLetra",$this->paramEncab,$valores));
                $this->MultiCell($tamano, $this->buscarCfg("tamanoAlto",$this->paramEncab,$valores), $nombreColum, $this->buscarCfg("marco",$this->paramEncab,$valores), $this->buscarCfg("letraAlineacionH",$this->paramEncab,$valores), true, 0, '', '', true, 0, false, true, $this->buscarCfg("tamanoAlto",$this->paramEncab,$valores), 'M');
        }
    }


    private function imprimirCeldasTabla($valorColum,$valores)
    {
        $tamano=in_bsq_array_keys($valores, "tamanoW");
        if($tamano)
        {
                $this->SetFont($this->buscarCfg("letra",$this->paramTabla,$valores), $this->tipoLetra($this->paramTabla,$valores), $this->buscarCfg("tamanoLetra",$this->paramTabla,$valores));
                $this->MultiCell($tamano, $this->buscarCfg("tamanoAlto",$this->paramTabla,$valores), $valorColum, $this->buscarCfg("marco",$this->paramTabla,$valores), $this->buscarCfg("letraAlineacionH",$this->paramTabla,$valores), 0, 0, '', '', true, 0, false, true, $this->buscarCfg("tamanoAlto",$this->paramTabla,$valores), 'M');
        }
    }


    

    private function buscarCfg($props,$paramCfglib,$paramCfg=array())
    {
      
        $valor=in_bsq_array_keys($paramCfg, $props);
        if(!is_null($valor))
        {
            return $valor;
        }else
        {   
            $valor=in_bsq_array_keys($paramCfglib, $props);
            return $valor;
        }
    }

 

    private function tipoLetra($paramCfglib,$paramCfg)
    {
            $tipoLetra="";
            if($this->buscarCfg("letraNegrita",$paramCfglib,$paramCfg)==true)
            {
                $tipoLetra.="B";
            }
            if($this->buscarCfg("letraCursiva",$paramCfglib,$paramCfg)==true)
            {
                $tipoLetra.="I";
            }
            if($this->buscarCfg("letraSubrayada",$paramCfglib,$paramCfg)==true)
            {
                $tipoLetra.="U";
            }
        return  $tipoLetra;
    }




    public function PiePagina_lib()
    {

    }


    public function ImprimirPdf_lib()
    {
        $this->Output(in_bsq_array_keys($this->paramCfg, "nombrePdf").".pdf", in_bsq_array_keys($this->paramCfg, "destPdf"));
    }



    public function parametrosEncabezado($array=array())
    {
             cmpArrSobrescribir($this->paramEncab,$array);
    }


    public function parametrostabla($array=array())
    {
             cmpArrSobrescribir($this->paramTabla,$array);
    }


    public function parametrosGenerales($array=array())
    {
             cmpArrSobrescribir($this->paramGenerales,$array);
    }

    
    public function parametrosCofiguracion($array=array())
    {
             cmpArrSobrescribir($this->paramCfg,$array);
    }


    

    

    


    


}