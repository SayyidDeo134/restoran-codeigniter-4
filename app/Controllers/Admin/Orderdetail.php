<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Orderdetail;

class Orderdetail extends BaseController{

    protected $db;
    protected $table;
    protected $user;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->user = session()->get('administrator');
        $this->table = new M_Orderdetail();

    }

    public function index(){

        if(isset($_POST['cari-tanggal'])){
            $orderdetail = $this->table->where('tglorder >= ', $this->request->getPost('tanggal-mulai'))
                ->where('tglorder <= ', $this->request->getPost('tanggal-akhir'))->paginate(3, 'page');
        }else {
            $orderdetail = $this->table->paginate(3, 'page');
        }

        $data = [
            'title'         =>  'ADMIN | ORDERDETAIL',
            'orderdetail'   =>  $orderdetail,
            'pager'         =>  $this->table->pager,
        ];
        return view('admin/orderdetail/view-data', $data);
    }

}

?>