<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salas extends MY_Crud {

    
        public function  __construct()
        {
            error_reporting(E_ALL);
            $this->rutamodelo='procesos/';
            $this->modelo='salas_model';
            $this->ruta='procesos/salas';
            $this->plantilla="principal";
            $this->vista="procesos/salas";
            $this->campos=array("Cedula"=>"cedula","Nombre"=>"paciente_nombres","Hora Inicio"=>"hora_inicio","Hora Fin"=>"hora_fin");
            $this->objSubClass=$this;
            $this->agregarJs=true;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{   
             
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=$this->mod->tratamientosDia()->result();
            plantilla($this->plantilla,$this->vista, $this->data);
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
