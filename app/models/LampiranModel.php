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
        $lampiran = "SELECT * FROM lampiran";
        $this->db->query($lampiran);
        return $this->db->resultSet();
    }
    public function getDataByMonth($bulan)
    {
        $lampiran = "SELECT * FROM lampiran JOIN notifikasi on lampiran.id_notifikasi = notifikasi.id WHERE notifikasi.bulan = '$bulan'";
        $this->db->query($lampiran);
        return $this->db->resultSet();
    }
}
