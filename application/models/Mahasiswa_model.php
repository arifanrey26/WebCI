<?php 
    class Mahasiswa_model extends CI_Model{
        function getAll(){
            $this->db->select('*');
            $this->db->from('tm_user');
            $this->db->join('tm_grup','tm_user.grup = tm_grup.id_grup');
            $query = $this->db->get();
            return $query;
        }
        function getGrup(){
            $this->db->select('*');
            $this->db->from('tm_grup');
            $query = $this->db->get();
            return $query;
        }
        function input_data($data,$table){
            $this->db->insert($table,$data);
        }
        function edit_data($where,$table){
            return $this->db->get_where($table,$where);
        }
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }
        function hapus_data($where,$table){
            $this->db->where($where);
            $this->db->delete($table);
        }
        function get_grup(){
            $this->db->order_by('id_grup','ASC');
            return $this->db->from('tm_grup')->get()->result();
        }
        function login($user,$pass,$table){
            $this->db->select('*');
            $this->db->from('tm_user');
            $this->db->where('username',$user);
            $this->db->where('password',$pass);
            $query = $this->db->get();
            return $query;
        }
        function input_grup($data,$table){
            $this->db->insert($table,$data);
        }
        function edit_grup($where,$table){
            return $this->db->get_where($table,$where);
        }
        function update_grup($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }
        function hapus_grup($where,$table){
            $this->db->where($where);
            $this->db->delete($table);
        }
        // public function get_data(){
        //     $data_mahasiswa = [["nama"=>"Kim Jefry","prodi"=>"MIF"],
        //     ["nama"=>"Jong Un","prodi"=>"TKK"],
        //     ["nama"=>"Budi Setiawan","prodi"=>"TIF"]
        // ];
        //     return $data_mahasiswa;
        // }
        // // public function get_data(){
        // //     $data_prodi = [["prodi"=>"MIF","Ket"=>"Manajemen Informatika"],
        // //     ["prodi"=>"TKK","Ket"=>"Teknik Komputer"],
        // //     ["prodi"=>"TIF","Ket"=>"Teknik Informatika"]
        // // ];
        // }
    }
?>