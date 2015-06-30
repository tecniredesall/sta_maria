<?php

class Confinvprincipal_model extends MY_ModelCrud {


    public function __construct() 
    {
        parent:: __construct();
        $this->vst="farmacia_inv.view_prod_det";
        $this->table="farmacia_inv.conf_inv_principal";
    }
    
    
}
?>