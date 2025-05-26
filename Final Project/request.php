<?php
include("dataBase.php");
include("header.php");


if (empty($_SESSION['user_id']) || empty($_SESSION['user_email'])) {
    header("Location: index.html");
}

$query = "SELECT id, city_name FROM aqi_info ORDER BY city_name";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error fetching cities: " . mysqli_error($con));
}

$cities = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Cities for AQI Comparison</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1 {
            color: #333;
        }

        .city-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin: 20px 0;
        }

        .city-item {
            padding: 10px;
            background: #f5f5f5;
            border-radius: 5px;
        }

        .error {
            color: red;
            background: #ffebeb;
            margin: 0;
            padding: 0;
        }

        .selected-count {
            margin: 10px 0;
            font-weight: bold;
        }

        button {
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #45a049;
        }
    </style>
</head>


<body>
    <div class="container">
        <h1>Select Cities for AQI Comparison</h1>
        <p>Please select at least 10 cities</p>

        <form action="showAqi.php" method="post">
            <div class="city-grid">
                <?php foreach ($cities as $city): ?>
                    <div class="city-item">
                        <input type="checkbox" name="cities[]" value="<?php echo $city['id']; ?>" class="city-checkbox">
                        <label>
                            <?php echo $city['city_name'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="selected-count">Selected: <span id="count">0</span> cities</div>
            <div id="error-message" class="error"></div>

            <button type="submit" value="submit" onsubmit="return validateSelection()">Submit</button>
        </form>
    </div>

    <script>
        // Update selected count
        const checkboxes = document.querySelectorAll('.city-checkbox');
        const countDisplay = document.getElementById('count');

        function updateSelectedCount() {
            const selected = document.querySelectorAll('.city-checkbox:checked').length;
            countDisplay.textContent = selected;

        }
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
            checkbox.addEventListener('change', validateSelection);
        });

        function validateSelection() {
            const selected = document.querySelectorAll('.city-checkbox:checked').length;
            console.log(selected)
            if (selected < 10) {
                console.log("hi")
                document.getElementById('error-message').style.display = "block";
                document.getElementById('error-message').style.margin = "6px 4px 6px 4px";
                document.getElementById('error-message').style.padding = "6px 4px 6px 4px";
                document.getElementById('error-message').style.border = "1px solid #ffb3b3;";
                document.getElementById('error-message').textContent =
                    `Please select at least 10 cities to proceed. You have selected ${selected}.`;
                return false;

            } else {
                console.log("hi")
                document.getElementById('error-message').style.margin = "0px";
                document.getElementById('error-message').style.padding = "0px";
                document.getElementById('error-message').style.border = "none";
                document.getElementById('error-message').textContent = ``;
                document.getElementById('error-message').style.display = 'none';
                return true;
            }


        }
        updateSelectedCount();
        validateSelection();
    </script>
</body>

</html>