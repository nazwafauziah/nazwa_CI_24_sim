<?php
class Buku_model extends CI_Model {

    public function get_kategori() {
        return $this->db->get('kategori')->result();
    }

    public function insert($data) {
        $this->db->insert('buku', $data);
    }

    public function get_all() {
    $this->db->select('buku.*, kategori.nama_kategori');
    $this->db->from('buku');
    $this->db->join('kategori', 'kategori.id = buku.id_kategori', 'left');
    return $this->db->get()->result();
    }

    public function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('buku');
    }

    public function get_by_id($id) {
    return $this->db->get_where('buku', ['id' => $id])->row();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('buku', $data);
    }
}