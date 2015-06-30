<?php

class Solicitudes_model extends MY_ModelCrud {

    
    public function __construct() 
    {
        parent:: __construct();
        $this->vst="farmacia_inv.view_prod_det";
        $this->table="farmacia_inv.sol_salas";
    }


    


    

   

}
?>