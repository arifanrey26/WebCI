<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hitunglingkaran extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('lingkaran');
    }

    function index()
    {
        $this->benchmark->mark('code_start');

        $this->lingkaran->keliling('21');
        echo "<hr/>";
        $this->lingkaran->luas('14');

        $this->benchmark->mark('code_end');

        echo "</br>";
        echo "</br>";
        echo "Waktu menjalankan kode : ".$this->benchmark->elapsed_time('code_start', 'code_end');        
    }
}