<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_arsip extends Model
{
    public function all_data()
    {
        return $this->db->table('tbl_arsip')
        ->join('tbl_dep', 'tbl_dep.id_dep = tbl_arsip.id_dep', 'left')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
        ->orderBy('id_arsip','DESC')
        ->get()
        ->getResultArray();
    }

    public function detail_data($id_arsip)
    {
        $this->db->table('tbl_arsip')
        ->join('tbl_dep', 'tbl_dep.id_dep = tbl_arsip.id_dep', 'left')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
        ->where('id_arsip',$data['id_arsip'])
        ->get()
        ->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_arsip')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_arsip')
            ->where('id_arsip', $data['id_arsip'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tbl_arsip')
            ->where('id_arsip', $data['id_arsip'])
            ->delete($data);
    }
}