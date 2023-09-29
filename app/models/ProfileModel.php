<?php

class ProfileModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function update($data)
    {
        $nama = $data['nama'];
        $nrik = $data['nrik'];
        $no_hp = $data['no_hp'];
        $id = $_SESSION['login']['id'];
        $query = "UPDATE users SET nama = '$nama', nrik ='$nrik', no_hp = '$no_hp'  WHERE id = '$id' ";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePassword($data)
    {
        $id = $_SESSION['login']['id'];
        $password_lama = $data['password_lama'];
        $password_baru = $data['password_baru'];
        $konfirmasi_password_baru = $data['konfirmasi_password_baru'];

        $users = "SELECT * FROM users WHERE id = '$id'";
        $this->db->query($users);
        $usersResult = $this->db->single();

        if (password_verify($password_lama, $usersResult['password'])) {


            if ($password_baru == $konfirmasi_password_baru) {
                $hashPasswordBaru = password_hash($password_baru, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password = '$hashPasswordBaru'  WHERE id = '$id' ";
                $this->db->query($query);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                echo "pass tdk sama";
            }
            die;
        } else {
            echo "false";
        }
    }
}
