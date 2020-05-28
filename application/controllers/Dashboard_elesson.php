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
        //=========================== Mata Pelajaran=============================//
       
        public function pengampuh(){
            $this->Admin_model->setPengampuh($this->input->post());
                $this->session->set_flashdata("message","<div class='alert alert-success' role='alert'>
                    Insert data Berhaslil!
                  </div>'");
                    redirect("Dashboard_elesson/matapelajaran");
        }

        public function matapelajaran(){
            $data['pengajar'] = $this->Admin_model->getPengajar()->result();
            $data['mapel'] = $this->Admin_model->getMataPelajaran()->result();
            $this->template->tampil('crud/elesson/Dashboard/mata_pelajaran',$data);
        }

        //===========================Upload Materi=============================//
        public function uploadmateri(){
            $data['mapel'] = $this->Admin_model->getMataPelajaran()->result();
            $this->template->tampil('crud/elesson/Dashboard/upload_materi',$data);
        }

        public function cekupload(){
            $matapelajaran = $this->input->post("matapelajaran");
            $materi = $this->input->post("materi");
            $nama_file   = $_FILES['berkas']['name'];

            $extensionList = array("png","jpg","jpeg","zip", "rar", "doc", "docx", "ppt", "pptx", "pdf","mp4","mkv","mov","3gp");
            $pecah = explode(".", $nama_file);
            $ekstensi = $pecah[1];

            // echo date("Y-m-d"); die;

            $config['upload_path']          = './uploadmateri/';
            $config['allowed_types']        = 'png|jpg|jpeg|zip|rar|doc|docx|ppt|pptx|pdf|mp4|mkv|mov|3gp';
            $config['max_size']             = 1020;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['encrypt_name']			= TRUE;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('berkas'))
		    {
                if(!in_array(strtolower($ekstensi), $extensionList)){
                    $this->session->set_flashdata("message","<div class='alert alert-danger' role='alert'>
                    File yang anda upload salah!
                  </div>'");
                  redirect("Dashboard_elesson/uploadmateri");
                }else{
                    $datamapel = $this->Admin_model->getMataPelajaranById($matapelajaran)->row_array();
                    $datakelas = $this->Admin_model->getKelasById($datamapel['id_kelas'])->row_array();
                    $nama = $this->upload->data("file_name");
                    $this->Admin_model->setMateri($materi, $nama, $matapelajaran, $datakelas['id_kelas']);
                    $this->session->set_flashdata("message","<div class='alert alert-success' role='alert'>
                    Upload Materi Berhasil!
                  </div>'");
                    redirect("Dashboard_elesson/uploadmateri");
                }            
            }
        }

        //============================== tambah data user ===========================//
        public function tambah_data_user(){
            // $data['tambah'] = $this->Admin_model->getAll()->result();
            $data['level'] = $this->Admin_model->get_level()->result();
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
            $where = array('id_admin'=>$id);
            $data['user']=$this->Admin_model->edit_data_user($where,'admin')->result();
            $data['level']=$this->Admin_model->get_level()->result();
            $data['blokir']=$this->Admin_model->get_blokir();
            $this->template->tampil('crud/elesson/Dashboard/edit/edit_user',$data);
        }
        public function proses_edit_data_user(){
            $id=$this->input->post('id_admin');
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

        //=================================Show grup==================================//
        public function showGrup(){
            $data['level'] = $this->Admin_model->get_level()->result();
            $this->template->tampil('crud/home_grup',$data);
        }
        //============================================================================//



        //  //============================== tambah data user ===========================//
        //  public function tambah_data_grup(){
        //     // $data['tambah'] = $this->Admin_model->getAll()->result();
        //     $data['level'] = $this->Admin_model->get_level()->result();
        //     $data['blokir'] = $this->Admin_model->getBlokir()->result();
        //     $this->template->tampil('crud/elesson/Dashboard/tambah/tambah_grup',$data);
        // }
        // public function proses_tambah_data_user(){
        //     $username = $this->input->post('username');
        //     $password = $this->input->post('password');
        //     $nam_leng = $this->input->post('nama');
        //     $level = $this->input->post('level');
        //     $alamat = $this->input->post('alamat');
        //     $notel = $this->input->post('telp');
        //     $email = $this->input->post('email');
        //     $blokir = $this->input->post('blokir');
        //     $id_sess = $this->input->post('id_session');

        //     $data = array(
        //         'username'=>$username,
        //         'password'=>$password,
        //         'nama_lengkap'=>$nam_leng,
        //         'level'=>$level,
        //         'alamat'=>$alamat,
        //         'no_telp'=>$notel,
        //         'email'=>$email,
        //         'blokir'=>$blokir,
        //         'id_session'=>$id_sess
        //     );
        //     $this->Admin_model->save_data_user($data,'admin');
        //     redirect('Dashboard_elesson',$data);
        // }
        // //================================ End Of tambah data grup ===================//


        // //================================ Edit grup ================================//
        // public function edit_grup($id_level){
        //     $where = array('id_admin'=>$id_level);
        //     $data['user']=$this->Admin_model->edit_data_grup($where,'admin')->result();
        //     $data['level']=$this->Admin_model->get_level()->result();
        //     $data['blokir']=$this->Admin_model->get_blokir();
        //     $this->template->tampil('crud/elesson/Dashboard/edit/edit_user',$data);

        //     }
        // public function proses_edit_data_grup(){    
        //     $id_level=$this->input->post('id level');
        //     $level = $this->input->post('Group');
            

        //     $data = array(
        //         // 'id_admin'=>$id_admin,
        //         'id level'=>$id_level,
        //         'Group'=>$level,
                
        //     );
        //     // $where = array(
        //     //     'id_admin'=>$id_admin
        //     // );
        //     $this->Admin_model->update_data_grup($id,$data);
        // }
    }

?>