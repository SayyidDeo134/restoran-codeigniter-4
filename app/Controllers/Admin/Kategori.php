<?php namespace App\Controllers\Admin;

    use App\Controllers\BaseController;
    use App\Models\M_Kategori;
    
    class Kategori extends BaseController{
        protected $table;
        protected $db;
        protected $tblkategori;
        public function __construct(){
            $this->table = new M_Kategori();
            $this->db = \Config\Database::connect();
            $this->tblkategori = $this->db->table('tblkategori');
        }

        public function index(){
            $data = [
                'title'     =>  'ADMIN | KATEGORI',
                'kategori'  =>  $this->table->paginate(2, 'page'),
                'pager'     =>  $this->table->pager
            ];
            return view('admin/kategori/view-data', $data);
        }

        public function formInsert(){
            $data = [
                'title'     =>  'ADMIN | KATEGORI | INSERT'
            ];

            return view('admin/kategori/insert-data', $data);
        }

        public function formUpdate($id = null){
            $query = $this->tblkategori->where('idkategori', $id)->get()->getRowArray();
            $data = [
                'title'     =>  'ADMIN | KATEGORI | EDIT',
                'kategori'  =>  $query
            ];

            return view('admin/kategori/edit-data', $data);
        }

        public function aksi(){
            if (isset($_POST['add'])) {
                $rules = [
                    'kategori'  =>  [
                        'rules'     =>  'required|alpha_space',
                        'errors'    =>  [
                            'required'  =>  'Kolom kategori tidak boleh kosong',
                            'alpha_space'   =>  'Nama kategori tidak boleh menggunakan angka dan simbol'
                        ]
                    ]
                ];
                if ($this->validate($rules)) {
                    $data = [
                        'kategori'      =>  $this->request->getPost('kategori')
                    ];
                    $this->tblkategori->insert($data);
                    session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                        DATA BERHASIL DITAMBAH:)
                    </div>');
                    return redirect()->to(base_url('admin/kategori'));
                }else{
                    $errors = $this->validator->getErrors();
                    session()->setFlashdata('pesan', $errors);
                    return redirect()->to(base_url('admin/kategori/tambah'));
                }
            }else if(isset($_POST['ubah'])){
                $id = $this->request->getPost('idkategori');
                $rules = [
                    'kategori'  =>  [
                        'rules'     =>  'required|alpha_space',
                        'errors'    =>  [
                            'required'  =>  'Kolom kategori tidak boleh kosong',
                            'alpha_space'   =>  'Nama kategori tidak boleh menggunakan angka dan simbol'
                        ]
                    ]
                ];
                if ($this->validate($rules)) {
                    $data = [
                        'kategori'      =>  $this->request->getPost('kategori')
                    ];
                    $this->tblkategori->set($data);
                    $this->tblkategori->where('idkategori', $id);
                    $this->tblkategori->update();
                    session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                        DATA BERHASIL DIUBAH:)
                    </div>');
                    return redirect()->to(base_url('admin/kategori'));
                }else{
                    $errors = $this->validator->getErrors();
                    session()->setFlashdata('pesan', $errors);
                    return redirect()->to(base_url('admin/kategori/edit/' . $id));
                }
            }
        }

        public function hapus($id = null){
            $this->tblkategori->where('idkategori', $id);
            $this->tblkategori->delete();
            session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                DATA BERHASIL DIHAPUS:)
            </div>');
            return redirect()->to(base_url('admin/kategori'));
        }

    }

?>