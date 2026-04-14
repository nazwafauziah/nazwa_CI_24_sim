<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_model extends CI_Model {

    public function get_all()
    {
        return $this->db->get('kategori')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('kategori', ['id' => $id])->row();
    }

    public function insert($data)
    {
        $this->db->insert('kategori', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kategori', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kategori');
    }
}