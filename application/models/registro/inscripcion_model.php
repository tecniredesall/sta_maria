<?php

class Inscripcion_model extends CI_Model {


    var $table="inscripcion";
    var $vista="vst_inscripcion_full";
    
    public function __construct() {
        parent:: __construct();
    }
    

    

    function getList($id="-1")
    {
        $this->db->from($this->table);
        $this->db->select("*");
        if($id!=-1)
        {
            $this->db->where(array('id'=>$id));
        }

        return $this->db->get();
    }
    
    function getListVista($where=array())
    {
         $query="select *,'-1'::integer as bsq from $this->vista";
         $sql=$this->db->query($query);
         return $sql;

        $this->db->from($this->vista);
        $this->db->select('*');
        if(!empty ($where))
        {
            $this->db->where($where);
        }
        return $this->db->get();
    }


    function insertarEstudiantes($personas_id=-1)
    {
        if($personas_id!=-1)
        {
         
            $this->db->from($this->table." as tb");
            $this->db->select("id");
            $this->db->where(array('tb.personas_id'=>$personas_id));
            $objResult=$this->db->get();
            if($objResult->num_rows())
            {
                return $objResult->row();
            }else
            {
                $this->db->insert("$this->table",array("personas_id"=>$personas_id));
                $this->db->from($this->table." as tb");
                $this->db->select("id");
                $this->db->where(array('tb.personas_id'=>$personas_id));
                $objResult=$this->db->get();
                return $objResult->row();
            }
        }
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