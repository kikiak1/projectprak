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
    }
}
