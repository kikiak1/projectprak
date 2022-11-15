<?php

namespace App\Controllers;
use App\Models\Model_user;
use App\Models\Model_dep;

class User extends BaseController
{
    public function __construct()
    {
        $this->Model_user = new Model_user();
        $this->Model_dep = new Model_dep();
        helper('form');
    }
    public function index()
    {
        $data = array(
            'title' => 'User',
            'user'  => $this->Model_user->all_data(),
            'isi'   => 'user/l_user'
        );
        return view('layout/l_wrapper' ,$data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Add User',
            'dep'   => $this->Model_dep->all_data(),
            'isi'   => 'user/l_add'
        );
        return view('layout/l_wrapper' ,$data);
    }

    public function insert()
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama user',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ]
            ],
            'email' => [
                'label'  => 'E-mail',
                'rules'  => 'required|is_uniqe[tbl_user.email]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                    'is_uniqe' => '{field} sudah dibuat, input {field} lain !!!'
                ]
        ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ]
        ],
        'level' => [
            'label'  => 'Level',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi !!!',
            ]
         ],
         'id_dep' => [
            'label'  => 'Departement',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi !!!',
            ]
        ],
        'foto' => [
            'label'  => 'Foto',
            'rules'  => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg,image/gif]',
            'errors' => [
                'uploaded' => '{field} Wajib Diisi !!!',
                'max_size' => 'ukuran {field} max 104kb!!!',
                'mime_in' => 'format {field} wajib PNG,JPEG,JPEG,GIF!!!',
            ]
        ]
        ])){
            //mengambil file foto yang akan diupload di form
            $foto = $this->request->getFile('foto');
            //merandom nama file foto
            $nama_file = $foto->getRandomName();
            //jika valid
        $data = array(
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'level' => $this->request->getPost('level'),
            'id_dep' => $this->request->getPost('id_dep'),
            'foto' => nama_file,
        );

        $foto->move('foto', $nama_file ); //direktori upload file

        $this->Model_user->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        return redirect()->to(base_url('user'));
        }else
        {
            //jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/add'));
        }
    }
    public function edit($id_user)
    {
        $data = array(
            'title' => 'Edit User',
            'dep'   => $this->Model_dep->all_data(),
            'user'  => $this->Model_user->detail_data($id_user),
            'isi'   => 'user/l_edit'
        );
        return view('layout/l_wrapper' ,$data);
    }
    public function update($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama user',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ]
        ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ]
        ],
        'level' => [
            'label'  => 'Level',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi !!!',
            ]
         ],
         'id_dep' => [
            'label'  => 'Departement',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib Diisi !!!',
            ]
        ],
        'foto' => [
            'label'  => 'Foto',
            'rules'  => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg,image/gif]',
            'errors' => [
                'max_size' => 'ukuran {field} max 104kb!!!',
                'mime_in' => 'format {field} wajib PNG,JPEG,JPEG,GIF!!!',
            ]
        ]

        ])){
            $foto = $this->request->getFile('foto');
            if($foto->getError()==4)
            { $data = array(
                'id_user'   => $id_user,
                'nama_user' => $this->request->getPost('nama_user'),
                'password'  => $this->request->getPost('password'),
                'level'     => $this->request->getPost('level'),
                'id_dep'    => $this->request->getPost('id_dep'),
            );   
            $this->Model_user->edit($data);
        }else{
            //menghapus foto lama
            $user = $this->Model_user->detail_data($id_user);
            if ($user['foto'] != " "){
                unlink('foto/',$user['foto']);
            }
            //merandom nama file foto
            $nama_file = $foto->getRandomName();
            $data = array(
                'id_user'   => $id_user,
                'nama_user' => $this->request->getPost('nama_user'),
                'password'  => $this->request->getPost('password'),
                'level'     => $this->request->getPost('level'),
                'id_dep'    => $this->request->getPost('id_dep'),
                'foto'    => nama_file,
            );    
            $foto->move('foto', $nama_file ); //direktori upload file   
            $this->Model_user->edit($data);
        }     
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate !!!');
        return redirect()->to(base_url('user'));
     }else
            {
            //jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/edit'.$id_user));
        }

    }
    public function delete($id_user)
    {
        //menghapus foto lama
        $user = $this->Model_user->detail_data($id_user);
        if ($user['foto'] != " "){
            unlink('foto/',$user['foto']);
        }
        
        $data = array(
            'id_user' => $id_user,
        );
        $this->Model_user->delete_data($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!!');
        return redirect()->to(base_url('user'))
;    }
}
