<?php

namespace App\Controllers;
use App\Models\Model_home;

class Home extends BaseController
{
	public function __construct()
	{
		if (session()->get('level') != "1") {
            echo 'Access denied';
            exit;
        }
		$this->Model_home = new Model_home();
	}
	public function index()
	{
		$data = array(
			'title' => 'Home',
			'tot_arsip'	=> $this->Model_home->tot_arsip(),
			'tot_dep'	=> $this->Model_home->tot_dep(),
			'tot_user'	=> $this->Model_home->tot_user(),
			'tot_kategori'	=> $this->Model_home->tot_kategori(),
			'isi'	=> 'l_home'
		);
		return view('layout/l_wrapper', $data);
	}
}