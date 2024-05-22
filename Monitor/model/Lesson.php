<?php

require_once __DIR__ . '/./Database.php';

class Lesson {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addLesson($date, $time, $userName, $carName, $startKilometers, $endKilometers) {
        try {
            $sql = "INSERT INTO lessons (date, time, user_name, car_name, startKilometers, endKilometers) VALUES (:date, :time, :userName, :carName, :startKilometers, :endKilometers)";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':userName', $userName);
            $stmt->bindParam(':carName', $carName);
            $stmt->bindParam(':startKilometers', $startKilometers);
            $stmt->bindParam(':endKilometers', $endKilometers);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout bij toevoegen van les aan de database: " . $e->getMessage();
            // Meer gedetailleerde foutinformatie van de database
            print_r($stmt->errorInfo());
            return false;
        }
        
    }

    public function updateLesson($lessonId, $date, $time) {
        try {
            $sql = "UPDATE lessons SET date = :date, time = :time WHERE lesson_id = :lessonId";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':lessonId', $lessonId);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout bij bijwerken van les in de database: " . $e->getMessage();
            return false;
        }
    }
    
    

    public function deleteLesson($lessonId) {
        try {
            $sql = "DELETE FROM lessons WHERE lesson_id = :lessonId"; // Verander 'id' naar 'lesson_id'
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':lessonId', $lessonId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout bij verwijderen van les uit de database: " . $e->getMessage();
            return false;
        }
    }
    

    public function getAllLessons() {
        try {
            $sql = "SELECT * FROM lessons";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen van lessen: " . $e->getMessage();
            return [];
        }
    }

    public function getAllStudents() {
        try {
            $sql = "SELECT * FROM users WHERE role = 'student'";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen van studenten: " . $e->getMessage();
            return [];
        }
    }

    public function getAllCars() {
        try {
            $sql = "SELECT * FROM cars";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen van auto's: " . $e->getMessage();
            return [];
        }
    }
}
?>
