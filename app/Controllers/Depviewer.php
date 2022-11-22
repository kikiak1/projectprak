<?php

namespace App\Controllers;

use App\Models\Model_dep;

class Depviewer extends BaseController
{

    public function __construct() 
    {
        if (session()->get('level') != "2") {
            echo 'Access denied';
            exit;
        }
        $this->Model_dep = new Model_dep();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title'    => 'Departement',
            'dep' => $this->Model_dep->all_data(),
            'isi'      => 'viewer/l_dep'
        );
        return view('viewer/layout/l_wrapper' ,$data);
    }

}
