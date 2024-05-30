<?php
session_start();
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
        .admin-container {
            padding: 20px;
        }
        .admin-container h2 {
            color: #333;
        }
        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px;
            background-color: #ff4b5c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <h2>Admin Panel</h2>
        <form action="admin_logout.php" method="post" style="position: absolute; top: 10px; right: 10px;">
            <button class="logout-button" type="submit">Logout</button>
        </form>
    </header>
    <div class="admin-container">
        <h2>Welcome, <?php echo $_SESSION['admin_username']; ?></h2>
        
       <br><a href="automobiles.php"> Add car to the system </a>
<br><a href="display_rents.php"> View orders</a>
    </div>
</body>
</html>

