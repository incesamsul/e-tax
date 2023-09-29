<?php

class Bantuan extends Controller
{
    protected $notif;
    public function __construct()
    {
        LoginCheck::isLogin();
        $this->notif = $this->model('NotifikasiModel')->getPerCabang($_SESSION['login']['id']);
    }

    public function index()
    {
        $data['judul'] = 'bantuan';
        $data['liClassActive'] = 'liBantuan';
        $data['notifikasi'] = $this->notif;
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar');
        $this->view('pages/bantuan/index');
        $this->view('templates/footer', $data);
    }
}
