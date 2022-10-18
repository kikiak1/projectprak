<?php

namespace App\Controllers;

use App\Models\Model_dep;

class Dep extends BaseController
{

    public function __construct() 
    {
        $this->Model_dep = new Model_dep();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title'    => 'Departement',
            'dep' => $this->Model_dep->all_data(),
            'isi'      => 'l_dep'
        );
        return view('layout/l_wrapper' ,$data);
    }

    public function add()
    {
        $data = array('nama_dep' => $this->request->getPost());
        $this->Model_dep->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!!');
        return redirect()->to(base_url('dep'));
    }

    public function edit($id_dep)
    {
        $data = array(
            'id_dep' => $id_dep,
            'nama_dep' => $this->request->getPost(),
        );
        $this->Model_dep->edit($data);
        session()->setFlashdata('pesan', 'Data Berhasil Di Update !!!');
        return redirect()->to(base_url('dep'));
    }

    public function delete($id_dep)
    {
        $data = array(
            'id_dep' => $id_dep,
        );
        $this->Model_dep->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('dep'));
    }
}
