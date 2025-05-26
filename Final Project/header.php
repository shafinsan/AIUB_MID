<?php
session_start();
if (empty($_SESSION['fullname'])) {
    header("Location: index.html");
}

if (isset($_GET['logout'])) {
    session_unset();        
    session_destroy();      
    header("Location: index.html"); 
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_color']) && isset($_POST['color'])) {
    $color = $_POST['color'];
    $userId = $_SESSION['user_id'];
    setcookie($userId, $color);
    $_SESSION['theme_color'] = $color;
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding-top: 70px;
            /* To prevent header overlap */
        }

        .header {
            background-color: #ffffff;
            color: #333;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .user-info span {
            font-weight: 500;
            font-size: 16px;
        }

        .color-picker {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .color-picker form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .color-picker span {
            font-size: 14px;
            color: #555;
        }

        .color-picker input[type="color"] {
            width: 28px;
            height: 28px;
            border: none;
            cursor: pointer;
            background: none;
            padding: 0;
        }

        .logout-btn {
            padding: 6px 12px;
            background-color: #e53935;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="user-info">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['fullname'] ?? 'User'); ?></span>
        </div>

        <div class="color-picker">
            <form method="post">
                <span>Theme:</span>
                <input type="color" name="color" value="<?php echo htmlspecialchars($currentColor); ?>"
                    onchange="this.form.submit()" />
                <input type="hidden" name="change_color" value="1" />
            </form>
      
            <a href="?logout=1" class="logout-btn">Logout</a>
        </div>
    </header>
</body>

</html>