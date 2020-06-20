<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MateriApi extends MY_Controller
{
    function get($id)
    {
        if($id != null){
            $id_siswa = $id;
            
            $query = "SELECT materi.id, materi.judul, pengajar.nama FROM materi
            JOIN materi_kelas ON materi.id = materi_kelas.materi_id
            JOIN kelas ON materi_kelas.kelas_id = kelas.parent_id
            JOIN kelas_siswa ON kelas.id = kelas_siswa.kelas_id
            JOIN siswa ON kelas_siswa.siswa_id = siswa.id
            JOIN pengajar ON materi.pengajar_id = pengajar.id
            
            WHERE siswa.id = '$id_siswa'";

            $materi = $this->db->query($query)->result_array();

            if($materi){
                $response = array(
                    'status' => true,
                    'message' => "berhasil mendapat data materi",
                    'gambar' => 'logo-materi-pdf.png',
                    'materi' => $materi
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => false,
                    'message' => "gagal mendapat data materi"                
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

    function detail($segment_3 = '', $segment_4 = '', $segment_5 = '')
    {
        $materi_id = (int)$segment_3;

        if (empty($materi_id)) {
            show_404();
        }

        $materi = $this->materi_model->retrieve($materi_id);
        if (empty($materi)) {
            show_404();
        }

        # tambah views jika materi terfulis
        if (empty($materi['file'])) {
            $plus_views = false;

            # buat session kalo sudah baca materi yan ini
            $session_read = $this->session->userdata('read_materi');
            if (empty($session_read)) {
                $this->session->set_userdata(array('read_materi' => array($materi['id'])));
                $plus_views = true;
            } else {
                if (!in_array($materi['id'], $session_read)) {
                    $plus_views = true;
                }
            }

            if ($plus_views) {
                $this->materi_model->plus_views($materi['id']);
            }
        }

        $data['materi'] = $materi;

        switch ($segment_4) {
            case 'laporkan':
                $komentar = $this->komentar_model->retrieve((int)$segment_5);
                if (empty($komentar) OR $komentar['tampil'] == 0 OR $komentar['materi_id'] != $materi['id']) {
                    show_error('Komentar tidak ditemukan');
                }
                $data['komentar'] = $komentar;

                $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim|xss_clean');
                if (!empty($_POST['alasan']) AND $_POST['alasan'] == 'tulis') {
                    $this->form_validation->set_rules('alasan_lain', 'Tulis alasan', 'required|trim|xss_clean');
                }

                if ($this->form_validation->run() == true) {
                    $alasan = $this->input->post('alasan', true);
                    if ($alasan == 'tulis') {
                        $alasan = $this->input->post('alasan_lain', true);
                    }

                    $unix_id  = uniqid() . time();
                    $field_id = 'laporkan-komentar';
                    $retrieve_field = retrieve_field($field_id);
                    if (empty($retrieve_field)) {
                        create_field($field_id, 'Laporkan Komentar', json_encode(array(
                            $unix_id => array(
                                'materi_id'   => $materi['id'],
                                'komentar_id' => $komentar['id'],
                                'alasan'      => $alasan,
                                'login_id'    => get_sess_data('login', 'id'),
                                'tgl_lapor'   => date('Y-m-d H:i:s')
                            )
                        )));
                    } else {
                        $value_field = json_decode($retrieve_field['value'], 1);

                        # cek sudah ada belum datanya
                        $exist = false;
                        foreach ($value_field as $val) {
                            if ($val['materi_id'] == $materi['id'] AND $val['login_id'] == get_sess_data('login', 'id') AND $val['komentar_id'] == $komentar['id']) {
                                $exist = true;
                            }
                        }

                        if (!$exist) {
                            $value_field[$unix_id] = array(
                                'materi_id'   => $materi['id'],
                                'komentar_id' => $komentar['id'],
                                'alasan'      => $alasan,
                                'login_id'    => get_sess_data('login', 'id'),
                                'tgl_lapor'   => date('Y-m-d H:i:s')
                            );

                            update_field($field_id, 'Laporkan Komentar', json_encode($value_field));
                        }
                    }

                    $this->session->set_flashdata('laporkan', get_alert('success', 'Laporan berhasil dikirim.'));
                    redirect('materi/detail/' . $materi['id'] . '/laporkan/' . $komentar['id']);
                }

                $this->twig->display('laporkan-komentar.html', $data);
            break;

            default:
            case 'download':
                # jika request download
                if ($segment_4 == 'download' AND !empty($materi['file'])) {
                    $target_file = get_path_file($materi['file']);
                    if (!is_file($target_file)) {
                        show_error("Maaf file tidak ditemukan.");
                    }

                    $data_file = file_get_contents($target_file); // Read the file's contents
                    $name_file = $materi['file'];

                    $this->materi_model->plus_views($materi['id']);

                    force_download($name_file, $data_file);
                }

                # post komentar
                $this->form_validation->set_rules('komentar', 'Komentar', 'required');
                if ($this->form_validation->run() == true) {
                    $komentar_id = $this->komentar_model->create(
                        get_sess_data('login', 'id'),
                        $materi['id'],
                        $tampil = 1,
                        $this->input->post('komentar', true)
                    );

                    redirect('MateriApi/detail/' . $materi['id'] . '/#komentar-' . $komentar_id);
                }

                $data['materi']['download_link'] = site_url('MateriApi/detail/'.$materi['id'].'/download');

                # ambil komentar
                $retrieve_all_komentar = $this->komentar_model->retrieve_all(20, (int)$segment_4, null, $materi['id'], 1);

                # format komentar
                foreach ($retrieve_all_komentar['results'] as $key => $val) {
                    $retrieve_all_komentar['results'][$key] = $this->format_komentar($val);
                }

                $data['materi']['komentar']            = $retrieve_all_komentar['results'];
                $data['materi']['jml_komentar']        = $retrieve_all_komentar['total_record'];
                $data['materi']['komentar_pagination'] = $this->pager->view($retrieve_all_komentar, 'materi/detail/' . $materi['id'] . '/');

                # cari tipenya
                if (empty($materi['file'])) {
                    $type = 'tertulis';
                } else {
                    $type = 'file';
                    $data['materi']['file_info']         = get_file_info(get_path_file($materi['file']));
                    $data['materi']['file_info']['mime'] = get_mime_by_extension(get_path_file($materi['file']));
                }

                $data['type'] = $type;
                $data['materi']['mapel'] = $this->mapel_model->retrieve($materi['mapel_id']);

                # cari materi kelas
                $arr_materi_kelas_id = array();
                $materi_kelas        = $this->materi_model->retrieve_all_kelas($materi['id']);
                foreach ($materi_kelas as $mk) {
                    $arr_materi_kelas_id[]            = $mk['kelas_id'];
                    $kelas                            = $this->kelas_model->retrieve($mk['kelas_id']);
                    $data['materi']['materi_kelas'][] = $kelas;
                }

                /**
                 * Jika siswa cek dengan kelas aktif
                 */
                if (is_siswa()) {
                    $kelas_aktif = $this->siswa_kelas_aktif;
                    $retrieve_kelas = $this->kelas_model->retrieve($kelas_aktif['kelas_id']);

                    $kelas_valid = false;
                    foreach ($arr_materi_kelas_id as $mk_id) {
                        if ($mk_id == $retrieve_kelas['parent_id']) {
                            $kelas_valid = true;
                            break;
                        }
                    }

                    if ($kelas_valid == false) {
                        $this->session->set_flashdata('materi', get_alert('warning', 'Materi tidak tersedia untuk kelas Anda.'));
                        redirect('materi');
                    }
                }

                # cari pembuatnya
                if (!empty($materi['pengajar_id'])) {
                    $pengajar = $this->pengajar_model->retrieve($materi['pengajar_id']);
                    $data['materi']['pembuat'] = array(
                        'nama'      => $pengajar['nama'],
                        'link_foto' => get_url_image_pengajar($pengajar['foto'], 'medium', $pengajar['jenis_kelamin'])
                    );
                    if (is_admin()) {
                        $data['materi']['pembuat']['link_profil'] = site_url('pengajar/detail/'.$pengajar['status_id'].'/'.$pengajar['id']);
                    } else {
                        $data['materi']['pembuat']['link_profil'] = site_url('pengajar/detail/'.$pengajar['id']);
                    }
                }

                if (!empty($materi['siswa_id'])) {
                    $siswa = $this->siswa_model->retrieve($materi['siswa_id']);
                    $data['materi']['pembuat'] = array(
                        'nama'        => $siswa['nama'],
                        'link_foto'   => get_url_image_siswa($siswa['foto'], 'medium', $siswa['jenis_kelamin'])
                    );

                    if (is_admin()) {
                        $data['materi']['pembuat']['link_profil'] = site_url('siswa/detail/'.$siswa['status_id'].'/'.$siswa['id']);
                    } else {
                        $data['materi']['pembuat']['link_profil'] = site_url('siswa/detail/'.$siswa['id']);
                    }
                }

                # cari materi terkait
                $retrieve_terkait_mapel = $this->materi_model->retrieve_all(
                    $no_of_records = 10,
                    $page_no       = 1,
                    $pengajar_id   = array(),
                    $siswa_id      = array(),
                    $mapel_id      = array($materi['mapel_id']),
                    $judul         = null,
                    $konten        = null,
                    $tgl_posting   = null,
                    $publish       = 1,
                    $kelas_id      = array(),
                    $type          = array(),
                    $pagination    = false
                );

                $data_terkait = array();
                foreach ($retrieve_terkait_mapel as $row) {
                    if (empty($data_terkait[$row['id']]) AND $row['id'] != $materi['id'] AND count($data_terkait) <= 20) {
                        $data_terkait[$row['id']] = $row;
                    }
                }

                $retrieve_terkait_kelas = $this->materi_model->retrieve_all(
                    $no_of_records = 10,
                    $page_no       = 1,
                    $pengajar_id   = array(),
                    $siswa_id      = array(),
                    $mapel_id      = array(),
                    $judul         = null,
                    $konten        = null,
                    $tgl_posting   = null,
                    $publish       = 1,
                    $kelas_id      = $arr_materi_kelas_id,
                    $type          = array(),
                    $pagination    = false
                );

                foreach ($retrieve_terkait_kelas as $row) {
                    if (empty($data_terkait[$row['id']]) AND $row['id'] != $materi['id'] AND count($data_terkait) <= 20) {
                        $data_terkait[$row['id']] = $row;
                    }
                }

                $data['terkait'] = $data_terkait;

                # setup texteditor
                $html_js = get_texteditor();

                # setup colorbox
                $html_js .= load_comp_js(array(
                    base_url('assets/comp/colorbox/jquery.colorbox-min.js'),
                ));

                $data['comp_js']  = $html_js;
                $data['comp_css'] = load_comp_css(array(
                    base_url('assets/comp/colorbox/colorbox.css')
                ));

                $this->twig->display('detail-materi.html', $data);
            break;
        }
    }
}