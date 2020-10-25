<?php namespace App\Controllers;

    use CodeIgniter\I18n\Time;
    use Wildanfuady\WFcart\WFcart;

    class Keranjang extends BaseController{

        protected $db;
        protected $tblorder;
        protected $tblorderdetail;
        protected $tblpelanggan;
        protected $tblmenu;
        protected $tblkategori;
        protected $user;
        protected $cart;

        public function __construct(){
            $this->db = \Config\Database::connect();
            $this->tblorder = $this->db->table('tblorder');
            $this->tblorderdetail = $this->db->table('tblorderdetail');
            $this->tblpelanggan = $this->db->table('tblpelanggan');
            $this->tblmenu = $this->db->table('tblmenu');
            $this->tblkategori = $this->db->table('tblkategori');
            $this->user = session()->get('pelanggan');
            $this->cart = new WFcart();
        }

        public function index(){

            $query_kategori = $this->tblkategori->get()->getResultArray();
            if(!empty(session()->get('cart'))){
                $quantity_total = $this->cart->quantity_totals();
            }else{
                $quantity_total = 0;
            }
            $data = [
                'kategori'      =>  $query_kategori,
                'items'         =>  $this->cart->totals(),
                'total'         =>  $this->cart->count_totals(),
                'quantity_total'=>  $quantity_total
            ];

            return view('keranjang-view', $data);

        }

        public function prosesPesan(){
            date_default_timezone_set('Asia/jakarta');
            $cart = session()->get('cart');
            $idpelanggan = $this->user['idpelanggan'];
            $dataOrder = [
                'idpelanggan'       =>  $idpelanggan,
                'tglorder'          =>  date('Y-m-d'),
                'total'             =>  $this->cart->count_totals(),
                'bayar'             =>  0,
                'kembali'           =>  0,
                'status'            =>  0
            ];
            $this->tblorder->insert($dataOrder);
            $idOrder = $this->db->insertID();
            foreach($cart as $key){
                $dataOrderDetail = [
                    'idorder'       =>  $idOrder,
                    'idmenu'        =>  $key['id'],
                    'jumlah'        =>  $key['quantity'],
                    'hargajual'     =>  $key['price']
                ];
                $this->tblorderdetail->insert($dataOrderDetail);
            }
            session()->remove('cart');
            session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                Pesanan anda telah di proses, terimakasih telah memesan
            </div>');
            return redirect()->to(base_url());
        }

        public function tambahKeranjang($idmenu = null){
            // ambil product berdasarkan idmenu
            $getMenu = $this->tblmenu->where('idmenu', $idmenu)->get()->getRow();
            if($getMenu != null){
                $data = [
                    'idpelanggan'   =>  $this->user['idpelanggan'],
                    'id'            =>  $idmenu,
                    'menu'          =>  $getMenu->menu,
                    'price'         =>  $getMenu->harga,
                    'quantity'      =>  1,
                ];

                $this->cart->add_cart($idmenu, $data);
                $nama_menu = $data['menu'];
                session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                    '. $nama_menu .' berhasil ditambahkan
                </div>');

            }else{
                session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                    Tidak ada menu yang di pilih
                </div>');
            }
            return redirect()->to(base_url('keranjang'));
        }

        public function min($id = null){
            $this->cart->minus($id);
            return redirect()->to(base_url('keranjang'));
        }

        public function plus($id = null){
            $this->cart->plus($id);
            return redirect()->to(base_url('keranjang'));
        }

        public function remove($id = null){
            $getMenu = $this->tblmenu->where('idmenu', $id)->get()->getRow();
            // var_dump($this->cart->remove($id));
            if($getMenu != null){
                $this->cart->remove($id);
                session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                    '. $getMenu->menu .' berhasil dihapus
                </div>');
            }else{
                session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                    Gagal menghapus
                </div>');
            }
            return redirect()->to(base_url('keranjang'));
        }

    }

?>