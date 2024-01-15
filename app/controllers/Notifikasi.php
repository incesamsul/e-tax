<?php

class Notifikasi extends Controller
{
    public function __construct()
    {
        LoginCheck::isLogin();
        RoleCheck::cekLevel(['akuntansi']);
    }

    public function index($filter = null, $jenis = 0, $tglAwal = null, $tglAkhir = null)
    {


        if ($filter) {
            if ($jenis) {
                $data['notifikasi'] = $this->model('NotifikasiModel')->getPerJenis($jenis, $tglAwal, $tglAkhir);
            } else {
                $data['notifikasi'] = $this->model('NotifikasiModel')->getFiltered($filter, $tglAwal, $tglAkhir);
                $data['filtered'] = $filter;
            }
        } else {
            $data['notifikasi'] = $this->model('NotifikasiModel')->get();
            $data['filter'] = '';
        }


        $data['judul'] = 'notifikasi';
        $data['liClassActive'] = 'liNotifikasi';
        $data['script'] = $this->script('NotifikasiScript');
        $data['pajak'] = $this->model('PajakModel')->get();
        $data['url'] = BASEURL . '/notifikasi/' . $filter . '/' . $jenis;
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/notifikasi/index', $data);
        $this->view('templates/footer', $data);
    }

    public function create()
    {
        $data['judul'] = 'create notifikasi';
        $data['liClassActive'] = 'liNotifikasi';
        $data['pajak'] = $this->model('PajakModel')->get();
        $data['cabang'] = $this->model('PenggunaModel')->getUserByRole('cabang');
        $data['script'] = $this->script('CreateNotifikasiScript');
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/notifikasi/create', $data);
        $this->view('templates/footer', $data);
    }

    public function edit($id = 0)
    {
        $data['judul'] = 'edit notifikasi';
        $data['liClassActive'] = 'liNotifikasi';
        $data['id'] = $id;
        $data['edit'] = $this->model('NotifikasiModel')->show($id);
        $data['pajak'] = $this->model('PajakModel')->get();
        $data['cabang'] = $this->model('PenggunaModel')->getUserByRole('cabang');
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/notifikasi/create', $data);
        $this->view('templates/footer', $data);
    }

    public function delete()
    {
        if ($this->model('NotifikasiModel')->delete($_POST) > 0) {
            Helpers::setAlert('data notifikasi berhasil di hapus');
            header('location: ' . BASEURL . '/notifikasi');
            exit;
        } else {
            Helpers::setAlert('data tidak terhapus');
            header('location: ' . BASEURL . '/notifikasi');
        }
    }

    public function store()
    {
        if ($this->model('NotifikasiModel')->store($_POST) > 0) {
            Helpers::setAlert('data notifikasi berhasil di tambah');
            header('location: ' . BASEURL . '/notifikasi');
            exit;
        } else {
            Helpers::setAlert('data tidak tersimpan');
            header('location: ' . BASEURL . '/notifikasi');
        }
    }

    public function update()
    {
        if ($this->model('NotifikasiModel')->update($_POST) > 0) {
            Helpers::setAlert('data notifikasi berhasil di update');
            header('location: ' . BASEURL . '/notifikasi');
            exit;
        } else {
            Helpers::setAlert('data tidak terupdate');
            header('location: ' . BASEURL . '/notifikasi');
        }
    }

    public function email()
    {

        $email = $this->model('NotifikasiModel')->email($_POST);
        Helpers::setAlert($email);
        header('location: ' . BASEURL . '/notifikasi');
        exit;
    }

    public function emails()
    {
        $email = $this->model('NotifikasiModel')->emails($_POST);
        Helpers::setAlert($email);
        header('location: ' . BASEURL . '/notifikasi');
        exit;
    }
}
