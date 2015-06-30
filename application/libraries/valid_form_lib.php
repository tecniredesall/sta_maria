<?php if(!defined('BASEPATH'))         exit('No direct script access allowed');

class valid_form_lib{

    public $obj;
    public $Obligatorios=array();
    public $css=array();
    
    function  __construct()
    {
            $this->obj=& get_instance();
    }

    
}