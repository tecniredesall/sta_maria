<?php

class Agendar_model extends MY_ModelCrud {

    
    public function __construct() {
        parent:: __construct();
        $this->table="d";
    }
    
    
    
    
    
    public function itemsCal($data)
    {

        $query='select servicios_id id,fecha_inicio as "start",title,0::integer as agd,1::integer as solicitudes_id,servicios_id,salas_id,fecha_fin  as fecha_fin,allday,min(salas_dist_id) as salas_dist_id,color
        from pre_agenda_cal('.$data[0].',\''.$data[1].'\',\''.$data[2].'\')
        group by servicios_id,salas_id,fecha_inicio,fecha_fin,title,allday,color
        order by "start" asc';
        $data= $this->db->query($query)->result();
        return $data;
    }
    
    public function addPreAgenda($data)
    {
        $query='insert into pre_agenda (plan_id,fecha_agendada,solicitudes_id,servicios_id,salas_id,salas_dist_id)values('.$data[0].',\''.$data[5].'\','.$data[1].','.$data[2].','.$data[3].','.$data[4].')';
        $data= $this->db->query($query);
        return array(array("agd"=>"1"));
    }





}
?>