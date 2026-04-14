<?php
class Buku extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('buku_model');
    }

    public function index(){
        $data['buku'] = $this->buku_model->get_all();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah(){
        $data['kategori'] = $this->buku_model->get_kategori();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function simpan(){
        $data = [
            'kode_buku' => $this->input->post('kode_buku'),
            'judul_buku' => $this->input->post('judul_buku'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'tahun' => $this->input->post('tahun'),
            'kategori_id' => $this->input->post('kategori_id'),
            'stok' => $this->input->post('stok'),
            'lokasi_rak' => $this->input->post('lokasi_rak')
        ];

        $this->buku_model->insert($data);
        redirect('buku');
    }

    public function edit($id){
        $data['buku'] = $this->buku_model->get_by_id($id);
        $data['kategori'] = $this->buku_model->get_kategori();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update(){
        $id = $this->input->post('id');

        $data = [
            'kode_buku' => $this->input->post('kode_buku'),
            'judul_buku' => $this->input->post('judul_buku'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'tahun' => $this->input->post('tahun'),
            'kategori_id' => $this->input->post('kategori_id'),
            'stok' => $this->input->post('stok'),
            'lokasi_rak' => $this->input->post('lokasi_rak')
        ];

        $this->buku_model->update($id,$data);
        redirect('buku');
    }

    public function hapus($id){
        $this->buku_model->delete($id);
        redirect('buku');
    }
}