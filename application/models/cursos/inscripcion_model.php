<?php

class Inscripcion_model extends CI_Model {


    var $table="inscripcion";
    var $estudiantes_id=-1;
    public function __construct() {

        parent:: __construct();
        $this->estudiantes_id=$this->session->userdata("estudiantes_id");
        if($this->estudiantes_id=="" || $this->estudiantes_id==null)
        {
            $this->estudiantes_id=-1;
        }
    }


    function getCmb()
    {
        $query="select id,nombre as valor from $this->table";
        $sql = $this->db->query($query);
        return $sql->result();
    }


    //////////////////////////////////////////////////////////////////////////////////////

    function getCalendario()
    {
        $query="select calendario_id as id,* from fn_calendario_inscripcion($this->estudiantes_id)";
        $sql = $this->db->query($query);
        return $sql->result();
    }
    
    
    
    function getInscritos($calendario_id=-1)
    {
        $query="select est.* from vst_estudiantes as est inner join vst_inscripcion as ins on est.id=ins.estudiantes_id where ins.calendario_id=$calendario_id";
        $sql = $this->db->query($query);
        return $sql->result();
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    function json_insertar($param=array())
    {
        $rsData=array();
        if(!empty($param))
        {
            $estudiantes=$this->session->userdata("estudiantes_id");
            if($estudiantes!="" || $estudiantes!=null)
            {
                $query="insert into inscripcion (cursos_id,estudiantes_id) values($param[0],$estudiantes)";
                $sql = $this->db->query($query);
                $rsData=$sql->result();
            }
        }
        return $rsData;
    }


    function json_inscribir($param=array())
    {
        
        $rsData=array(array("confirm"=>"1"));
        if(!empty($param))
        {
            $estudiantes_id=$this->session->userdata("estudiantes_id");
            if($estudiantes_id!="" || $estudiantes_id!=null)
            {
                $obj=instancia_controller();
                $obj->db_exception=false;
                $query="select fn_inscribir($param[0],$estudiantes_id,$param[1]);";
                $sql = $this->db->query($query);
                if(is_array($obj->erroresbd) &&  isset(instancia_controller()->erroresbd[1]))
                {
                    if(!(stristr(instancia_controller()->erroresbd[1], 'MAX_PERMITIDO') === FALSE))
                    {
                            $rsData=array(array("confirm"=>"-1"));

                    }else
                    {
                        $rsData=array(array("confirm"=>"-100"));
                    }
                }
            }
        }
        return $rsData;
    }


    function json_cancelar($param=array())
    {
        $rsData=array();
        if(!empty($param))
        {
            
            
            if($this->estudiantes_id!="" || $this->estudiantes_id!=null)
            {
                $query="select fn_elim_inscripcion($param[0],$this->estudiantes_id,$param[1]) as elim";
                $sql = $this->db->query($query);
                $rsData=$sql->result();
            }
        }
        return $rsData;
    }



    function insertar($datos)
    {
        return $this->db->insert("$this->table",$datos);
    }


    function actualizar($datos,$id=-1)
    {
       return $this->db->update($this->table, $datos,array("id"=>$id));

    }

    function eliminar($where=array())
    {
        if(!empty($where))
        {
            return $this->db->delete("$this->table", $where);
        }
        return null;
    }


   
}
?>