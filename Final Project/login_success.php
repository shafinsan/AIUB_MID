<?php
session_start();
include("dataBase.php");

if (!isset($_SESSION['logged_in'])) {
    header("Location: index.html");
    exit;
}


$user_id = $_SESSION['user_id'];
$query = "SELECT fullname,color FROM users WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user_data = mysqli_fetch_assoc($result);
setcookie($user_id, $user_data['color']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #121212;
            color: #e0e0e0;
        }

        .success-container {
            text-align: center;
            padding: 30px;
            background-color: #1e1e1e;
            border-radius: 10px;
            border: 1px solid #333;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .success-icon {
            color: #04aa6d;
            font-size: 50px;
            margin-bottom: 20px;
        }
    </style>
    <script>
        setTimeout(() => {
            window.location.href = "request.php";
        }, 1000);
    </script>
</head>

<body>
    <div class="success-container">
        <div class="success-icon">✓</div>
        <h1>Welcome, <?php echo htmlspecialchars($user_data['fullname'] ?? 'User'); ?>!</h1>
        <p>Login successful. Redirecting to dashboard...</p>
       
    </div>
</body>

</html>
<?php
mysqli_stmt_close($stmt);
exit;
?>