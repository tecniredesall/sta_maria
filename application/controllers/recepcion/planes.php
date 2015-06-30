<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planes extends MY_Crud {
    
        public function  __construct()
        {

            $this->rutamodelo='recepcion/';
            $this->modelo='planes_model';
            $this->ruta='recepcion/planes';
            $this->plantilla="principal";
            $this->vista="recepcion/planes";
            $this->campos=array("Nombre"=>"nombre","Precio"=>"precio");
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{   

            add_js_libs("jquery.autocomplete", "jquery/plugins/devbridge-autocomplete1_2_12");
            add_js_libs("listas", "helpers");
            add_css_libs('style','jquery/plugins/devbridge-autocomplete1_2_12');
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=array();
            $this->data['campos1']=$this->campos;
            $this->data['datatabla1']=array();
            $this->data['plan_id']=$this->mod->addPlanTmp();
            plantilla($this->plantilla,$this->vista, $this->data);
            
	}

        public function insertar()
        {
        
            msj_exitoso("Se Creo el Plan de citas Satisfactoriamente");
            $this->session->set_userdata(array("flash"=>$this->flash));
            redirect($this->ruta);
    }


        

        public function redireccionar($op=1)
        {
            
            if($op==1)
            {
                $this->session->set_userdata(array("space"=>array("global"=>array("admision"=>"1"))));
                redirect("mantenimientos/personas");
            }else
            if($op==2)
            {
                redirect($this->ruta);
            }
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
