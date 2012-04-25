<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of personas
 *
 * @author dnl
 */
class Personas extends MY_Controller{
  function __construct() {
    parent::__construct();
  }
  function search(){
    $this->output->enable_profiler(false);
    $this->load->view('personas/search-Form');
  }
}

?>
