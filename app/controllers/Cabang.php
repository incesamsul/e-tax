<?php

class Cabang extends Controller
{
    protected $notif = [];
    public function __construct()
    {
        LoginCheck::isLogin();
        RoleCheck::cekLevel(['cabang', 'group', 'akuntansi']);
        $this->notif = $this->model('NotifikasiModel')->getPerCabang($_SESSION['login']['id']);
    }

    public function index()
    {

        $data['judul'] = 'notifikasi';
        $data['liClassActive'] = 'liNotifikasi';
        $data['notifikasi'] = $this->notif;
        $data['pajak'] = $this->model('PajakModel')->get();
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar');
        $this->view('pages/notifikasi/index', $data);
        $this->view('templates/footer', $data);
    }

    public function list()
    {

        $data['judul'] = 'pengguna';
        $data['liClassActive'] = 'liPengguna';
        $data['pengguna'] = $this->model('PenggunaModel')->getUserByRole('cabang');
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pengguna/index', $data);
        $this->view('templates/footer', $data);
    }

    public function belum_kumpul()
    {

        $data['judul'] = 'pengguna';
        $data['liClassActive'] = 'liPengguna';
        $data['pengguna'] = $this->model('PenggunaModel')->getUserBelumKumpul();
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pengguna/belum_kumpul', $data);
        $this->view('templates/footer', $data);
    }


    public function sudah_kumpul()
    {

        $data['judul'] = 'pengguna';
        $data['liClassActive'] = 'liPengguna';
        $data['pengguna'] = $this->model('PenggunaModel')->getUserSudahKumpul();
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pengguna/sudah_kumpul', $data);
        $this->view('templates/footer', $data);
    }


    public function report()
    {

        $data['judul'] = 'pengguna';
        $data['liClassActive'] = 'liPengguna';
        $data['pengguna'] = $this->model('PenggunaModel')->getReport();
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pengguna/report', $data);
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
