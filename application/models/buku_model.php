<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {  // ← huruf B besar (Buku_model, bukan buku_model)

    public function get_all()
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        // PERBAIKAN: pakai id_kategori, bukan id dan kategori_id
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
        $this->db->order_by('buku.id_buku', 'DESC');
        return $this->db->get()->result();
    }

    public function get_kategori()
    {
        return $this->db->get('kategori')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('buku', $data);
    }

    public function get_by_id($id)
    {
        // PERBAIKAN: pakai id_buku, bukan id
        return $this->db->get_where('buku', ['id_buku' => $id])->row();
    }

    public function update($id, $data)
    {
        // PERBAIKAN: pakai id_buku, bukan id
        $this->db->where('id_buku', $id);
        return $this->db->update('buku', $data);
    }

    public function delete($id)
    {
        // PERBAIKAN: pakai id_buku, bukan id
        return $this->db->delete('buku', ['id_buku' => $id]);
    }
}