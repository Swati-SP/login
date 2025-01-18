<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-container {
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
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <?php
        // Database connection
        include("connect.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $user = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
            $role = mysqli_real_escape_string($conn, $_POST['role']);

            // Check if the email or username already exists
            $check_sql = "SELECT * FROM user WHERE email = '$email' OR username = '$user'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows > 0) {
                echo "<script>alert('Username or Email already exists!');</script>";
            } else {
                // Insert data into the database
                $sql = "INSERT INTO user (username, email, password, role) VALUES ('$user', '$email', '$pass', '$role')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Registration successful! Please login to continue.');</script>";
                } else {
                    echo "<script>alert('Error: Unable to register. Please try again.');</script>";
                }
            }

            // Close the database connection
            $conn->close();
        }
        ?>

        <!-- Signup form -->
        <form action="signup.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Role:</label>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
