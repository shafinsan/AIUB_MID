<?php
session_start();
include("dataBase.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Email and password are required";
        header("Location: login_fail.php");
        exit;
    }
    
    try {
        $query = "SELECT id, email,fullname, password FROM users WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . mysqli_error($con));
        }
        
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['logged_in'] = true;
            
            header("Location: login_success.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Invalid email or password";
            header("Location: login_fail.php");
            exit;
        }
    } catch(Exception $e) {
        $_SESSION['login_error'] = "Database error: " . $e->getMessage();
        header("Location: login_fail.php");
        exit;
    } finally {
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }
    }
} else {
    header("Location: index.html");
    exit;
}
?>