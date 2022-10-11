<?php

namespace App\Controllers;

class Kategori extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Kategori',
            'isi'   => 'l_kategori'
        );
        return view('layout/l_wrapper' ,$data);
    }
}
