<?php

class Pajak extends Controller
{
    public function __construct()
    {
        LoginCheck::isLogin();
        RoleCheck::cekLevel(['akuntansi']);
    }

    public function index()
    {

        $data['judul'] = 'Pajak';
        $data['liClassActive'] = 'liPajak';
        $data['pajak'] = $this->model('PajakModel')->get();
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pajak/index', $data);
        $this->view('templates/footer', $data);
    }

    public function create()
    {
        $data['judul'] = 'create Pajak';
        $data['liClassActive'] = 'liPajak';
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pajak/create');
        $this->view('templates/footer', $data);
    }

    public function edit($id = 0)
    {
        $data['judul'] = 'edit Pajak';
        $data['liClassActive'] = 'liPajak';
        $data['id'] = $id;
        $data['edit'] = $this->model('PajakModel')->show($id);
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pajak/create', $data);
        $this->view('templates/footer', $data);
    }

    public function delete()
    {
        if ($this->model('PajakModel')->delete($_POST) > 0) {
            Helpers::setAlert('data Pajak berhasil di hapus');
            header('location: ' . BASEURL . '/Pajak');
            exit;
        } else {
            Helpers::setAlert('data tidak terhapus');
            header('location: ' . BASEURL . '/Pajak');
        }
    }

    public function store()
    {
        $postLampiran = $this->model('PajakModel')->store($_POST);
        Helpers::setAlert($postLampiran);
        header('location: ' . BASEURL . '/pajak');
        exit;
    }

    public function update()
    {
        $postLampiran = $this->model('PajakModel')->update($_POST);
        Helpers::setAlert($postLampiran);
        header('location: ' . BASEURL . '/pajak');
        exit;
    }

    public function download_contoh_lampiran($files = null)
    {
        Helpers::download_contoh_lampiran($files);
    }
}
