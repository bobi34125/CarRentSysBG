<?php
include 'dbcon.php';

// Function to retrieve all automobiles
function getAutomobiles() {
    global $conn;
    $sql = "SELECT * FROM automobiles";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to add a new automobile with an image
function addAutomobile($name, $fuel_type, $engine_type, $horsepower, $width, $length, $height, $extras, $image) {
    global $conn;

    // Upload image to a directory on your server
    $targetDirectory = "images/";
    $targetFile = $targetDirectory . basename($image["name"]);

    // Check if the image file already exists
    if (file_exists($targetFile)) {
        return false; // You can handle this case according to your needs
    }

    // Move the uploaded image to the target directory
    move_uploaded_file($image["tmp_name"], $targetFile);

    // Insert automobile details, including the image file name in the database
    $sql = "INSERT INTO automobiles (name, fuel_type, engine_type, horsepower, width, length, height, weight, extras, image)
            VALUES ('$name', '$fuel_type', '$engine_type', $horsepower, $width, $length, $height, $weight, '$extras', '$targetFile')";
    return $conn->query($sql);
}

// Function to get details of a specific automobile
function getAutomobileDetails($id) {
    global $conn;
    $sql = "SELECT * FROM automobiles WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Example usage for adding an automobile with an image
// Assuming you have a form with enctype="multipart/form-data" for file uploads
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $fuel_type = $_POST["fuel_type"];
    $engine_type = $_POST["engine_type"];
    $horsepower = $_POST["horsepower"];
    $width = $_POST["width"];
    $length = $_POST["length"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $extras = $_POST["extras"];
    $image = $_FILES["image"]; // Assuming the file input is named "image"

    if (addAutomobile($name, $fuel_type, $engine_type, $horsepower, $width, $length, $height, $extras, $image)) {
        echo "Automobile added successfully.";
    } else {
        echo "Failed to add automobile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Automobile Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container form label {
            margin-bottom: 5px;
            color: #333;
        }
        .form-container form input,
        .form-container form textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container form button {
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Automobile</h2>
        <form action="add_automobile.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="fuel_type">Fuel Type:</label>
            <input type="text" name="fuel_type" required>

            <label for="engine_type">Engine Type:</label>
            <input type="text" name="engine_type" required>

            <label for="horsepower">Horsepower:</label>
            <input type="number" name="horsepower" required>

            <label for="width">Width:</label>
            <input type="number" name="width" required>

            <label for="length">Length:</label>
            <input type="number" name="length" required>

            <label for="height">Height:</label>
            <input type="number" name="height" required>
            
            <label for="weight">Weight:</label>
            <input type="number" name="weight" required>

            <label for="extras">Extras:</label>
            <textarea name="extras"></textarea>

            <label for="image">Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Add Automobile</button>
        </form>
    </div>
</body>
</html>
