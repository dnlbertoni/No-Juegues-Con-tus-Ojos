<?php
/**
 * Description of Fechas_model
 *
 * @author dnl
 */
class Fechas_model extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->setTable('fechas');
    }
    function getPesquizas($all=true,$min=false, $max=false){
        if($min){
            $this->db->select_min('fecha');
        }
        if($all){
            $this->db->select('fecha');            
        }
        if($max){
            $this->db->select_max('fecha');
        }
        $this->db->from($this->getTable());
        $this->db->where('tipoevent', 1);
        $this->db->where('programa_id', $this->session->userdata('programa_id'));
        if($all){
            return $this->db->get()->result();
        }else{
            $this->db->limit(1);
            return $this->db->get()->row()->fecha;            
        }
    }
}
