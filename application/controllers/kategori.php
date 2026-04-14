<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_model');
        $this->load->library('session');
    }

    // ======================
    // TAMPIL DATA
    // ======================
    public function index()
    {
        $data['kategori'] = $this->kategori_model->get_all();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori/index', $data);
        $this->load->view('templates/footer');
    }

    // ======================
    // FORM TAMBAH
    // ======================
    public function tambah()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori/tambah');
        $this->load->view('templates/footer');
    }

    // ======================
    // SIMPAN DATA
    // ======================
    public function simpan()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->kategori_model->insert($data);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');

        redirect('kategori');
    }

    // ======================
    // HAPUS DATA
    // ======================
    public function hapus($id)
    {
        $this->kategori_model->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');

        redirect('kategori');
    }

    // ======================
    // FORM EDIT
    // ======================
    public function edit($id)
    {
        $data['kategori'] = $this->kategori_model->get_by_id($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori/edit', $data);
        $this->load->view('templates/footer');
    }

    // ======================
    // UPDATE DATA
    // ======================
    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            // kalau gagal validasi, kembali ke edit
            $this->edit($id);
        } else {
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori')
            ];

            $this->kategori_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');

            redirect('kategori');
        }
    }
}