<?php

class Lampiran extends Controller
{
    public function __construct()
    {
        LoginCheck::isLogin();
        RoleCheck::cekLevel(['akuntansi']);
    }

    public function index()
    {
        $data['judul'] = 'lampiran';
        $data['liClassActive'] = 'liLampiran';
        $data['notifikasi'] = $this->model('NotifikasiModel')->get();
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/lampiran/index', $data);
        $this->view('templates/footer', $data);
    }

    public function terima()
    {
        if ($this->model('NotifikasiModel')->terima($_POST) > 0) {
            Helpers::setAlert('data lampiran diterima');
            header('location: ' . BASEURL . '/lampiran');
            exit;
        } else {
            Helpers::setAlert('data lampiran sudah diterima');
            header('location: ' . BASEURL . '/lampiran');
        }
    }


    public function tolak($id = 0)
    {
        if (isset($_POST['btnTolak'])) {
            if ($this->model('NotifikasiModel')->tolak($_POST) > 0) {
                Helpers::setAlert('data lampiran ditolak');
                header('location: ' . BASEURL . '/lampiran');
                exit;
            } else {

                Helpers::setAlert('data lampiran sudah ditolak');
                header('location: ' . BASEURL . '/lampiran');
            }
        }
        $data['judul'] = 'lampiran';
        $data['liClassActive'] = 'liLampiran';
        $data['notifikasi'] = $this->model('NotifikasiModel')->show($id);
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/lampiran/tolak', $data);
        $this->view('templates/footer', $data);
    }


    public function reset()
    {
        if ($this->model('NotifikasiModel')->reset($_POST) > 0) {
            Helpers::setAlert('data lampiran direset');
            header('location: ' . BASEURL . '/lampiran');
            exit;
        } else {
            Helpers::setAlert('data lampiran sudah direset');
            header('location: ' . BASEURL . '/lampiran');
        }
    }

    public function download($files)
    {
        $file_name = $files; // replace with your file name
        $file_path = "public/storage/lampiran/" . $file_name; // replace with your file path

        if (file_exists($file_path)) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename=' . $file_name);
            header('Pragma: no-cache');
            readfile($file_path);
            header('location: ' . BASEURL . '/lampiran');
            exit;
        } else {
            header('location: ' . BASEURL . '/pages/pages404');
        }
    }
}
