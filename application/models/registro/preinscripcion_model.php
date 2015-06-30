<?php

class Preinscripcion_model extends CI_Model {


    var $table="pre_inscripcion";
    
    public function __construct() {
        parent:: __construct();
    }

    
    function getCmb()
    {
        $query="select id,nombre as valor from $this->table";
        $sql = $this->db->query($query);
        return $sql->result();
    }

    function getList($id="-1")
    {
        $this->db->from($this->table." as tb");
        $this->db->select("*");
        if($id!=-1)
        {
            $this->db->where(array('tb.id'=>$id));
        }
        return $this->db->get();
    }

    function getCedula($cedula=-1)
    {
        $this->db->from("personas as tb");
        $this->db->select("id");
        if($cedula!=-1)
        {
            $this->db->where(array('tb.cedula'=>$cedula));
        }
        $objResul=$this->db->get();
        return $objResul;
    }

    function getCntPreinscripciones($estudiantes_id=-1)
    {
        //crear function en postgres que me diga que se pueden inscribir solo 7 dias antes;
        $this->db->from("$this->table");
        $this->db->where(array("estudiantes_id"=>$estudiantes_id));
        return $this->db->count_all_results();
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