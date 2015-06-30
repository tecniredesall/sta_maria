<?php

class Rol_menu_model extends CI_Model {


    var $table="seguridad.rolmenu";
    
    public function __construct() {
        parent:: __construct();
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


    function getTabla()
    {

        $this->db->from("seguridad.vst_rl_mn as tb");
        $this->db->select("rlmn_id as id,*");
        return $this->db->get();
    }


    ////////////////////////////////////////////////////////////////////////////////////////

    
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