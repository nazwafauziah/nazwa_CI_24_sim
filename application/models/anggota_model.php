<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model{

    private $table = 'anggota';

    // Ambil semua data
    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    // Ambil berdasarkan ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id'=>$id])->row();
    }

    // Insert data
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Hapus data
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id'=>$id]);
    }

    // Update data (INI YANG DIPERBAIKI)
    public function update($id,$data)
    {
        return $this->db->where('id',$id)->update($this->table, $data);
    }

}