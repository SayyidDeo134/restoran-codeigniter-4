<?php namespace App\Controllers\Admin; 

    use App\Controllers\BaseController;
    use App\Models\M_User;

    class User extends BaseController{

        protected $db;
        protected $tbluser;
        protected $table;

        public function __construct(){
            $this->table = new M_User();
            $this->db = \Config\Database::connect();
            $this->tbluser = $this->db->table('tbluser');
        }

        public function index(){
            $data = [
                'title'     =>  'ADMIN | USER',
                'user'      =>  $this->table->where('user !=', 'Administrator')->paginate(2, 'page'),
                'pager'     =>  $this->table->pager
            ];
            return view('admin/user/view-data', $data);
        }

        public function formInsert(){
            $data = [
                'title'     =>  'ADMIN | USER | TAMBAH'
            ];
            return view('admin/user/insert-data', $data);
        }

        public function formUbahPassword(){
            $data = [
                'title'     =>  'ADMIN | USER | UBAH PASSWORD'
            ];
            return view('admin/user/edit-data', $data);
        }

        public function aksi(){

            if(isset($_POST['add'])){
                $rules = [
                    'username'  =>  [
                        'rules' => 'required|alpha_space|is_unique[tbluser.user]',
                        'errors' => [
                            'required'  => 'Kolom Username harus di isi',
                            'alpha_space'   =>  'Username tidak boleh menggunakan simbol atau spasi',
                            'is_unique' =>  'Username sudah ada,silahkan coba yang lain'
                        ],
                    ]
                ];
                if($this->validate($rules)){
                    $username = $this->request->getPost('username');
                    $level = $this->request->getPost('level');

                    $next_id = $this->db->query("SHOW TABLE STATUS LIKE 'tbluser'")->getRow()->Auto_increment;

                    $nomor = '';
                    if($next_id > 0 && $next_id < 10){
                        $nomor = '00' . $next_id;
                    }else if ($next_id >= 10 && $next_id <= 99 ){
                        $nomor = '0'. $next_id;
                    }

                    $email = $username . '.' . $level . $nomor . '@gmail.com';

                    $data = [
                        'user' => $username,
                        'email' => $email,
                        'password' => sha1($username),
                        'level' =>  $level,
                        'aktif' =>  1
                    ];

                    var_dump($data);

                    $this->tbluser->insert($data);
                    session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                        DATA BERHASIL DITAMBAH:)
                    </div>');
                    return redirect()->to(base_url('admin/user'));

                }else{
                    $errors = $this->validator->getErrors();
                    session()->setFlashdata('pesan', $errors);
                    return redirect()->to(base_url('admin/user/tambah'));
                }
            }else if(isset($_POST['ubah'])){
                $rules = [
                    'old-password'  =>  [
                        'rules' => 'required|min_length[3]',
                        'errors' => [
                            'required'  => 'Kolom Password lama harus di isi',
                            'min_length' => 'Minimal 3 huruf'
                        ],
                    ],
                    'new-password'  =>  [
                        'rules' => 'required|min_length[3]',
                        'errors' => [
                            'required'  => 'Kolom Password baru harus di isi',
                            'min_length' => 'Minimal 3 huruf'
                        ],
                    ],
                    'konfirm'  =>  [
                        'rules' => 'required|min_length[3]|matches[new-password]',
                        'errors' => [
                            'required'  => 'Kolom Konfirmasi Password harus di isi',
                            'min_length' => 'Minimal 3 huruf',
                            'matches'   =>  'Konfirmasi password salah'
                        ],
                    ],
                ];
                if ($this->validate($rules)) {
                    $old = $this->request->getPost('old-password');
                    $new = $this->request->getPost('new-password');
                    $query = $this->tbluser->where('password', sha1($old))->get();

                    if($query->resultID->num_rows > 0){
                        $query = $query->getRow();
                        $data = [
                            'password'  =>  sha1($new)
                        ];
                        $this->tbluser->set($data);
                        $this->tbluser->where('iduser', $query->iduser);
                        $this->tbluser->update();

                        session()->remove('administrator');
                        session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                            Anda berhasil merubah password, silahkan login lagi
                        </div>');
                        return redirect()->to(base_url('login-admin'));
                    }else{
                        $errors = ['old-password' => 'Password lama salah'];
                        session()->setFlashdata('pesan', $errors);
                        return redirect()->to(base_url('admin/user/ubah-password'));
                    }
                    
                }else{
                    $errors = $this->validator->getErrors();
                    session()->setFlashdata('pesan', $errors);
                    return redirect()->to(base_url('admin/user/ubah-password'));
                }
            }

        }

        public function ubahStatus($id = null, $aktif = null){
            if($aktif == 1){
                $status = 0;
                $pesan = 'User berhasil di non-aktifkan';
            }else{
                $status = 1;
                $pesan = 'User berhasil di aktifkan';
            }

            $this->tbluser->set('aktif', $status);
            $this->tbluser->where('iduser', $id);
            $this->tbluser->update();
            session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                '. $pesan .'
            </div>');
            return redirect()->to(base_url('admin/user'));

        }

        public function hapus($id = null, $status = null){
            if ($status == 0) {
                $this->tbluser->where('iduser', $id);
                $this->tbluser->delete();
                session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                    DATA BERHASIL DIHAPUS
                </div>');
                return redirect()->to(base_url('admin/user'));
            }else{
                session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                    GAGAL HAPUS, DIKARENAKAN USER MASIH AKTIF
                </div>');
                return redirect()->to(base_url('admin/user'));
            }
        }

    }

?>