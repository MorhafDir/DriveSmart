<?php

class Database
{
    private $host = "localhost";
    private $dbname = "drivesmart_db";

    private $user = "root";

    private $pass = "";

    public $db;

    // dit is de constructor waar de verbinding met de db wordt gemaakt
    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Als je dit ziet, good job"; // weg commenten als je wil zien of de verbinding werkt
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    // deze functie wordt in de controller aangeroepen om de db connectie te krijgen
    public function getDb()
    {
        return $this->db;
    }

}
