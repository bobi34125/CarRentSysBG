<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            position: relative;
        }

        h2 {
            color: #fff;
            margin: 0;
        }

        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4b5c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #e0444f;
        }

        .car-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .car-card {
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin: 15px;
            width: 300px;
            transition: transform 0.3s ease-in-out;
        }

        .car-card:hover {
            transform: scale(1.05);
        }

        .car-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .car-details {
            padding: 15px;
            text-align: center;
        }

        .rent-button, .view-details-button {
            display: inline-block;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .rent-button {
            background-color: #4CAF50;
        }

        .rent-button:hover {
            background-color: #45a049;
        }

        .view-details-button {
            background-color: #3498db;
        }

        .view-details-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <h2>Available Cars</h2>
        <form action="user_logout.php" method="post" style="position: absolute; top: 10px; right: 10px;">
            <button class="logout-button" type="submit">Logout</button>
        </form>
    </header>

    <?php
    // Include the database connection file
    include 'dbcon.php';

    // Function to retrieve all automobiles
    function getAutomobiles() {
        global $conn;
        $sql = "SELECT * FROM automobiles";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all automobiles from the database
    $automobiles = getAutomobiles();
    ?>

    <div class="car-container">
        <?php foreach ($automobiles as $automobile) : ?>
            <div class="car-card">
                <?php
                $imagePath = "{$automobile['image']}";

                if (file_exists($imagePath)) {
                    echo "<img class='car-image' src='{$imagePath}' alt='{$automobile['name']}'>";
                } else {
                    echo "<p class='error'>Image not found: {$imagePath}</p>";
                }
                ?>
                <div class="car-details">
                    <h3><?php echo $automobile['name']; ?></h3>
                    <p>Fuel Type: <?php echo $automobile['fuel_type']; ?></p>
                    <p>Engine Type: <?php echo $automobile['engine_type']; ?></p>
                    <p>Horsepower: <?php echo $automobile['horsepower']; ?></p>
                    <p>Width: <?php echo $automobile['width']; ?></p>
                    <p>Length: <?php echo $automobile['length']; ?></p>
                    <p>Height: <?php echo $automobile['height']; ?></p>
                    
                    <a href="car_details.php?car_id=<?php echo $automobile['id']; ?>" class="view-details-button">View Details</a>
                    <a href="rental_form.php" class="rent-button">Rent Now</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

