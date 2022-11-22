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
}
