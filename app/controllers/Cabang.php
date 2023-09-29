<?php

class Cabang extends Controller
{
    protected $notif = [];
    public function __construct()
    {
        LoginCheck::isLogin();
        RoleCheck::cekLevel(['cabang','group']);
        $this->notif = $this->model('NotifikasiModel')->getPerCabang($_SESSION['login']['id']);
    }

    public function index()
    {
        
        $data['judul'] = 'notifikasi';
        $data['liClassActive'] = 'liNotifikasi';
        $data['notifikasi'] = $this->notif;
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar');
        $this->view('pages/notifikasi/index', $data);
        $this->view('templates/footer', $data);
    }

    public function kirim($idNotifikasi)
    {
        $data['judul'] = 'kirim lampiran';
        $data['liClassActive'] = 'liNotifikasi';
        $data['notifikasi'] = $this->model('NotifikasiModel')->show($idNotifikasi);

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/notifikasi/kirim', $data);
        $this->view('templates/footer', $data);
    }

    public function kirim_lampiran()
    {
        $postLampiran = $this->model('NotifikasiModel')->kirimLampiran($_POST);
        Helpers::setAlert($postLampiran);
        header('location: ' . BASEURL . '/cabang');
        exit;
    }

    public function download_contoh_lampiran($files)
    {
        Helpers::download_contoh_lampiran($files);
    }
}
