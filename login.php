<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container form input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-container form button {
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-container form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login_process.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        <a href ="register_process.php"> Register here </a></form>
    </div>
</body>
</html>
