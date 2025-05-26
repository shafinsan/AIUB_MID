<?php
include("dataBase.php");
include("header.php");

if (empty($_POST["cities"])) {
    header("Location: request.php");
}
if (!isset($_POST["submit"]) && count($_POST["cities"]) < 10) {
    header("Location: request.php");
} else {

    $defaultBgColor = "black";
    $bgColor = !empty($_COOKIE[$_SESSION['user_id']]) ? $_COOKIE[$_SESSION['user_id']] : $defaultBgColor;

    

    function getBrightness($hex)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return (0.299 * $r + 0.587 * $g + 0.114 * $b);
    }


    $bgBrightness = getBrightness($bgColor);
    $textColor = ($bgBrightness > 128) ? '#333333' : '#ffffff';
    $tableBgColor = ($bgBrightness > 128) ? '#ffffff' : '#333333';
    $tableTextColor = ($bgBrightness > 128) ? '#333333' : '#ffffff';
    $borderColor = ($bgBrightness > 128) ? '#dddddd' : '#555555';
    $headerBgColor = ($bgBrightness > 128) ? '#4CAF50' : '#2E7D32';

    if (!empty($_POST["cities"])) {
        $dataArray = [];

        foreach ($_POST["cities"] as $id) {
            $sql = "SELECT * FROM aqi_info WHERE id = $id";
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $dataArray[] = $row;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            background-color: <?php echo $bgColor; ?>;
            color: <?php echo $textColor; ?>;
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            color: <?php echo $textColor; ?>;
            text-align: center;
            background-color: <?php echo $bgColor; ?>;
            padding: 10px;
            border-radius: 5px;
            color: <?php echo $bgColor == 'white' || $bgColor != 'black' ? 'black' : 'white'; ?>;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid <?php echo $borderColor; ?>;
            background-color: <?php echo $tableBgColor; ?>;
            color: <?php echo $tableTextColor; ?>;
        }

        th {
            background-color: <?php echo $headerBgColor; ?>;
            color: white;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background-color: <?php echo ($bgBrightness > 128) ? '#f5f5f5' : '#444444'; ?> !important;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background: <?php echo $headerBgColor; ?>;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        .back-btn:hover {
            background: <?php echo ($bgBrightness > 128) ? '#45a049' : '#1B5E20'; ?>;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Information Table</h1>

        <?php if (!empty($dataArray)): ?>
            <table>
                <thead>
                    <tr>
                        <th style="display: none;">ID</th>
                        <th>City Name</th>
                        <th>Country</th>
                        <th>AQI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataArray as $city): ?>
                        <tr>
                            <td style="display: none;"><?php echo ($city['id']); ?></td>
                            <td><?php echo ($city['city_name']); ?></td>
                            <td><?php echo ($city['country']); ?></td>
                            <td><?php echo ($city['aqi_number']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No city data available. Please go back and select at least 10 cities.</p>
        <?php endif; ?>

        <a href="request.php" class="back-btn">Back to City Selection</a>
    </div>
</body>

</html>