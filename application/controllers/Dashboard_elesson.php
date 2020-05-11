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
            $data['level'] = $this->Admin_model->getLevel()->result();
            $this->template->tampil('crud/elesson/Dashboard/home_admin_elesson',$data);
        }



        //============================== tambah data user ===========================//
        public function tambah_data_user(){
            // $data['tambah'] = $this->Admin_model->getAll()->result();
            $data['level'] = $this->Admin_model->get_level();
            $data['blokir'] = $this->Admin_model->getBlokir()->result();
            $this->template->tampil('crud/elesson/Dashboard/tambah/tambah_user',$data);
        }
        public function proses_tambah_data_user(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nam_leng = $this->input->post('nama');
            $level = $this->input->post('level');
            $alamat = $this->input->post('alamat');
            $notel = $this->input->post('telp');
            $email = $this->input->post('email');
            $blokir = $this->input->post('blokir');
            $id_sess = $this->input->post('id_session');

            $data = array(
                'username'=>$username,
                'password'=>$password,
                'nama_lengkap'=>$nam_leng,
                'level'=>$level,
                'alamat'=>$alamat,
                'no_telp'=>$notel,
                'email'=>$email,
                'blokir'=>$blokir,
                'id_session'=>$id_sess
            );
            $this->Admin_model->save_data_user($data,'admin');
            $this->session->set_flashdata('notif', "<script> alert('Data Berhasil Disimpan!')".$total_post."data berhasil di simpan!</p>");
            redirect('Dashboard_elesson',$data);
        }
        //================================ End Of tambah data user ===================//



        public function logout(){
            $data['logout'] = $this->session->sess_destroy();
            $this->load->view('crud/elesson/Login/login_elesson');
        }
    }

?>