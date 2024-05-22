<?php

class Database
{
    private $host = "localhost";
    private $dbname = "drivesmart_db";

    private $user = "root";

    private $pass = "";

    public $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function getDb()
    {
        return $this->db;
    }


}
