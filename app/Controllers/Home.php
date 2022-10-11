<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Home',
            'isi'   => 'l_home'
        );
        return view('layout/l_wrapper' ,$data);
    }
}
