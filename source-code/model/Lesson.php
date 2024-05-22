<?php


require_once 'Database.php';

class Lesson
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addLesson($date, $time, $userId, $carId, $startKilometers, $endKilometers, $packageId = null)
    {
        $sql = "INSERT INTO lessons (date, time, user_id, car_id, start_kilometer, end_kilometer, package_id) VALUES (:date, :time, :userId, :carId, :startKilometers, :endKilometers, :packageId)";
        $stmt = $this->db->getDb()->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':carId', $carId);
        $stmt->bindParam(':startKilometers', $startKilometers);
        $stmt->bindParam(':endKilometers', $endKilometers);
        $stmt->bindParam(':packageId', $packageId);
        $stmt->execute();
    }


    public function deleteLesson($lessonId)
    {
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

    public function getLessonById($lessonId)
    {
        try {
            $sql = "SELECT * FROM lessons WHERE lesson_id = :lessonId";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':lessonId', $lessonId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen van les: " . $e->getMessage();
            return null;
        }
    }





    public function getAllLessons()
    {
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

    public function getAllStudents()
    {
        try {
            $sql = "SELECT * FROM users WHERE role = 'Student'";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen van studenten: " . $e->getMessage();
            return [];
        }
    }

    public function getAllCars()
    {
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

    public function fetchAvailableLessons()
    {
        $query = $this->db->getDb()->prepare("SELECT * FROM lessons WHERE package_id IS NULL");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateLessonDetails($lessonId, $date, $time, $userId, $carId)
    {
        try {
            if (!$this->isCarIdValid($carId)) {
                throw new Exception("Ongeldige car_id: $carId");
            }

            $sql = "UPDATE lessons SET date = :date, time = :time, user_id = :userId, car_id = :carId WHERE lesson_id = :lessonId";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':lessonId', $lessonId);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':carId', $carId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout bij bijwerken van les in de database: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Fout bij bijwerken van les: " . $e->getMessage();
            return false;
        }
    }


    public function updateLesson($lessonId, $date, $time)
    {
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


    public function isCarIdValid($carId)
    {
        $sql = "SELECT COUNT(*) AS count FROM cars WHERE car_id = :carId";
        $stmt = $this->db->getDb()->prepare($sql);
        $stmt->bindParam(':carId', $carId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }



    public function getInstructorLessons()
    {
        try {
            $sql = "SELECT * FROM lessons INNER JOIN users ON lessons.user_id = users.user_id WHERE users.role = 'Instructor'";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen van lessen voor instructeurs: " . $e->getMessage();
            return [];
        }
    }




    public function getLessonsByDate($date) {
        try {
            $sql = "SELECT lessons.lesson_id, lessons.date, lessons.time, users.name AS student_name, lessons.topic
                    FROM lessons
                    INNER JOIN users ON lessons.user_id = users.user_id
                    WHERE lessons.date = :date";
            $stmt = $this->db->getDb()->prepare($sql);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen van lessen voor de datum $date: " . $e->getMessage();
            return [];
        }
    }
    




}
?>