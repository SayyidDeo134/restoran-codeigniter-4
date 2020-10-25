<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AksesAdministrator implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if(session()->get('administrator')['level'] != 'Administrator'){
            session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                Tidak bisa mengakses, anda bukan administrator
            </div>');
            return redirect()->to(base_url('admin'));
        }
        // else{
        //     if(session('administrator', ['level']) !== 'Administrator'){
        //         session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
        //             Tidak bisa mengakses, anda bukan administrator
        //         </div>');
        //         return redirect()->to(base_url('admin'));
        //     }
        // }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}