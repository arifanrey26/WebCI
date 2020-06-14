<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginApi extends MY_Controller
{
    function index()
    {
        if ($this->input->post("email"))
        {
            $email    = $this->input->post('email', TRUE);
            $password = md5($this->input->post('password', TRUE));

            $get_login = $this->login_model->retrieve(null, $email, $password);

            if (empty($get_login)) {
                // jika tidak ada email dan password yang cocok
                $response = array(
                    "status" => false,
                    "message" => "User tidak ditemukan"
                );

                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                if (!empty($get_login['pengajar_id'])) {
                    $user = $this->pengajar_model->retrieve($get_login['pengajar_id']);

                    $user_type = empty($get_login['is_admin']) ? 'pengajar' : 'admin';

                    // jika ada email dan password yang cocok
                    $response = array(
                        "status" => false,
                        "message" => "Hanya siswa yang bisa mengakses aplikasi",
                        "user" => $user,
                        "tipe" => $user_type
                    );

                } elseif (!empty($get_login['siswa_id'])) {
                    $user = $this->siswa_model->retrieve($get_login['siswa_id']);

                    $user_type = 'siswa';

                    // jika ada email dan password yang cocok
                    $response = array(
                        "status" => true,
                        "message" => "User ditemukan",
                        "user" => $user,
                        "tipe" => $user_type
                    );
                }

                # cek jika user berstatus tidak aktif
                if ($user['status_id'] != 1) {                    
                    $response = array(
                        "status" => false,
                        "message" => "User tidak aktif"
                    );
                }


                header('Content-Type: application/json');
                echo json_encode($response);
            }

        } else {
            // jika tidak memasukkan username
            $response = array(
                "status" => false,
                "message" => "invalid input"
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}

