<?php namespace App\Controllers\Admin;

    use App\Controllers\BaseController;

    class Dashboard extends BaseController{

        public function __construct(){

        }

        public function index(){
            $data = [
                'title'     =>  'ADMIN | DASHBOARD'
            ];
            return view('admin/view-dashboard', $data);
        }

    }

?>