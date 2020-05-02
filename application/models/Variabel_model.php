<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variabel_model extends CI_Model {
    public $txt = "Hello World dari CI Model";
    public $list = [
        'variabel1'=>'Data Variabel ke 1',
        'variabel2'=>'Data Variabel ke 2'
    ];       
}