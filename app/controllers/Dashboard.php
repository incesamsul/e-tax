<?php

class Dashboard extends Controller
{

    public function __construct()
    {
        LoginCheck::isLogin();
    }

    public function index()
    {
        $url = $_GET['url'];
        $bulan = isset(explode('/', $url)[1]) ? explode('/', $url)[1] : null;
        $jenisPajak = isset(explode('/', $url)[2]) ? explode('/', $url)[2] : null;


        $data['judul'] = 'dashboard';
        $data['liClassActive'] = 'liDashboard';
        $data['script'] = $this->script('DashboardScript');
        if ($_SESSION['login']['role'] == 'akuntansi') {
            $data['notifikasi'] = $this->model('NotifikasiModel')->getByMonth($bulan);
        } else {
            $data['notifikasi'] = $this->model('NotifikasiModel')->getPerCabang($_SESSION['login']['id']);
        }
        $verified = 0;
        $declined = 0;
        $pending = 0;
        foreach ($data['notifikasi'] as $value) {
            if ($value['verifikasi'] == '2') {
                $declined++;
            } else if ($value['verifikasi'] == '1') {
                $verified++;
            } else {
                $pending++;
            }
        }

        $data['verified'] = $verified;
        $data['declined'] = $declined;
        $data['pending'] = $this->model('LampiranModel')->getPending($bulan, $jenisPajak);
        $data['cabang'] = $this->model('NotifikasiModel')->getCabang($bulan);
        $data['lampiran'] = $this->model('PenggunaModel')->getReport($bulan, $jenisPajak);
        $data['pajak'] = $this->model('PajakModel')->get();
        $data['bulan'] = $bulan;
        $data['jenisPajak'] = $jenisPajak;
        // $data['belum_kumpul'] = $this->model('PenggunaModel')->getUserBelumKumpul($bulan, $jenisPajak);
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar');
        $this->view('pages/dashboard/index', $data);
        $this->view('templates/footer', $data);
    }
}
