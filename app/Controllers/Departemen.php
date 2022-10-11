<?php

namespace App\Controllers;

class Departemen extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Departemen',
            'isi'   => 'l_departemen'
        );
        return view('layout/l_wrapper' ,$data);
    }
}
