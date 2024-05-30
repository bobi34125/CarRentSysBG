<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
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
        }

        h2, h3 {
            color: #333;
        }

        .car-details-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .car-details-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .car-details-info {
            padding: 20px;
        }

        .gallery-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .thumbnail {
            width: 100px;
            height: 75px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            transition: transform 0.2s ease-in-out;
        }

        .thumbnail:hover, .car-details-image:hover {
            transform: scale(1.1);
        }

        .extras-section {
            margin-top: 20px;
        }

        .extras-section strong {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .extras-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .extras-list li {
            margin-bottom: 5px;
        }

        a {
            display: inline-block;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h2>Car Details</h2>
    </header>

    <div class="car-details-container">
        <?php
        // Include the database connection file
        include 'dbcon.php';

        // Get car details from the database based on car_id
        if (isset($_GET['car_id'])) {
            $car_id = $_GET['car_id'];
            $sql = "SELECT * FROM automobiles WHERE id = $car_id";
            $result = $conn->query($sql);
            $carDetails = $result->fetch_assoc();
        }
        ?>

        <?php if (!empty($carDetails)) : ?>
            <img class="car-details-image" src="<?php echo $carDetails['image']; ?>" alt="<?php echo $carDetails['name']; ?>">
            <div class="car-details-info">
                <h3><?php echo $carDetails['name']; ?></h3>
                <p>Fuel Type: <?php echo $carDetails['fuel_type']; ?></p>
                <p>Engine Type: <?php echo $carDetails['engine_type']; ?></p>
                <p>Horsepower: <?php echo $carDetails['horsepower']; ?></p>
                <p>Width: <?php echo $carDetails['width']; ?></p>
                <p>Length: <?php echo $carDetails['length']; ?></p>
                <p>Height: <?php echo $carDetails['height']; ?></p>

                <!-- Extras -->
                <?php
                $extras = explode(',', $carDetails['extras']);
                if (!empty($extras)) {
                    echo '<div class="extras-section">
                            <strong>Extras:</strong>
                            <ul class="extras-list">';
                    
                    foreach ($extras as $extra) {
                        echo '<li>' . trim($extra) . '</li>';
                    }

                    echo '</ul></div>';
                }
                ?>
            </div>

            <!-- Image gallery thumbnails -->
            <div class="gallery-container">
                <?php
                // Fetch additional images from the database based on car_id
                $additionalImages = ["image1.jpg", "image2.jpg", "image3.jpg"]; // Replace with actual image URLs

                foreach ($additionalImages as $thumbnail) {
                    echo '<img class="thumbnail" src="' . $thumbnail . '" alt="Thumbnail">';
                }
                ?>
            </div>
        <?php else : ?>
            <p>No car details available.</p>
        <?php endif; ?>

        <a href="rental_form.php">Rent Now</a>
    </div>
</body>
</html>

