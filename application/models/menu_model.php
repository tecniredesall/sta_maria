<?php

class Menu_model extends CI_Model {


    var $table="modulo";
    
    public function __construct() {
        parent:: __construct();
    }
    

    function verModulos()
    {
        $query="select id,id as ciudad_id, 20::integer as municipio_id,22::integer as parroquia_id from modulo limit 1";
        $sql = $this->db->query($query);
        return $sql; // trae el resultadop con el nombre de los cvampos
    }

    
    
    function insertar($datos)
    {
        return $this->db->insert("$this->table",$datos);
    }
    
    function actualizar($datos,$id=-1)
    {
       return $this->db->update("$this->table", $datos,"id=$id");
        
    }
    
    function eliminar($where=array(),$id=-1)
    {
        return $this->db->delete("$this->table", $where);
    }





   
}
?>