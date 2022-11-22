<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kategori extends Model
{
    protected $table = "tbl_kategori";
    protected $allowedFields = ['nama_kategori'];

    public function all_data()
    {
        return $this->db->table('tbl_kategori')
        ->orderBy('id_kategori','ASCE')
        ->get()
        ->getResultArray();
            
    }
    public function add($data)
    {
        $this->db->table('tbl_kategori')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_kategori')
            ->where('id_kategori',$data['id_kategori'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tbl_kategori')
            ->where('id_kategori', $data['id_kategori'])
            ->delete($data);
    }
}