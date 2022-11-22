<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class No_auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {

			if (session()->get('level') == "1") {
				return redirect()->to(base_url('home'));
			}

			if (session()->get('level') == "2") {
				return redirect()->to(base_url('viewer'));
			}
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}