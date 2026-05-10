<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model{

    public function get_all()
    {
        $this->db->select('peminjaman.*, anggota.nama');
        $this->db->select('peminjaman');
        $this->db->select('anggota', 'anggota.id = peminjaman.anggota_id');
        return $this->db->get()->result();
    }

    public function insert($data,$buku_id)
    {
        $this->db->insert('peminjaman', $data);
        $peminjaman_id = $this->db->insert_id();

        $this->db->insert('detail_peminjaman',[
            'peminjaman_id'=>$peminjaman_id,
            'buku_id'=>$buku_id,
            'qty'=>1
        ]);
        $this->db->set('stok','stok - 1', FALSE);
        $this->db->where('id', $buku_id);
        $this->db->update('buku');
    }

    public function get_detail($id)
    {
        $this->db->select('detail_peminjaman.*, buku.judul_buku');
        $this->db->from('detail_peminjaman');
        $this->db->join('buku', 'buku.id_buku = detail_peminjaman.buku_id_buku');
        $this->db->where('peminjaman_id', $id);
        return $this->db->get()->row();
    }

    public function pengembalian($id)
    {
        $detail = $this->get_detail($id);
        $pinjam = $this->db->get_where('peminjaman',['id=>$id'])->row();

        $today = date('Y-m-d');
        $terlambat = 0;
        $denda = 0;

        if($today > $pinjam->tanggal_jatuh_tempo){
            $terlambat=(strtotime($today)- strtotime($pinjam->tanggal_jatuh_tempo))/ 86400;
        }

        $this->db->insert('pengembalian',[
            'peminjaman_id'=>$id,
            'tanggal_kembali'=>$today,
            'terlambat' =>$terlambat,
            'denda' => $denda
        ]);

        $this->db->where('id', $id);
        $this->db->update('peminjaman', ['status'=>'kembali']);

        $this->db->set('stok', 'stok + 1', FALSE);
        $this->db->where('id', $detail->buku_id);
        $this->db->where('id', $id);
        $this->db->update('buku');
    }
}