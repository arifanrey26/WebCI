<?php 

    defined('BASEPATH') OR exit('No direct script access allowed');
    class Dashboard_elesson extends CI_Controller{
        function __construct(){
            parent::__construct();
            // $this->load->library('table');
            $this->load->model('Admin_model');
        }
        public function index(){
            $data['user'] = $this->Admin_model->getAll()->result();
            $this->template->tampil('crud/home_mahasiswa',$data);
        }
    }

?>