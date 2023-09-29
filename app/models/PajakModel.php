<?php

class PajakModel
{


    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function store($data)
    {
        $target_dir = "public/storage/contoh_lampiran/";
        $target_file = $target_dir . $data['nama_pajak'] . '.xlsx';

        $nama_pajak = $data['nama_pajak'];


        $cekPajak = "SELECT * FROM pajak WHERE nama_pajak = '$nama_pajak'";
        $this->db->query($cekPajak);
        $resultPajak = $this->db->single();


        if (!$resultPajak) {

            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file already exists
            if (file_exists($target_file)) {
                return "maaf file telah ada.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["sample"]["size"] > 5000000) {
                return "maaf file terlalu besar (max 5 mb)";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($fileType != "xls" && $fileType != "xlsx") {
                return "Hanya dapat unggah file dengan format Excel.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                return "Maaf, terjadi kesalahan.";
            } else {
                $nama_pajak = $data['nama_pajak'];
                $lampiran = $data['lampiran'];
                if (move_uploaded_file($_FILES["sample"]["tmp_name"], $target_file)) {
                    $query = "INSERT INTO pajak (nama_pajak, lampiran, sample)
                    VALUES ('$nama_pajak', '$lampiran', '$target_file')";
                    $this->db->query($query);
                    $this->db->execute();
                    $this->db->rowCount();
                    return " file " . basename($_FILES["sample"]["name"]) . " berhasil di upload.";
                } else {
                    return "Maaf, terdapat masalah.";
                }
            }
        } else {
            return 'Sudah ada file pajak dengan nama ini';
        }
    }

    public function update($data)
    {

        $target_dir = "public/storage/contoh_lampiran/";
        $target_file = $target_dir . $data['nama_pajak'] . '.xlsx';

        if ($_FILES['sample']['size'] == 0) {
            $nama_pajak = $data['nama_pajak'];
            $lampiran = $data['lampiran'];
            $sample = $target_file;
            $id = $data['id'];
            $query = "UPDATE pajak
            SET nama_pajak = '$nama_pajak',
                lampiran = '$lampiran',
                sample = '$sample'
            WHERE id = '$id'";

            $this->db->query($query);
            $this->db->execute();
            if ($this->db->rowCount() > 0) {
                return 'file berhasil di-update';
            } else {
                return 'tidak ada yang berubah';
            }
        } else {
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check file size
            if ($_FILES["sample"]["size"] > 5000000) {
                return "Maaf file terlalu besar (max 5 mb)";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($fileType != "xls" && $fileType != "xlsx") {
                return "Hanya dapat unggah file dengan format Excel.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                return "Maaf, terjadi kesalahan.";
            } else {
                $nama_pajak = $data['nama_pajak'];
                $lampiran = $data['lampiran'];
                $id = $data['id'];
                if (move_uploaded_file($_FILES["sample"]["tmp_name"], $target_file)) {

                    $query = "UPDATE pajak
                    SET nama_pajak = '$nama_pajak',
                        lampiran = '$lampiran',
                        sample = '$target_file'
                    WHERE id = '$id'";

                    $this->db->query($query);
                    $this->db->execute();

                    return " file " . basename($_FILES["sample"]["name"]) . " berhasil diunggah.";
                } else {
                    return "Maaf, ada masalah.";
                }
            }
        }
    }

    public function delete($data)
    {
        $id = $data['delete'];
        $query = "DELETE FROM pajak WHERE id = '$id' ";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function get()
    {
        $pajak = "SELECT * FROM pajak";
        $this->db->query($pajak);
        return $this->db->resultSet();
    }

    public function show($id)
    {
        $pajak = "SELECT * FROM pajak WHERE id = '$id'";
        $this->db->query($pajak);
        return $this->db->single();
    }
}
