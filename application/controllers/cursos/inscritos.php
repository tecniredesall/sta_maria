<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscritos extends MY_Crud {
    
        public function  __construct()
        {
            $this->accion="/../activar";
            $this->imprimir=true;
            $this->rutamodelo='cursos/';
            $this->modelo='inscripcion_model';
            $this->ruta='/cursos/inscritos/ver';
            $this->plantilla="principal";
            $this->vista="cursos/inscritos";
            $this->campos=array("Cedula"=>"cedula","Nombre"=>"nombres","Apellido"=>"apellidos","Tlf. Celular"=>"tlf_celular","Correo"=>"correo");
            $this->camposPdf=array("Cédula"=>array("campo"=>"cedula","tamanoW"=>"27"),"Nombres"=>array("campo"=>"nombres","tamanoW"=>"45"),"Apellido"=>array("campo"=>"apellidos","tamanoW"=>"45"),"Teléfono\nCelular"=>array("campo"=>"tlf_celular","tamanoW"=>"40"),"Teléfono\nLocal"=>array("campo"=>"tlf_local","tamanoW"=>"40"));
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	
        
        public function ver($calendario_id=-1)
        {
            $this->accion.="/".$calendario_id;
            $this->btnLimpiar=controller_actual()."/../../limpiar/".$calendario_id;
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=$this->mod->getInscritos($calendario_id);
            plantilla($this->plantilla,$this->vista, $this->data);
        }
        
        
        public function activar($calendario_id=-1)
        {
            $this->load->model("cursos/cursos_model","cursos");
            if($this->cursos->activarCurso($calendario_id)==true)
            {
                msj_exitoso("El Curso fue Activado Satisfactoriamente");
                $this->session->set_userdata(array("flash"=>$this->flash));
            }
            redirect($this->ruta."/".$calendario_id);
        }

        
        
        public function actualizar($id)
        {
           if($varii=in_post(array($this->modelo)))
           {
                $data=$varii;
                if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                {
           
                    msj_exitoso("Registro fue actualizado exitosamente");
                }else
                {
                    msj_error($this->erroresbd[1]);
                    msj_error("Error al actualizar El registro");
                    $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getParticipantes")));
                }
                $this->session->set_userdata(array("flash"=>$this->flash));
                redirect($this->ruta);
           }else
           {
                $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getParticipantes")));
                redirect($this->ruta);
           }  
        }

        public function limpiar($calendario_id=-1)
        {
            redirect($this->ruta."/".$calendario_id);
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
