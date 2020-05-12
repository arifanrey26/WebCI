<?php 
    class Admin_model extends CI_Model{
        public function __construct(){
    	    parent::__construct();
	    }
        //get All Attribute from tb Admin
        function getAll(){
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->join('tb_level','admin.level = tb_level.id_level');
            $this->db->join('blokir','admin.blokir = blokir.id_blokir');
            $query = $this->db->get();
            return $query;
        }
        // End of get All


        
        //get Level from tb_level
        function getLevel(){
            $this->db->select('*');
            $this->db->from('tb_level');
            $query = $this->db->get();
            return $query;
        }
        //get Level order by ASC
        function get_level(){
            $this->db->order_by('id_level','ASC');
            return $this->db->from('tb_level')->get()->result();
        }
        //End get Level by ASC
        //End of get Level
        



        //get Blokir from tb_blokir
        function getBlokir(){
            $this->db->select('*');
            $this->db->from('blokir');
            $query = $this->db->get();
            return $query;
        }
        //get Blokir from tb_blokir
        function get_blokir(){
            $this->db->order_by('id_blokir','ASC');
            return $this->db->from('blokir')->get()->row_array();
        }
        //End Of get Blokir
        //End of get Blokir



        // Login Function
        function login($user,$pass,$table){
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('username',$user);
            $this->db->where('password',$pass);
            $query = $this->db->get();
            return $query;
        }
        //End of Login



        //CRUD for Admin
        function save_data_user($data,$table){
            $this->db->insert($table,$data);
        }
        function edit_data_user($where,$table){
            return $this->db->get_where($table,$where);
        }
        function update_data_user($id, $data){
            $this->db->where('id_admin', $id);
            $berhasil = $this->db->update('admin', $data);
            if($berhasil)
            {
                redirect('Dashboard_elesson/'.'?update=1','refresh');
            }
            else
            {
                redirect('Dashboard_elesson/'.'?update=2','refresh');
            }
        }
        function delete_data_user($id){
            $this->db->where('id_admin', $id);
            $berhasil = $this->db->delete('admin');
            if($berhasil)
            {
                redirect('Dashboard_elesson/'.'?delete=1'.'refresh');
            }
            else
            {
                redirect('Dashboard_elesson/'.'?delete=2'.'refresh');
            }
        }
    }

?>