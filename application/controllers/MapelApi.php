<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MapelApi extends MY_Controller
{
    function get($id)
    {
        if($id != null){
            $id_siswa = $id;

            $query = "SELECT mapel_ajar.id, mapel_ajar.hari_id, mapel_ajar.jam_mulai, mapel_ajar.jam_selesai, pengajar.nama AS pengajar, mapel.nama FROM mapel_ajar
            JOIN mapel_kelas ON mapel_ajar.mapel_kelas_id = mapel_kelas.id
            JOIN mapel ON mapel_kelas.mapel_id = mapel.id
            JOIN kelas_siswa ON mapel_kelas.kelas_id = kelas_siswa.kelas_id
            JOIN pengajar ON mapel_ajar.pengajar_id = pengajar.id
            JOIN siswa ON kelas_siswa.siswa_id = siswa.id
            
            WHERE siswa.id = '$id_siswa' AND mapel_ajar.aktif = 1
            
            ORDER BY mapel_ajar.hari_id ASC";

            $mapel = $this->db->query($query)->result_array();

            $mapel2 = array();        

            foreach($mapel as $row){
                switch($row['hari_id']){
                    case "1":
                        $row['hari_id'] = "SENIN";                        
                        break;
                    case "2":
                        $row['hari_id'] = "SELASA";                        
                        break;
                    case "3":
                        $row['hari_id'] = "RABU";                        
                        break;
                    case "4":
                        $row['hari_id'] = "KAMIS";                        
                        break;
                    case "5":
                        $row['hari_id'] = "JUMAT";                        
                        break;
                    case "6":
                        $row['hari_id'] = "SABTU";                        
                        break;
                    case "7":
                        $row['hari_id'] = "MINGGU";
                    break;
                }                
                array_push($mapel2, $row);
            }
            
            if($mapel){
                $response = array(
                    'status' => true,
                    'message' => 'berhasil get data mapel',
                    'mapel' => $mapel2
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);

            } else {
                $response = array(
                    'status' => false,
                    'message' => 'gagal get data mapel'                
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);
            }

        } else {
            $response = array(
                'status' => false,
                'message' => 'input tidak valid'                
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}