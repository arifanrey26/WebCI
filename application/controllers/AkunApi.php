<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AkunApi extends MY_Controller
{
    function get($id)
    {
        $user = $this->db->get_where('siswa', ['id' => $id])->row_array();

        if ($user != null) {
            $response = array(
                'status' => true,
                'message' => "berhasil get data akun",
                'user' => $user
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'status' => false,
                'message' => "gagal get data akun"                
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}