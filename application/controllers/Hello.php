<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hello extends CI_Controller {

    public function index(){
        $this->load->model('Hello_model');
        $model = $this->Hello_model;

        $a = $model->txt;

        $data['teks'] = $a;

        $this->load->view('helloview', $data);
    }
    
    public function test()
    {
        $this->load->view('test_view');
    }


}