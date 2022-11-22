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
    }
}
