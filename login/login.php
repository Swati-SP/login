<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php
         include('../connect.php');

        // Start session to store username
        session_start();

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
                    // Store username in session for later use
                    $_SESSION['username'] = $user['username'];

                    // Redirect based on user role
                    if ($user['role'] == 'user') {
                        // Redirect to user dashboard with username passed
                        header("Location: /../users/dashboard.php?username=" . urlencode($user['username']));
                        exit();
                    } elseif ($user['role'] == 'admin') {
                        // Redirect to admin dashboard with username passed
                        header("Location: /swatiprograms/admin/dashboard.php?username=" . urlencode($user['username']));
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
