<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "db-aqi";

try {
    $con = mysqli_connect($server, $user, $pass, $dbname);
    if (!$con) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>