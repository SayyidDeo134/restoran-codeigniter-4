<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginPelanggan implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if(!session('pelanggan', ['isLoggedIn'])){
            session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                Anda belum login 
            </div>');
            return redirect()->to(base_url('login-pelanggan'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}