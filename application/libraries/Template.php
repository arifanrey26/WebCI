<?php

class Template{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function tampil($template = NULL, $data = NULL)
    {
        if($template != NULL)
        {
            // Bagian $data['head'] untuk memanggil file head.php dari folder Admin/_Template/
            // ['head'] data yang kita panggil dari file template.php dari folderAdmin/_Template/
            $data['head'] = $this->_ci->load->view('Admin/_Template/head', $data, TRUE);

            // Bagian $data['topbar'] untuk memanggil file topbar.php dari folder Admin/_Template/
            // ['topbar'] data yang kita panggil dari file template.php dari folderAdmin/_Template/
            $data['topbar'] = $this->_ci->load->view('Admin/_Template/topbar', $data, TRUE);

            // Bagian $data['sidebar'] untuk memanggil file sidebar.php dari folder Admin/_Template/
            // ['sidebar'] data yang kita panggil dari file template.php dari folderAdmin/_Template/
            $data['sidebar'] = $this->_ci->load->view('Admin/_Template/sidebar', $data, TRUE);

            // ['isi'] data yang kita panggil dari file content.php dari folderAdmin/_Template/
            $data['isi'] = $this->_ci->load->view($template, $data, TRUE);

            // Bagian $data['content'] untuk memanggil file content.php dari folder Admin/_Template/
            // ['content'] data yang kita panggil dari file template.php dari folderAdmin/_Template/
            $data['content'] = $this->_ci->load->view('Admin/_Template/content', $data, TRUE);

            // Bagian $data['footer'] untuk memanggil file footer.php dari folder Admin/_Template/
            // ['footer'] data yang kita panggil dari file template.php dari folderAdmin/_Template/
            $data['footer'] = $this->_ci->load->view('Admin/_Template/footer', $data, TRUE);

            // Bagian $data['template'] untuk memanggil file template.php dari folder Admin/_Template/
            // ['template'] data yang kita panggil dari file template.php dari folderAdmin/_Template/
            echo $data['template'] = $this->_ci->load->view('Admin/_Template/template', $data, TRUE);
        }
    }
}
