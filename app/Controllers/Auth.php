<?php namespace App\Controllers;

    class Auth extends BaseController{

        protected $db;
        protected $tbluser;
        protected $tblpelanggan;

        public function __construct(){
            $this->db = \Config\Database::connect();
            $this->tbluser = $this->db->table('tbluser');
            $this->tblpelanggan = $this->db->table('tblpelanggan');
        }

        public function viewLoginAdmin(){
            return view('auth/view-login-admin');
        }

        public function viewRegistrasiPelanggan(){
            return view('auth/view-registrasi-pelanggan');
        }

        public function viewLoginPelanggan(){
            return view('auth/view-login-pelanggan');
        }

        public function login(){
            if(isset($_POST['login-admin'])){
                $rules = [
                    'email' => [ 'rules' => 'required' ],
                    'password'  =>  ['rules' => 'required']
                ];
                if ($this->validate($rules)) {
                    $username = $this->request->getPost('email');
                    $password = $this->request->getPost('password');
                    $query = $this->tbluser->where('email', $username)->where('password', sha1($password))->limit(1)->get();
                    if($query->resultID->num_rows > 0){
                        $query = $query->getRow();
                        if($query->aktif == 1){
                            $this->setAdmin($query);
                            return redirect()->to(base_url('admin'));
                        }else{
                            session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                                User tidak aktif, silahkan hubungi administrator
                            </div>');
                            return redirect()->to(base_url('login-admin'));
                        }
                    }else{
                        session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                            User tidak ditemukan
                        </div>');
                        return redirect()->to(base_url('login-admin'));
                    }
                }else{
                    session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                        Ada Kolom yang kosong, tolong di isi
                    </div>');
                    return redirect()->to(base_url('login-admin'));
                }
            }else if(isset($_POST['login-pelanggan'])){
                $rules = [
                    'email' => [ 'rules' => 'required' ],
                    'password'  =>  ['rules' => 'required']
                ];
                if ($this->validate($rules)) {
                    $email = $this->request->getPost('email');
                    $password = $this->request->getPost('password');
                    $query = $this->tblpelanggan->where('email', $email)->where('password', sha1($password))->limit()->get();
                    if($query->resultID->num_rows > 0){
                        $query = $query->getRow();
                        if ($query->aktif == 1) {
                            $this->setPelanggan($query);
                            return redirect()->to(base_url());  
                        }else{
                            session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                                Pelanggan tidak aktif
                            </div>');
                            return redirect()->to(base_url('login-pelanggan'));  
                        }
                    }else{
                        session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                            Pelanggan tidak ditemukan
                        </div>');
                        return redirect()->to(base_url('login-pelanggan'));  
                    }
                }else{
                    session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                        Ada kesalahan saat pengisian form
                    </div>');
                    return redirect()->to(base_url('login-pelanggan'));
                }
            }
        }

        public function registerPelanggan(){
            $rules = [
                'pelanggan'     =>  [
                    'rules'     =>  'required|min_length[3]',
                    'errors'    =>  [
                        'required'      =>  'Nama lengkap harus di isi',
                        'min_length'    =>  'Nama minimal 3'
                    ],
                ],
                'alamat'        =>  [
                    'rules'     =>  'required',
                    'errors'    =>  [ 'required'    =>  'Alamat harus di isi' ]
                ],
                'email'         =>  [
                    'rules'     =>  'required|is_unique[tblpelanggan.email]',
                    'errors'    =>  [ 'required'    =>  'Email harus di isi', 'is_unique'   =>  'Email sudah terdaftar silahkan coba lain' ]
                ],
                'telp'          =>  [
                    'rules'     =>  'required',
                    'errors'    =>  [ 'required'    =>  'Nomor telepon harus di isi' ]
                ],
                'password'      =>  [
                    'rules'     =>  'required',
                    'errors'    =>  [ 'required'    =>  'Password harus di isi' ]
                ],
            ];

            if($this->validate($rules)){
                $pelanggan = $this->request->getPost('pelanggan');
                $alamat = $this->request->getPost('alamat');
                $telp = $this->request->getPost('telp');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $data = [
                    'pelanggan'     =>  $pelanggan,
                    'alamat'        =>  $alamat,
                    'telp'         =>  $telp,
                    'email'         =>  $email,
                    'password'      =>  sha1($password),
                    'aktif'         =>  1
                ];

                $this->tblpelanggan->insert($data);
                session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                    Pendaftaran berhasil, silahkan login untuk memesan
                </div>');
                return redirect()->to(base_url('registrasi'));

            }else{
                $errors = $this->validator->getErrors();
                foreach($errors as $key => $value){
                    session()->setFlashdata('pesan', '<div class="alert alert-danger my-2" role="alert">
                        '.$value.'
                    </div>');
                }
                return redirect()->to(base_url('registrasi'));
            }
        }

        public function setAdmin($isi){
            $data = [
                'iduser'        =>  $isi->iduser,
                'username'      =>  $isi->user,
                'level'         =>  $isi->level,
                'isLoggedIn'    =>  TRUE
            ];
            session()->set('administrator', $data);
        }

        public function setPelanggan($isi){
            $data = [
                'idpelanggan'   =>  $isi->idpelanggan,
                'pelanggan'     =>  $isi->pelanggan,
                'alamat'        =>  $isi->alamat,
                'telp'          =>  $isi->telp,
                'isLoggedIn'    =>  TRUE
            ];
            session()->set('pelanggan', $data);
        }

        public function adminLogout(){
            session()->remove('administrator');
            session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                Anda telah logout
            </div>');
            return redirect()->to(base_url('login-admin'));
        }

        public function pelangganLogout(){
            session()->remove('pelanggan');
            session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                Anda telah logout
            </div>');
            return redirect()->to(base_url('login-pelanggan'));
        }

    }

?>