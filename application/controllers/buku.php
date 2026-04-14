<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('buku_model');
        $this->load->library('form_validation');
    }

    // READ - Menampilkan semua data buku
    public function index()
    {
        $data['title'] = 'Data Buku';
        $data['buku'] = $this->buku_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/index', $data);
        $this->load->view('templates/footer');
    }

    // CREATE - Form tambah buku
    public function tambah()
    {
        $data['title'] = 'Tambah Buku';
        $data['kategori'] = $this->buku_model->get_kategori();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/tambah', $data);
        $this->load->view('templates/footer');
    }

    // CREATE - Simpan data buku
    public function simpan()
    {
        $this->form_validation->set_rules('kode_buku', 'Kode Buku', 'required');
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('stok', 'Stok', 'numeric|greater_than_equal_to[0]');

        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_message('numeric', '{field} harus berupa angka');
        $this->form_validation->set_message('min_length', '{field} minimal {param} karakter');
        $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Buku';
            $data['kategori'] = $this->buku_model->get_kategori();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('buku/tambah', $data);
            $this->load->view('templates/footer');
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
                $this->session->set_flashdata('success', 'Data buku berhasil disimpan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data buku');
            }
            redirect('buku');
        }
    }

    // UPDATE - Form edit buku
    public function edit($id)
    {
        $buku = $this->buku_model->get_by_id($id);
        
        if (empty($buku)) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
            redirect('buku');
        }
        
        $data['title'] = 'Edit Buku';
        $data['buku'] = $buku;
        $data['kategori'] = $this->buku_model->get_kategori();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/edit', $data);
        $this->load->view('templates/footer');
    }

    // UPDATE - Proses update data buku
    public function update($id)
    {
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
            $this->session->set_flashdata('success', 'Data buku berhasil diupdate');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data buku');
        }
        
        redirect('buku');
    }

    // DELETE - Hapus data buku
    public function hapus($id)
    {
        $buku = $this->buku_model->get_by_id($id);
        
        if (empty($buku)) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
        } else {
            if ($this->buku_model->delete($id)) {
                $this->session->set_flashdata('success', 'Data buku berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data buku');
            }
        }
        
        redirect('buku');
    }
}