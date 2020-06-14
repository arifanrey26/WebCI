<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KelasApi extends MY_Controller
{
    function get($id)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas_siswa', 'siswa.id', 'kelas_siswa.siswa_id');
        $this->db->where('kelas_siswa.siswa_id', $id);
        $userKelas = $this->db->get()->row_array();    
        $kelasid = $userKelas['kelas_id'];

        if ($userKelas != null) {

            $query = "SELECT siswa.nama FROM siswa
            JOIN kelas_siswa ON siswa.id = kelas_siswa.siswa_id
            WHERE kelas_siswa.kelas_id = '$kelasid'";
            $anggotaKelas = $this->db->query($query)->result_array();

            $response = array(
                'status' => true,
                'message' => "berhasil get data akun",
                'anggota_kelas' => $anggotaKelas
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'status' => false,
                'message' => "gagal mendapat data kelas"                
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}