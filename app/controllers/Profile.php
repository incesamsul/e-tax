<?php

class Profile extends Controller
{
    protected $notif;
    public function __construct()
    {
        LoginCheck::isLogin();
        $this->notif = $this->model('NotifikasiModel')->getPerCabang($_SESSION['login']['id']);
    }

    public function index()
    {

        $data['judul'] = 'profile';
        $data['liClassActive'] = 'liProfile';
        $data['notifikasi'] = $this->notif;
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('templates/sidebar');
        $this->view('pages/profile/index');
        $this->view('templates/footer', $data);
    }

    public function update()
    {
        if ($this->model('ProfileModel')->update($_POST) > 0) {
            $_SESSION['login'] = [
                'id' => $_SESSION['login']['id'],
                'nama' => $_POST['nama'],
                'nrik' => $_POST['nrik'],
                'no_hp' => $_POST['no_hp'],
                'role' => $_SESSION['login']['role'],
                'foto' => $_SESSION['login']['foto'],
                'timestamp' => time()
            ];
            Helpers::setAlert('data profil berhasil diubah');
            header('location: ' . BASEURL . '/profile');
            exit;
        } else {
            Helpers::setAlert('data profil tidak berubah');
            header('location: ' . BASEURL . '/profile');
        }
    }

    public function update_password()
    {
        if ($this->model('ProfileModel')->updatePassword($_POST) > 0) {
            Helpers::setAlert('password berhasil diubah');
            header('location: ' . BASEURL . '/profile');
            exit;
        } else {
            Helpers::setAlert('passwrod tidak berubah');
            header('location: ' . BASEURL . '/profile');
        }
    }
}
