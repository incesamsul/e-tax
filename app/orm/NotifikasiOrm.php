<?php

class NotifikasiOrm
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public static function pajak($id_pajak)
    {
        $instance = new self();
        $pajak = "SELECT * FROM pajak WHERE id = '$id_pajak'";
        $instance->db->query($pajak);
        return $instance->db->single();
    }

    public static function cabang($id_user)
    {
        $instance = new self();
        $pajak = "SELECT * FROM users WHERE id = '$id_user'";
        $instance->db->query($pajak);
        return $instance->db->single();
    }

    public static function hasOneLampiran($id_notifikasi)
    {
        $instance = new self();
        $lampiran = "SELECT * FROM lampiran WHERE id_notifikasi = '$id_notifikasi'";
        $instance->db->query($lampiran);
        return $instance->db->single();
    }
}
