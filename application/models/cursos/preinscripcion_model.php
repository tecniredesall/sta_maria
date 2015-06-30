<?php

class Preinscripcion_model extends CI_Model {


    var $table="pre_inscripcion";
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
       $query="select fn.*,fn.calendario_id as id from fn_calendario_preinscripcion($this->estudiantes_id) as fn 
                inner join  cursos as cr on fn.cursos_id=cr.id inner join calendario as cal on fn.calendario_id=cal.id
                where cr.id not in (select id from fn_cal_turno_duplicado($this->estudiantes_id,cr.turnos_id, cal.fecha_inicio, cal.fecha_fin)) or 
                cr.id in (select cursos_id from pre_inscripcion where cursos_id=cr.id and estudiantes_id=$this->estudiantes_id)";
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
                $query="insert into pre_inscripcion (cursos_id,estudiantes_id) values($param[0],$estudiantes)";
                $sql = $this->db->query($query);
                //echo $rsData=$sql->result();
            }
        }
        return $rsData;
    }


    function json_preinscribir($param=array())
    {
        
        $rsData=array(array("confirm"=>"-1"));
        if(!empty($param))
        {
            
            $estudiantes_id=$this->session->userdata("estudiantes_id");
            if($estudiantes_id!="" || $estudiantes_id!=null)
            {
                $query="insert into pre_inscripcion (calendario_id,estudiantes_id,cursos_id,fecha_preinscripcion) values($param[0],$estudiantes_id,$param[1],now());";
                echo $query;
                $sql = $this->db->query($query);
                $rsData=array(array("confirm"=>"1"));
            }
        }
        return $rsData;
    }

    

    function json_cancelar($param=array())
    {
        $rsData=array();
        if(!empty($param))
        {
            $estudiantes_id=$this->session->userdata("estudiantes_id");
            if($estudiantes_id!="" || $estudiantes_id!=null)
            {
                $query="select fn_elim_preinscripcion($param[0],$estudiantes_id) as elim";
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