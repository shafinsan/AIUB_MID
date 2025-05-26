<?php
session_start();
if (!isset($_SESSION['form_data'])) {
    header("Location: index.html");
    exit();
}
$formData = $_SESSION['form_data'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .confirmation-container {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 10px;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: #04aa6d;
            text-align: center;
            margin-bottom: 20px;
        }

        .data-display {
            margin-bottom: 30px;
        }

        .data-row {
            display: flex;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }

        .data-label {
            font-weight: bold;
            width: 150px;
            color: #b0b0b0;
        }

        .data-value {
            flex: 1;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-confirm {
            background-color: #04aa6d;
            color: white;
        }

        .btn-confirm:hover {
            background-color: #038e5e;
        }

        .btn-cancel {
            background-color: #444;
            color: white;
        }

        .btn-cancel:hover {
            background-color: #333;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #04aa6d;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <div class="confirmation-container">
        <h1>Confirm Your Registration</h1>

        <div class="data-display">
            <div class="data-row">
                <div class="data-label">Full Name:</div>
                <div class="data-value"><?php echo htmlspecialchars($formData['fullname']); ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Email:</div>
                <div class="data-value"><?php echo htmlspecialchars($formData['email']); ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Date of Birth:</div>
                <div class="data-value"><?php echo htmlspecialchars($formData['dob']); ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Country:</div>
                <div class="data-value"><?php echo htmlspecialchars($formData['country']); ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Gender:</div>
                <div class="data-value"><?php echo htmlspecialchars($formData['gender']); ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Favorite Color:</div>
                <div class="data-value">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: <?php echo htmlspecialchars($formData['color']); ?>; border: 1px solid #333;"></span>
                    <?php echo htmlspecialchars($formData['color']); ?>
                </div>
            </div>
            <div class="data-row">
                <div class="data-label">Opinion:</div>
                <div class="data-value"><?php echo nl2br(htmlspecialchars($formData['opinion'])); ?></div>
            </div>
        </div>

        <form action="finalize_registration.php" method="POST" class="button-group">
            <button type="submit" class="btn btn-confirm">Confirm Registration</button>
            <a href="index.html" class="btn btn-cancel">Cancel</a>
        </form>
    </div>
</body>

</html>