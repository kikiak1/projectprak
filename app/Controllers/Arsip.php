<?php

namespace App\Controllers;

use App\Models\Model_arsip;
use App\Models\Model_kategori;
use App\Models\Model_dep;
use App\Models\Model_auth;

class Arsip extends BaseController
{
    public function __construct()
    {
        if (session()->get('level') != "1") {
            echo 'Access denied';
            exit;
        }
        $this->Model_arsip = new Model_arsip();
        $this->Model_kategori = new Model_kategori();
        $this->Model_dep = new Model_dep();
        $this->Model_auth = new Model_auth();
        helper('form');

    }

    public function index()
    {
        $data = array(
            'title' => 'Arsip',
            'arsip' => $this->Model_arsip->all_data(),
            'isi'   => 'arsip/l_index'
        );
        return view('layout/l_wrapper' ,$data);
    }

    public function add()
    {
        $data = array(
            'title'    => 'Arsip',
            'kategori' => $this->Model_kategori->all_data(),
            'isi'      => 'arsip/l_add'
        );
        return view('layout/l_wrapper' ,$data);

    }

    public function insert()
    {
        if($this->validate([
            'nama_arsip'=>[
                'label' => 'Nama Arsip',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi!!!'
                ]
            ],
            'id_kategori'=> [
                'label'  => 'Kategori',
                'rules'  => 'required',
                'errors' => [
                    'require'   => '{field} Wajib Diisi !!!',
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors'=> [
                    'require'   => '{field} Wajib Diisi !!!',
                ]
            ],
            'file_arsip' => [
            'label'      => 'File Arsip',
            'rules'      => 'uploaded[file_arsip]|max_size[file_arsip,2048]|ext_in[file_arsip,pdf]',
            'errors'     => [
                        'uploaded' => '{field} Wajib Diisi !!!',
                        'max_size' => 'Ukuran {field} Max 2048 KB !!!!',
                        'ext_in'   => 'format {field} Wajib .PDF',   
                    ]
            ],

        ])) {

            //mengambil file arsip yang akan diupload di form
            $file_arsip = $this->request->getFile('file_arsip');
            //merandom nama file arsip
            $nama_file = $file_arsip->getRandomName();
            //mengambil ukuran file
            $ukuran_file = $file_arsip->getSize('kb');
            //jila Valid
            $data = array(
                'id_kategori' => $this->request->getPost('id_kategori'),
                'no_arsip'    => $this->request->getPost('no_arsip'),
                'nama_arsip'  => $this->request->getPost('nama_arsip'),
                'deskripsi'   => $this->request->getPost('deskripsi'),
                'tgl_upload'  => date('Y-m-d'),
                'tgl_update'  => date('Y-m-d'),
                'id_dep'      => session()->get('id_dep'),
                'id_user'     => session()->get('id_user'),
                'file_arsip'  => $nama_file,
                'ukuran_file' => $ukuran_file,
            );

            $file_arsip->move('file_arsip',$nama_file); //directori upload file
            $this->Model_arsip->add($data);
            session()->setFlashdata('pesan', 'Data berhasil di tambahkan !!!');
            return redirect()->to(base_url('arsip'));


        } else {
            //jika tidak vaild
            session()->setflashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/add'));
        }
       
    }
    //edit
    public function edit($id_arsip)
    {
        $arsip = $this->Model_arsip->where('id_arsip',$id_arsip)->first();
        $kategori = $this->Model_kategori->where('id_kategori', $arsip['id_kategori'])->first();
        $data = array(
            'title'    => 'Arsip',
            'kategori' => $this->Model_kategori->all_data(),
            'arsip'    => $arsip,
            'isi'      => 'arsip/l_edit',
            'kate'     => $kategori,
        );
        return view('layout/l_wrapper' ,$data);

    }

    public function update($id_arsip)
    {
        if($this->validate([
            'nama_arsip'=>[
                'label' => 'Nama Arsip',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi!!!'
                ]
            ],
            'id_kategori'=> [
                'label'  => 'Kategori',
                'rules'  => 'required',
                'errors' => [
                    'require'   => '{field} Wajib Diisi !!!',
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors'=> [
                    'require'   => '{field} Wajib Diisi !!!',
                ]
            ],

        ])) {
            $data = array(
                'id_arsip'    => $id_arsip,
                'id_kategori' => $this->request->getPost('id_kategori'),
                'no_arsip'    => $this->request->getPost('no_arsip'),
                'nama_arsip'  => $this->request->getPost('nama_arsip'),
                'deskripsi'   => $this->request->getPost('deskripsi'),
                'tgl_update'  => date('Y-m-d'),
                'id_dep'      => session()->get('id_dep'),
                'id_user'     => session()->get('id_user'),
            );

            $this->Model_arsip->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil di tambahkan !!!');
            return redirect()->to(base_url('arsip'));
        }else {
            //jika tidak vaild
            session()->setflashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/edit/' . $id_arsip));

        }
    }

    public function delete($id_arsip)
    {
        //menghapus file
        $arsip = $this->Model_arsip->detail_data($id_arsip);

        $data = array(
            'id_arsip' => $id_arsip,
        );
        $this->Model_arsip->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus !!!');
        return redirect()->to(base_url('arsip'));
    }
    public function viewpdf($id_arsip)
    {
        $arsip = $this->Model_arsip->where('id_arsip',$id_arsip)->first();
        $departemen = $this->Model_dep->where('id_dep', $arsip['id_dep'])->first();
        $auth = $this->Model_auth->where('id_user', $arsip['id_user'])->first();
        $data = array(
            'title' => 'View Arsip',
            'arsip' => $arsip,
            'isi'   => 'arsip/l_viewpdf',
            'dep'   => $departemen,
            'user'  => $auth
        );
        return view('layout/l_wrapper', $data);
    }
}
