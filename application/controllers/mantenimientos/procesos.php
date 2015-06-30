<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Procesos extends MY_Crud {

  
        public function  __construct()
        {
            error_reporting(E_ALL);
            $this->rutamodelo='mantenimientos/';
            $this->modelo='procesos_model';
            $this->ruta='mantenimientos/procesos';
            $this->plantilla="principal";
            $this->vista="mantenimientos/procesos";
            $this->campos=array("Nombre"=>"nombre");
            $this->objSubClass=$this;
            $this->agregarJs=FALSE;
            $this->agregarCss=FALSE;
            parent::__construct();
            $this->cargarTabla();
        }
        
	public function index()
	{   
            add_js_libs('ventanas-modales','jquery/plugins/lewebmonster-modal_iframe/js');
            add_css_libs('ventanas-modales','jquery/plugins/lewebmonster-modal_iframe/css');
            
            $this->data['campos']=$this->campos;
            $this->session_id=$this->session->userdata("ss_id");
            $ids=$this->mod->add_ids($this->session_id);
            
            if($varTmp=$this->session->userdata("varTmp"))
            {
                $ids=$this->mod->ids($varTmp["id"]);
            }
            
            $this->data['datatabla']=$this->mod->getList("-1",array("sys"=>"false"))->result();
            $this->session->set_userdata(array("procesos_id"=>$ids->procesos_id,"desc_procesos_id"=>$ids->desc_procesos_id));
            
            plantilla($this->plantilla,$this->vista, $this->data);
	}

        public function actualizarExito($id = -1) 
        {
            msj_exitoso("Registro fue actualizado exitosamente");
        }
        
        public function actualizarError($id = -1) 
        {
            msj_error($this->erroresbd[1]);
            msj_error("Error al actualizar El registro");
        }

        
        
        public function insertar()
        {
            $this->session->unset_userdata("varTmp");
            if($this->agregar=="t" || $this->modePrg==true)
            {
                if($data=in_post(array($this->modelo)))
                {   
                    $data=array_merge($data,array("sys"=>'false'));
                    $this->mod->actualizar($data,$this->session->userdata("procesos_id"));
                    if(empty($this->erroresbd))
                    {
                    
                        if($data1=in_post(array("desc_procesos_model")))
                        {    
                            $data1=array_merge($data1,array("sys"=>'false'));
                            $this->mod->actualizar($data1,$this->session->userdata("desc_procesos_id"),"desc_proceso");
                            
                            if(empty($this->erroresbd))
                            {
                                $this->objSubClass->insertarExito();
                            }else
                            {
                                $this->erroresbd[1]="2";
                                $this->objSubClass->insertarError();
                            }
                        }
                    }else
                   {
                        $this->erroresbd[1]="1";
                        $this->objSubClass->insertarError();
                   }
                    
                }else
                {
                    $this->erroresbd[1]="1";
                    $this->objSubClass->insertarError();
                }
                $this->session->set_userdata(array("flash"=>$this->flash));

            }else
            {
                msj_error("Usted no tiene permiso para Agregar Registros");
                $this->session->set_userdata(array("flash"=>$this->flash));
            }
            redirect($this->ruta);
        }
        
        
        
        
        public function actualizar($id)
        {
            
          $this->session->unset_userdata("varTmp");
          if($this->modificar=="t" || $this->modePrg==true)
            {
                    if($varii=in_post(array($this->modelo)))
                    {
                         $data=$varii;
                         if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                         {
                             if($data1=in_post(array("desc_procesos_model")))
                             {
                                
                                if($this->mod->actualizar($data1,$this->session->userdata("desc_procesos_id"),"desc_proceso") && empty($this->erroresbd))
                                {
                                      $this->objSubClass->actualizarExito($id);
                                      $this->seg->registro($this->nombrePrg,"Actualizar",$this->usuario_id,$this->panelId,$this->nivel);
                                }else
                                {
                                    $this->objSubClass->actualizarError($id);
                                }
                             }
                             
                             
                             
                             
                         }else
                         {
                            $autoload["$this->modelo"]=array("id"=>$id,"function"=>"getList");
                            $autoload["desc_procesos_model"]=array("id"=>$id,"function"=>"getDesc_proceso");
                            $this->session->set_userdata(array("autoload"=>$autoload));
                            $this->session->set_userdata(array("varTmp"=>array("id"=>$ids)));
                            $this->objSubClass->actualizarError($id);
                         }
                         $this->session->set_userdata(array("flash"=>$this->flash));
                         redirect($this->ruta);
                    }else
                    {
                        
                        $autoload["$this->modelo"]=array("id"=>$id,"function"=>"getList");
                        $autoload["desc_procesos_model"]=array("id"=>$id,"function"=>"getDesc_proceso");
                        $this->session->set_userdata(array("autoload"=>$autoload));
                        $this->session->set_userdata(array("varTmp"=>array("id"=>$id)));
                        
                        
                         redirect($this->ruta);
                    }
           }else
           {
               msj_error("Usted no tiene permiso para Modificar Registros");
               $this->session->set_userdata(array("flash"=>$this->flash));
           }
           
           redirect($this->ruta);
        }
        
        

        public function insertarExito()
        {
            
            msj_exitoso("Registro fue agregado exitosamente");
        }
        
        public function insertarError()
        {
            msj_error($this->erroresbd[1]);
            msj_error("El Registro no se guardo correctamente");
        }

        
        public function eliminarExito($id)
        {
            msj_exitoso("Registro fue eliminado exitosamente");
            
        }

        public function eliminarError($id)
        {
            msj_error($this->erroresbd[0]);
            msj_error("El Registro no se Elimino correctamente");
        }


        public function imprimir()
        {
            $this->load->library("tcpdf_lib",array("format"=>"LETTER"),"pdf");
            $this->pdf->parametrosGenerales(array("titulo"=>"Personas Registradas","imgHeader"=>"generales/cintillo_header_fcite_aragua.jpg"));
            $this->pdf->inicializacion();
            $this->pdf->EncabezadoTabla_lib($this->camposPdf);
            $this->pdf->Tabla_lib($this->camposPdf,$this->mod->getList()->result());
            $this->pdf->ImprimirPdf_lib();
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
