<?php

class Auth extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION['login'])) {
            if($_SESSION['login']['role'] == "cabang" ){
                header('location: ' . BASEURL . '/cabang');
            } else {
                header('location: ' . BASEURL . '/dashboard');
            }   
        }
    }

    public function index()
    {
        if (isset($_POST['signIn'])) {
            if ($this->model('AuthModel')->prosesLogin($_POST) == true) {
                if($_SESSION['login']['role'] == "cabang" ){
                    header('location: ' . BASEURL . '/cabang');
                } else {
                    header('location: ' . BASEURL . '/dashboard');
                }
            } else {
                // echo "gagal";
            }
        }
        $this->view('auth/index');
    }

    public function logout()
    {
        session_destroy();
        header('location:' . BASEURL . '/auth');
    }
}
