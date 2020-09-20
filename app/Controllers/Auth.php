<?php namespace App\Controllers;

    class Auth extends BaseController{

        public function __construct(){

        }

        public function viewLoginAdmin(){
            return view('auth/view-login-admin');
        }

    }

?>