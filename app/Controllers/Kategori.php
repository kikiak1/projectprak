<?php

namespace App\Controllers;

use App\Models\Model_kategori;

class Kategori extends BaseController
{

    public function __construct() 
    {
        if (session()->get('level') != "1") {
            echo 'Access denied';
            exit;
        }
        $this->Model_kategori = new Model_kategori();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title'    => 'Kategori',
            'kategori' => $this->Model_kategori->all_data(),
            'isi'      => 'l_kategori'
        );
        return view('layout/l_wrapper' ,$data);
    }

    public function add()
    {
        $data = array('nama_kategori' => $this->request->getPost());
        $this->Model_kategori->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!!');
        return redirect()->to(base_url('kategori'));
    }

    public function edit($id_kategori)
    {
        $data = array(
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost(),
        );
        $this->Model_kategori->edit($data);
        session()->setFlashdata('pesan', 'Data Berhasil Di Update !!!');
        return redirect()->to(base_url('kategori'));
    }

    public function delete($id_kategori)
    {
        $data = array(
            'id_kategori' => $id_kategori,
        );
        $this->Model_kategori->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('kategori'));
    }
}
