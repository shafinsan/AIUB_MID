<?php

session_start();


if (!isset($_SESSION['form_data'])) {
    header("Location: index.html");
    exit();
}

$formData = $_SESSION['form_data'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db-aqi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $checkStmt->bindParam(':email', $formData['email']);
    $checkStmt->execute();
    
    if ($checkStmt->rowCount() > 0) {
        $_SESSION['registration_error'] = "This email is already registered";
        header("Location: userExists.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, dob, country, gender, color, opinion, terms) 
                           VALUES (:fullname, :email, :password, :dob, :country, :gender, :color, :opinion, :terms)");

    $stmt->bindParam(':fullname', $formData['fullname']);
    $stmt->bindParam(':email', $formData['email']);
    $stmt->bindParam(':password', password_hash($formData['password'], PASSWORD_DEFAULT));
    $stmt->bindParam(':dob', $formData['dob']);
    $stmt->bindParam(':country', $formData['country']);
    $stmt->bindParam(':gender', $formData['gender']);
    $stmt->bindParam(':color', $formData['color']);
    $stmt->bindParam(':opinion', $formData['opinion']);
    $terms = isset($formData['terms']) ? 1 : 0;
    $stmt->bindParam(':terms', $terms);

    $stmt->execute();

    unset($_SESSION['form_data']);
    $_SESSION['registration_success'] = true;

  
    header("Location: registrationSuccessfull.php");
    exit();
} catch (PDOException $e) {
    $_SESSION['registration_error'] = "Registration failed: " . $e->getMessage();
    header("Location: registrationFail.php");
    exit();
}
