<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('buku_model');
        $this->load->library('form_validation');
    }

    // READ - Menampilkan data buku
    public function index()
    {
        $data['buku'] = $this->buku_model->get_all();
        $this->load->view('buku/index', $data);
    }

    // CREATE - Form tambah
    public function tambah()
    {
        $data['kategori'] = $this->buku_model->get_kategori();
        $this->load->view('buku/tambah', $data);
    }

    // CREATE - Simpan data
    public function simpan()
    {
        $this->form_validation->set_rules('kode_buku', 'Kode Buku', 'required');
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['kategori'] = $this->buku_model->get_kategori();
            $this->load->view('buku/tambah', $data);
        } else {
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
            
            if ($this->buku_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data');
            }
            redirect('buku');
        }
    }

    // UPDATE - Form edit (PERBAIKAN DI SINI)
    public function edit($id)
    {
        // Cek apakah data ada
        $buku = $this->buku_model->get_by_id($id);
        
        if (empty($buku)) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
            redirect('buku');
        }
        
        $data['buku'] = $buku;
        $data['kategori'] = $this->buku_model->get_kategori();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/edit', $data);
        $this->load->view('templates/footer');
    }

    // UPDATE - Proses update (PERBAIKAN DI SINI)
    public function update($id)
    {
        // Cek apakah data ada
        $buku = $this->buku_model->get_by_id($id);
        
        if (empty($buku)) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
            redirect('buku');
        }

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
        
        if ($this->buku_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data');
        }
        
        redirect('buku');
    }

    // DELETE - Hapus data
    public function hapus($id)
    {
        $buku = $this->buku_model->get_by_id($id);
        
        if (empty($buku)) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
        } else {
            if ($this->buku_model->delete($id)) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data');
            }
        }
        
        redirect('buku');
    }
}