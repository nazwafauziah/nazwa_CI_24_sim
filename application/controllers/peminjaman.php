<?php

class peminjaman extends CI__Controller {

public function __construct()
{
    Parent::__construct();

    if($this->session->userdata('login')) {
        redirect('login');
    }
    $this->load->model('Peminjaman_model');
}

public function index()
{
    $data['data'] = $this->Peminjaman_model->get_all();

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('peminjaman/index', $data);
    $this->load->view('templates/footer');
}

pulic function tambah()
{
    
    $data['buku'] = $this->db->get('buku')->result();

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('peminjaman/tambah', $data);
    $this->load->view('templates/footer');
}
public function simpan()
{
    $data = [
        'kode_pinjam' => uniqid('PMJ-'),
        'buku_id' => $this->input->post('buku_id'),
        'tanggal_pinjam' => date('Y-m-d'),
        'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
        'status' => 'Dipinjam',
        'user_id' => $this->session->userdata('id_user')
    ];
    $buku_id = $this->input->post('buku_id');

    $this->Peminjaman_model->insert($data, $buku_id);
    redirect('peminjaman');
}
public function kembali($id)
{
    $this->Peminjaman_model->pengembalian($id);
    redirect('peminjaman');
}

}