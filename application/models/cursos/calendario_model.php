<?php

class Calendario_model extends CI_Model {


    var $table="calendario";
    var $vista="vst_calendario";
    
    public function __construct() {
        parent:: __construct();
    }


    function getCmb()
    {
        $query="select id,nombre as valor from $this->table";
        $sql = $this->db->query($query);
        return $sql->result();
    }


    function getCalendarioId($id=-1)
    {
        
        if($id!=-1){
            
            $this->db->from("$this->vista");
            $this->db->where(array("id"=>"$id"));
            return $this->db->get()->result();
        }else
        {
            return array();
        }
    }

    function getCalendarioProfCursos($cursos_id=-1)
    {
        
        echo $cursos_id;
        if($cursos_id!=-1)
        {
            
            $query="select * from fn_calendario_prof_cursos($cursos_id,1);";
            $sql=$this->db->query($query);
            return $sql->result();
        }else
        {
            return array();
        }
    }






    //////////////////////////////////////////////////////////////////////////////////////

    function getCalendario()
    {
        $query="select *,id as idbd from $this->vista";
        //$query="select id,fecha_inicio,fecha_fin,iniciado from $this->table";
        $sql = $this->db->query($query);
        return $sql->result();
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////


    
    function json_insertar($param=array())
    {
        $rsData=array();
        if(!empty($param))
        {
            $query="select fn_agr_calendario('$param[0]','$param[1]',1) as id";
            $sql = $this->db->query($query);
            $rsData=$sql->result();
        }
        return $rsData;
    }
    
    function json_eliminar($param=array())
    {
        $rsData=array();
        if(!empty($param))
        {
            $query="select fn_elim_calendario($param[0]) as confirm";
            $sql = $this->db->query($query);
            $rsData=$sql->result();
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