<?php

class LimpahanSaldoModel
{


    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function upload($data)
    {

        $target_dir = "public/storage/limpahan_saldo/";
        $target_file = $target_dir . time() . basename($_FILES["file"]["name"]);

        $bulan = explode('-', $data['bulan'])[1];
        $tahun = explode('-', $data['bulan'])[0];
        $file = $target_file;

        $cekfile = "SELECT * FROM limpahan_saldo WHERE bulan = '$bulan' AND tahun = '$tahun'";
        $this->db->query($cekfile);
        $resultfile = $this->db->single();


        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            return "maaf file telah ada.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 5000000) {
            return "maaf file terlalu besar ( max 5bm ).";
            $uploadOk = 0;
        }

        // Allow certain file formats
        // if ($fileType != "xls" && $fileType != "xlsx") {
        //     return "maaf hanya bisa upload excel saja.";
        //     $uploadOk = 0;
        // }

        if ($uploadOk == 0) {
            return "Sorry, terjadi kesalahan.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO limpahan_saldo (bulan, tahun, file)
                VALUES ('$bulan', '$tahun', '$file')";
                $this->db->query($query);
                $this->db->execute();
                $this->db->rowCount();
                return " file " . basename($_FILES["file"]["name"]) . " berhasil di upload.";
            } else {
                return "Sorry, ada masalah.";
            }
        }
    }

    public function get()
    {
        $limpahan_saldo = "SELECT * FROM limpahan_saldo";
        $this->db->query($limpahan_saldo);
        return $this->db->resultSet();
    }

    public function delete($data)
    {
        $id = $data['delete'];

        $query = "DELETE FROM limpahan_saldo WHERE id = '$id' ";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
