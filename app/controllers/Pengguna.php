<?php

class Pengguna extends Controller
{
    public function __construct()
    {
        LoginCheck::isLogin();
        RoleCheck::cekLevel(['admin']);
    }

    public function index()
    {

        $data['judul'] = 'pengguna';
        $data['liClassActive'] = 'liPengguna';
        $data['pengguna'] = $this->model('PenggunaModel')->get();
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pengguna/index', $data);
        $this->view('templates/footer', $data);
    }

    public function create()
    {
        $data['judul'] = 'create pengguna';
        $data['liClassActive'] = 'liPengguna';
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pengguna/create');
        $this->view('templates/footer', $data);
    }

    public function edit($id = 0)
    {
        $data['judul'] = 'edit pengguna';
        $data['liClassActive'] = 'liPengguna';
        $data['id'] = $id;
        $data['edit'] = $this->model('PenggunaModel')->show($id);
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/pengguna/create', $data);
        $this->view('templates/footer', $data);
    }

    public function delete()
    {
        if ($this->model('PenggunaModel')->delete($_POST) > 0) {
            Helpers::setAlert('data pengguna berhasil dihapus');
            header('location: ' . BASEURL . '/pengguna');
            exit;
        } else {
            Helpers::setAlert('data tidak terhapus');
            header('location: ' . BASEURL . '/pengguna');
        }
    }

    public function store()
    {
        if ($this->model('PenggunaModel')->store($_POST) > 0) {
            Helpers::setAlert('data pengguna berhasil ditambah');
            header('location: ' . BASEURL . '/pengguna');
            exit;
        } else {
            Helpers::setAlert('data tidak tersimpan');
            header('location: ' . BASEURL . '/pengguna');
        }
    }

    public function update()
    {
        if ($this->model('PenggunaModel')->update($_POST) > 0) {
            Helpers::setAlert('data pengguna berhasil di update');
            header('location: ' . BASEURL . '/pengguna');
            exit;
        } else {
            Helpers::setAlert('data tidak terupdate');
            header('location: ' . BASEURL . '/pengguna');
        }
    }
}
