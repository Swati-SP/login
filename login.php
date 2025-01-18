<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #555;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php
        include("connect.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            // Check if the user exists in the database
            $sql = "SELECT * FROM user WHERE username = '$username' OR email = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                // User exists, check password
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    // Login successful, redirect based on role
                    if ($user['role'] == 'user') {
                        header("Location: users/dashboard.php");
                        exit();
                    } elseif ($user['role'] == 'admin') {
                        header("Location: admin/dashboard.php");
                        exit();
                    }
                } else {
                    // Incorrect password
                    echo "<div class='message'>Invalid password!</div>";
                }
            } else {
                // User not found
                echo "<div class='message'>Username or email not found!</div>";
            }

            // Close the database connection
            $conn->close();
        }
        ?>

        <!-- Login form -->
        <form action="login.php" method="post">
            <label for="username">Username or Email:</label>
            <input type="text" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
