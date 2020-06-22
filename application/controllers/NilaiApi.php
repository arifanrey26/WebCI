<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NilaiApi extends MY_Controller
{
    function get($id)
    {
        $query = "SELECT tugas.id, tugas.judul, nilai_tugas.nilai, tugas.tgl_buat AS tanggal FROM nilai_tugas
        JOIN tugas ON nilai_tugas.tugas_id = tugas.id
        JOIN siswa ON nilai_tugas.siswa_id = siswa.id        
        
        WHERE siswa.id = '$id' AND tugas.tampil_siswa = '1'";

        $nilai = $this->db->query($query)->result_array();

        $semuaNilai = array();

        foreach($nilai as $row) {
            $id_tugas = $row['id'];
            $id_field_tambahan = "history-mengerjakan-$id-$id_tugas";

            $query = "SELECT tugas.id, tugas.judul, nilai_tugas.nilai, field_tambahan.value AS waktu FROM nilai_tugas
            JOIN tugas ON nilai_tugas.tugas_id = tugas.id
            JOIN siswa ON nilai_tugas.siswa_id = siswa.id
            JOIN field_tambahan ON field_tambahan.id = '$id_field_tambahan'
            
            WHERE siswa.id = '$id' AND tugas.tampil_siswa = '1'";
    
            $data = $this->db->query($query)->result_array();

            $semuaNilai += $data;
        }

        if($semuaNilai) {
            $response = array(
                'status' => true,
                'message' => "berhasil mendapat data nilai",            
                'nilai' => $semuaNilai
            );
    
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo "gagal";
        }
    }
}