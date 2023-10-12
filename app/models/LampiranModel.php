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
}
