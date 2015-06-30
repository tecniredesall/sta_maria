<?php

class Desccursos_model extends CI_Model {


    var $table="desc_cursos";
    
    public function __construct() {
        parent:: __construct();
    }


    function getCmb()
    {
        $query="select id,nombre as valor from $this->table";
        $sql = $this->db->query($query);
        return $sql->result();
    }


    //////////////////////////////////////////////////////////////////////////////////////


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
    ////////////////////////////////////////////////////////////////////////////////////////

      function getModulos($padre_id)
    {
        if(is_array($padre_id) && isset($padre_id['padre_id']))
        {
            $padre_id=$padre_id['padre_id'];
        }
        if($padre_id!="seleccione" && $padre_id!="@@@***@@@")
        {
            $this->db->from($this->table." as tb");
            $this->db->select('id,nombre as valor');
            $this->db->where('tb.nivel_id',$padre_id);
            $sql = $this->db->get();
            return $sql->result();
        }else
        {
            return array();
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