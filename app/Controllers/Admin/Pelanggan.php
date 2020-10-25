<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Pelanggan;

class Pelanggan extends BaseController{

    protected $db;
    protected $tblpelanggan;
    protected $user;
    protected $table;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->tblpelanggan = $this->db->table('tblpelanggan');
        $this->table = new M_Pelanggan();
        $this->user = session()->get('administrator');

    }

    public function index(){

        $data = [
            'title'         =>  'ADMIN | PELANGGAN',
            'pelanggan'     =>  $this->table->paginate(2, 'page'),
            'pager'         =>  $this->table->pager,
        ];
        return view('admin/pelanggan/view-data', $data);
    }

    public function ubahStatus($id = null, $aktif = null){
        if($aktif == 1){
            $status = 0;
            $pesan = 'Akun pelanggan berhasil di non-aktifkan';
        }else{
            $status = 1;
            $pesan = 'Akun Pelanggan berhasil di aktifkan';
        }

        $this->tblpelanggan->set('aktif', $status);
        $this->tblpelanggan->where('idpelanggan', $id);
        $this->tblpelanggan->update();
        session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
            '. $pesan .'
        </div>');
        return redirect()->to(base_url('admin/pelanggan'));

    }

    public function hapus($id = null, $status = null){
        if ($status == 0) {
            $this->tblpelanggan->where('idpelanggan', $id);
            $this->tblpelanggan->delete();
            session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                DATA BERHASIL DIHAPUS
            </div>');
            return redirect()->to(base_url('admin/pelanggan'));
        }else{
            session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                GAGAL HAPUS, DIKARENAKAN USER MASIH AKTIF
            </div>');
            return redirect()->to(base_url('admin/pelanggan'));
        }
    }

}

?>