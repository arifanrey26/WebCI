<?php 
    class Admin_model extends CI_Model{
        function getAll(){
            $this->db->select('*');
            $this->db->from('admin');
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
    }

?>