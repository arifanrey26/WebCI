<?php 
    class Admin_model extends CI_Model{
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
        //End of get Level



        //get Level order by ASC
        function get_level(){
            $this->db->order_by('id_level','ASC');
            return $this->db->from('tb_level')->get()->result();
        }
        //End get Level by ASC



        //get Blokir from tb_blokir
        function getBlokir(){
            $this->db->select('*');
            $this->db->from('blokir');
            $query = $this->db->get();
            return $query;
        }
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
        function edit_data_user($id){
            $this->db->select('*');
		    $this->db->from('admin');
		    $this->db->where('id_admin', $id);
		    return $this->db->get()->row_array();
        }
        function update_data_user($id, $data){
            $this->db->where('id_admin', $id);
            $berhasil = $this->db->update('admin', $data);
            if($berhasil)
            {
                redirect('Dashboard_elesson/'.$id.'?update=1','refresh');
            }
            else
            {
                redirect('Dashboard_elesson/'.$id.'?update=2','refresh');
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