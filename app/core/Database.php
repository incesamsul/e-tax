<?php

class Database
{
    private $DB_NAME = DB_NAME;
    private $DB_HOST = DB_HOST;
    private $DB_USER = DB_USER;

    private $dbh;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function bind($param, $value, $tipe = null)
    {
        if (is_null($tipe)) {
            switch (true) {
                case is_int($value):
                    $tipe = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $tipe = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $tipe = PDO::PARAM_NULL;
                    break;
                default:
                    $tipe = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $tipe);
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
