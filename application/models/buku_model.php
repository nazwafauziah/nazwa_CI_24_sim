<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    public function get_all()
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
        return $this->db->get()->result();
    }

    public function insert($data)
    {
        $this->db->insert('buku', $data);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('buku', ['id_buku' => $id])->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id_buku', $id);
        $this->db->update('buku', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_buku', $id);
        $this->db->delete('buku');
    }
}
?>