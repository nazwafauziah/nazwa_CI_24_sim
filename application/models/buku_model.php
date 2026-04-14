<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class buku_model extends CI_Model {

    public function get_all(){
        $this->db->select('buku.*, kategori.nama_kategori as nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.kategori_id', 'left');
        return $this->db->get()->result();
    }

    public function get_kategori(){
        return $this->db->get('kategori')->result();
    }

    public function insert($data){
        return $this->db->insert('buku', $data);
    }

    // PERBAIKAN: get_by_id menggunakan 'id' (karena primary key di tabel buku adalah 'id')
    public function get_by_id($id){
        return $this->db->get_where('buku', ['id' => $id])->row();
    }

    // PERBAIKAN: update menggunakan 'id'
    public function update($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('buku', $data);
    }

    // PERBAIKAN: delete menggunakan 'id'
    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete('buku');
    }
}