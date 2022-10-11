<?php

namespace App\Controllers;

class Arsip extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Arsip',
            'isi'   => 'l_arsip'
        );
        return view('layout/l_wrapper' ,$data);
    }
}
