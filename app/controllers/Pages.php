<?php

class Pages extends Controller
{

    public function __construct()
    {
        LoginCheck::isLogin();
    }

    public function index() // this is the pages 404 as the default method
    {
        $data['judul'] = 'Not found';
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pages404/index');
        $this->view('templates/footer');
    }

    public function pages403()
    {
        $data['judul'] = 'forrbidde pages';
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pages403/index');
        $this->view('templates/footer');
    }
}
