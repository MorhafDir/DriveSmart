<?php

require_once 'Database.php';

class Databeheer
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getDb();
    }

    // USER FUNCTIONS
    public function registerUser($name, $address, $city, $email, $phone, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = $this->db->prepare("INSERT INTO users (name, address, city, email, phone, password) VALUES (:name, :address, :city, :email, :phone, :password)");
        $query->bindParam(':name', $name);
        $query->bindParam(':address', $address);
        $query->bindParam(':city', $city);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':password', $hashedPassword);
        $query->execute();
    }

    public function loginUser($email, $password)
    {
        $query = $this->db->prepare("SELECT password FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $user = $query->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchAllUserData($email)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $new_name, $new_address, $new_city, $new_email, $new_phone, $new_password, $new_disabilityDetails)
    {
        $parameters = [];
        $conditions = [];

        if ($new_name) {
            $conditions[] = "name = :new_name";
            $parameters[':new_name'] = $new_name;
        }
        if ($new_address) {
            $conditions[] = "address = :new_address";
            $parameters[':new_address'] = $new_address;
        }
        if ($new_city) {
            $conditions[] = "city = :new_city";
            $parameters[':new_city'] = $new_city;
        }
        if ($new_email) {
            $conditions[] = "email = :new_email";
            $parameters[':new_email'] = $new_email;
        }
        if ($new_phone) {
            $conditions[] = "phone = :new_phone";
            $parameters[':new_phone'] = $new_phone;
        }
        if ($new_password) {
            $conditions[] = "password = :new_password";
            $parameters[':new_password'] = password_hash($new_password, PASSWORD_DEFAULT);
        }
        if ($new_disabilityDetails) {
            $conditions[] = "disabilitydetails = :new_disabilityDetails";
            $parameters[':new_disabilityDetails'] = $new_disabilityDetails;
        }

        if (!empty($conditions)) {
            $sql = "UPDATE users SET " . implode(', ', $conditions) . " WHERE user_id = :user_id";
            $parameters[':user_id'] = $id;

            $stmt = $this->db->prepare($sql);
            foreach ($parameters as $key => &$value) {
                $stmt->bindParam($key, $value);
            }
            return $stmt->execute();
        }
        return false;
    }

    // CAR FUNCTIONS
    public function registerCar($model, $type)
    {
        $query = $this->db->prepare("INSERT INTO cars (model, type) VALUES (:model, :type)");
        $query->bindParam(':model', $model);
        $query->bindParam(':type', $type);
        $query->execute();
    }

    public function fetchCar($model, $type)
    {
        $query = $this->db->prepare("SELECT * FROM cars WHERE model = :model AND type = :type");
        $query->bindParam(':model', $model);
        $query->bindParam(':type', $type);
        $query->execute();
        return $query->rowCount() > 0;
    }

    // PACKAGE FUNCTIONS
    public function createPackage($name, $price, $description, $available)
    {
        $query = $this->db->prepare("INSERT INTO packages (name, price, description, available) VALUES (:name, :price, :description, :available)");
        $query->bindParam(':name', $name);
        $query->bindParam(':price', $price);
        $query->bindParam(':description', $description);
        $query->bindParam(':available', $available);
        $query->execute();

        $package_id = $this->db->lastInsertId();
        return $package_id;
    }

    public function pairLessonsToPackage($lesson_id, $package_id)
    {
        $query = $this->db->prepare("SELECT * FROM lessons WHERE package_id IS NULL");
        $query->execute();
        $lessons = $query->fetchAll();

        $query = $this->db->prepare("SELECT * FROM packages WHERE available = 1");
        $query->execute();
        $packages = $query->fetchAll();

        foreach ($lessons as $lesson) {
            $package = $packages[array_rand($packages)];
            $query = $this->db->prepare("UPDATE lessons SET package_id = :package_id WHERE lesson_id = :lesson_id");
            $query->bindParam(':package_id', $package['package_id']);
            $query->bindParam(':lesson_id', $lesson['lesson_id']);
            $query->execute();
        }
    }

    public function fetchAvailablePackages()
    {
        $query = $this->db->prepare("SELECT * FROM packages WHERE available = 1");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}