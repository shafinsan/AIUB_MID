<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form_data'] = $_POST;
    header("Location: confirmation.php");
    exit();
} else {
    header("Location: index.html");
    exit();
}
?>