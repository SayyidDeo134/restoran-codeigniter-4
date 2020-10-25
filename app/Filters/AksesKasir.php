<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AksesKasir implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if(!session('administrator', ['isLoggedIn'])){
            session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                Anda belum login 
            </div>');
            return redirect()->to(base_url('login-admin'));
        }else{
            if(session()->get('administrator')['level'] != 'Administrator' && session()->get('administrator')['level'] != 'Kasir'){
                session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                    Tidak bisa mengakses, anda bukan administrator Atau Kasir
                </div>');
                return redirect()->to(base_url('admin'));
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}