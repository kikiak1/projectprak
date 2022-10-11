<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'User',
            'isi'   => 'l_user'
        );
        return view('layout/l_wrapper' ,$data);
    }
}
