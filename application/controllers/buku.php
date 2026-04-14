<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Buku_model');
    }

    // tampil form
    public function tambah() {
        $data['kategori'] = $this->Buku_model->get_kategori();
        $this->load->view('buku_form', $data);
    }

    // proses simpan
    public function simpan() {
    $data = [
        'kode_buku' => $this->input->post('kode_buku'),
        'judul' => $this->input->post('judul'),
        'penulis' => $this->input->post('penulis'),
        'penerbit' => $this->input->post('penerbit'),
        'tahun' => $this->input->post('tahun'),
        'id_kategori' => $this->input->post('kategori'),
        'stok' => $this->input->post('stok'),
        'lokasi_rak' => $this->input->post('lokasi_rak'),
    ];

    // SIMPAN DATA
    $this->Buku_model->insert($data);

    // REDIRECT
    redirect('buku');
    }

    public function index() {
    $data['buku'] = $this->Buku_model->get_all();
    $this->load->view('buku_list', $data);
    }

    public function hapus($id) {
    $this->Buku_model->delete($id);
    redirect('buku');
    }

    public function edit($id) {
    $data['buku'] = $this->Buku_model->get_by_id($id);
    $data['kategori'] = $this->Buku_model->get_kategori();
    $this->load->view('buku_edit', $data);
    }

    public function update() {
        $id = $this->input->post('id');

        $data = [
            'kode_buku' => $this->input->post('kode_buku'),
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'tahun' => $this->input->post('tahun'),
            'id_kategori' => $this->input->post('kategori'),
            'stok' => $this->input->post('stok'),
            'lokasi_rak' => $this->input->post('lokasi_rak'),
        ];

        $this->Buku_model->update($id, $data);
        redirect('buku');
    }
}