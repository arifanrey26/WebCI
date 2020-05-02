<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Login_elesson extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Admin_model');
        }

        public function index(){
            $this->load->view('crud/login');
        }

        public function cek_log(){
            $username = $this->input->post('txt_user');
            $password = $this->input->post('txt_pass');
            $cek = $this->Admin_model->login($username,$password,'admin')->result();
            if ($cek != FALSE){
                foreach ($cek as $row){
                    $user = $row->username;
                    $password = $row->password;
                }
                $this->session->set_userdata('session_user', $user);
                $this->session->set_userdata('session_password', $password);
                redirect('Dashboard_elesson');
            }else{
                $this->load->view('crud/login_elesson');
            }
        }
    }
?>