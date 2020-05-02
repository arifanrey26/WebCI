<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helper extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
    }

    public function index(){        
        $this->load->view('start_template/header_start');
        $this->load->view('index');
        $this->load->view('start_template/footer_start');        
    }
}