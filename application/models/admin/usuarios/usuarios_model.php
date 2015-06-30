<?php

class Usuarios_model extends MY_ModelCrud {


    var $table="seguridad.usuarios";
    
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

    function verificarOldClave($usuario_id,$clave)
    {
        $this->db->from($this->table);
        $this->db->where(array("id"=>$usuario_id,"clave"=>$clave));
        $this->db->select("*");
        $data=$this->db->get();
        if($data->num_rows()>0)
        {
            return true;
        }else
        {
            return false;
        }
    }
    
    
    
    function bloquear($id,&$msj)
    {
        $this->db->from($this->table);
        $this->db->where(array("id"=>$id));
        $this->db->select("estatus");
        $data=$this->db->get();
        $data=$data->row();
        $estatus=$data->estatus;
        
        if($estatus=="t")
        {
            $msj="El usuario Fue Bloqueado exitosamente";
            $this->actualizar(array("estatus"=>"false"), $id);
            return false;
        }else
        if($estatus=="f")
        {
            $msj="El usuario Fue Desbloquedo exitosamente";
            $this->actualizar(array("estatus"=>"true"), $id);
            return true;
        }
    }

}
?>