<?php

class Cursos_model extends MY_ModelCrud {


    public function __construct() {
        $this->table="cursos";
        $this->vst="vst_cursos";
        parent:: __construct();
    }


    function getCmb()
    {
        //parent::getCmb();
        $query="select id,calendario_id,nombre as valor from vst_cursos";
        $sql = $this->db->query($query);
        return $sql->result();
    }
    
    function getCmbCursosDisponibles()
    {
        //parent::getCmb();
        $query="select id,calendario_id,nombre as valor from vst_cursos";
        $sql = $this->db->query($query);
        return $sql->result();
    }
    
    function activarCurso($calendario_id=-1)
    {
        $this->db->update($this->table, array("iniciado"=>"TRUE"),array("calendario_id"=>$calendario_id));
        return true;
    }

    
    //////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////////
    
  
}
?>