<?php

class dashboard extends CI_Controller {

    public function construct()
    {
       parent::construct();
    }
    public function index()
    {
        $data['total_kategori']= $this->db->count_all('kategori');
        $data['total_Buku']= $this->db->count_all('Buku');
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}