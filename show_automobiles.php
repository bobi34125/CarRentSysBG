<?php
include 'dbcon.php'; // Make sure to include your database connection file

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Automobiles</title>
    <style>
        /* Add some basic styling for better presentation */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Available Automobiles</h2>
    
    <?php if (!empty($automobiles)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Fuel Type</th>
                    <th>Engine Type</th>
                    <th>Horsepower</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Height</th>
                    <th>Extras</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($automobiles as $automobile) : ?>
                    <tr>
                        <td><?php echo $automobile['id']; ?></td>
                        <td><?php echo $automobile['name']; ?></td>
                        <td><?php echo $automobile['fuel_type']; ?></td>
                        <td><?php echo $automobile['engine_type']; ?></td>
                        <td><?php echo $automobile['horsepower']; ?></td>
                        <td><?php echo $automobile['width']; ?></td>
                        <td><?php echo $automobile['length']; ?></td>
                        <td><?php echo $automobile['height']; ?></td>
                        <td><?php echo $automobile['extras']; ?></td>
                        <td>
                         
    <img src="images/<?php echo $automobile['image']; ?>" alt="<?php echo $automobile['name']; ?>">
</td>


                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No automobiles available.</p>
    <?php endif; ?>
</body>
</html>