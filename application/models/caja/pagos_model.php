<?php

class Pagos_model extends MY_ModelCrud {

    
    public function __construct() 
    {
        parent:: __construct();
        $this->table="pre_agenda";
    }


    public function pagarServicios($preagenda_id,$pagos_plan_id)
    {
        $sql="select * from addagenda($preagenda_id,$pagos_plan_id)";
        //update pre_agenda set pagado=true where id=$value";
        $query= $this->db->query($sql);
        return $query;
    }

    public function crearPagoPlan($plan_id)
    {

        echo $sql="select add_pago_plan($plan_id) as id";
        $query= $this->db->query($sql);
        echo "ther";
        return $query;
    }

    public function pre_agenda($plan_id=-1)
    {
        $sql="select pac.nombres,pac.apellidos, pac.cedula,'true'::boolean as check,agd.id as id,agd.fecha_agendada,pl.nombre_plan,monto_solicitudes as total_plan,serv.id as servicios_id,serv.nombre as servicios_nombre,
(select precio from solicitudes where plan_id=agd.plan_id and servicios_id=serv.id) as precio
,-1::integer as bsq
from pre_agenda as agd
inner join servicios as serv on serv.id=agd.servicios_id
inner join plan as pl on pl.id=agd.plan_id
inner join vst_pacientes as pac on pac.pacientes_id=pl.paciente_id 
where agd.plan_id=$plan_id and pagado=false";
        $query= $this->db->query($sql);
        return $query;
    }

    public function agenda($paciente_id,$plan_id,$agenda_id)
    {
        $sql="select 'true'::boolean as check,agd.id as id,agd.fecha_agendada,serv.id as servicios_id,serv.nombre as servicios_nombre,serv.precio,-1::integer as bsq from pre_agenda as agd
        inner join servicios as serv on serv.id=agd.servicios_id
        where solicitudes_id=1";
        $query= $this->db->query($sql);
        return $query;
    }


    public function addAgendaPagar($data)
    {
        
        $sql="select agd.id as id,agd.fecha_agendada,serv.id as servicios_id,serv.nombre as servicios_nombre,serv.precio,-1::integer as bsq from pre_agenda as agd
        inner join servicios as serv on serv.id=agd.servicios_id
        where solicitudes_id=1";
        $query= $this->db->query($sql)->result();
        return $query;
    }

}
?>