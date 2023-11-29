<?php

class LampiranModel
{


    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getData()
    {
        $lampiran = "SELECT * FROM lampiran JOIN notifikasi on lampiran.id_notifikasi = notifikasi.id";
        $this->db->query($lampiran);
        return $this->db->resultSet();
    }

    public function getPending($bulan, $jenisPajak)
    {
        $lampiran = "SELECT * FROM notifikasi join lampiran on notifikasi.id = lampiran.id_notifikasi JOIN pajak on notifikasi.id_pajak = pajak.id WHERE verifikasi = '0' and bulan = '$bulan' and nama_pajak = '$jenisPajak'";
        $this->db->query($lampiran);
        return $this->db->resultSet();
    }
    
    public function getDataByMonth($bulan, $jenisPajak)
    {
        $lampiran = "SELECT * FROM lampiran JOIN notifikasi on lampiran.id_notifikasi = notifikasi.id JOIN pajak on notifikasi.id_pajak = pajak.id WHERE notifikasi.bulan = '$bulan' and nama_pajak = '$jenisPajak'";
        $this->db->query($lampiran);
        return $this->db->resultSet();
    }
}
