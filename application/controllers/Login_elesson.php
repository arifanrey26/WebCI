<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Login_elesson extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Admin_model');
        }

        public function index(){
            $this->load->view('crud/elesson/Login/login_elesson');
        }

        public function cek_log(){
            $username = $this->input->post('txt_user');
            $password = $this->input->post('txt_pass');
            $cek = $this->Admin_model->login($username,$password,'admin')->result();
            if ($cek != FALSE){
                foreach ($cek as $row){
                    $user = $row->username;
                    $level = $row->level;
                    $blokir =  $row->blokir;
                }
                if($blokir == "1"){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Mohon Maaf Akun anda terblokir!
                  </div>');
                  redirect('login');
                }else{   
                    $this->session->set_userdata('session_user', $user);
                    $this->session->set_userdata('session_level', $level);
                    $this->session->set_userdata('session_blokir', $blokir);
                    redirect('Dashboard_elesson');
                }
            }else{
                $this->load->view('crud/elesson/Login/login_elesson');
            }
        }
    }
?>