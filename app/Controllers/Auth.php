<?php namespace App\Controllers;

    class Auth extends BaseController{

        protected $db;
        protected $tbluser;

        public function __construct(){
            $this->db = \Config\Database::connect();
            $this->tbluser = $this->db->table('tbluser');
        }

        public function viewLoginAdmin(){
            return view('auth/view-login-admin');
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

        public function adminLogout(){
            session()->remove('administrator');
            session()->setFlashdata('pesan', '<div class="alert alert-success my-2" role="alert">
                Anda telah logout
            </div>');
            return redirect()->to(base_url('login-admin'));
        }

    }

?>