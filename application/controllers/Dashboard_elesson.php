<?php 

    defined('BASEPATH') OR exit('No direct script access allowed');
    class Dashboard_elesson extends CI_Controller{
        function __construct(){
            parent::__construct();
            // $this->load->library('table');
            $this->load->model('Admin_model');
        }



        //========================= View All User ==================================//
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
            redirect('Dashboard_elesson',$data);
        }
        //================================ End Of tambah data user ===================//



        //================================ Edit User ================================//
        public function edit_user($id){
            $id = $this->uri->segment(3);
            $data['user']=$this->Admin_model->edit_data_user($id);
            $data['level']=$this->Admin_model->getLevel()->result();
            $data['blokir']=$this->Admin_model->getBlokir()->result();
            $this->template->tampil('crud/elesson/Dashboard/edit/edit_user',$data);
        }
        public function proses_edit_data_user(){
            $id_admin=$this->input->post('id_admin');
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
                // 'id_admin'=>$id_admin,
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
            // $where = array(
            //     'id_admin'=>$id_admin
            // );
            $this->Admin_model->update_data_user($id,$data);
        }
        //================================ End Of Edit User =========================//



        //================================ Delete User ===============================//
        function hapus_user(){
            $id = $this->uri->segment(3);
            $this->Admin_model->delete_data_user($id);
          }
        //================================ End Of Delete User =======================//
        //================================ End Of View All User ======================//

        //================================ Logout ====================================//
        public function logout(){
            $data['logout'] = $this->session->sess_destroy();
            $this->load->view('crud/elesson/Login/login_elesson');
        }
        //================================ End Of Logout ============================//
    }

?>