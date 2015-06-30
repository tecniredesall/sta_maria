<?php

class Horas_model extends MY_ModelCrud {


    
    public function __construct() 
    {
        parent:: __construct();
        $this->valor="hora";
        $this->table="tiempo_hora";
    }

    


   
}
?>