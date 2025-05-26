<?php
session_start();
$error_message = $_SESSION['login_error'] ?? 'Login failed. Please try again.';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #121212;
        }

        .error-container {
            text-align: center;
            padding: 30px;
            background-color: #1e1e1e;
            border-radius: 10px;
            border: 1px solid #333;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .error-icon {
            color: #ff5555;
            font-size: 50px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #04aa6d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
      <script>
        setTimeout(() => {
            window.location.href = "index.html";
        }, 1000);
    </script>
</head>

<body>
    <div class="error-container" style="color: white;">
        <div class="error-icon">✗</div>
        <h1>Login Failed</h1>
        <p><?php echo htmlspecialchars($error_message); ?></p>
        <a href="index.html" class="btn">Try Again</a>
    </div>
</body>

</html>
<?php

?>