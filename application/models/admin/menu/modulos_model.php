<?php

class Modulos_model extends CI_Model {


    var $table="seguridad.menumodulos";
    
    public function __construct() {
        parent:: __construct();
    }

    
    function getCmb()
    {
        $query="select id,nombre as valor from $this->table where id!='-1'";
        $sql = $this->db->query($query);
        return $sql->result();
    }

    
    function getModulos($id="-1")
    {
        $where="";
        $this->db->from($this->table);
        $this->db->select("*");
        $this->db->where('id !=',"-1");
        if($id!=-1)
        {
            $this->db->where(array('id'=>$id));
            
        }
        

        $query="select * from seguridad.menumodulos $where";
        
        $sql = $this->db->get();;
        return $sql;
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