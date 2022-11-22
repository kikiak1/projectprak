<?php

namespace App\Controllers;

use App\Models\Model_kategori;

class Kategoriviewer extends BaseController
{

    public function __construct() 
    {
        if (session()->get('level') != "2") {
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
            'isi'      => 'viewer/l_kategori'
        );
        return view('viewer/layout/l_wrapper' ,$data);
    }

}
