<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends MY_Crud {

        public function  __construct()
        {
            
            $this->rutamodelo='mantenimientos/';
            $this->modelo='productos_model';
            $this->ruta='mantenimientos/productos';
            $this->plantilla="principal";
            $this->vista="mantenimientos/productos";
            $this->campos=array("Código"=>"cod_unico","Nombre Producto"=>"nombre","Descripcion"=>"descripcion");
            $this->objSubClass=$this;
            $this->fnActualizar="getListVst";
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{   
            
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=$this->mod->getListVst()->result();
            plantilla($this->plantilla,$this->vista, $this->data);
	}

           public function insertar()
    {
        if($this->agregar=="t" || $this->modePrg==true)
        {
            if($varii=in_post(array($this->modelo)))
            {
                $insertar=$this->mod->addProducto($varii);
                if($insertar=='t' && empty($this->erroresbd))
                {
                    if($this->modePrg==false)
                    {
                         $this->seg->registro($this->nombrePrg,"Insertar",$this->usuario_id,$this->panelId,$this->nivel);
                    }
                    $this->objSubClass->insertarExito();
                }else
                {
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





        public function actualizarExito($id = -1) 
        {
            msj_exitoso("Registro fue actualizado exitosamente");
        }
        
        public function actualizarError($id = -1) 
        {
            msj_error($this->erroresbd[1]);
            msj_error("Error al actualizar El registro");
        }

        public function limpiar()
        {
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
