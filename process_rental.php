<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .message-container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            color: #4CAF50;
        }

        .error-message {
            color: #F44336;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php
        include 'dbcon.php';

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        function rentAutomobile($customer_name, $customer_phone, $customer_email, $pickup_location, $automobile_id , $rental_start_date, $rental_end_date, $rental_days, $return_location) {
            global $conn;

            $sql = "INSERT INTO rentals (customer_name, customer_phone, customer_email, automobile_id, pickup_location, rental_start_date, rental_end_date, rental_days, return_location)
                VALUES ('$customer_name', '$customer_phone', '$customer_email', '$automobile_id', '$pickup_location', '$rental_start_date', '$rental_end_date', $rental_days, '$return_location')";


            return $conn->query($sql);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $customer_name = $_POST["customer_name"];
            $customer_phone = $_POST["customer_phone"]; // Corrected field name
            $customer_email = $_POST["customer_email"]; // Corrected field name
            $automobile_id = $_POST["automobile_id"];
            $pickup_location = $_POST["pickup_location"];
            $rental_start_date = $_POST["rental_start_date"];
            $rental_end_date = $_POST["rental_end_date"];
            $rental_days = $_POST["rental_days"];
            $return_location = $_POST["return_location"];

            if (rentAutomobile($customer_name, $customer_phone, $customer_email, $pickup_location, $automobile_id, $rental_start_date, $rental_end_date, $rental_days, $return_location)) {
                echo '<p class="success-message">Rental submitted successfully.</p>';
            } else {
                echo '<p class="error-message">Failed to submit rental. Error: ' . mysqli_error($conn) . '</p>';
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
