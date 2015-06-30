<?php

class Admision_model extends MY_ModelCrud {

    
    public function __construct() {
        parent:: __construct();
        $this->table="servicios";
    }

    
    
    public function AddItemsPlans($data)
    {
        $query="select id,fn_plan_pagado(plan.monto_solicitudes,plan.abonado) as pagado,nombre_plan as nombre,monto_solicitudes as  total,abonado,debe from plan where paciente_id=$data[0] and sys=false";
        $data= $this->db->query($query)->result();
        return $data;
    }

    public function activarCita($data)
    {
        $query="update pre_agenda set admitido=true where id=$data[0]";
        $rs= $this->db->query($query);
        if($rs[0]==1 && $rs["num_rows_affected"]>=1)
           {
               return array(array("act"=>1));
           }
        return array(array("act"=>0));
    }

    public function AddItemsCita($data)
    {
        $query="select subquery.*,st.id as status_id,st.status as status_nombre from (select pre_agenda.id,fnNombreServicios(servicios_id) as nombre_servicio,hora_inicio as hora_cita,
        (select precio from solicitudes where servicios_id=pre_agenda.servicios_id and plan_id=pre_agenda.plan_id) as precio
        ,fecha_agendada,pagado,'false'::boolean as espera,'true'::boolean as activar,admitido,
        fn_status_icon(fecha_agendada,pagado,admitido,re_agendar,ejecutado) as status_id
        from pre_agenda
        where pre_agenda.plan_id=$data[0]) as subquery inner join status_cita as st
        on subquery.status_id=st.id";
        $data= $this->db->query($query)->result();
        return $data;
    }
    
    public function autocompletePacientes($bsq,$params)
    {
        $bsq=trim($bsq);
        $query="select pacientes_id as data,cedula as value, nombres  from vst_pacientes where cedula like '$bsq%'";
        $data= $this->db->query($query)->result();
        return array("jquery"=>"Unit","suggestions"=>$data);
    }

    
    
    public function AddItems($id)
    {
        $query="select id,nombre,precio,color from servicios where id=$id[0]";
        $data= $this->db->query($query)->result();
        return $data;
    }


}
?>