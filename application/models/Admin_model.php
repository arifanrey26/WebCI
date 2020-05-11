<?php 
    class Admin_model extends CI_Model{
        function getAll(){
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->join('tb_level','admin.level = tb_level.id_level');
            $this->db->join('blokir','admin.blokir = blokir.id_blokir');
            $query = $this->db->get();
            return $query;
        }
        function getLevel(){
            $this->db->select('*');
            $this->db->from('tb_level');
            $query = $this->db->get();
            return $query;
        }
        function get_level(){
            $this->db->order_by('id_level','ASC');
            return $this->db->from('tb_level')->get()->result();
        }
        function getBlokir(){
            $this->db->select('*');
            $this->db->from('blokir');
            $query = $this->db->get();
            return $query;
        }
        function login($user,$pass,$table){
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('username',$user);
            $this->db->where('password',$pass);
            $query = $this->db->get();
            return $query;
        }
        function save_data_user($data,$table){
            $this->db->insert($table,$data);
        }
    }

?>