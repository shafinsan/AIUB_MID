<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Successful</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #d4edda;
            color: #155724;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .message-box {
            background-color: #ffffff;
            border: 2px solid #c3e6cb;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message-box h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .message-box p {
            font-size: 16px;
        }
    </style>
    <script>
        setTimeout(() => {
            window.location.href = "index.html";
        }, 1000);
    </script>
</head>

<body>
    <div class="message-box">
        <h1>✅ Registration Successful</h1>
        <p>Redirecting to home...</p>
    </div>
</body>

</html>