<?php

require_once 'Database.php';

class SicknessReport {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addSicknessReport($userId, $reason) {
        try {
            $sql = "INSERT INTO sickness_reports (user_id, reason) VALUES (:user_id, :reason)";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':reason', $reason);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout bij het indienen van het ziekterapport: " . $e->getMessage();
            return false;
        }
    }


    public function cancelSicknessReport($sicknessReportId) {
        try {
            $sql = "DELETE FROM sickness_reports WHERE id = :sicknessReportId";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':sicknessReportId', $sicknessReportId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout bij het annuleren van de ziekmelding: " . $e->getMessage();
            return false;
        }
    }

    public function getAllSicknessReports() {
        try {
            $sql = "SELECT * FROM sickness_reports";
            $stmt = $this->db->getDb()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij het ophalen van ziekmeldingen: " . $e->getMessage();
            return false;
        }
    }
    
}

?>
