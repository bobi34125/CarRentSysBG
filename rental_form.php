<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        select,
        input[type="date"],
        input[type="number"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Rent a Car</h2>

    <form action="process_rental.php" method="post">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" required>

        <label for="customer_phone">Phone:</label>
        <input type="tel" name="customer_phone" required>

        <label for="customer_email">Email:</label>
        <input type="email" name="customer_email" required>

        <label for="automobile_id">Select Car:</label>
        <select name="automobile_id" required>
            <?php
            // Fetch and display available cars from the database
            include 'dbcon.php';

            $sql = "SELECT id, name FROM automobiles";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                }
            } else {
                echo '<option value="" disabled>No cars available</option>';
            }

            $conn->close();
            ?>
        </select>

        <label for="pickup_location">Pickup Location:</label>
        <input type="text" name="pickup_location" required>

        <label for="rental_start_date">Rental Start Date:</label>
        <input type="date" name="rental_start_date" required>

        <label for="rental_days">Rental Days:</label>
        <input type="number" name="rental_days" required>

        <label for="rental_end_date">Rental End Date:</label>
        <input type="date" name="rental_end_date">

        <label for="return_location">Return Location:</label>
        <input type="text" name="return_location" required>

        <button type="submit">Submit Rental</button>
    </form>

    <script>
        // JavaScript to calculate and set the Rental End Date based on start date and rental days
        document.querySelector('input[name="rental_days"]').addEventListener('input', function () {
            const startDate = new Date(document.querySelector('input[name="rental_start_date"]').value);
            const rentalDays = parseInt(this.value);

            if (!isNaN(startDate.getTime()) && !isNaN(rentalDays)) {
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + rentalDays);

                const endDateInput = document.querySelector('input[name="rental_end_date"]');
                endDateInput.value = endDate.toISOString().split('T')[0];
            }
        });
    </script>
</body>
</html>
