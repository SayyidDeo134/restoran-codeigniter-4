<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Order;

class Order extends BaseController{

    protected $db;
    protected $table;
    protected $tblorder;
    protected $vorderdetail;
    protected $user;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->tblorder = $this->db->table('tblorder');
        $this->vorderdetail = $this->db->table('vorderdetail');
        $this->user = session()->get('administrator');
        $this->table = new M_Order();

    }

    public function index(){

        $data = [
            'title'     =>  'ADMIN | ORDER',
            'order'     =>  $this->table->orderBy('status', 'ASC')->paginate(3, 'page'),
            'pager'     =>  $this->table->pager,
        ];
        return view('admin/order/view-data', $data);
    }

    public function formBayar($id = null){
        $data = [
            'title'         =>  'ADMIN | ORDER | BAYAR',
            'order'         =>  $this->table->where('idorder', $id)->first(),
            'orderdetail'   =>  $this->vorderdetail->where('idorder', $id)->get()->getResultArray()
        ];
        return view('admin/order/view-edit', $data);
    }

    public function prosesBayar(){
        $id = $this->request->getPost('idorder');
        $rules = [
            'jumlah-bayar'  =>  [ 'rules' => 'required' ]
        ];

        if($this->validate($rules)){
            $jumlahBayar = $this->request->getPost('jumlah-bayar');
            $totalBayar = $this->request->getPost('total-bayar');
            if($jumlahBayar < $totalBayar){
                $errors = ['jumlah-bayar' => 'Jumlah bayar kurang dari total bayar'];
                session()->setFlashdata('pesan', $errors);
                return redirect()->to(base_url('admin/order/bayar/' . $id));
            }else{
                $kembali = $jumlahBayar - $totalBayar;
                $data = [
                    'bayar'     =>  $jumlahBayar,
                    'kembali'   =>  $kembali,
                    'status'    =>  1
                ];
                $this->tblorder->set($data);
                $this->tblorder->where('idorder', $id);
                $this->tblorder->update();
                session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                    PEMBAYARAN BERHASIL
                </div>');
                return redirect()->to(base_url('admin/order'));
            }
        }else{
            $errors = ['jumlah-bayar' => 'Kolom pengisian kosong'];
            session()->setFlashdata('pesan', $errors);
            return redirect()->to(base_url('admin/order/bayar/' . $id));
        }

    }


}

?>