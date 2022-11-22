<?php

namespace App\Controllers;

use App\Models\Model_arsip;
use App\Models\Model_kategori;
use App\Models\Model_dep;
use App\Models\Model_auth;

class Arsipviewer extends BaseController
{
    public function __construct()
    {
        if (session()->get('level') != "2") {
            echo 'Access denied';
            exit;
        }
    }
    
    public function viewpdf($id_arsip)
    {
        $arsip = $this->Model_arsip->where('id_arsip',$id_arsip)->first();
        $departemen = $this->Model_dep->where('id_dep', $arsip['id_dep'])->first();
        $auth = $this->Model_auth->where('id_user', $arsip['id_user'])->first();
        $data = array(
            'title' => 'View Arsip',
            'arsip' => $arsip,
            'isi'   => 'viewer/l_viewpdf',
            'dep'   => $departemen,
            'user'  => $auth
        );
        return view('viewer/layout/l_wrapper', $data);
    }
}
