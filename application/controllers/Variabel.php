<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variabel extends CI_Controller {
    public function index(){
        $this->load->model('Variabel_model');
        $model = $this->Variabel_model;

        $a = $model->txt;
        $b = $model->list;

        $data['teks'] = $a;
        $data['var'] = $b;

        $this->load->view('variabelview', $data);
    }
}
