<?php namespace App\Controllers;

use App\Models\M_Menu;
use Wildanfuady\WFcart\WFcart;
use App\Models\M_Orderdetail;

class Home extends BaseController
{

	protected $db;
	protected $tblkategori;
	protected $tblmenu;
	protected $vorderdetail;
	protected $table;
	protected $cart;
	protected $user;

	public function __construct(){
		$this->db = \Config\Database::connect();
		$this->tblkategori = $this->db->table('tblkategori');
		$this->tblmenu = $this->db->table('tblmenu');
		$this->table = new M_Menu();
		$this->vorderdetail = new M_Orderdetail();
		$this->cart = new WFcart();
		$this->user = session()->get('pelanggan');
	}

	public function index($id = null)
	{

		$menu = $this->table->paginate(3, 'page');
		if(!empty($id)){
			$menu = $this->table->where('idkategori', $id)->paginate(3, 'page');
		}
		$pager = $this->table->pager;

		if(!empty(session()->get('cart'))){
			$quantity_total = $this->cart->quantity_totals();
		}else{
			$quantity_total = 0;
		}

		$query_kategori = $this->tblkategori->get()->getResultArray();
		$data = [
			'kategori'		=>	$query_kategori,
			'menu'			=>	$menu,
			'pager'			=>	$pager,
			'quantity_total'=>	$quantity_total
		];

		return view('home-view', $data);
	}

	public function histori(){
		$idpelanggan = $this->user['idpelanggan'];
		if(isset($_POST['cari-tanggal'])){
            $orderdetail = $this->vorderdetail->where('idpelanggan', $idpelanggan)->where('tglorder >= ', $this->request->getPost('tanggal-mulai'))
                ->where('tglorder <= ', $this->request->getPost('tanggal-akhir'))->paginate(3, 'page');
        }else {
            $orderdetail = $this->vorderdetail->where('idpelanggan', $idpelanggan)->paginate(3, 'page');
		}
		
		if(!empty(session()->get('cart'))){
			$quantity_total = $this->cart->quantity_totals();
		}else{
			$quantity_total = 0;
		}
		$query_kategori = $this->tblkategori->get()->getResultArray();
        $data = [
			'kategori'		=>	$query_kategori,
            'orderdetail'   =>  $orderdetail,
			'pager'         =>  $this->vorderdetail->pager,
			'quantity_total'=>	$quantity_total
        ];
        return view('histori-view', $data);
	}

	//--------------------------------------------------------------------

}
