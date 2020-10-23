<?php namespace App\Controllers\Admin;

    use App\Controllers\BaseController;
    use App\Models\M_Menu;
    class Menu extends BaseController{
        protected $table;
        protected $db;
        protected $tblmenu;
        protected $tblkategori;
        public function __construct(){
            $this->table = new M_Menu();
            $this->db = \Config\Database::connect();
            $this->tblmenu = $this->db->table('tblmenu');
            $this->tblkategori = $this->db->table('tblkategori');
        }

        public function index(){
            $data = [
                'title'         =>  'ADMIN | KATEGORI',
                'menu'          =>  $this->table->paginate(2,'page'),
                'pager'         =>  $this->table->pager,
                'kategori'      =>  $this->tblkategori->get()->getResultArray()
            ];
            return view('admin/menu/view-data', $data);
        }

        public function formInsert(){
            $data = [
                'title'         =>  'ADMIN | MENU | INSERT',
                'kategori'      =>  $this->tblkategori->get()->getResultArray()
            ];
            return view('admin/menu/insert-data', $data);
        }

        public function aksi(){
            if (isset($_POST['add'])) {
                $rules = [
                    'menu'  =>  [
                        'rules'     =>  'required|alpha_space',
                        'errors'    =>  [
                            'required'  =>  'Kolom menu tidak boleh kosong',
                            'alpha_space'   =>  'Nama menu tidak boleh menggunakan angka dan simbol'
                        ]
                    ],
                    'harga'  =>  [
                        'rules'     =>  'required',
                        'errors'    =>  [
                            'required'  =>  'Kolom harga tidak boleh kosong',
                        ]
                    ]
                ];
                if ($this->validate($rules)) {
                    $file = $this->request->getFile('file');
                    $name = $file->getName();
                    $ext = $file->getExtension();
                    if ($name == "" || $this->checkExtension($ext) == false) {
                        $errors = ['gambar'     =>  'File tidak ada atau extensi salah'];
                    }else{
                        $next_id = $this->db->query("SHOW TABLE STATUS LIKE 'tblmenu'")->getRow()->Auto_increment;
                        $idkategori = $this->request->getPost('kategori');
                        $menu = $this->request->getPost('menu');
                        $harga = $this->request->getPost('harga');
                        $newname = 'menu-' . $next_id . '.' . $ext;
                        
                        $data = [
                            'idkategori' => $idkategori,
                            'menu' => $menu,
                            'gambar' => $newname,
                            'harga' => $harga
                        ];

                        $this->tblmenu->insert($data);
                        $file->move('uploads/menu', $newname);
                        session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                            DATA BERHASIL DITAMBAHKAN:)
                        </div>');
                        return redirect()->to(base_url('admin/menu'));

                    }
                }else{
                    $errors = $this->validator->getErrors();
                    var_dump($errors);
                }
            }
        }

        // function tambahan
        public function checkExtension($ext){
            if ($ext == 'jpg' || $ext == 'png' || $ext == 'webp' || $ext == 'JPG' || $ext == 'PNG' || $ext == 'WEBP' ) {
                return true;
            }else{
                return false;
            }
        }

    }

?>