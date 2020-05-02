<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mahasiswa extends CI_Controller{
        function __construct(){
            parent::__construct();
            // $this->load->library('table');
            $this->load->model('Mahasiswa_model');
            
        }
        public function index(){
            // $data['Mahasiswa'] = $this->Mahasiswa_model->get_data();
            // $this->load->view('view_teslib',$data);
            $data['user'] = $this->Mahasiswa_model->getAll()->result();
            $this->template->tampil('crud/home_mahasiswa',$data);
        }
        public function showGrup(){
            $data['grup'] = $this->Mahasiswa_model->getGrup()->result();
            $this->template->tampil('crud/home_grup',$data);
        }
        function add(){
            $data['grup']=$this->Mahasiswa_model->get_grup();
            $this->template->tampil('crud/tambah_mahasiswa',$data);
        }
        public function edit($id){
            $where = array('id'=>$id);
            $data['user']=$this->Mahasiswa_model->edit_data($where,'tm_user')->result();
            $data['grup']=$this->Mahasiswa_model->get_grup();
            $this->template->tampil('crud/edit_mahasiswa',$data);
        }
        public function update(){
            $id=$this->input->post('id');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama = $this->input->post('nama');
            $grup = $this->input->post('grup');

            $data = array(
                'username' => $username,
                'password' => $password,
                'nama' => $nama,
                'grup' => $grup
            );

            $where = array(
                'id' => $id
            );

            $this->Mahasiswa_model->update_data($where, $data, 'tm_user');
            redirect('Mahasiswa');
        }
        public function input(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama = $this->input->post('nama');
            $grup = $this->input->post('grup');

            $data = array(
                'username' => $username,
                'password' => $password,
                'nama' => $nama,
                'grup' => $grup
            );
            $this->Mahasiswa_model->input_data($data,'tm_user');
            
            redirect('Mahasiswa',$data);
        }
        public function hapus($id){
            $where = array ('id'=>$id);
            $this->Mahasiswa_model->hapus_data($where,'tm_user');
            redirect('Mahasiswa/index');
        }
        public function logout(){
            $data['logout'] = $this->session->sess_destroy();
            $this->load->view('crud/login');
        }
        function addGrup(){
            // $data['grup']=$this->Mahasiswa_model->get_grup();
            $this->template->tampil('crud/tambah_grup');
        }
        public function editGrup($id_grup){
            $where = array('id_grup'=>$id_grup);
            $data['grup']=$this->Mahasiswa_model->edit_grup($where,'tm_grup')->result();
            $this->template->tampil('crud/edit_grup',$data);
        }
        public function updateGrup(){
            $id_grup=$this->input->post('id_grup');
            $grup = $this->input->post('grup');

            $data = array('grup' => $grup);

            $where = array(
                'id_grup' => $id_grup
            );

            $this->Mahasiswa_model->update_grup($where, $data, 'tm_grup');
            redirect('Mahasiswa/showGrup');
        }
        public function inputGrup(){
            $nama_grup = $this->input->post('grup');

            $data = array('grup' => $nama_grup);
            $this->Mahasiswa_model->input_grup($data,'tm_grup');
            
            redirect('Mahasiswa/showGrup',$data);
        }
        public function hapusGrup($id){
            $where = array ('id_grup'=>$id);
            $this->Mahasiswa_model->hapus_grup($where,'tm_grup');
            redirect('Mahasiswa/showGrup');
        }

        public function Api(){
            $data = $this->Mahasiswa_model->getAll();
            echo json_encode($data->result_array());
        }

        public function ApiInsert(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama = $this->input->post('nama');
            $grup = $this->input->post('grup');

            $data = array(
                'username' => $username,
                'password' => $password,
                'nama' => $nama,
                'grup' => $grup
            );
            $this->Mahasiswa_model->input_data($data,'tm_user');
            echo json_encode($array);
        }

        public function ApiUpdate(){
           if($this->input->post('username')){
               $where = array('username'=>$this->input->post('username'));
               $username = $this->input->post('username');
               $password = $this->input->post('password');
               $nama = $this->input->post('nama');
               $grup = $this->input->post('grup');
            //    if($idgrup=='admin'){
            //        $grup = "admin";
            //    }elseif($idgrup=="2"){
            //        $grup = "user";
            //    }else{
            //        $array = array('error'=>true);
            //    }
               $data = array(
                   'username' => $username,
                   'password' => $password,
                   'nama' => $nama,
                   'grup' => $grup
               );
               if($this->Mahasiswa_model->update_data($where,$data,'tm_user')){
                   $array = array('success'=>true);
               }else{
                   $array = array('error'=>true);
               }
               echo json_encode($array);
           }
        }

        public function ApiDelete(){
            if($this->input->post('username')){
                $where = array('username'=> $this->input->post('username'));
                if($this->Mahasiswa_model->hapus_data($where,'tm_user')){
                    $array = array('success'=>true);
                }
                else{
                    $array = array('error'=>true);
                }
                echo json_encode($array);
            }
        }
    }
?>