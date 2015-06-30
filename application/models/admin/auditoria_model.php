<?php

class Auditoria_model extends MY_ModelCrud {


    
    public function __construct() {
        parent:: __construct();
        $this->table="seguridad.auditoria";
    }
    
    
    
    public function buscarIdPnl($usuario_id,$panel)
    {
      $sql="select * from seguridad.dtpanel('$panel',$usuario_id)";
      return $this->db->query($sql);
    }

    
    public function registro($nombrePrg,$accion,$usuario,$panel_id,$nivel)
    {
        $this->insertar(array("nombreprg"=>$nombrePrg,"accion"=>$accion,"usuarios_id"=>$usuario,"programa_id"=>$panel_id,"nivel"=>$nivel,'ip'=>$this->input->ip_address(),"conexion_id"=>$this->conexion_id));
    }
    
    
    public function updateTime()
    {
        $this->db->query("update seguridad.conexion set fecha_actualizacion=now(),fecha_tmp_finalizacion=now()+'".$this->config->item("sess_expiration")." second'::interval where id=$this->conexion_id");
    }

    
    public function finTime()
    {
        $this->db->query("update seguridad.conexion set fecha_actualizacion=now(),fecha_desconexion=now(),duracion=generales.restartiempo(now(),fecha_conexion),conectado=false where id=$this->conexion_id");
    }

    
    public function  verificarConexion($fin_sistema=1)
    {
        if($fin_sistema==1){
            $this->db->select("*");
            $this->db->from("seguridad.conexion");
            $this->db->where(array("fecha_tmp_finalizacion >"=>"now()","conectado"=>"true","id"=>$this->conexion_id));
            $data=$this->db->get();
            if($data->num_rows()>0)
            {
                $this->updateTime();
                return true;
            }else
            {
                $this->finTime();
                return false;
            }
        }else
        {
            return false;
        }
    }
}
?>