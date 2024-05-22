<?php
require_once 'Database.php';

class Mededeling {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addMededeling($titel, $bericht, $ontvangerType, $datum) {
        $sql = "INSERT INTO mededelingen (titel, bericht, ontvanger_type, datum) VALUES (:titel, :bericht, :ontvangerType, :datum)";
        $stmt = $this->db->getDb()->prepare($sql);
        $stmt->bindParam(':titel', $titel);
        $stmt->bindParam(':bericht', $bericht);
        $stmt->bindParam(':ontvangerType', $ontvangerType);
        $stmt->bindParam(':datum', $datum);
        $stmt->execute();
    }

    public function getMededelingen() {
        $sql = "SELECT * FROM mededelingen";
        $stmt = $this->db->getDb()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>