<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snpersonas extends Snsession {

    
        public function  __construct()
        {
            $this->rutamodelo='mantenimientos/';
            $this->modelo='personas_model';
            $this->ruta='/admin/snpersonas';
            $this->plantilla="snsession";
            $this->vista="snsession/admin/usuarios/personas";
            $this->objSubClass=$this;
            parent::__construct();
            
        }
        
	public function index()
	{
            plantilla($this->plantilla,$this->vista, $this->data);
	}

        

        public function limpiar()
        {
            redirect($this->ruta);
        }

        public function insertarExito($post=array())
        {
            $this->ruta="/admin/snusuarios";
            $row=$this->mod->getId(in_bsq_array_keys($post, "cedula"));
            $this->session->set_userdata(array("personas_id"=>$row->id));
            msj_exitoso("Datos agregados exitosamente");
        }
        
        public function insertarError()
        {
            if(!(stristr(instancia_controller()->erroresbd[1], 'personas_cedula_key') === FALSE))
            {
                msj_error("La cedula se encuentra registrada anteriormente");
            }else
            {
                msj_error("El Registro no se guardo correctamente");
            }
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
