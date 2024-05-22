<?php
require_once '../model/Database.php';

$database = new Database();
$db = $database->getDb();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    try {
        $stmt = $db->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (:name, :email, :phone, :message)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':message', $message);

        $stmt->execute();

        $to = $email;
        $subject = "Bevestiging van ontvangst";
        $message = "Beste " . $name . ",<br><br>Bedankt voor je bericht. We hebben het ontvangen en zullen zo spoedig mogelijk contact met je opnemen.<br><br>Met vriendelijke groet,<br>Autorijschool DriveSmart";
        $headers = "From: Autorijschool DriveSmart <schoolopdrachtgroep3@gmail.com>\r\n";
        $headers .= "Reply-To: schoolopdrachtgroep3@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "<script>alert('Je bericht verzonden!'); window.location.href='../view/ContactView.php';</script>";
            exit();
        } else {
            echo "<script>alert('Er is een fout opgetreden bij het verzenden van de e-mail.'); window.location.href='../view/ContactView.php';</script>";
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
