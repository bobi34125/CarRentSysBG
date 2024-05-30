<?php
include 'dbcon.php'; // Make sure to include your database connection file

// Function to add a new automobile with an image
function addAutomobile($name, $fuel_type, $engine_type, $horsepower, $width, $length, $height, $weight, $extras, $image) {
    global $conn;

    // Upload image to a directory on your server
    $targetDirectory = "images/";
    $targetFile = $targetDirectory . basename($image["name"]);

    // Check if the image file already exists
    if (file_exists($targetFile)) {
        return "Error: Image file already exists.";
    }

    // Move the uploaded image to the target directory
    if (!move_uploaded_file($image["tmp_name"], $targetFile)) {
        return "Error: Failed to move the uploaded image.";
    }

    // Insert automobile details, including the image file name in the database
    $sql = "INSERT INTO automobiles (name, fuel_type, engine_type, horsepower, width, length, height, weight, extras, image)
            VALUES ('$name', '$fuel_type', '$engine_type', '$horsepower', '$width', '$length', '$height', '$weight', '$extras', '$targetFile')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Process the form submission
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

    // Add the automobile to the database
    $result = addAutomobile($name, $fuel_type, $engine_type, $horsepower, $width, $length, $height, $weight, $extras, $image);

    if ($result === true) {
        echo "Automobile added successfully.";
    } else {
        echo "Failed to add automobile. Error: " . $result;
    }
}
?>
