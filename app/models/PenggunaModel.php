<?php

class PenggunaModel
{


    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function store($data)
    {
        $nama = $data['nama'];
        $email = $data['email'];
        $nrik = $data['nrik'];
        $no_hp = $data['no_hp'];
        $role = $data['role'];
        $date_created = time();
        $password = password_hash($nrik, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (nama,email,nrik, no_hp, role, password, foto, date_created, soft_delete)
        VALUES ('$nama', '$email', '$nrik', '$no_hp','$role', '$password', '', '$date_created', '0')";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($data)
    {
        $nama = $data['nama'];
        $nrik = $data['nrik'];
        $email = $data['email'];
        $no_hp = $data['no_hp'];
        $role = $data['role'];
        $id = $data['id'];
        $password = password_hash($nrik, PASSWORD_DEFAULT);
        $query = "UPDATE users
        SET nama = '$nama',
            email = '$email',
            nrik = '$nrik',
            no_hp = '$no_hp',
            role = '$role',
            password = '$password'
        WHERE id = '$id'";

        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($data)
    {
        $id = $data['delete'];
        $query = "DELETE FROM users WHERE id = '$id' ";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function get()
    {
        $users = "SELECT * FROM users";
        $this->db->query($users);
        return $this->db->resultSet();
    }

    public function show($id)
    {
        $users = "SELECT * FROM users WHERE id = '$id'";
        $this->db->query($users);
        return $this->db->single();
    }

    public function getUserByRole($role)
    {
        $users = "SELECT * FROM users WHERE role = '$role'";
        $this->db->query($users);
        return $this->db->resultSet();
    }

    public function getUserByRolePerMonth($role,$bulan)
    {
        $users = "SELECT *
        FROM users
        LEFT JOIN notifikasi ON users.id = notifikasi.id_user
        WHERE   notifikasi.bulan = '$bulan'";
        $this->db->query($users);
        return $this->db->resultSet();
    }

    public function getUserBelumKumpul($bulan, $jenisPajak)
    {
        $users = "SELECT * from  notifikasi JOIN users on notifikasi.id_user = users.id
        left join lampiran on notifikasi.id = lampiran.id_notifikasi
         join pajak on notifikasi.id_pajak = pajak.id
        WHERE   notifikasi.bulan = '$bulan' and lampiran.id is null
        and nama_pajak = '$jenisPajak'";
        $this->db->query($users);
        return $this->db->resultSet();
    }

    public function getUserSudahKumpul($bulan, $jenisPajak)
    {
        $users = "SELECT *
        FROM lampiran JOIN notifikasi ON lampiran.id_notifikasi = notifikasi.id join users on notifikasi.id_user = users.id 
        join pajak on notifikasi.id_pajak = pajak.id WHERE notifikasi.bulan = '$bulan' and nama_pajak = '$jenisPajak'";
        $this->db->query($users);
        return $this->db->resultSet();
    }

    public function getReport($bulan, $jenisPajak)
    {
        $users = "SELECT users.*, 
        CASE WHEN notifikasi.id_user IS NOT NULL THEN 1 ELSE 0 END AS status
        FROM users
        LEFT JOIN notifikasi ON users.id = notifikasi.id_user
        JOIN pajak ON notifikasi.id_pajak = pajak.id
        WHERE users.role = 'cabang' 
        AND notifikasi.bulan = '$bulan' 
        AND pajak.nama_pajak = '$jenisPajak'";
        $this->db->query($users);
        return $this->db->resultSet();
    }
}
