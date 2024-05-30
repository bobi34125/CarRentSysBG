<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Information</title>
      <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .no-data {
            text-align: center;
            color: #999;
        }

        /* Responsive Styling */
        @media screen and (max-width: 600px) {
            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rental Information</h2>

        <?php
        // Include your database connection file
        include 'dbcon.php';

        // Fetch and display rental information
        $sql = "SELECT rentals.*, automobiles.name AS car_name FROM rentals
                INNER JOIN automobiles ON rentals.automobile_id = automobiles.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>
                    <tr>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>CarID</th>
                        <th>Car</th>
                        <th>Pickup Location</th>
                        <th>Rental Start Date</th>
                        <th>Rental End Date</th>
                        <th>Rental Days</th>
                        <th>Return Location</th>
                    </tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row["customer_name"] . '</td>
                        <td>' . $row["customer_phone"] . '</td>
                        <td>' . $row["customer_email"] . '</td>
                        <td>' . $row["automobile_id"] . '</td>
                        <td>' . $row["car_name"] . '</td>
                        <td>' . $row["pickup_location"] . '</td>
                        <td>' . $row["rental_start_date"] . '</td>
                        <td>' . $row["rental_end_date"] . '</td>
                        <td>' . $row["rental_days"] . '</td>
                        <td>' . $row["return_location"] . '</td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo '<p class="no-data">No rental information available</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
