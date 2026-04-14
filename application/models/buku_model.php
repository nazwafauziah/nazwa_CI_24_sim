<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class buku_model extends CI_Model {

    // GET ALL DATA BUKU WITH JOIN KATEGORI
    public function get_all()
    {
        $this->db->select('buku.*, kategori.nama_kategori as nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.kategori_id', 'left');
        $this->db->order_by('buku.id', 'DESC');
        return $this->db->get()->result();
    }

    // GET ALL KATEGORI (untuk dropdown)
    public function get_kategori()
    {
        return $this->db->get('kategori')->result();
    }

    // INSERT DATA BUKU
    public function insert($data)
    {
        return $this->db->insert('buku', $data);
    }

    // GET BUKU BY ID
    public function get_by_id($id)
    {
        return $this->db->get_where('buku', ['id' => $id])->row();
    }

    // UPDATE DATA BUKU
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('buku', $data);
    }

    // DELETE DATA BUKU
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('buku');
    }

    // CEK KODE BUKU UNIQUE
    public function cek_kode_buku($kode_buku, $id = null)
    {
        $this->db->where('kode_buku', $kode_buku);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        return $this->db->get('buku')->num_rows() > 0;
    }
}