<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salinvprinc extends MY_Crud {

    public function  __construct()
        {
            $this->agregarJs=false;
            $this->rutamodelo='invfarmacias/';
            $this->modelo='inventarios_model';
            $this->ruta='invfarmacias/salinvprinc';
            $this->plantilla="principal";
            $this->vista="invfarmacias/salinvprinc";
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{

                    add_js_libs('modal_div_interno','jquery/plugins/lewebmonster-modal_iframe/js');
                    add_css_libs('ventanas-modales','jquery/plugins/lewebmonster-modal_iframe/css');
                    add_js_libs("listas", "helpers");
                    
                    $this->data['campos']=$this->campos;
                    $this->data['datatabla']=json_encode($this->mod->getList_sal_inv_princ()->result());
                    plantilla($this->plantilla,$this->vista, $this->data);
	}

        
        public function insertar()
        {
        if($this->agregar=="t" || $this->modePrg==true)
        {

            if($model=in_post(array($this->modelo)))
            {
                
                $salId=$this->mod->addSalInvPrin($model["sol_salas_id"]);
                if(($ids=in_post(array($this->modelo,"seleccion"))) && ($cant=in_post(array($this->modelo,"cnt"))))
                {
                    foreach ($ids as $ids_val)
                    {
                        $this->mod->addPrdInvPrin(1,$salId,$ids_val,$cant[$ids_val]);
                    }
                }
                
                    msj_exitoso("Los Productos fueron añadidos Correctamente");
                    $this->session->set_userdata(array("flash"=>$this->flash));
                
            }
        }
        redirect("$this->ruta");
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



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
