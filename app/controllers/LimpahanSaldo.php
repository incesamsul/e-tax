<?php

class LimpahanSaldo extends Controller
{
    public function __construct()
    {
        LoginCheck::isLogin();
        // RoleCheck::cekLevel(['akuntansi']);
    }

    public function index()
    {
        $data['judul'] = 'Limpahan saldo';
        $data['liClassActive'] = 'liLimpahanSaldo';
        $data['limpahan_saldo'] = $this->model('LimpahanSaldoModel')->get();
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('pages/limpahan_saldo/index', $data);
        $this->view('templates/footer', $data);
    }

    public function upload()
    {
        $limpahanSaldo = $this->model('LimpahanSaldoModel')->upload($_POST);
        Helpers::setAlert($limpahanSaldo);
        header('location: ' . BASEURL . '/limpahansaldo');
        exit;
    }

    public function delete()
    {
        if ($this->model('LimpahanSaldoModel')->delete($_POST) > 0) {
            Helpers::setAlert('data  berhasil di hapus');
            header('location: ' . BASEURL . '/limpahansaldo');
            exit;
        } else {
            Helpers::setAlert('data tidak terhapus');
            header('location: ' . BASEURL . '/limpahansaldo');
        }
    }
}
